<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('items')
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }

    public function show(Request $request, $id)
    {
        $order = Order::with('items.product')
            ->where('user_id', $request->user()->id)
            ->where('id', $id)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'phone_number' => ['required', 'string', 'max:20'],
            'zip_code' => ['required', 'string', 'max:10'],
            'country' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:500'],
            'delivery_type_id' => ['required', 'integer', 'exists:delivery_types,id']
        ]);

        $cartItems = Cart::with('product.categories', 'product.colors', 'product.sizes')
            ->where('user_id', $request->user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Cart is empty'
            ], 400);
        }

        $totalPrice = $cartItems->sum('total_price');

        DB::beginTransaction();

        try {
            // Create order
            $order = Order::create([
                'user_id' => $request->user()->id,
                'total_price' => $totalPrice,
                'phone_number' => $validated['phone_number'],
                'zip_code' => $validated['zip_code'],
                'country' => $validated['country'],
                'address' => $validated['address'],
                'status' => 'pending',
                'delivery_type_id' => $validated['delivery_type_id'],
                'is_paid' => false
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                $product = $cartItem->product;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'size_id' => $cartItem->size_id,
                    'color_id' => $cartItem->color_id,
                    'product_name_az' => $product->name_az,
                    'product_name_en' => $product->name_en,
                    'product_description_az' => $product->description_az,
                    'product_description_en' => $product->description_en,
                    'product_cover' => $product->cover,
                    'product_price' => $product->price,
                    'product_discounted_price' => $product->discounted_price,
                    'quantity' => $cartItem->quantity,
                    'total_price' => $cartItem->total_price,
                    'product_categories' => $product->categories->toArray(),
                    'product_colors' => $product->colors->toArray(),
                    'product_sizes' => $product->sizes->toArray(),
                ]);
            }

            // Clear cart
            Cart::where('user_id', $request->user()->id)->delete();

            DB::commit();

            $order->load('items');

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'data' => $order
            ], 201);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Failed to place order'
            ], 500);
        }
    }
}