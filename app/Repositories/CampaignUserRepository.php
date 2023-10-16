<?php

namespace App\Repositories;

use App\Contract\CampaignUserRepositoryInterface;
use App\Http\Resources\CampaignResource;
use App\Models\CampaignUser;
use Illuminate\Database\Eloquent\Collection;

class CampaignUserRepository implements CampaignUserRepositoryInterface
{
    public function returnAllCampaignUser()
    {
        $campaignUsers = CampaignUser::with('user','campaign')->get();
        return CampaignResource::collection($campaignUsers);
    }

    public function storeCampaignUser($campaignUserInputs,$campaignUser) : CampaignUser
    {
        $campaignUser = CampaignUser::create([
            'user_id' => $campaignUser->user_id,
            'campaign_id' => $campaignUserInputs['campaign_id'],
        ]);
        return $campaignUser;
    }


}
