<?php

namespace App\Http\Controllers\Destination;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Destination;
use App\Models\Region;

class SearchDestinationController extends Controller
{
    public function index(Request $request) {
        $idRegionSelected = '';
        if (isset($request->region)) {
            $regionSelected = Region::findOrFail($request->region);
            $idRegionSelected = $regionSelected->id;
        }

        $idDepartmentSelected = '';
        if (isset($request->department)) {
            $departmentSelected = Department::findOrFail($request->department);
            $idDepartmentSelected = $departmentSelected->id;
            $idRegionSelected = $departmentSelected->region->id;
        }

        if ($idRegionSelected !== '') {
            $destinations = Destination::whereHas('department', function ($department) use ($idRegionSelected, $idDepartmentSelected) {
                $department->whereHas('region', function ($region) use ($idRegionSelected) {
                    $region->where('id', '=', $idRegionSelected);
                });
                if ($idDepartmentSelected !== '') {
                    $department->where('id', '=', $idDepartmentSelected);
                }
            })->get();
            $departments = Department::where('region_id', '=', $idRegionSelected)->get();
        } else {
            $destinations = Destination::all();
            $departments = Department::all();
        }

        return view('functionalities.filter.destinations', [
            'regions' => Region::all(),
            'departments' => $departments,
            'idRegionSelected' => $idRegionSelected,
            'idDepartmentSelected' => $idDepartmentSelected,
            'destinations' => $destinations
        ]);
    }
}
