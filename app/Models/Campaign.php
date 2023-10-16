<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    protected $table = 'campaign';
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function campaignUsers()
    {
        return $this->hasMany(CampaignUser::class);
    }
}
