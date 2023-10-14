<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory,Sluggable,SoftDeletes;

    protected $fillable = ['name','description','image','slug','user_id','status','parent_id','tags'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function parent(){
        return $this->belongsTo($this,'parent_id');
    }

    public function children(){
        return $this->hasMany($this,'parent_id');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    protected $hidden = ['created_at','updated_at','deleted_at','status'];
}
