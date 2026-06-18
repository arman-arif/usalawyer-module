<?php

namespace App\Modules\Lawyer\Http\Controllers\Admin;

use App\Http\Controllers\Web\Core\ProjectBaseController;
use App\Modules\Lawyer\Http\Requests\Admin\SubCategoryRequest;
use App\Modules\Lawyer\Models\SubCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminSubCategoryController extends ProjectBaseController
{
    public function __construct()
    {
        $this->model = SubCategory::class;
        parent::__construct();
    }

    public function index()
    {
        $query = SubCategory::query()->with('category')->latest();

        return parent::index($query);
    }

    public function store(SubCategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

            SubCategory::create($data);

            return redirect()->route('lawyer.admin.sub-categories.index')
                ->with('success', __('Sub-category created successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while creating the sub-category.'));
        }
    }

    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

            $subCategory->update($data);

            return redirect()->route('lawyer.admin.sub-categories.index')
                ->with('success', __('Sub-category updated successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while updating the sub-category.'));
        }
    }

    public function destroy(SubCategory $subCategory)
    {
        try {
            $subCategory->delete();

            return redirect()->route('lawyer.admin.sub-categories.index')
                ->with('success', __('Sub-category deleted successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while deleting the sub-category.'));
        }
    }
}
