<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth;

use BadMethodCallException;
use Illuminate\Http\Request;
use Zs\Foundation\JWTAuth\Http\Parser\Parser;
use Zs\Foundation\JWTAuth\Contracts\JWTSubject;
use Zs\Foundation\JWTAuth\Support\CustomClaims;
use Zs\Foundation\JWTAuth\Exceptions\JWTException;

/**
 * Class JWT.
 */
class JWT
{
    use CustomClaims;

    /**
     * The authentication manager.
     *
     * @var \Zs\Foundation\JWTAuth\Manager
     */
    protected $manager;

    /**
     * The HTTP parser.
     *
     * @var \Zs\Foundation\JWTAuth\Http\Parser\Parser
     */
    protected $parser;

    /**
     * The token.
     *
     * @var \Zs\Foundation\JWTAuth\Token|null
     */
    protected $token;

    /**
     * JWT constructor.
     *
     * @param \Zs\Foundation\JWTAuth\Manager            $manager
     * @param \Zs\Foundation\JWTAuth\Http\Parser\Parser $parser
     */
    public function __construct(Manager $manager, Parser $parser)
    {
        $this->manager = $manager;
        $this->parser = $parser;
    }

    /**
     * Generate a token for a given subject.
     *
     * @param \Zs\Foundation\JWTAuth\Contracts\JWTSubject  $subject
     *
     * @return string
     */
    public function fromSubject(JWTSubject $subject)
    {
        $payload = $this->makePayload($subject);

        return $this->manager->encode($payload)->get();
    }

    /**
     * Alias to generate a token for a given user.
     *
     * @param \Zs\Foundation\JWTAuth\Contracts\JWTSubject  $user
     *
     * @return string
     */
    public function fromUser(JWTSubject $user)
    {
        return $this->fromSubject($user);
    }

    /**
     * Refresh an expired token.
     *
     * @param bool  $forceForever
     * @param bool  $resetClaims
     *
     * @return string
     */
    public function refresh($forceForever = false, $resetClaims = false)
    {
        $this->requireToken();

        return $this->manager->customClaims($this->getCustomClaims())
                             ->refresh($this->token, $forceForever, $resetClaims)
                             ->get();
    }

    /**
     * Invalidate a token (add it to the blacklist).
     *
     * @param bool  $forceForever
     *
     * @return $this
     */
    public function invalidate($forceForever = false)
    {
        $this->requireToken();

        $this->manager->invalidate($this->token, $forceForever);

        return $this;
    }

    /**
     * Alias to get the payload, and as a result checks that
     * the token is valid i.e. not expired or blacklisted.
     *
     * @throws \Zs\Foundation\JWTAuth\Exceptions\JWTException
     *
     * @return \Zs\Foundation\JWTAuth\Payload
     */
    public function checkOrFail()
    {
        return $this->getPayload();
    }

    /**
     * Check that the token is valid.
     *
     * @param bool  $getPayload
     *
     * @return \Zs\Foundation\JWTAuth\Payload|bool
     */
    public function check($getPayload = false)
    {
        try {
            $payload = $this->checkOrFail();
        } catch (JWTException $e) {
            return false;
        }

        return $getPayload ? $payload : true;
    }

    /**
     * Get the token.
     *
     * @return \Zs\Foundation\JWTAuth\Token|false
     */
    public function getToken()
    {
        if (! $this->token) {
            try {
                $this->parseToken();
            } catch (JWTException $e) {
                return false;
            }
        }

        return $this->token;
    }

    /**
     * Parse the token from the request.
     *
     * @throws \Zs\Foundation\JWTAuth\Exceptions\JWTException
     *
     * @return $this
     */
    public function parseToken()
    {
        if (! $token = $this->parser->parseToken()) {
            throw new JWTException('The token could not be parsed from the request');
        }

        return $this->setToken($token);
    }

    /**
     * Get the raw Payload instance.
     *
     * @return \Zs\Foundation\JWTAuth\Payload
     */
    public function getPayload()
    {
        $this->requireToken();

        return $this->manager->decode($this->token);
    }

    /**
     * Alias for getPayload().
     *
     * @return \Zs\Foundation\JWTAuth\Payload
     */
    public function payload()
    {
        return $this->getPayload();
    }

    /**
     * Convenience method to get a claim value.
     *
     * @param string  $claim
     *
     * @return mixed
     */
    public function getClaim($claim)
    {
        return $this->payload()->get($claim);
    }

    /**
     * Create a Payload instance.
     *
     * @param \Zs\Foundation\JWTAuth\Contracts\JWTSubject  $subject
     *
     * @return \Zs\Foundation\JWTAuth\Payload
     */
    public function makePayload(JWTSubject $subject)
    {
        return $this->factory()->customClaims($this->getClaimsArray($subject))->make();
    }

    /**
     * Build the claims array and return it.
     *
     * @param \Zs\Foundation\JWTAuth\Contracts\JWTSubject  $subject
     *
     * @return array
     */
    protected function getClaimsArray(JWTSubject $subject)
    {
        return array_merge(
            $this->getClaimsForSubject($subject),
            $subject->getJWTCustomClaims(), // custom claims from JWTSubject method
            $this->customClaims // custom claims from inline setter
        );
    }

    /**
     * Get the claims associated with a given subject.
     *
     * @param \Zs\Foundation\JWTAuth\Contracts\JWTSubject  $subject
     *
     * @return array
     */
    protected function getClaimsForSubject(JWTSubject $subject)
    {
        return [
            'sub' => $subject->getJWTIdentifier(),
            'prv' => $this->hashProvider($subject),
        ];
    }

    /**
     * Hash the provider and return it.
     *
     * @param string|object  $provider
     *
     * @return string
     */
    protected function hashProvider($provider)
    {
        return sha1(is_object($provider) ? get_class($provider) : $provider);
    }

    /**
     * Check if the provider matches the one saved in the token.
     *
     * @param string|object  $provider
     *
     * @return bool
     */
    public function checkProvider($provider)
    {
        if (($prv = $this->payload()->get('prv')) === null) {
            return true;
        }

        return $this->hashProvider($provider) === $prv;
    }

    /**
     * Set the token.
     *
     * @param \Zs\Foundation\JWTAuth\Token|string  $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token instanceof Token ? $token : new Token($token);

        return $this;
    }

    /**
     * Unset the current token.
     *
     * @return $this
     */
    public function unsetToken()
    {
        $this->token = null;

        return $this;
    }

    /**
     * Ensure that a token is available.
     *
     * @throws \Zs\Foundation\JWTAuth\Exceptions\JWTException
     *
     * @return void
     */
    protected function requireToken()
    {
        if (! $this->token) {
            throw new JWTException('A token is required');
        }
    }

    /**
     * Set the request instance.
     *
     * @param \Illuminate\Http\Request  $request
     *
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->parser->setRequest($request);

        return $this;
    }

    /**
     * Get the Manager instance.
     *
     * @return \Zs\Foundation\JWTAuth\Manager
     */
    public function manager()
    {
        return $this->manager;
    }

    /**
     * Get the Parser instance.
     *
     * @return \Zs\Foundation\JWTAuth\Http\Parser\Parser
     */
    public function parser()
    {
        return $this->parser;
    }

    /**
     * Get the Payload Factory.
     *
     * @return \Zs\Foundation\JWTAuth\Factory
     */
    public function factory()
    {
        return $this->manager->getPayloadFactory();
    }

    /**
     * Get the Blacklist.
     *
     * @return \Zs\Foundation\JWTAuth\Blacklist
     */
    public function blacklist()
    {
        return $this->manager->getBlacklist();
    }

    /**
     * Magically call the JWT Manager.
     *
     * @param string  $method
     * @param array  $parameters
     *
     * @throws \BadMethodCallException
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (method_exists($this->manager, $method)) {
            return call_user_func_array([$this->manager, $method], $parameters);
        }

        throw new BadMethodCallException("Method [$method] does not exist.");
    }
}
