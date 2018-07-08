<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
namespace Zs\Foundation\Member;

use Zs\Foundation\Auth\User as Authenticatable;
use Zs\Foundation\JWTAuth\Contracts\JWTSubject;

/**
 * Class Member.
 */
class Member extends Authenticatable implements JWTSubject
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var string
     */
    protected $table = 'members';

    /**
     * Get member instance for passport.
     *
     * @param $name
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Zs\Foundation\Member\Member
     */
    public function findForPassport($name)
    {
        return $this->newQuery()->where('name', $name)->first();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
