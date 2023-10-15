<?php

namespace App\Http\Controllers;

use App\Contract\ProductRepositoryInterface;
use App\Http\Requests\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Http\Services\Product\ProductService;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private ProductRepositoryInterface $repository){

    }

    public function index()
    {
        return $this->repository->getAllProducts();
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request,ImageService $imageService)
    {
        return $this->repository->createProduct($request,$imageService);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->repository->getProductById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        ProductService::creatingMediaAndProduct($request);
        $productInputs = ProductService::productInputs($request);
        ProductService::deleteImage($request);
        return $this->repository->updateProduct($id,$request,$productInputs);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($deleted_ids)
    {
        return $this->repository->deleteProduct($deleted_ids);
    }
}
