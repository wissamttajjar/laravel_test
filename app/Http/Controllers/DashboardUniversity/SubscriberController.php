<?php

namespace App\Http\Controllers\DashboardUniversity;

use App\Models\Semester;
use App\Models\subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SubscriberController extends Controller
{
    /**
     * Display a subscriber name type state
     */
    public function index()
    {
        $subscriber = subscriber::get();
        return view('subscriber.show_subscribtion')->with('subscriber', $subscriber);
    }

    /**
     * Show the form for add subscriber
     */
    public function create()
    {
        // return view('subscriber.Add_subscriptionForm');
        return view('subscriber.Add_subscriptionForm')->with('semester', Semester::latest()->first()); //show last semester open for add subscriber into him 
    }

    /**
     * Store a newly created subscriber in storage.
     */
    public function store(Request $request)
    {


        $request->validate(
            [
                'subscriber_type' => ['required'],
                'fullname' => ['required', 'alpha_dash'],
                'college' => ['required', 'alpha_dash'],
                'college_number' => ['required', 'numeric'],
                'phone_number' => ['required', 'regex:/^09\d{8}$/'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*()_+!])[A-Za-z\d@#$%^&*()_+!]+$/'],
                'semester_id' => ['required'],
            ]
        );

        $subscriber = $request->except(['_token']);
        
        $subscriber['password'] = Hash::make($subscriber['password']);
        $store = subscriber::create($subscriber);
        $store->update(['subscriber_state' => 'active']);
        return redirect()->route('subscriber.index');
    }
    /**
     * Display the specified subscriber.
     */
    // public function show(string $id)
    // {
    //     try {

    //         return view('subscriberinfo')->with('subscriberinfo', subscriber::findOrFail($id));
    //     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //         return redirect()->back()->with('error', 'Subscriber not found');
    //     }
    // }

    /**
     * Show the form for editing the specified subscriber.
     */
    public function edit(string $id)
    {
        try {

            return view('edit_subscriber')->with('edit_subscriber', subscriber::findOrFail($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Subscriber not found');
        }
    }

    /**
     * Update the specified subscriber in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'subscriber_type' => ['required'],
                'fullname' => ['required', 'alpha_dash'],
                'college' => ['required', 'alpha'],
                'college_number' => ['required', 'numeric'],
                'phone_number' => ['required', 'regex:/^09\d{8}$/'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:6', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*()_+!])[A-Za-z\d@#$%^&*()_+!]+$/'],
                'subscriber_state' => ['required'],
                'semester_id' => ['required']
            ]
        );
        try {
            $subscriber = subscriber::findOrFail($id);
            $subscriber->update($request->except(['_token']));
            return redirect()->route('subscriber.index');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Subscriber not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $subscriber = subscriber::findOrFail($id);
            $subscriber->delete();
            return redirect()->route('subscriber.index')->with('success', 'Deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Subscriber not found');
        }
    }
}
