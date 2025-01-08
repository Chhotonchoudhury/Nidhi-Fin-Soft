<?php

namespace App\Http\Controllers;
use App\Models\SavingAccountPlan;
use App\Models\FdPlan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    //
    public function SavingIndex(Request $request)
    {
        // Capture search query
        $search = $request->input('search', '');

        // Apply search query and paginate for SavingAccountPlans
        $plans = SavingAccountPlan::when($search, function ($query, $search) {
            return $query->where('plan_code', 'like', "%{$search}%")
                        ->orWhere('plan_name', 'like', "%{$search}%")
                        ->orWhere('annual_interest_rate', 'like', "%{$search}%");
        })
        ->paginate(50); // Paginate results per page

        // Return view with search and paginated results
        return view('accountPlan.Savingindex', compact('plans', 'search'));
    }

    public function SavingForm($id = null)
    {
        if ($id) {
            // Fetch the SavingAccountPlan data for editing
            $plan = SavingAccountPlan::findOrFail($id);
            return view('accountPlan.Savingstore', ['plan' => $plan]);
        } else {
            // For creating a new SavingAccountPlan
            return view('accountPlan.Savingstore');
        }
    }

    public function storeOrUpdateSaving(Request $request, $id = null)
    {
        // Validation
        $validated = $request->validate([
            'plan_code' => 'required|string|unique:saving_account_plans,plan_code,' . ($id ?? 'NULL') . ',id',
            'plan_name' => 'required|string|max:255',
            'min_opening_balance' => 'required|numeric|min:0',
            'min_avg_balance' => 'required|numeric|min:0',
            'annual_interest_rate' => 'required|numeric|min:0|max:100',
            'senior_citizen_annual_interest_rate' => 'nullable|numeric|min:0|max:100',
            'interest_payout' => 'required|in:Monthly,Yearly,Half Yearly,Quarterly',
            'lock_in_amount' => 'required|numeric|min:0',
            'min_monthly_avg_balance_charge' => 'nullable|numeric|min:0',
            'sms_charge_frequency' => 'required|in:Monthly,Yearly',
            'sms_charge' => 'required|numeric|min:0',
            'card_charge_frequency' => 'required|in:Monthly,Yearly',
            'card_charge' => 'required|numeric|min:0',
            'free_ifsc_collection_per_month' => 'required|integer|min:0',
            'active' => 'required|boolean',
        ]);
    
        // Check if ID is provided (Update or Create)
        $plan = $id ? SavingAccountPlan::findOrFail($id) : new SavingAccountPlan();
    
        // Fill the data and save
        $plan->fill($validated);
        $plan->save();
    
        // Redirect with success message
        $message = $id ? 'Plan updated successfully' : 'Plan created successfully';
        return redirect()->route('saving.index')->with('success', $message);
    }



     //
    public function FdIndex(Request $request)
    {
         // Capture search query
         $search = $request->input('search', '');
 
         // Apply search query and paginate for SavingAccountPlans
         $fdPlans = FdPlan::when($search, function ($query, $search) {
             return $query->where('plan_code', 'like', "%{$search}%")
                         ->orWhere('plan_name', 'like', "%{$search}%")
                         ->orWhere('annual_interest_rate', 'like', "%{$search}%");
         })
         ->paginate(50); // Paginate results per page
 
         // Return view with search and paginated results
         return view('accountPlan.Fdindex', compact('fdPlans', 'search'));
    }

    public function FdForm($id = null)
    {
        if ($id) {
            // Fetch the SavingAccountPlan data for editing
            $plan = FdPlan::findOrFail($id);
            return view('accountPlan.Fdstore', ['plan' => $plan]);
        } else {
            // For creating a new SavingAccountPlan
            return view('accountPlan.Fdstore');
        }
    }

    public function storeOrUpdateFd(Request $request, $id = null)
    {
        // Validation
        $validated = $request->validate([
            'plan_code' => 'required|string|unique:fd_plans,plan_code,' . ($id ?? 'NULL') . ',id',
            'plan_name' => 'required|string|max:255',
            'min_amount' => 'required|numeric|min:0',
            'lockin_period' => 'required|string',
            'annual_interest_rate' => 'required|numeric|min:0|max:100',
            'senior_citizen_annual_interest_rate' => 'nullable|numeric|min:0|max:100',
            'interest_lockin_period' => 'required|string',
            'tenure_type' => 'required|in:month,year',
            'tenure_value' => 'required|integer|min:1',
            'interest_payout' => 'required|in:Monthly,Yearly,Quarterly',
            'cancellation_charge' => 'nullable|numeric|min:0',
            'penal_charge' => 'nullable|numeric|min:0',
            'active' => 'required|boolean',
        ]);
    
        // Check if ID is provided (Update or Create)
        $plan = $id ? FdPlan::findOrFail($id) : new FdPlan();
    
        // Fill the data and save
        $plan->fill($validated);
        $plan->save();
    
        // Redirect with success message
        $message = $id ? 'Plan updated successfully' : 'Plan created successfully';
        return redirect()->route('fd.index')->with('success', $message);
    }
    


}
