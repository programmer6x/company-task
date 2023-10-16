<?php

namespace App\Contract;

use App\Models\Campaign;

interface CampaignRepositoryInterface
{
    public function returnAllCampaign();
    public function createCampaign($campaignInputs);
    public function createCampaignViaCampaignUser($campaignMessage);

    public function createManyCampaign(Campaign $campaign,$idsData);

}
