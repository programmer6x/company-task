<?php

namespace App\Http\Services\Campaign;

use App\Contract\CampaignRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CampaignRequest;

class CampaignService
{
    private CampaignRepositoryInterface $campaignRepository;
    public function __construct()
    {
        $this->campaignRepository = app()->make(CampaignRepositoryInterface::class);
    }

    private function getInputOFCampaigns(Request $request) : array
    {
        $inputs = $request->only([
            'message','user_id'
        ]);

        $inputs['user_id'] = Auth::id();

        return $inputs;
    }

    public function createCampaign(CampaignRequest $request)
    {
        return $this->campaignRepository->createCampaign($this->getInputOFCampaigns($request));
    }
}
