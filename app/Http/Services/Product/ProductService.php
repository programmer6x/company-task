<?php

namespace App\Http\Services\Product;

use App\Contract\MediaRepositoryInterface;
use App\Http\Services\Media\MediaService;
use App\Models\Media;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductService
{
    private MediaRepositoryInterface $repository;

    public function __construct(){
        $this->repository = app()->make(MediaRepositoryInterface::class);
    }

    public static function productInputs($request){
        $productInputs = $request->only([
            'name', 'description', 'tags', 'category_id', 'status', 'marketable', 'price', 'sold_number', 'frozen_number', 'marketable_number'
        ]);
        return $productInputs;
    }

    public static function dividingImages($image){
        $imageName = rand().'.'.time().'.'.$image->extension();
        $result = $image->move(public_path('images'),$imageName);
        if ($result === false) {
            return response()->json([
                'data' => [
                    'uploading image failed',
                    'status' => '400'
                ]
            ], 400);
        }
        return $mediaInputs['file'] = 'images/'.$imageName;
    }

    public static function creatingProduct($productInputs){
        $productInputs['user_id'] = Auth::id();
        $product = Product::create($productInputs);
        $product->load('category', 'user');
        return $product;

    }

    public static function successfulJson()
    {
        return new JsonResponse([
            'data' => [
                'it was successful',
            ]
        ], 200);
    }

    public static function updatingProduct($productInputs,$product)
    {
        $productInputs['user_id'] = Auth::id();
        $product->update($productInputs);

    }

    public static function creatingMediaAndProduct(Request $request)
    {
        $productInputs = ProductService::productInputs($request);
        $storeMedia = [];
        $mediaInputs = MediaService::mediaInputs($request);
        if ($request->hasFile('images')) {
            $product = ProductService::creatingProduct($productInputs);
            $images = $request->file('images');
            foreach ($images as $image) {
                ProductService::dividingImages($image);
                $mediaInputs['product_id'] = $product->id;
                $storeMedia[] = $mediaInputs;
            }
            $product->medias()->createMany($storeMedia);
        }
        return ProductService::successfulJson();
    }

    public static function deleteImage($request)
    {
        if ($request->deleted_ids &&  $request->has("deleted_ids")){
            foreach ($request->deleted_ids as $item){
                Media::find($item)->delete();
            }
        }
    }

//    public static function checkImage($request)
//    {
//        if ($request->hasFile('images')) {
//            $product = ProductService::creatingProduct($productInputs);
//            $images = $request->file('images');
//            foreach ($images as $image) {
//                ProductService::dividingImages($image);
//                $mediaInputs['product_id'] = $product->id;
//                $storeMedia[] = $mediaInputs;
//            }
//            $product->medias()->createMany($storeMedia);
//        }
//    }

    public function createProduct($request): Product
    {
        DB::beginTransaction();
        $productInputs = ProductService::productInputs($request);
        $storeMedia = [];
        $mediaInputs = MediaService::mediaInputs($request);
        $product = ProductService::creatingProduct($productInputs);
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                ProductService::dividingImages($image);
                $mediaInputs['product_id'] = $product->id;
                $storeMedia[] = $mediaInputs;
                $this->repository->createMany($storeMedia);
            }

        }
        return $product;
    }

}
