<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Attachments;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TransferRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;
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




// authentication.....

Route::get('/', [AuthController::class , 'login'])->name('login');

Route::post('/', [AuthController::class , 'authenticate']);

Route::get('/signup', [AuthController::class , 'register'])->name('signup');
// registering account
Route::post('/users', [AuthController::class,'store'])->name('users.store');

Route::get('/confirmation', [AuthController::class , 'confirmation'])->name('confirmation');

Route::post('/logout', [AuthController::class , 'logout'])->name('logout');
// Show the form to request a password reset link

Route::get('password/reset', [PasswordResetController::class, 'showLinkRequestForm'])
    ->name('password.request');

// Handle sending the password reset link
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Show the form to reset the password
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset');

// Handle the password reset form submission
Route::post('password/reset/', [PasswordResetController::class, 'reset'])
    ->name('password.update');


// superadmin-routes

Route::middleware(['auth' , 'superadmin'])->group(function () {
        Route::get('/sa-admins', [SuperAdminController::class ,'index'])->name('sa.admins');

        Route::get('/sa-attachments/everyone', [SuperAdminController::class ,'attachments'])->name('sa.attachments');

        Route::get('/sa-profile', [SuperAdminController::class ,'profile'])->name('sa.profile');

        Route::get('/sa-approval', [SuperAdminController::class ,'approval'])->name('sa.approval');

        Route::get('/sa-staff', [SuperAdminController::class ,'staff'])->name('sa.staff');

        Route::get('/sa-profile/{sa}/edit', [SuperAdminController::class,'edit'])->name('sa.edit');

        Route::put('/sa-profile/{sa}', [SuperAdminController::class,'update'])->name('sa.update');

        Route::get('/sa-staff/{staff}/edit', [SuperAdminController::class,'editStaff'])->name('sa.edit-staff');

        Route::put('/sa-staff/{staff}', [SuperAdminController::class,'updateStaff'])->name('sa.update-staff');

        Route::get('/sa-admin/{admin}/edit', [SuperAdminController::class,'editAdmin'])->name('sa.edit-admin');

        Route::put('/sa-admin/{admin}', [SuperAdminController::class,'updateAdmin'])->name('sa.update-admin');

        Route::get('/sa-attachments/municipality', [SuperAdminController::class, 'municipality'])->name('sa.municipality');

        Route::get('/sa-attachments/onlyme', [SuperAdminController::class, 'onlyMe'])->name('sa.only-me');

        Route::get('/sa-attachments/public', [SuperAdminController::class, 'publicAttachments'])->name('sa.public');

        Route::get('/sa-create-attachment', [SuperAdminController::class, 'createAttachment'])->name('sa.create');

        Route::get('/sa-attachments/everyone/{municipality?}', [SuperAdminController::class, 'specificMunicipality'])
        ->name('sa.search');

        Route::get('/sa-approval/user/{user}', [SuperAdminController::class, 'approve'])->name('sa.approve');

        Route::get('/sa-staff/{municipality}', [SuperAdminController::class ,'specificStaff'])->name('sa.specificStaff');

        Route::get('/sa-admins/{municipality}', [SuperAdminController::class ,'specificAdmin'])->name('sa.specificAdmin');

        Route::get('/sa/update-password/{user}/edit', [SuperAdminController::class, 'updatePasswordForm'])
        ->name('sa.password');
        
        Route::put('/sa/update-password/{user}', [SuperAdminController::class, 'updatePassword'])
            ->name('sa.passUpdate');

            
    Route::get('/sa/request-of-transfers', [SuperAdminController::class, 'showRequest'])->name('sa.request');

    Route::get('/sa/approval-of-transfers', [SuperAdminController::class, 'showApproval'])->name('sa.showApproval');

    Route::get('/sa/approval-of-transfers/{user}', [SuperAdminController::class, 'approvedApproval'])->name('sa.approved');

    Route::get('/sa-request', [SuperAdminController::class, 'goToRequest'])->name('sa.showRequest');

    Route::post('/sa-request', [TransferRequestController::class, 'store'])->name('sa.requestTransfer');
    
    Route::get('/sa/request-of-transfers/user/{user}', [SuperAdminController::class, 'approvedRequest'])->name('sa.requestApproved');
});

// admin-routes

Route::middleware(['auth', 'admin'])->group(function () {

    // Route::get('/admin/all-admins', [AdminController::class, 'admin'])->name('admin.admin');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');

    Route::put('/admin/users/disable/{admin}', [AdminController::class, 'disableUser'])->name('admin.disable');

    Route::put('/admin/users/enable/{admin}', [AdminController::class, 'enableUser'])->name('admin.enable');

    Route::get('/admin/all-admins/{municipality}', [AdminController::class ,'specificAdmin'])->name('admin.specificAdmin');

    Route::get('/admin/all-admins/{admin}/edit/', [AdminController::class,'editAdmin'])->name('admin.edit-admin');

    Route::put('/admin/all-admins/{admin}', [AdminController::class,'updateAdmin'])->name('admin.update-admin');
    
    Route::get('/admin-staff', [AdminController::class, 'index'])->name('admin.staff');

    Route::get('/admin-staff/{municipality}', [AdminController::class ,'specificStaff'])->name('admin.specificStaff');

    Route::get('/admin-staff/{staff}/edit', [AdminController::class,'editStaff'])->name('admin.edit-staff');

    Route::put('/admin-staff/{staff}', [AdminController::class,'updateStaff'])->name('admin.update-staff');

    Route::get('/admin-approval', [AdminController::class, 'approval'])->name('admin.approval');

    Route::get('/admin-profile', [AdminController::class, 'profile'])->name('admin.profile');

    Route::get('/admin-profile/{admin}/edit', [AdminController::class,'edit'])->name('admin.edit');

    Route::put('/admin-profile/{admin}', [AdminController::class,'update'])->name('admin.update');

    Route::get('/admin-create-attachment', [AdminController::class, 'createAttachment'])->name('admin.create');

    Route::get('/admin-attachments/municipality', [AdminController::class, 'municipality'])->name('admin.municipality');

    Route::get('/admin-attachments/public', [AdminController::class, 'publicAttachments'])->name('admin.public');

    Route::get('/admin-attachments/everyone', [AdminController::class, 'attachments'])->name('admin.attachments');

    Route::get('/admin-attachments/everyone/{municipality?}', [AdminController::class, 'specificMunicipality'])
    ->name('admin.search');

    Route::get('/admin-attachments/user/only-me', [AdminController::class, 'onlyme'])->name('admin.onlyme');

    Route::get('/admin-approval/user/{user}', [AdminController::class, 'approve'])->name('admin.approve');

    Route::get('/admin/update-password/{user}/edit', [AdminController::class, 'updatePasswordForm'])
    ->name('admin.password');

    Route::put('/admin/update-password/{user}', [AdminController::class, 'updatePassword'])
        ->name('admin.passUpdate');

    Route::get('/admin/request-of-transfers', [AdminController::class, 'showRequest'])->name('admin.request');

    Route::get('/admin/approval-of-transfers', [AdminController::class, 'showApproval'])->name('admin.showApproval');

    Route::get('/admin/approval-of-transfers/{user}', [AdminController::class, 'approvedApproval'])->name('admin.approved');

    Route::get('/admin-request', [AdminController::class, 'goToRequest'])->name('admin.showRequest');

    Route::post('/admin-request', [TransferRequestController::class, 'store'])->name('admin.requestTransfer');
    
    Route::get('/admin/request-of-transfers/user/{user}', [AdminController::class, 'approvedRequest'])->name('admin.requestApproved');
});




// staff routes 

Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('/staff-attachments/everyone', [StaffController::class, 'attachments'])->name('staff.attachments');

    Route::get('/staff-profile', [StaffController::class, 'profile'])->name('staff.profile');

    Route::get('/staff-profile/{staff}/edit', [StaffController::class,'edit'])->name('staff.edit');

    Route::put('/staff-profile/{staff}', [StaffController::class,'update'])->name('staff.update');

    Route::get('/staff-attachments/municipality', [StaffController::class, 'municipality'])->name('staff.municipality');

    Route::get('/staff-attachments/onlyme', [StaffController::class, 'onlyMe'])->name('staff.only-me');

    Route::get('/staff-attachments/public', [StaffController::class, 'publicAttachments'])->name('staff.public');

    Route::get('/staff-create-attachment', [StaffController::class, 'createAttachment'])->name('staff.create');

    Route::get('/staff-attachments/everyone/{municipality?}', [StaffController::class, 'specificMunicipality'])
    ->name('staff.search');

    Route::get('/staff/update-password/{user}/edit', [StaffController::class, 'updatePasswordForm'])
    ->name('staff.password');

    Route::put('/staff/update-password/{user}', [StaffController::class, 'updatePassword'])
        ->name('staff.passUpdate');

        Route::get('/staff-request', [StaffController::class, 'goToRequest'])->name('staff.showRequest');

        Route::post('/staff-request', [TransferRequestController::class, 'store'])->name('staff.requestTransfer');

});


// file upload routes

Route::middleware('auth')->group(function () {
        
    Route::post('/staff-attachments', [Attachments::class, 'store'])->name('staff.attachments-store');

    Route::post('/admin-attachments', [Attachments::class, 'store'])->name('admin.attachments-store');

    Route::post('/superadmin-attachments', [Attachments::class, 'store'])->name('sa.attachments-store');

    Route::get('/attachment/{file}/edit', [Attachments::class,'edit'])->name('file.edit');

    Route::put('/attachment/{file}', [Attachments::class,'update'])->name('file.update');

    Route::delete('/attachment/delete/{file}', [Attachments::class, 'destroy'])->name('file.destroy');

    Route::delete('/user/delete/{user}', [AuthController::class , 'destroy'])->name('user.destroy');

    Route::delete('/transfer-request/delete/{user}', [TransferRequestController::class , 'destroy'])->name('request.destroy');

    
    Route::get('/forgot-password', [AuthController::class , "goToForgotPassword"])->name('user.resetPassword');

});





