<?php

namespace App\Http\Controllers\DashboardUniversity;

use App\Models\year;
use App\Models\company;

use App\Models\contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddCompanyContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = contract::get();
        return view('contracts')->with('contracts', $contracts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AddContract')->with('year', Year::latest()->first());;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $adminKey = env('ADMIN_KEY');
        if ($request->adminKey == $adminKey) {

            $request->validate([
                'company_name' => ['required', 'alpha_dash', 'unique:companies,company_name'],
                'company_address' => ['required', 'alpha_num'],
                'comunication_email' => ['required', 'email', 'unique:companies,comunication_email'],
                'phone_number' => ['required', 'regex:/^09\d{8}$/', 'unique:companies,phone_number'],
                'company_website' => ['url', 'unique:companies,company_website'],
                'contract_number' => ['required', 'numeric'],
                'contract_price' => ['required', 'numeric'],
                'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date'],
                'year_id' => ['required']
            ]);
            //create company record
            $company =  company::create($request->only(["company_name", "company_address", "comunication_email", "phone_number", "company_website"]));
            //----------------------------------------------
            //create contract record
            $contract = $request->only(["contract_number", "contract_price", "start_date", "end_date", "year_id"]);
            $contract['company_id'] = $company->company_id;
            contract::create($contract);
            return redirect()->route('Add_Company_Contract.index');
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

            return view('editcontract')->with('edit_contract', contract::fingOrFail($id));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Company not found');
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
                'company_name' => ['required', 'alpha_dash', 'unique:companies,company_name'],
                'company_address' => ['required', 'alpha_num'],
                'comunication_email' => ['required', 'email'],
                'phone_number' => ['required', 'regex:/^09\d{8}$/'],
                'company_website' => ['url'],
                'contract_number' => ['required', 'numeric'],
                'contract_price' => ['required', 'numeric'],
                'start_date' => ['required', 'date'],
                'end_date' => ['required', 'date'],
                'company_id' => ['required'],
                'year_id' => ['required']

            ]);
            //update company record
            $company_id = $request->only('company_id');
            try {
                $company = company::findOrFail($company_id);

                $company->update($request->only(["company_name", "company_address", "comunication_email", "phone_number", "company_website"]));
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

                return redirect()->back()->with('error', 'Company not found');
            }



            //--------------------------------------------- 
            //update contract record

            try {

                $contract = contract::findOrFail($id);

                $contract->update($request->only(["contract_number", "contract_price", "start_date", "end_date", "year_id", "company_id"]));
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

                return redirect()->back()->with('error', 'contract not found');
            }
            //-----------------------------------------------
            return redirect()->route('Add_Company_Contract.index');
        } else
            return redirect()->back()->with('error', 'You are not allowed to add users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $contract = contract::findOrFail($id);
            $company_id = $contract['company_id'];
            $company = company::findOrFail($company_id);
            $contract->delete();
            $company->delete();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'contract or company not found');
        }

        return redirect()->route('Add_Company_Contract.index');
    }
}
