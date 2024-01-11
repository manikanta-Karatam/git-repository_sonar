<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_id',
        'user_name',
        'user_ip',
        'login_time',
        'logout_time',
        'status',
         ];
}
