<?php

namespace App\Repositories;

use App\Contract\CampaignRepositoryInterface;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CampaignRepository implements CampaignRepositoryInterface
{
    public function returnAllCampaign(): Collection
    {
        $campaigns = Campaign::with('user')->get();
        return $campaigns;
    }

    public function createCampaign($campaignInputs): Campaign
    {
        return Campaign::create($campaignInputs);
    }

    public function createManyCampaign($campaign,$idsData)
    {
        return $campaign->campaignUsers()->createMany($idsData);
    }


    public function createCampaignViaCampaignUser($campaignMessage): Campaign
    {
        $campaignInputs['user_id'] = Auth::id();
        $campaign = Campaign::create([
            'message' => $campaignMessage,
            'user_id' => $campaignInputs['user_id']
        ]);

        return $campaign;
    }
}
