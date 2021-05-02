<?php

namespace App\Http\Controllers\Region;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();
        return view('functionalities.region.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('functionalities.region.create');
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
            'name' => 'required|string|min:5'
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        Region::create($data);

        return redirect('regions')->with('flash', 'La región ' . $data['name'] . ' ha sido creada.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return view('functionalities.region.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        $this->authorize('update-destroy-user-equals', [$region]);
        return view('functionalities.region.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $this->authorize('update-destroy-user-equals', [$region]);
        $rules = [
            'name' => 'required|string|min:5'
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        $validator->validate();
        $region->name = $request->name;
        if ($region->isClean()) {
            $validator->errors()->add(
                'general', 'La región no ha cambiado'
            );
            throw new ValidationException($validator);
        }
        $region->save();
        
        return redirect('regions')->with('flash', 'La región ' . $data['name'] . ' ha sido editada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $this->authorize('update-destroy-user-equals', [$region]);
        $region->delete();

        return redirect('regions')->with('flash', 'La región ' . $region->name . ' ha sido eliminada.');
    }

    public function eliminate(Region $region)
    {
        $this->authorize('update-destroy-user-equals', [$region]);
        return view('functionalities.region.eliminate', compact('region'));
    }
}
