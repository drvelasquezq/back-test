<?php

namespace App\Http\Controllers\Department;

use App\Models\Region;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return view('functionalities.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        return view('functionalities.department.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:5',
            'region' => 'required|exists:regions,id'
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $data['region_id'] = $request->region;
        $data['user_id'] = auth()->user()->id;
        Department::create($data);
        
        return redirect('departments')->with('flash', 'El departamento ' . $data['name'] . ' ha sido creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('functionalities.department.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $this->authorize('update-destroy-user-equals', [$department]);
        $regions = Region::all();
        return view('functionalities.department.edit', compact('department', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $this->authorize('update-destroy-user-equals', [$department]);
        $rules = [
            'name' => 'required|string|min:5',
            'region' => 'required|exists:regions,id'
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        $validator->validate();
        $department->name = $request->name;
        $department->region_id = Region::findOrFail($request->region)->id;
        if ($department->isClean()) {
            $validator->errors()->add(
                'general', 'El departamento no ha cambiado'
            );
            throw new ValidationException($validator);
        }
        $department->save();

        return redirect('departments')->with('flash', 'El departamento ' . $data['name'] . ' ha sido editado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $this->authorize('update-destroy-user-equals', [$department]);
        $department->delete();

        return redirect('departments')->with('flash', 'El departamento ' . $department->name . ' ha sido eliminado.');
    }

    public function eliminate(Department $department) {
        $this->authorize('update-destroy-user-equals', [$department]);
        return view('functionalities.department.eliminate', compact('department'));
    }
}
