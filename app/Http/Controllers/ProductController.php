<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $user = null;
        // Authorization header'dan token ile kullanıcıyı manuel bul
        $authHeader = $request->header('Authorization');
        if ($authHeader && preg_match('/Bearer\\s(.+)/', $authHeader, $matches)) {
            $accessToken = $matches[1];
            $tokenModel = PersonalAccessToken::findToken($accessToken);
            if ($tokenModel) {
                $user = $tokenModel->tokenable;
            }
        }

        $query = Product::query()
            ->active()
            ->with(['categories', 'colors', 'sizes']);

        // Category filtering by slugs
        if ($request->has('category_slugs') && !empty($request->category_slugs)) {
            $categorySlugs = is_array($request->category_slugs)
                ? $request->category_slugs
                : explode(',', $request->category_slugs);
            $query->byCategorySlugs($categorySlugs);
        }

        // Price range filtering
        if ($request->has('min_price') || $request->has('max_price')) {
            $query->byPriceRange($request->min_price, $request->max_price);
        }

        // Search by name
        if ($request->has('search') && !empty($request->search)) {
            $locale = $request->get('locale', 'en');
            $query->search($request->search, $locale);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'newest_first');
        $locale = $request->get('locale', 'en');

        switch ($sortBy) {
            case 'newest_first':
                $query->orderBy('created_at', 'desc');
                break;
            case 'price_high_to_low':
                $query->orderBy('price', 'desc');
                break;
            case 'price_low_to_high':
                $query->orderBy('price', 'asc');
                break;
            case 'name_a_to_z':
                $query->orderBy("name_{$locale}", 'asc');
                break;
            case 'name_z_to_a':
                $query->orderBy("name_{$locale}", 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Pagination
        $perPage = $request->get('per_page', 12); // Default 12 items per page
        $perPage = min($perPage, 50); // Maximum 50 items per page for performance

        $products = $query->paginate($perPage);

        // Add cart and favorite status for authenticated users
        if ($user) {
            $userCartItems = $user->cart()->with('size', 'color')->get();
            $userFavorites = $user->favorites()->pluck('product_id')->toArray();

            $products->getCollection()->transform(function ($product) use ($userCartItems, $userFavorites) {
                // Check if product is in cart (any size/color combination)
                $product->in_cart = $userCartItems->where('product_id', $product->id)->count() > 0;
                $product->is_favorite = in_array((int) $product->id, array_map('intval', $userFavorites));

                // Add cart items for this product with size/color info
                $product->cart_items = $userCartItems->where('product_id', $product->id)->map(function ($cartItem) {
                    return [
                        'id' => $cartItem->id,
                        'quantity' => $cartItem->quantity,
                        'size' => $cartItem->size ? [
                            'id' => $cartItem->size->id,
                            'name' => $cartItem->size->name
                        ] : null,
                        'color' => $cartItem->color ? [
                            'id' => $cartItem->color->id,
                            'name' => $cartItem->color->name
                        ] : null
                    ];
                })->values();

                return $product;
            });
        } else {
            // For non-authenticated users, set default values
            $products->getCollection()->transform(function ($product) {
                $product->in_cart = false;
                $product->is_favorite = false;
                $product->cart_items = [];
                return $product;
            });
        }

        return $products;
    }

    public function find($slug)
    {
        $user = null;
        $authHeader = request()->header('Authorization');
        if ($authHeader && preg_match('/Bearer\\s(.+)/', $authHeader, $matches)) {
            $accessToken = $matches[1];
            $tokenModel = PersonalAccessToken::findToken($accessToken);
            if ($tokenModel) {
                $user = $tokenModel->tokenable;
            }
        }

        $product = Product::with(['categories', 'colors', 'sizes'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        if ($user) {
            $userCartItems = $user->cart()->with('size', 'color')->get();
            $userFavorites = $user->favorites()->pluck('product_id')->toArray();
            $product->in_cart = $userCartItems->where('product_id', $product->id)->count() > 0;
            $product->is_favorite = in_array((int) $product->id, array_map('intval', $userFavorites));
            $product->cart_items = $userCartItems->where('product_id', $product->id)->map(function ($cartItem) {
                return [
                    'id' => $cartItem->id,
                    'quantity' => $cartItem->quantity,
                    'size' => $cartItem->size ? [
                        'id' => $cartItem->size->id,
                        'name' => $cartItem->size->name
                    ] : null,
                    'color' => $cartItem->color ? [
                        'id' => $cartItem->color->id,
                        'name' => $cartItem->color->name
                    ] : null
                ];
            })->values();
        } else {
            $product->in_cart = false;
            $product->is_favorite = false;
            $product->cart_items = [];
        }

        return $product;
    }

    public function similar($slug)
    {
        $user = null;
        // Authorization header'dan token ile kullanıcıyı manuel bul
        $authHeader = request()->header('Authorization');
        if ($authHeader && preg_match('/Bearer\\s(.+)/', $authHeader, $matches)) {
            $accessToken = $matches[1];
            $tokenModel = PersonalAccessToken::findToken($accessToken);
            if ($tokenModel) {
                $user = $tokenModel->tokenable;
            }
        }

        $product = Product::with('categories')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get category IDs of the current product
        $categoryIds = $product->categories->pluck('id')->toArray();

        // Find similar products from the same categories, excluding the current product
        $similarProducts = Product::with(['categories', 'colors', 'sizes'])
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            })
            ->inRandomOrder()
            ->limit(4)
            ->get();

        // Add cart and favorite status for authenticated users
        if ($user) {
            $userCartItems = $user->cart()->with('size', 'color')->get();
            $userFavorites = $user->favorites()->pluck('product_id')->toArray();

            $similarProducts->transform(function ($product) use ($userCartItems, $userFavorites) {
                // Check if product is in cart (any size/color combination)
                $product->in_cart = $userCartItems->where('product_id', $product->id)->count() > 0;
                $product->is_favorite = in_array((int) $product->id, array_map('intval', $userFavorites));

                // Add cart items for this product with size/color info
                $product->cart_items = $userCartItems->where('product_id', $product->id)->map(function ($cartItem) {
                    return [
                        'id' => $cartItem->id,
                        'quantity' => $cartItem->quantity,
                        'size' => $cartItem->size ? [
                            'id' => $cartItem->size->id,
                            'name' => $cartItem->size->name
                        ] : null,
                        'color' => $cartItem->color ? [
                            'id' => $cartItem->color->id,
                            'name' => $cartItem->color->name
                        ] : null
                    ];
                })->values();

                return $product;
            });
        } else {
            // For non-authenticated users, set default values
            $similarProducts->transform(function ($product) {
                $product->in_cart = false;
                $product->is_favorite = false;
                $product->cart_items = [];
                return $product;
            });
        }

        return response()->json([
            'success' => true,
            'data' => $similarProducts
        ]);
    }

    public function scopeSearch($query, $search, $locale = 'en')
    {
        if (empty($search)) {
            return $query;
        }

        $nameColumn = "name_{$locale}";
        $descriptionColumn = "description_{$locale}";

        // Validate locale to prevent SQL injection
        $validLocales = ['en', 'az', 'ru'];
        if (!in_array($locale, $validLocales)) {
            $locale = 'en';
            $nameColumn = "name_en";
            $descriptionColumn = "description_en";
        }

        return $query->where(function ($q) use ($search, $nameColumn, $descriptionColumn) {
            $q->where($nameColumn, 'like', "%{$search}%")
                ->orWhere($descriptionColumn, 'like', "%{$search}%");
        });
    }
}