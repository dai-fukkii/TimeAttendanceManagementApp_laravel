<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_log extends Model
{
    use HasFactory;

    protected $table = 'user_log';

    protected $fillable = ['user_id','username','status'];

}
