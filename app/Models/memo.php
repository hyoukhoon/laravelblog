<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class memo extends Model
{
    use HasFactory;

    protected $fillable = [
        'pid', 'memo', 'userid', 'name', 'bid'
    ];
}
