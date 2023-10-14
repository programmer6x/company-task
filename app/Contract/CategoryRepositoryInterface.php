<?php

namespace App\Contract;

use App\Http\Requests\CategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function getCategoryById(int $id);
    public function deleteCategory(Category $category);
    public function createCategory(CategoryRequest $request,ImageService $imageService);
    public function updateCategory(int $id, CategoryRequest $request,ImageService $imageService);
}
