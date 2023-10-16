<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignUser extends Model
{
    use HasFactory,SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }

    protected $guarded = ['id'];
    protected $table = 'campaign_users';
    protected $hidden = ['created_at','updated_at','deleted_at'];

}
