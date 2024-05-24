<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $num
 * @property int      $notice
 * @property int      $notviewmemo
 * @property int      $pnum
 * @property int      $step
 * @property int      $good
 * @property int      $bad
 * @property int      $cnt
 * @property int      $isdisp
 * @property int      $isimg
 * @property int      $level
 * @property int      $memo_cnt
 * @property DateTime $reg_date
 * @property DateTime $memo_date
 * @property DateTime $edit_date
 * @property string   $mobile
 * @property string   $multi
 * @property string   $name
 * @property string   $passwd
 * @property string   $subject
 * @property string   $thumb
 * @property string   $uid
 * @property string   $url
 * @property string   $videourl
 * @property string   $cate
 * @property string   $content
 * @property string   $email
 * @property string   $file_list
 * @property string   $fn_name1
 * @property string   $fn_name2
 * @property string   $attachfile
 * @property string   $gubun
 * @property string   $ip
 * @property boolean  $iswarning
 */
class Kboard extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'kboard';

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
        'reg_date', 'mobile', 'multi', 'name', 'notice', 'notviewmemo', 'passwd', 'pnum', 'point', 'memo_date', 'scrap_cnt', 'secret', 'step', 'subject', 'thumb', 'uid', 'url', 'videourl', 'good', 'bad', 'cate', 'cnt', 'content', 'edit_date', 'email', 'file_list', 'fn_name1', 'fn_name2', 'attachfile', 'gubun', 'html', 'ip', 'isdisp', 'isimg', 'iswarning', 'level', 'memo_cnt'
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
        'num' => 'int', 'reg_date' => 'datetime', 'mobile' => 'string', 'multi' => 'string', 'name' => 'string', 'notice' => 'int', 'notviewmemo' => 'int', 'passwd' => 'string', 'pnum' => 'int', 'memo_date' => 'datetime', 'step' => 'int', 'subject' => 'string', 'thumb' => 'string', 'uid' => 'string', 'url' => 'string', 'videourl' => 'string', 'good' => 'int', 'bad' => 'int', 'cate' => 'string', 'cnt' => 'int', 'content' => 'string', 'edit_date' => 'datetime', 'email' => 'string', 'file_list' => 'string', 'fn_name1' => 'string', 'fn_name2' => 'string', 'attachfile' => 'string', 'gubun' => 'string', 'ip' => 'string', 'isdisp' => 'int', 'isimg' => 'int', 'iswarning' => 'boolean', 'level' => 'int', 'memo_cnt' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'reg_date', 'memo_date', 'edit_date'
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
