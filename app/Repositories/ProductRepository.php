<?php

namespace App\Repositories;

use App\Contract\ProductRepositoryInterface;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Services\Image\ImageService;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductRepositoryInterface
{

    public function getAllProducts()
    {
        $products = Product::where('status',0)->with('category','user')->simplePaginate(10);
        return ProductResource::collection($products);
    }

    public function getProductById(int $id)
    {
        $product = Product::where('id',$id)->first();
        return $product->load('category','user');
    }

    public function createProduct(ProductRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')){
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'product');
            $result = $imageService->save($request->file('image'));
            if ($result === false){
                return response()->json([
                    'data' => [
                        'uploading image failed',
                        'status' => '400'
                    ]
                ],400);
            }
            $inputs['image'] = $result;
        }
        $inputs['user_id'] = Auth::id();
        $category = Product::create($inputs);
        $category->load('category','user');
        return response()->json($category,200);
    }

    public function updateProduct(int $id, ProductRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        $product = Product::find($id);
        if ($request->hasFile('image')){
            if (!empty($product->image)){
                $imageService->deleteImage($product->image);
            }
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'product');
            $result = $imageService->save($request->file('image'));
            if ($result === false){
                return response()->json([
                    'data' => [
                        'uploading image failed',
                        'status' => '400'
                    ]
                ],400);
            }
            $inputs['image'] = $result;
        }
        $inputs['user_id'] = Auth::id();
        $product->update($inputs);
        return response()->json($product,200);
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);

    }

}
