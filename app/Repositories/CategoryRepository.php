<?php

namespace App\Repositories;

use App\Contract\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Services\Image\ImageService;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        $categories = Category::where('status',1)->with('parent','children','user')->simplePaginate(10);
        return CategoryResource::collection($categories);
    }

    public function getCategoryById(int $id)
    {
        $category = Category::where('id',$id)->first();
        return $category->load('parent','children','user');
    }

    public function createCategory(CategoryRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')){
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'category');
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
        $category = Category::create($inputs);
        $category->load('parent','children','user');
        return response()->json($category,200);
    }

    public function updateCategory(int $id, CategoryRequest $request,ImageService $imageService)
    {
        $inputs = $request->all();
        $category = Category::find($id);
        if ($request->hasFile('image')){
            if (!empty($category->image)){
                $imageService->deleteImage($category->image);
            }
            $imageService->setExclusiveDirectory('images'.DIRECTORY_SEPARATOR.'category');
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
        $category->update($inputs);
        return response()->json($category,200);
    }

    public function deleteCategory(Category $category)
    {
        if($category->products->count() == 0){
            $category->delete();
        }
        else{
            return response()->json([
                'data' => [
                    'error' => "you can't delete the categories those have products",
                    'status' => '400'
                ]
            ]);
        }
         return response()->json(null,Response::HTTP_NO_CONTENT);

    }
}
