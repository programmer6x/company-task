<?php

namespace App\Http\Controllers;

use App\Contract\MediaRepositoryInterface;
use App\Http\Requests\MediaRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private MediaRepositoryInterface $repository){

    }
    public function index()
    {
        return $this->repository->getAllMedias();
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(MediaRequest $request,ImageService $imageService)
    {
        return $this->repository->createMedia($request,$imageService);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->repository->getMediaById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(MediaRequest $request, string $id,ImageService $imageService)
    {
        return $this->repository->updateMedia($id,$request,$imageService);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($media_ids)
    {
        return $this->repository->deleteMedia($media_ids);
    }
}
