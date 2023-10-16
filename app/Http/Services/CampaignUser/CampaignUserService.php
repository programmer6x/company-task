<?php

namespace App\Http\Services\CampaignUser;

use App\Contract\CampaignRepositoryInterface;
use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use App\Models\CampaignUser;
use Illuminate\Http\Request;

class CampaignUserService
{
    private CampaignRepositoryInterface $repository;

    public function __construct(){
        $this->repository = app()->make(CampaignRepositoryInterface::class);
    }

    private function getIdsData(CampaignRequest $request, Campaign $campaign) {
        $ids = [];

        foreach ($request->user_ids as $user_id) {
            $ids[] = [
                'user_id' => $user_id,
                'campaign_id' => $campaign->id
            ];
        }

        return $ids;
    }

    public function storeIds(CampaignRequest $request, Campaign $campaign)
    {
        $idsData = $this->getIdsData($request, $campaign);
        $this->repository->createManyCampaign($campaign,$idsData);
    }
}


