<?php

namespace App\Http\Controllers;

use App\Contract\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private CategoryRepositoryInterface $repository){

    }

    public function index()
    {
        return $this->repository->getAllCategories();
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request,ImageService $imageService)
    {
        return $this->repository->createCategory($request,$imageService);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->repository->getCategoryById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id,ImageService $imageService)
    {
        return $this->repository->updateCategory($id,$request,$imageService);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        return $this->repository->deleteCategory($category);
    }
}
