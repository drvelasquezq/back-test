<?php

namespace App\Http\Controllers\Destination;

use App\Traits\Conversor;
use App\Models\Department;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DestinationController extends Controller
{
    use Conversor;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinations = Destination::all();
        return view('functionalities.destination.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('functionalities.destination.create', compact('departments'));
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
            'sales_strategy' => 'required|string|min:5',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'department' => 'required|exists:departments,id'
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $data['department_id'] = $request->department;
        $data['user_id'] = auth()->user()->id;
        Destination::create($data);

        return redirect('destinations')->with('flash', 'El destino ' . $data['name'] . ' ha sido creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        $latiudeDegreesWithMinutesAndSeconds = $this->fromDecimalDegreesToDegreesWithMinutesAndSeconds($destination->latitude);
        $longitudeDegreesWithMinutesAndSeconds = $this->fromDecimalDegreesToDegreesWithMinutesAndSeconds($destination->longitude);
        $coordinates = [
            'latitude' => $latiudeDegreesWithMinutesAndSeconds,
            'longitude' => $longitudeDegreesWithMinutesAndSeconds
        ];
        $coordinates['latitude']['coordinate'] = $this->determineGeographicCoordinate($destination->latitude);
        $coordinates['longitude']['coordinate'] = $this->determineGeographicCoordinate($destination->longitude, 'longitude');
        return view('functionalities.destination.show', compact('destination', 'coordinates'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination)
    {
        $this->authorize('update-destroy-user-equals', [$destination]);
        $departments = Department::all();
        return view('functionalities.destination.edit', compact('destination', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
    {
        $this->authorize('update-destroy-user-equals', [$destination]);
        $rules = [
            'name' => 'required|string|min:5',
            'sales_strategy' => 'required|string|min:5',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'department' => 'required|exists:departments,id'
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        $validator->validate();
        $destination->name = $request->name;
        $destination->sales_strategy = $request->sales_strategy;
        $destination->latitude = $request->latitude;
        $destination->longitude = $request->longitude;
        $destination->department->id = Department::findOrFail($request->department)->id;
        if ($destination->isClean()) {
            $validator->errors()->add(
                'general', 'El destino no ha cambiado'
            );
            throw new ValidationException($validator);
        }
        $destination->save();

        return redirect('destinations')->with('flash', 'El destino ' . $data['name'] . ' ha sido editado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        $this->authorize('update-destroy-user-equals', [$destination]);
        $destination->delete();

        return redirect('destinations')->with('flash', 'El destino ' . $destination->name . ' ha sido eliminado.');
    }

    public function eliminate(Destination $destination) {
        $this->authorize('update-destroy-user-equals', [$destination]);
        return view('functionalities.destination.eliminate', compact('destination'));
    }
}
