<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function all(Request $request)
    {
        $perPage = $request->get('per_page', 15); // Default 15, max 100
        $perPage = min($perPage, 100); // Limit to max 100

        $blogs = Blog::orderBy("created_at", "desc")
            ->with('category')
            ->paginate($perPage);
        return $blogs;
    }

    public function find($slug)
    {
        $blog = Blog::with('category')->where('slug', $slug)->firstOrFail();

        // Get next blog
        $nextBlog = Blog::where('id', '>', $blog->id)
            ->where('is_active', true)
            ->orderBy('id', 'asc')
            ->with('category')
            ->first();

        // Get 3 similar blogs from the same category
        $similarBlogs = Blog::where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->with('category')
            ->limit(3)
            ->get();

        return response()->json([
            'blog' => $blog,
            'next_blog' => $nextBlog,
            'similar_blogs' => $similarBlogs
        ]);
    }
}
