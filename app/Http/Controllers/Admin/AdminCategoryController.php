<?php

namespace App\Modules\Lawyer\Http\Controllers\Admin;

use App\Http\Controllers\Web\Core\ProjectBaseController;
use App\Modules\Lawyer\Http\Requests\Admin\CategoryRequest;
use App\Modules\Lawyer\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminCategoryController extends ProjectBaseController
{
    public function __construct()
    {
        $this->model = Category::class;
        parent::__construct();
    }

    public function index()
    {
        $query = Category::query()->withCount('subCategories')->latest();

        return parent::index($query);
    }

    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

            Category::create($data);

            return redirect()->route('lawyer.admin.categories.index')
                ->with('success', __('Category created successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while creating the category.'));
        }
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

            $category->update($data);

            return redirect()->route('lawyer.admin.categories.index')
                ->with('success', __('Category updated successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while updating the category.'));
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return redirect()->route('lawyer.admin.categories.index')
                ->with('success', __('Category deleted successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while deleting the category.'));
        }
    }
}
