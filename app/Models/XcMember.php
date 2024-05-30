<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $num
 * @property int      $resetpass
 * @property string   $uid
 * @property string   $signtype
 * @property string   $photo
 * @property string   $passwd
 * @property string   $nickName
 * @property string   $mobile
 * @property string   $loginIp
 * @property string   $email
 * @property DateTime $regDate
 * @property DateTime $passUpDate
 * @property DateTime $lastLogin
 * @property boolean  $wronglogin
 * @property boolean  $isPush
 * @property boolean  $ismember
 * @property boolean  $isEmail
 * @property boolean  $isAuth
 */
class XcMember extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xc_member';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'num';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'signtype', 'resetpass', 'regDate', 'photo', 'passwd', 'passUpDate', 'wronglogin', 'nickName', 'mobile', 'loginIp', 'lastLogin', 'isPush', 'ismember', 'isEmail', 'isAuth', 'email'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'num' => 'int', 'uid' => 'string', 'signtype' => 'string', 'resetpass' => 'int', 'regDate' => 'datetime', 'photo' => 'string', 'passwd' => 'string', 'passUpDate' => 'datetime', 'wronglogin' => 'boolean', 'nickName' => 'string', 'mobile' => 'string', 'loginIp' => 'string', 'lastLogin' => 'datetime', 'isPush' => 'boolean', 'ismember' => 'boolean', 'isEmail' => 'boolean', 'isAuth' => 'boolean', 'email' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'regDate', 'passUpDate', 'lastLogin'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    // Scopes...

    // Functions ...

    // Relations ...
}
