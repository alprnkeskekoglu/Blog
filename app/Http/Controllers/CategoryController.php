<?php

namespace App\Http\Controllers;

use Dawnstar\Models\Blog;
use Dawnstar\Models\Category;
use Dawnstar\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)
            ->withCount(['blogs' => function ($q) {
                $q->where('status', 1);
            }])
            ->having('blogs_count', '>', 0)
            ->orderBy('blogs_count')
            ->with('tags')
            ->get();

        $breadcrumb = [
            "Kategoriler" => "javascript:void(0);"
        ];

        return view('pages.category.home', compact('categories', 'breadcrumb'));
    }

    public function detail($slug)
    {
        $category = Category::where('slug', $slug)
            ->first();

        if(is_null($category)) {
            abort(404);
        }

        $tagSlugs = request()->get('tags');

        $tagSlugs = $tagSlugs ? explode(',', $tagSlugs) : [];

        $blogs = $category->blogs()
            ->where('status', 1)
            ->orderByDesc('date')
            ->with('tags')
            ->withCount(['comments' => function($q) {
                $q->where('status', 1);
            }]);

        if(count($tagSlugs) > 0) {
            $blogs = $blogs->whereHas('tags', function($q) use($tagSlugs) {
                $q->whereIn('slug', $tagSlugs);
            });
        }

        $blogs = $blogs->get();


        $tags = $category->tags()
            ->where('status', 1)
            ->withCount('blogs')
            ->orderByDesc('blogs_count')
            ->having('blogs_count', '>', 0);

        if(count($tagSlugs) > 0) {
            $tags = $tags->whereHas('blogs', function($q) use($blogs) {
                $q->whereIn('id', $blogs->pluck('id')->toArray());
            });
        }

        $tags = $tags->get()->take(8);



        $breadcrumb = [
            "Kategoriler" => route('category.index'),
            $category->name => "javascript:void(0);",
        ];


        return view('pages.category.detail', compact('category', 'blogs', 'tags', 'tagSlugs', 'breadcrumb'));
    }
}
