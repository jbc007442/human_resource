<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MockTestController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\CandidateDashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AppliedJobController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Website Routes (Public)
|--------------------------------------------------------------------------
*/

Route::prefix('/')->group(function () {
    Route::get('/', [WebsiteController::class, 'home'])->name('home');

    Route::get('/companies', [CompanyController::class, 'list'])
        ->name('companies');

    Route::get('/mocktest', [MockTestController::class, 'index'])->name('mocktest');

    Route::get('/about', function () {
        return view('website.about');
    })->name('about');

    Route::get('/contact', function () {
        return view('website.contact');
    })->name('contact');

    // LEAD POST → submit form
    Route::post('/contact', [LeadController::class, 'store'])->name('contact.store');


    Route::get('/test/{id}', [MockTestController::class, 'start'])->name('test.start');
    Route::post('/test/submit/{id}', [MockTestController::class, 'submit'])->name('test.submit');
    Route::get('/test/result/{id}', [MockTestController::class, 'result'])
        ->name('test.result');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest)
|--------------------------------------------------------------------------
*/
Route::prefix('/')->middleware('guest')->group(function () {

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    // ✅ ADD THIS LINE HERE
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    // REGISTER FORM SUBMIT
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/forgot-password', function () {
        return view('auth.forgotpassword');
    })->name('password.forgot');

    Route::get('/reset-password', function () {
        return view('auth.resetpassword');
    })->name('password.reset');
});

/*
|--------------------------------------------------------------------------
| Dashboard Routes (Authenticated)
|--------------------------------------------------------------------------
*/


// ================= COMMON (All Logged-in Users) =================
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// ================= CANDIDATE (Jobseeker) =================
Route::middleware(['auth', 'role:jobseeker'])->group(function () {

    Route::get('/candidate-dashboard', [CandidateDashboardController::class, 'index'])
        ->name('candidate.dashboard');

    Route::get('/applied-jobs', [AppliedJobController::class, 'index'])
        ->name('dashboard.appliedjobs');

    // Resume
    Route::get('/resume', [ResumeController::class, 'index'])->name('dashboard.resume');
    Route::get('/add-resume', [ResumeController::class, 'create'])->name('dashboard.addresume');
    Route::post('/resume/save', [ResumeController::class, 'store'])->name('resume.store');
    Route::get('/resume/download', [ResumeController::class, 'downloadPdf'])->name('resume.download');

    // Job Apply
    Route::get('/jobs/{job}/apply', [ApplicationController::class, 'create'])->name('jobs.apply');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('jobs.apply.store');


    // payment routes
    Route::get('/buy-plan', [PaymentController::class, 'create'])
        ->name('payments.create');

    Route::post('/payment-success', [PaymentController::class, 'store'])
        ->name('payments.store');
});


// ================= COMPANY =================
Route::middleware(['auth', 'role:company'])->group(function () {

    Route::get('/company-overview', [CompanyController::class, 'index'])->name('company.overview');

    Route::get('/jobs/{job}/applicants', [CompanyController::class, 'applicants'])
        ->name('jobs.applicants');

    Route::get('/company-edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/company-save', [CompanyController::class, 'save'])->name('company.save');

    Route::get('/create-jobs', function () {
        return view('dashboard.pages.company.create-jobs');
    })->name('create.jobs');

    Route::get('/edit-jobs/{id}', [JobController::class, 'edit'])->name('edit.jobs');
    Route::post('/update-jobs/{id}', [JobController::class, 'update'])->name('jobs.update');

    Route::get('/job-list', [JobController::class, 'index'])->name('job.list');
    Route::post('/jobs/store', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/data', [JobController::class, 'data'])->name('jobs.data');

    Route::post('/jobs/status/{id}', [JobController::class, 'toggleStatus'])->name('jobs.status');
    Route::delete('/jobs/delete/{id}', [JobController::class, 'delete'])->name('jobs.delete');

    Route::post('/jobs/import', [JobController::class, 'import'])->name('jobs.import');
});


// ================= ADMIN =================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/all-company', [AdminController::class, 'allCompanies'])->name('all.company');

    Route::get('/get-job-by-company/{company_id}', [AdminController::class, 'jobsByCompany'])
        ->name('get.job.by.company');

    Route::get('/applicants/{job_id}', [AdminController::class, 'applicants'])
        ->name('applicants');

    Route::get('/applicant-details/{id}', [AdminController::class, 'applicantDetails'])
        ->name('applicant.details');

    Route::get('/all-user', [UserController::class, 'index'])
        ->name('dashboard.alluser');

    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

    Route::get('/users-json', [UserController::class, 'getUsersJson'])
        ->name('users.json');

    Route::post('/users/toggle-status/{id}', [UserController::class, 'toggleStatus'])
        ->name('users.toggle');

    Route::get('/all-tests', [MockTestController::class, 'allTests'])
        ->name('all.tests');

    Route::get('/test-questions-page/{id}', function ($id) {
        return view('dashboard.pages.user.questionbyId', compact('id'));
    })->name('test.questions.page');

    Route::get('/test-questions/{id}', function ($id) {
        return \App\Models\MockTestQuestion::where('mock_test_id', $id)->get();
    })->name('test.questions');

    Route::get('/leads', [LeadController::class, 'index'])
        ->name('leads.index');

    Route::delete('/leads/{id}', [LeadController::class, 'destroy'])
        ->name('leads.destroy');

    // Mock Tests (Company)
    Route::get('/create-test', [MockTestController::class, 'create'])->name('create.test');
    Route::post('/store-test', [MockTestController::class, 'store'])->name('store.test');
    Route::post('/generate-questions', [MockTestController::class, 'generateQuestions']);

    Route::get('/edit-test/{id}', [MockTestController::class, 'edit'])->name('edit.test');
    Route::post('/update-test/{id}', [MockTestController::class, 'update'])->name('update.test');

    Route::get('/tests-json', function () {
        return response()->json(
            \App\Models\MockTest::withCount('questions')->latest()->get()
        );
    });
});