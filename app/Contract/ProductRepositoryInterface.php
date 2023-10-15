<?php

namespace App\Contract;

use App\Http\Requests\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Http\Services\Media\MediaService;
use App\Http\Services\Product\ProductService;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById(int $id);
    public function deleteProduct($deleted_ids);
    public function createProduct(ProductRequest $request,ImageService $imageService);
    public function updateProduct(int $id, ProductRequest $request,$productInputs);
}
