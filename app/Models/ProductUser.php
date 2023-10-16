<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductUser extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'campain_users';
    protected $guarded = ['id'];
    protected $hidden = ['created_at','updated_at','deleted_at'];
}
