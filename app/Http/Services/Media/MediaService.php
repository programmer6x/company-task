<?php

namespace App\Http\Services\Media;

use App\Enums\ImageType;
use App\Http\Services\Image\ImageService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use Nette\Utils\Image;

class MediaService
{
    public static function mediaInputs($request)
    {
        $mediaInputs = $request->only([
            'is_main', 'file', 'type', 'status', 'product_id'
        ]);
        $request->validate([
                'file.*' => 'required|file|mimes:png,jpg,jpeg,gif,mp4',
                'type' => [new Enum(ImageType::class)],
                'product_id' => 'numeric|exists:products,id',
                'status' => 'numeric|in:0,1',
                'is_main' => 'numeric|in:0,1',
            ]);
        return $mediaInputs;
    }

    public static function checkFileEmptiness($file, $imageService)
    {
        if (!empty($file)) {
            $imageService->deleteImage($file);
        }
    }

}
