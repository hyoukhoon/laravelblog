<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * @property int      $num
 * @property int      $resetpass
 * @property boolean  $isAuth
 * @property boolean  $wronglogin
 * @property boolean  $isPush
 * @property boolean  $ismember
 * @property boolean  $isEmail
 * @property string   $email
 * @property string   $uid
 * @property string   $signtype
 * @property string   $photo
 * @property string   $passwd
 * @property string   $nickName
 * @property string   $mobile
 * @property string   $loginIp
 * @property DateTime $regDate
 * @property DateTime $lastLogin
 * @property DateTime $passUpDate
 */
class Member extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'num';

    public function setPasswordAttribute($value){
        $this->attributes['passwd'] = Hash::make($value);
    }

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'passwd', 'nickName', 'mobile', 'loginIp', 'lastLogin'
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
        'num' => 'int', 'isAuth' => 'boolean', 'email' => 'string', 'wronglogin' => 'boolean', 'uid' => 'string', 'signtype' => 'string', 'resetpass' => 'int', 'regDate' => 'datetime', 'photo' => 'string', 'passwd' => 'string', 'nickName' => 'string', 'mobile' => 'string', 'loginIp' => 'string', 'lastLogin' => 'datetime', 'isPush' => 'boolean', 'ismember' => 'boolean', 'isEmail' => 'boolean', 'passUpDate' => 'datetime'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'regDate', 'lastLogin', 'passUpDate'
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
