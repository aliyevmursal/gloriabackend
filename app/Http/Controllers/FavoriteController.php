<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $favorites = Favorite::with('product.categories', 'product.colors', 'product.sizes')
            ->where('user_id', $request->user()->id)
            ->get();

        // Her favori kaydının ilişkili product nesnesine is_favorite: true ekle
        $favorites->each(function ($favorite) {
            if ($favorite->product) {
                $favorite->product->is_favorite = true;
            }
        });

        return response()->json([
            'success' => true,
            'data' => $favorites
        ]);
    }

    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id']
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if (!$product->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Product is not available'
            ], 400);
        }

        $favorite = Favorite::where('user_id', $request->user()->id)
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Product removed from favorites';
            $is_favorite = false;
        } else {
            Favorite::create([
                'user_id' => $request->user()->id,
                'product_id' => $validated['product_id']
            ]);
            $message = 'Product added to favorites';
            $is_favorite = true;
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => [
                'is_favorite' => $is_favorite
            ]
        ]);
    }

    public function check(Request $request, $productId)
    {
        $isFavorite = Favorite::where('user_id', $request->user()->id)
            ->where('product_id', $productId)
            ->exists();

        return response()->json([
            'success' => true,
            'data' => [
                'is_favorite' => $isFavorite
            ]
        ]);
    }
}