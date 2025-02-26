<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
    public function index(): View|Factory|Application
    {
        $categories = Category::whereHas('contents', function ($query) {
            return $query->where('active', true)->whereLike('website', config('app.base_domain_path') . '%');
        })->get();
        return view(config('app.base_domain_path', 'freudefoto') . '/category.index', compact('categories'));
    }

    /**
     * @param Request $request
     * @param $categoryName
     * @return Factory|View|Application|Redirector|RedirectResponse
     */
    public function get(Request $request, $categoryName): Factory|View|Application|Redirector|RedirectResponse
    {
        $queryString = $request->getQueryString();
        if (Str::contains($queryString, 'slug')) {
            $slug = Str::afterLast($queryString, '=');
            return redirect('/single/' . $slug, 303);
        }
        $categoryId = $categoryName;
        if (!is_numeric($categoryId)) {
            $category = Category::whereTranslation('name', $categoryId)->firstOrFail();
            $categoryId = $category->id;
        }
        $category = Category::find($categoryId);
        if($category === null) {
            return redirect('/');
        }
        $contents = $category
            ->contents()
            ->orderByDesc('created_at')
            ->where('active', true)
            ->whereLike('website', config('app.base_domain_path') . '%')
            ->whereDate('date', '<=', Carbon::now('Europe/Berlin'))
            ->simplePaginate(config('app.blog_entries_per_page'));

        return view(config('app.base_domain_path', 'freudefoto') . '/category.index', compact('contents','categoryName'));
    }

    public function list(): View|Factory|Application
    {
        $categories = Category::all();
        return view('/admin/category.list', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'de_name' => ['required'],
            'en_name' => ['required'],
        ]);
        $categoryData = [
            'en' => [
                'name'       => $request->input('en_name'),
            ],
            'de' => [
                'name'       => $request->input('de_name'),
            ],
        ];
        Category::create($categoryData);
        return redirect('/categories/list')->with('success', 'Category created!');
    }

    public function create()
    {
        return view('/admin/category.createOrUpdate');
    }

    public function edit($id): View|Factory|Application
    {
        $category = Category::find($id);
        $contents = Content::where('category_id', $id)->get();
        return view('/admin/category.createOrUpdate', compact('category', 'contents'));
    }

    public function update(Request $request, $id): Application|Redirector|RedirectResponse
    {
        $validatedData = $request->validate([
            'de_name' => ['required'],
            'en_name' => ['required'],
        ]);

        $categoryData = [
            'en' => [
                'name'       => $request->input('en_name'),
            ],
            'de' => [
                'name'       => $request->input('de_name'),
            ],
        ];
        $category = Category::find($id);
        $category->update($categoryData);
        return redirect('/categories/list')->with('success', 'Category created!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect('/categories/list')->with('success', 'Category deleted successfully');
    }
}
