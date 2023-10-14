<?php

namespace App\Contract;

use App\Http\Requests\CartItemRequest;
use App\Http\Requests\MediaRequest;

interface CartItemRepositoryInterface
{
    public function getAllCartItems();
    public function getCartItemById(int $id);
    public function deleteCartItem($cart_ids);
    public function createCartItem(CartItemRequest $request);
    public function updateCartItem(int $id, CartItemRequest $request);
}
