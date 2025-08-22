<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = Cart::with('product.categories', 'product.colors', 'product.sizes', 'size', 'color')
            ->where('user_id', $request->user()->id)
            ->get();

        $totalPrice = $cartItems->sum('total_price');

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $cartItems,
                'total_price' => $totalPrice,
                'items_count' => $cartItems->count()
            ]
        ]);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'size_id' => ['required', 'exists:sizes,id'],
            'color_id' => ['nullable', 'exists:colors,id'],
            'quantity' => ['required', 'integer', 'min:1']
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if (!$product->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Product is not available'
            ], 400);
        }

        // Check if the product has this size and if it's active
        $productSize = $product->sizes()
            ->where('size_id', $validated['size_id'])
            ->withPivot(['price', 'is_active'])
            ->first();

        if (!$productSize || !$productSize->pivot->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Selected size is not available for this product'
            ], 400);
        }

        // Check if the same product with same size and color already exists in cart
        $cartItem = Cart::where('user_id', $request->user()->id)
            ->where('product_id', $validated['product_id'])
            ->where('size_id', $validated['size_id'])
            ->where('color_id', array_key_exists('color_id', $validated) ? $validated['color_id'] : null)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            $cartItem = Cart::create([
                'user_id' => $request->user()->id,
                'product_id' => $validated['product_id'],
                'size_id' => $validated['size_id'],
                'color_id' => array_key_exists('color_id', $validated) ? $validated['color_id'] : null,
                'quantity' => $validated['quantity']
            ]);
        }

        $cartItem->load('product', 'size', 'color');

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart',
            'data' => $cartItem
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1']
        ]);

        $cartItem = Cart::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $cartItem->update($validated);
        $cartItem->load('product', 'size', 'color');

        return response()->json([
            'success' => true,
            'message' => 'Cart updated',
            'data' => $cartItem
        ]);
    }

    public function remove(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart'
        ]);
    }

    public function clear(Request $request)
    {
        Cart::where('user_id', $request->user()->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared'
        ]);
    }
}