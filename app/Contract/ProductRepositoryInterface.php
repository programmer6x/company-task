<?php

namespace App\Contract;

use App\Http\Requests\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAllProducts();
    public function getProductById(int $id);
    public function deleteProduct(Product $product);
    public function createProduct(ProductRequest $request,ImageService $imageService);
    public function updateProduct(int $id, ProductRequest $request,ImageService $imageService);
}
