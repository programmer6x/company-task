<?php

namespace App\Repositories;

use App\Contract\CampaignUserRepositoryInterface;
use App\Models\CampaignUser;
use Illuminate\Database\Eloquent\Collection;

class CampaignUserRepository implements CampaignUserRepositoryInterface
{
    public function returnAllCampaignUser() : Collection
    {
        $campaignUsers = CampaignUser::with('user','campaign')->get();
        return $campaignUsers;
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
