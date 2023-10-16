<?php

namespace App\Http\Controllers;

use App\Contract\CampaignRepositoryInterface;
use App\Http\Requests\CampaignRequest;
use App\Http\Services\Campaign\CampaignService;
use App\Http\Services\CampaignUser\CampaignUserService;
use App\Http\Services\Product\ProductService;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{

    public function __construct(readonly private CampaignRepositoryInterface $campaignRepository, readonly private CampaignService $campaignService, readonly private CampaignUserService $campaignUserService)
    {
    }
    public function index()
    {
        return $this->campaignRepository->returnAllCampaign();
    }

    public function store(CampaignRequest $request,Campaign $campaign)
    {
        $campaign = $this->campaignService->createCampaign($request);
        $this->campaignUserService->storeIds($request, $campaign);
        return $campaign->load('campaignUsers');

    }
}
