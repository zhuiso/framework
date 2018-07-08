<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\JWTAuth;

use Zs\Foundation\JWTAuth\Support\RefreshFlow;
use Zs\Foundation\JWTAuth\Support\CustomClaims;
use Zs\Foundation\JWTAuth\Exceptions\JWTException;
use Zs\Foundation\JWTAuth\Exceptions\TokenBlacklistedException;
use Zs\Foundation\JWTAuth\Contracts\Providers\JWT as JWTContract;

class Manager
{
    use CustomClaims, RefreshFlow;

    /**
     * The provider.
     *
     * @var \Zs\Foundation\JWTAuth\Contracts\Providers\JWT
     */
    protected $provider;

    /**
     * The blacklist.
     *
     * @var \Zs\Foundation\JWTAuth\Blacklist
     */
    protected $blacklist;

    /**
     * the payload factory.
     *
     * @var \Zs\Foundation\JWTAuth\Factory
     */
    protected $payloadFactory;

    /**
     * The blacklist flag.
     *
     * @var bool
     */
    protected $blacklistEnabled = true;

    /**
     * the persistent claims.
     *
     * @var array
     */
    protected $persistentClaims = [];

    /**
     * Constructor.
     *
     * @param \Zs\Foundation\JWTAuth\Contracts\Providers\JWT  $provider
     * @param \Zs\Foundation\JWTAuth\Blacklist  $blacklist
     * @param \Zs\Foundation\JWTAuth\Factory  $payloadFactory
     *
     * @return void
     */
    public function __construct(JWTContract $provider, Blacklist $blacklist, Factory $payloadFactory)
    {
        $this->provider = $provider;
        $this->blacklist = $blacklist;
        $this->payloadFactory = $payloadFactory;
    }

    /**
     * Encode a Payload and return the Token.
     *
     * @param \Zs\Foundation\JWTAuth\Payload  $payload
     *
     * @return \Zs\Foundation\JWTAuth\Token
     */
    public function encode(Payload $payload)
    {
        $token = $this->provider->encode($payload->get());

        return new Token($token);
    }

    /**
     * Decode a Token and return the Payload.
     *
     * @param \Zs\Foundation\JWTAuth\Token  $token
     * @param bool  $checkBlacklist
     *
     * @throws \Zs\Foundation\JWTAuth\Exceptions\TokenBlacklistedException
     *
     * @return \Zs\Foundation\JWTAuth\Payload
     */
    public function decode(Token $token, $checkBlacklist = true)
    {
        $payloadArray = $this->provider->decode($token->get());

        $payload = $this->payloadFactory
                        ->setRefreshFlow($this->refreshFlow)
                        ->customClaims($payloadArray)
                        ->make();

        if ($checkBlacklist && $this->blacklistEnabled && $this->blacklist->has($payload)) {
            throw new TokenBlacklistedException('The token has been blacklisted');
        }

        return $payload;
    }

    /**
     * Refresh a Token and return a new Token.
     *
     * @param \Zs\Foundation\JWTAuth\Token  $token
     * @param bool  $forceForever
     * @param bool  $resetClaims
     *
     * @return \Zs\Foundation\JWTAuth\Token
     */
    public function refresh(Token $token, $forceForever = false, $resetClaims = false)
    {
        $this->setRefreshFlow();

        $claims = $this->buildRefreshClaims($this->decode($token));

        if ($this->blacklistEnabled) {
            // Invalidate old token
            $this->invalidate($token, $forceForever);
        }

        // Return the new token
        return $this->encode(
            $this->payloadFactory->customClaims($claims)->make($resetClaims)
        );
    }

    /**
     * Invalidate a Token by adding it to the blacklist.
     *
     * @param \Zs\Foundation\JWTAuth\Token  $token
     * @param bool  $forceForever
     *
     * @throws \Zs\Foundation\JWTAuth\Exceptions\JWTException
     *
     * @return bool
     */
    public function invalidate(Token $token, $forceForever = false)
    {
        if (! $this->blacklistEnabled) {
            throw new JWTException('You must have the blacklist enabled to invalidate a token.');
        }

        return call_user_func(
            [$this->blacklist, $forceForever ? 'addForever' : 'add'],
            $this->decode($token, false)
        );
    }

    /**
     * Build the claims to go into the refreshed token.
     *
     * @param \Zs\Foundation\JWTAuth\Payload  $payload
     *
     * @return array
     */
    protected function buildRefreshClaims(Payload $payload)
    {
        // assign the payload values as variables for use later
        extract($payload->toArray());

        // persist the relevant claims
        return array_merge(
            $this->customClaims,
            compact($this->persistentClaims, 'sub', 'iat')
        );
    }

    /**
     * Get the Payload Factory instance.
     *
     * @return \Zs\Foundation\JWTAuth\Factory
     */
    public function getPayloadFactory()
    {
        return $this->payloadFactory;
    }

    /**
     * Get the JWTProvider instance.
     *
     * @return \Zs\Foundation\JWTAuth\Contracts\Providers\JWT
     */
    public function getJWTProvider()
    {
        return $this->provider;
    }

    /**
     * Get the Blacklist instance.
     *
     * @return \Zs\Foundation\JWTAuth\Blacklist
     */
    public function getBlacklist()
    {
        return $this->blacklist;
    }

    /**
     * Set whether the blacklist is enabled.
     *
     * @param bool  $enabled
     *
     * @return $this
     */
    public function setBlacklistEnabled($enabled)
    {
        $this->blacklistEnabled = $enabled;

        return $this;
    }

    /**
     * Set the claims to be persisted when refreshing a token.
     *
     * @param array  $claims
     *
     * @return $this
     */
    public function setPersistentClaims(array $claims)
    {
        $this->persistentClaims = $claims;

        return $this;
    }
}
