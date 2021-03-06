<?php

namespace App\Http\Controllers;

use Dawnstar\Models\Blog;
use Dawnstar\Models\Category;
use Dawnstar\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Cache::remember($request->get('page') . "CATEGORY_HOMEPAGE" . getBrowser(), 60 * 60 * 24, function () {
            return Category::where('status', 1)
                ->withCount(['blogs' => function ($q) {
                    $q->where('status', 1);
                }])
                ->having('blogs_count', '>', 0)
                ->orderByDesc('blogs_count')
                ->with('tags')
                ->get();
        });

        $breadcrumb = [
            "Kategoriler" => "javascript:void(0);"
        ];

        return view('pages.category.home', compact('categories', 'breadcrumb'));
    }

    public function detail($slug)
    {
        $category = Category::where('slug', $slug)
            ->first();

        if (is_null($category) || $category->status == 3) {
            abort(404);
        }

        $tempTagSlugs = request()->get('tags');
        $tempTagSlugs = str_replace(['"', "'", " "], "", strip_tags($tempTagSlugs));

        $tagSlugs = $tempTagSlugs ? explode(',', $tempTagSlugs) : [];


        $blogs = $category->blogs()
            ->where('status', 1)
            ->orderByDesc('date')
            ->orderByDesc('created_at')
            ->with('tags')
            ->withCount(['comments' => function ($q) {
                $q->where('status', 1);
            }]);


        if (count($tagSlugs) > 0) {
            $blogs = $blogs->whereHas('tags', function ($q) use ($tagSlugs) {
                $q->whereIn('slug', $tagSlugs);
            });
        }

        $blogs = $blogs = $blogs->get();


        $tags = $category->tags()
            ->where('status', 1)
            ->whereHas('blogs')
            ->orderBy('name');

        if (count($tagSlugs) > 0) {
            $tags = $tags->whereHas('blogs', function ($q) use ($blogs) {
                $q->whereIn('id', $blogs->pluck('id')->toArray());
            });
        }

        $tags = $tags->get()->take(12);


        $breadcrumb = [
            "Kategoriler" => route('category.index'),
            $category->name => "javascript:void(0);",
        ];

        return view('pages.category.detail', compact('category', 'blogs', 'tags', 'tagSlugs', 'breadcrumb'));
    }
}
