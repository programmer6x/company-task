<?php

namespace App\Http\Controllers;

use App\Contract\CampaignRepositoryInterface;
use App\Contract\CampaignUserRepositoryInterface;
use App\Http\Services\CampaignUser\CampaignUserService;
use Illuminate\Http\Request;

class CampaignUserController extends Controller
{
    private $repository;
    private $campaignRepository;

    public function __construct(CampaignUserRepositoryInterface $repository,CampaignRepositoryInterface $campaignRepository)
    {
        $this->repository = $repository;
        $this->campaignRepository = $campaignRepository;
    }

    public function index()
    {
        return $this->repository->returnAllCampaignUser();
    }

//    public function store(Request $request,CampaignUserService $campaignUserService){
//        $campaignUserInputs = $campaignUserService->getInputsOfCampaignUser($request);
//        dd($campaignUserInputs);
//        $campaignUser = $campaignUserService->dividingUserIds($campaignUserInputs['user_ids']);
//        $campaignUserCreated = $this->repository->storeCampaignUser($campaignUserInputs,$campaignUser);
//        $campaign = $this->campaignRepository->createCampaignViaCampaignUser($campaignUserInputs['message']);
//    }
}
