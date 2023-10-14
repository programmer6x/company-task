<?php

namespace App\Http\Controllers;

use App\Contract\CartItemRepositoryInterface;
use App\Http\Requests\CartItemRequest;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(private CartItemRepositoryInterface $repository){

    }
    public function index()
    {
        return $this->repository->getAllCartItems();
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(CartItemRequest $request)
    {
        return $this->repository->createCartItem($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->repository->getCartItemById($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(CartItemRequest $request, string $id)
    {
        return $this->repository->updateCartItem($id,$request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cart_ids)
    {
        return $this->repository->deleteCartItem($cart_ids);
    }
}
