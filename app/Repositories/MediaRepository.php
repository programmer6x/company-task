<?php

namespace App\Repositories;

use App\Contract\MediaRepositoryInterface;
use App\Http\Requests\MediaRequest;
use App\Http\Resources\MediaResource;
use App\Http\Services\Image\ImageService;
use App\Models\Media;
use Illuminate\Http\Response;

class MediaRepository implements MediaRepositoryInterface
{
    public function getAllMedias()
    {
        $medias = Media::where('status',1)->with('product')->simplePaginate(10);
        return MediaResource::collection($medias);
    }

    public function getMediaById(int $id)
    {
        $media = Media::where('id',$id)->first();
        return $media->load('product');
    }

    public function createMedia(MediaRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('file')){
            if ($request->input('type') == 'photo'){
                $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'media');
            }else if ($request->input('type') == 'video'){
                $imageService->setExclusiveDirectory('videos'.DIRECTORY_SEPARATOR.'media');
            }
            $result = $imageService->save($request->file('file'));
            if ($result === false){
                return response()->json([
                    'data' => [
                        'uploading image failed',
                        'status' => '400'
                    ]
                ],400);
            }
            $inputs['file'] = $result;
        }
        $media = Media::create($inputs);
        $media->load('product');
        return response()->json($media,200);
    }

    public function updateMedia(int $id, MediaRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        $media = Media::find($id);
        if ($request->hasFile('file')){
            if (!empty($media->file)){
                $imageService->deleteImage($media->file);
            }
            if ($request->input('type') == 'photo'){
                $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'media');
            }else if ($request->input('type') == 'video'){
                $imageService->setExclusiveDirectory('videos'.DIRECTORY_SEPARATOR.'media');
            }
            $result = $imageService->save($request->file('file'));
            if ($result === false){
                return response()->json([
                    'data' => [
                        'uploading image failed',
                        'status' => '400'
                    ]
                ],400);
            }
            $inputs['file'] = $result;
        }
        $media->update($inputs);
        return response()->json($media,200);
    }

    public function deleteMedia($media_ids)
    {
        $media_ids = explode(",",$media_ids);

        Media::query()->whereIn('id',$media_ids)->delete();

        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
