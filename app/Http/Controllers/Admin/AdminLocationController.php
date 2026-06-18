<?php

namespace App\Modules\Lawyer\Http\Controllers\Admin;

use App\Http\Controllers\Web\Core\ProjectBaseController;
use App\Modules\Lawyer\Http\Requests\Admin\LocationRequest;
use App\Modules\Lawyer\Models\Location;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminLocationController extends ProjectBaseController
{
    public function __construct()
    {
        $this->model = Location::class;
        parent::__construct();
    }

    public function index()
    {
        $query = Location::query()->withCount('lawyers')->latest();

        return parent::index($query);
    }

    public function store(LocationRequest $request)
    {
        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

            Location::create($data);

            return redirect()->route('lawyer.admin.locations.index')
                ->with('success', __('Location created successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while creating the location.'));
        }
    }

    public function update(LocationRequest $request, Location $location)
    {
        try {
            $data = $request->validated();
            $data['slug'] = $data['slug'] ?: Str::slug($data['name']);

            $location->update($data);

            return redirect()->route('lawyer.admin.locations.index')
                ->with('success', __('Location updated successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while updating the location.'));
        }
    }

    public function destroy(Location $location)
    {
        try {
            $location->delete();

            return redirect()->route('lawyer.admin.locations.index')
                ->with('success', __('Location deleted successfully.'));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->back()->with('error', __('Something went wrong while deleting the location.'));
        }
    }
}
