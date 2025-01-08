<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PlansController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Exports\BranchExport;
use App\Exports\MemberExport;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-email', function () {
    try {
        Mail::raw('This is a test email.', function ($message) {
            $message->to('cont2chhoton@gmail.com')
                    ->subject('Test Email');
        });
        return 'Test email sent successfully!';
    } catch (\Exception $e) {
        return 'Failed to send email: ' . $e->getMessage();
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','verified'])->group(function () {

    Route::get('/company', [CompanyController::class, 'index'])->name('company.view');
    Route::get('/company-update', [CompanyController::class, 'Edite'])->name('company.edit');
    Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
    Route::post('/share-ranges/update', [CompanyController::class, 'ShareRangeUpdate'])->name('share-ranges.update');
    
    Route::get('/branches', [CompanyController::class, 'branch'])->name('company.branch');
    Route::get('/branches/form/{id?}', [CompanyController::class, 'branchForm'])->name('company.branch.form');
    // This route handles both inserting and updating branches based on the presence of $id
    Route::post('/branches/form/{id?}', [CompanyController::class, 'storeOrUpdateBranch']);

    
    Route::get('/agent', [AgentController::class, 'index'])->name('agent.index');
    Route::get('/agent/form/{id?}', [AgentController::class, 'AgentForm'])->name('agent.form');
    Route::post('/agent/form/{id?}', [AgentController::class, 'storeOrUpdateAgent'])->name('agent.save');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/form/{id?}', [EmployeeController::class, 'EmployeeForm'])->name('employees.form');

    Route::get('/members', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/form/{id?}', [MemberController::class, 'MemberForm'])->name('member.form');
    Route::post('/member/form/{id?}', [MemberController::class, 'storeOrUpdateMember'])->name('member.save');

    Route::get('members/export-pdf', [PDFController::class, 'MemberExportPDF'])->name('members.export.pdf');
    Route::get('members/export-excel', function () {
        return Excel::download(new MemberExport, 'members.xlsx');
    })->name('members.export.excel');

    Route::get('/agent', [AgentController::class, 'index'])->name('agent.index');
    Route::get('/agent/form/{id?}', [AgentController::class, 'AgentForm'])->name('agent.form');
    Route::post('/agent/form/{id?}', [AgentController::class, 'storeOrUpdateAgent'])->name('agent.save');

    Route::get('/savings-plan', [PlansController::class, 'SavingIndex'])->name('saving.index');
    Route::get('/savings-plan/form/{id?}', [PlansController::class, 'SavingForm'])->name('saving.form');
    Route::post('/savings-plan/form/{id?}', [PlansController::class, 'storeOrUpdateSaving'])->name('saving.save');


    Route::get('/fd-plan', [PlansController::class, 'FdIndex'])->name('fd.index');
    Route::get('/fd-plan/form/{id?}', [PlansController::class, 'FdForm'])->name('fd.form');
    Route::post('/fd-plan/form/{id?}', [PlansController::class, 'storeOrUpdateFd'])->name('fd.save');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route group with 'auth' and 'verified' middleware for pdf export
Route::middleware(['auth', 'verified'])->group(function () {
    // Define the route for exporting branches to PDF
    Route::get('branches/export-pdf', [PDFController::class, 'BranchExportPDF'])->name('branches.export.pdf');
    Route::get('branches/export-excel', function () {
        return Excel::download(new BranchExport, 'branches.xlsx');
    })->name('branches.export.excel');
});


require __DIR__.'/auth.php';
