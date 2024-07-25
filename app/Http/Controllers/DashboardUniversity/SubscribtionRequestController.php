<?php

namespace App\Http\Controllers\DashboardUniversity;

use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\subscription_request;
use Illuminate\Support\Facades\Hash;

class SubscribtionRequestController extends Controller
{
    /**
     * Display a listing of the subscriber request type name .
     */
    public function index()
    {
        $request = subscription_request::get();
        return view('subscription_request_show')->with('request', $request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified request in add subscriber form page.
     */
    public function show(string $id)
    {
        try {

            return view('subscriber.Add_subscriptionForm')->with('request', subscription_request::findOrFail($id)); //show in subscriber form page

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'subscriber Request not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
