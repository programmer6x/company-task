<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'media';
    protected $guarded = ['id'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    protected $hidden = ['created_at','updated_at','deleted_at','status'];
}
