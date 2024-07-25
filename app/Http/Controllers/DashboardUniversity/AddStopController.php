<?php

namespace App\Http\Controllers\DashboardUniversity;

use App\Models\stop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddStopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stop = stop::get();
        return view('All_stop')->with('stop', $stop);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Add_stop');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'stops' => ['required', 'array'],
                'stops.*.stop_name' => ['required', 'alpha_dash'],
                'stops.*.stop_location' => ['required', 'alpha_dash'],
            ]
        );

        foreach ($request->input('stops') as $stop) {
            Stop::create($stop);
        }

        return redirect()->route('Add_Stop.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {

            return view('edit_stop')->with('edit_stop', stop::findOrFail($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Stop not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'stop_name' => ['required', 'alpha_dash'],
                'stop_location' => ['required', 'alpha_dash'],
            ]
        );
        try {
            $stop = stop::findOrFail($id);
            $stop->update($request->only(["stop_name", "stop_location"]));
            return redirect()->route('Add_Stop.index');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Stop not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $stop = stop::findOrFail($id);
            $stop->delete();
            return redirect()->route('Add_Stop.index')->with('success', 'Deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Stop not found');
        }
    }
}
