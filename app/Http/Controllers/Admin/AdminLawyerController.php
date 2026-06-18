<?php

namespace App\Modules\Lawyer\Http\Controllers\Admin;

use App\Http\Controllers\Web\Core\ProjectBaseController;
use App\Modules\Lawyer\Http\Requests\Admin\LawyerRequest;
use App\Modules\Lawyer\Models\Lawyer;
use Illuminate\Support\Facades\Log;

class AdminLawyerController extends ProjectBaseController
{
    public function __construct()
    {
        $this->model = Lawyer::class;
        parent::__construct();
    }

    public function index()
    {
        $query = Lawyer::query()->with(['locations', 'categories', 'subCategories'])->latest();

        return parent::index($query);
    }

    public function store(LawyerRequest $request)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('lawyers/photos', 'lawyer_local');
            }

            $locations = $data['locations'] ?? [];
            $categories = $data['categories'] ?? [];
            $subCategories = $data['sub_categories'] ?? [];
            unset($data['locations'], $data['categories'], $data['sub_categories']);

            $lawyer = Lawyer::create($data);

            $lawyer->locations()->sync($locations);
            $lawyer->categories()->sync($categories);
            $lawyer->subCategories()->sync($subCategories);

            return redirect()->route('lawyer.admin.lawyers.index')
                ->with('success', __('Lawyer created successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while creating the lawyer.'));
        }
    }

    public function update(LawyerRequest $request, Lawyer $lawyer)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo')->store('lawyers/photos', 'lawyer_local');
            } else {
                unset($data['photo']);
            }

            $locations = $data['locations'] ?? [];
            $categories = $data['categories'] ?? [];
            $subCategories = $data['sub_categories'] ?? [];
            unset($data['locations'], $data['categories'], $data['sub_categories']);

            $lawyer->update($data);
            $lawyer->locations()->sync($locations);
            $lawyer->categories()->sync($categories);
            $lawyer->subCategories()->sync($subCategories);

            return redirect()->route('lawyer.admin.lawyers.index')
                ->with('success', __('Lawyer updated successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while updating the lawyer.'));
        }
    }

    public function destroy(Lawyer $lawyer)
    {
        try {
            $lawyer->delete();

            return redirect()->route('lawyer.admin.lawyers.index')
                ->with('success', __('Lawyer deleted successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while deleting the lawyer.'));
        }
    }
}
