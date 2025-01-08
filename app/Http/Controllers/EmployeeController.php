<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
     // Display all employees
     public function index(Request $request)
     {
         $search = $request->input('search', '');
         
         $employees = Employee::when($search, function ($query, $search) {
             return $query->where('employee_code', 'like', "%{$search}%")
                          ->orWhere('name', 'like', "%{$search}%")
                          ->orWhere('city', 'like', "%{$search}%");
         })
         ->paginate(50); // Paginate results per page
 
         return view('employees.list', compact('employees', 'search'));
     }
}
