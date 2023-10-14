<?php

namespace App\Repositories;

use App\Contract\CartItemRepositoryInterface;
use App\Http\Requests\CartItemRequest;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartItemRepository implements CartItemRepositoryInterface
{
    public function getAllCartItems()
    {
        $cartItems = CartItem::with('user','product')->simplePaginate(10);
        return CartItemResource::collection($cartItems);
    }

    public function getCartItemById(int $id)
    {
        $cartItem = CartItem::find($id);
        return $cartItem->load('user','product');

    }

    public function createCartItem(CartItemRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $cartItem = CartItem::create($inputs);
        $cartItem->load('user','product');
        return response()->json($cartItem,200);
    }

    public function updateCartItem(int $id, CartItemRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $cartItem = CartItem::find($id);
        $cartItem->update($inputs);

        return response()->json($cartItem,200);

    }

    public function deleteCartItem($cart_ids)
    {
        $cart_ids = explode(",",$cart_ids);
        CartItem::query()->whereIn('id',$cart_ids)->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
