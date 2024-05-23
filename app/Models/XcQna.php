<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $num
 * @property string   $contents
 * @property string   $email
 * @property string   $username
 * @property DateTime $regdate
 * @property boolean  $status
 */
class XcQna extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'xc_qna';

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
        'contents', 'email', 'regdate', 'status', 'username'
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
        'num' => 'int', 'contents' => 'string', 'email' => 'string', 'regdate' => 'datetime', 'status' => 'boolean', 'username' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'regdate'
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
