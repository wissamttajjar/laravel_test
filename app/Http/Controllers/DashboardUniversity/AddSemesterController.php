<?php

namespace App\Http\Controllers\DashboardUniversity;

use App\Models\year;
use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class AddSemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semesters = Semester::get();
        return view('semester')->with('semesters', $semesters);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        try {
            return view('Addsemester')->with('year', year::findOrFail($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'year not found');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $adminKey = env('ADMIN_KEY');
        if ($request->adminKey == $adminKey) {

            $request->validate([
                'semester_name' => ['required', 'alpha_dash'],
                'semester_code' => ['required', 'alpha_num', 'unique:semesters,semester_code'],
                'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date', 'after:start_date'],
                'year_id' => ['required']

            ]);

            $semester = $request->except(["_token", "adminKey"]);
            // $year_id = year::where('year_date', $semester['year_id'])->first();
            // if ($year_id) {
            //     $semester['year_id'] = $year_id->id;
            // }
            $semester['password'] = Hash::make($semester['password']);
            Semester::create($semester);

            return redirect()->route('Add_Semester.index');
        } else
            return redirect()->back()->with('error', 'You are not allowed to add users');
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

            return view('editsemester')->with('editsemester', Semester::findOrFail($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Semester not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $adminKey = env('ADMIN_KEY');
        if ($request->adminKey == $adminKey) {
            $request->validate([
                'semester_name' => ['required', 'alpha_dash'],
                'semester_code' => ['required', 'alpha_num'], //test the 'unique:semesters,semester_code'
                'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date', 'after:start_date'],
                'year_id' => ['required']

            ]);
            try {

                $semester = Semester::findOrFail($id);
                $semester->update($request->except(["_token", "adminKey"]));
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return redirect()->back()->with('error', 'Semester not found');
            }
            return redirect()->route('Add_Semester.index');
        } else
            return redirect()->back()->with('error', 'You are not allowed to edit users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $semester = Semester::findOrFail($id);
            $semester->delete();
            return redirect()->route('Add_Semester.index');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Semester not found');
        }
    }
}
