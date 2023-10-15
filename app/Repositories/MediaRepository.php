<?php

namespace App\Repositories;

use App\Contract\MediaRepositoryInterface;
use App\Http\Requests\MediaRequest;
use App\Http\Resources\MediaResource;
use App\Http\Services\Image\ImageService;
use App\Models\Media;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MediaRepository implements MediaRepositoryInterface
{
    public function getAllMedias()
    {
        $medias = Media::where('status', 1)->with('product')->simplePaginate(10);
        return MediaResource::collection($medias);
    }

    public function getMediaById(int $id)
    {
        $media = Media::where('id', $id)->first();
        return $media->load('product');
    }

    public function createMedia(MediaRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $fileName = rand(1, 99) . '.' . time() . '.' . $file->extension();
                $fileDirectory = 'app' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . rand(1, 99) . '.' . time() . '.' . $file->extension();
                $file->storeAs('images', $fileName);
                $media = new Media([
                    'name' => $inputs['name'],
                    'description' => $inputs['description'],
                    'product_id' => $inputs['product_id'],
                    'file' => $fileDirectory,
                    'type' => 'photo'
                ]);
                $media->save();
            }
        }

    }

    public function updateMedia(int $id, MediaRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        $media = Media::find($id);
        if ($request->hasFile('file')) {
            if ($media->file) {
//                Storage::delete($media->file);
//                $media->delete();
            }
            foreach ($request->file('file') as $file) {
                $fileName = rand(1, 99) . '.' . time() . '.' . $file->extension();
                $fileDirectory = 'app' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . rand(1, 99) . '.' . time() . '.' . $file->extension();
                $file->storeAs('images', $fileName);
                $inputs['file'] = $fileDirectory;
                $media->update($inputs);
            }

        }
        return response()->json($media, 200);
    }

    public function deleteMedia($media_ids)
    {
        $media_ids = explode(",", $media_ids);

        Media::query()->whereIn('id', $media_ids)->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
