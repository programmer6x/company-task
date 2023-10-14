<?php

namespace App\Contract;

use App\Http\Requests\MediaRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Media;
use Illuminate\Http\Request;


interface MediaRepositoryInterface
{
    public function getAllMedias();
    public function getMediaById(int $id);
    public function deleteMedia($media_ids);
    public function createMedia(MediaRequest $request,ImageService $imageService);
    public function updateMedia(int $id, MediaRequest $request,ImageService $imageService);
}
