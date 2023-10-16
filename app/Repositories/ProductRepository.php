<?php

namespace App\Repositories;

use App\Contract\ProductRepositoryInterface;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Services\Image\ImageService;
use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Media\MediaService;

class ProductRepository implements ProductRepositoryInterface
{

    public function getAllProducts()
    {
        $products = Product::where('status', 0)->with('category', 'user')->simplePaginate(10);
        return ProductResource::collection($products);
    }

    public function getProductById(int $id)
    {
        $product = Product::where('id', $id)->first();
        return $product->load('category', 'user');
    }

    public function createProduct(ProductRequest $request,$product)
    {
       return ProductService::successfulJson();
    }

    public function updateProduct(int $id, Request $request,$productInputs)
    {
        DB::beginTransaction();
        $product = Product::find($id)->update($productInputs);
        ProductService::successfulJson();
    }

    public function deleteProduct($deleted_ids)
    {
        $deleted_ids = explode(",",$deleted_ids);
        $products = Product::whereIn('id',$deleted_ids)->get();
        foreach ($products as $product){
            if ($product->medias->count() != 0){
                $medias = $product->medias;
                foreach ($medias as $media){
                    $media->delete();
                }
            }
            $product->delete();
        }
//        $products = Product::whereIn('id',$deleted_ids)->delete();
    }

}
