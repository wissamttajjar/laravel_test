<?php

namespace App\Http\Controllers\DashboardUniversity;

use App\Models\stop;
use App\Models\trip;
use App\Models\Trip_stop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddStopToTripController extends Controller
{
    /**
     * Display a listing of the Trip_stop .
     */
    public function index()
    {
        $trip_stop = Trip_stop::get();
        return view('all_trip_stop')->with('trip_stop', $trip_stop);
    }

    /**
     * Show the page to createing a new record in Trip_Stop .
     * this function receve a $id from trippage .
     * حيث صفحة الاظهار تبع رحلات كل سجل يحوي زر وهو اضافة مواقف عند ضغط عليها ترسل رقم الرحلة من اجل عرضه في صفحة اضافة رحلات ومواقف 
     */
    public function create($id)
    {

        try {
            return view('stoptrip')->with('trip', trip::fingOrFail($id))->with('stop', stop::get());
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'trip not found');
        }
    }

    /**
     * Store a newly created Trip_stop in Trip_Stop model.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'tip_id' => ['required', 'exists:trip,trip_id'],
                'stops' => ['required', 'array'],
                'stops.*' => ['exists:stop,stop_id'],
            ]
        );

        // create a trip_stop ,,, create every trip with stop in a record ,,,1 trip with 4 stop ->4record in Trip_stop model
        foreach ($request->input('stops') as $stop_id) {
            Trip_stop::insert([
                'trip_id' => $request->input('trip_id'),
                'stop_id' => $stop_id,
            ]);
        }


        return redirect()->route('Add_stop_to_trip.index');
    }

    /**
     * 
     * Display the specified Trip_stop to delelt or edit this record .
     */
    public function show(string $id)
    {
        try {

            return view('showtripstop')->with('tripstop', Trip_stop::findOrFail($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Trip_stop not found');
        }
    }

    /**
     * Show the form for editing the specified Trip_stop.
     */
    public function edit(string $id)
    {
        try {

            return view('edittrip_stop')->with('edittrip_Stop', Trip_stop::fingOrFail($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Trip_stop not found');
        }
    }

    /**
     * Update the specified Trip_Stop  in Trip_stop model.
     */
    public function update(Request $request, string $id)
    {

        $request->validate(
            [
                'tip_id' => ['required', 'exists:trip,trip_id'],
                'stop_id' => ['required', 'exists:stop,stop_id']
            ]
        );

        try {
            $trip_stop = Trip_stop::findOrFail($id);

            $trip_stop->update($request->only(["trip_id", "stop_id"]));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return redirect()->back()->with('error', 'trip_stop not found');
        }

        //-----------------------------------------------
        return redirect()->route('Add_stop_to_trip.index');
    }

    /**
     * Remove the specified Trip_stop record from storage. 
     * 1- from show page and delet one record from Trip_stop
     */
    public function destroyOneRecordTripStop(string $id)
    {

        try {
            $trip_stop = Trip_stop::findOrFail($id);
            $trip_stop->delete();
            return redirect()->route('Add_stop_to_trip.index');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Trip not found to delet');
        }
    }

    // 2-delet all record from Trip_Stop with tip id
    public function destroyTripStop(string $trip_id)
    {
        // يقوم بالبحث عن جميع سجلات الرحلة بناءً على trip_id
        $trip_stops = Trip_stop::where('trip_id', $trip_id);

        // يقوم بحذف جميع سجلات الرحلة المطابقة
        $trip_stops->delete();

        // يعيد توجيه المستخدم إلى الصفحة الرئيسية
        return redirect()->route('Add_stop_to_trip.index');
    }
}
