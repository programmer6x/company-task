<?php

namespace App\Contract;

use Illuminate\Http\Request;

interface CampaignUserRepositoryInterface
{
    public function returnAllCampaignUser();
    public function storeCampaignUser($campaignUserInputs,$campaignUser);
}
