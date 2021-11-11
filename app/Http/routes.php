<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::auth();

Route::post('login', 'Auth\AuthController@login');
Route::get('login',  'Auth\AuthController@showLoginForm');
Route::get('logout', 'Auth\AuthController@logout');

Route::get('/', 'HomeController@index');

Route::get('/profile', 'UserController@profile');
Route::get('/profile-edit', 'UserController@profileEdit');
Route::post('/profile-update', 'UserController@profileUpdate');
Route::get('/user', 'UserController@index');
Route::get('/user/inactive', 'UserController@inactive');
Route::get('/user/{id}', 'UserController@show');
	
Route::get('/department', 'DepartmentController@index');

Route::get('/process', 'ProcessController@index');
	
Route::get('/designation', 'DesignationController@index');

Route::get('/select', 'SelectController@index');

Route::get('/option', 'OptionController@index');

Route::get('change-password-form', 'UserController@changePasswordForm');
Route::post('change-password-store', 'UserController@changePasswordStore');

Route::get('/attendance', 'AttendanceController@index');
// Route::get('/attendance-upload-excel', 'AttendanceController@create');
// Route::post('/attendance-upload-store', 'AttendanceController@store');

Route::get('/own-form', 'ReportController@ownForm');
Route::get('/own-show', 'ReportController@ownShow');

Route::get('/own/attendance/{id}/edit', 'AttendanceController@ownEdit');
Route::put('/own/attendance/{id}', 'AttendanceController@ownUpdate');

Route::get('/check-in-out-insert-yesterday', 'CheckInOutController@insertYesterday');
Route::get('/in-out', 'CheckInOutController@index');
Route::get('/it', 'CheckInOutController@it');

Route::get('/leave', 'LeaveController@index');
Route::get('/leave/create', 'LeaveController@create');
Route::post('/leave', 'LeaveController@store');
Route::get('/leave/{id}', 'LeaveController@show');
Route::get('/line-manager-leave', 'LeaveController@lineManagerIndex');
Route::get('/line-manager-leave/{id}/edit', 'LeaveController@lineManagerEdit');
Route::put('/line-manager-leave/{id}', 'LeaveController@lineManagerUpdate');
Route::get('/hr-leave', 'LeaveController@hrIndex');
Route::get('/hr-leave/{id}/edit', 'LeaveController@hrEdit');
Route::put('/hr-leave/{id}', 'LeaveController@hrUpdate');

Route::get('/leave-report', 'LeaveReportController@index');
	
Route::group([ 'middleware' => 'can:admin-access'], function () {
	Route::get('/user/{id}/edit', 'UserController@edit');
	Route::put('/user/{id}', 'UserController@update');

	Route::get('/user-registration', 'UserRegistrationController@create');
	Route::post('/user-registration', 'UserRegistrationController@store');

	Route::get('/department/create', 'DepartmentController@create');
	Route::post('/department', 'DepartmentController@store');
	Route::get('/department/{id}/edit', 'DepartmentController@edit');
	Route::put('/department/{id}', 'DepartmentController@update');

	Route::get('/process/create', 'ProcessController@create');
	Route::post('/process', 'ProcessController@store');
	Route::get('/process/{id}/edit', 'ProcessController@edit');
	Route::put('/process/{id}', 'ProcessController@update');

	Route::get('/designation/create', 'DesignationController@create');
	Route::post('/designation', 'DesignationController@store');
	Route::get('/designation/{id}/edit', 'DesignationController@edit');
	Route::put('/designation/{id}', 'DesignationController@update');

	Route::get('/check-in-out-form', 'CheckInOutController@form');
	Route::post('/check-in-out-insert', 'CheckInOutController@insert');

	Route::get('/select/create', 'SelectController@create');
	Route::post('/select', 'SelectController@store');
	Route::get('/select/{id}/edit', 'SelectController@edit');
	Route::put('/select/{id}', 'SelectController@update');

	Route::get('/option/create', 'OptionController@create');
	Route::post('/option', 'OptionController@store');
	Route::get('/option/{id}/edit', 'OptionController@edit');
	Route::put('/option/{id}', 'OptionController@update');

	Route::get('/attendance/{id}/edit', 'AttendanceController@edit');
	Route::put('/attendance/{id}', 'AttendanceController@update');

	Route::get('/report/id-wise-form', 'ReportController@idWiseForm');
	Route::get('/report/id-wise-show', 'ReportController@idWiseShow');
	Route::get('/report/id-wise-shown', 'ReportController@idWiseShown');
	Route::post('/report/id-wise-shown', 'ReportController@idWiseShown');
	Route::get('/report/dept-wise-form', 'ReportController@deptWiseForm');
	Route::get('/report/dept-wise-show', 'ReportController@deptWiseShow');
	Route::get('/report/desig-wise-form', 'ReportController@desigWiseForm');
	Route::get('/report/desig-wise-show', 'ReportController@desigWiseShow');
	Route::get('/report/process-wise-form', 'ReportController@processWiseForm');
	Route::get('/report/process-wise-show', 'ReportController@processWiseShow');
	Route::get('/report/all-user-form', 'ReportController@allUserForm');
	Route::get('/report/all-user-show', 'ReportController@allUserShow');

	Route::get('/report/dept-wise-summary-form', 'ReportSummaryController@deptWiseSummaryForm');
	Route::get('/report/dept-wise-summary-show', 'ReportSummaryController@deptWiseSummaryShow');
	Route::get('/report/id-wise-summary-show', 'ReportSummaryController@idWiseSummaryShow');

	Route::get('/report/id-wise-form-excel', 'ReportExcelController@idWiseFormExcel');
	Route::post('/report/id-wise-show-excel', 'ReportExcelController@idWiseShowExcel');
	Route::get('/report/dept-wise-form-excel', 'ReportExcelController@deptWiseFormExcel');
	Route::post('/report/dept-wise-show-excel', 'ReportExcelController@deptWiseShowExcel');
	Route::get('/report/all-user-form-excel', 'ReportExcelController@allUserFormExcel');
	Route::post('/report/all-user-show-excel', 'ReportExcelController@allUserShowExcel');

	Route::get('/emp-form', 'ReportController@empForm');
	Route::get('/emp-show', 'ReportController@empShow');

});

Route::group([ 'middleware' => 'can:supervisor-access'], function () {
	
	Route::get('/super-form', 'ReportController@superForm');
	Route::get('/super-show', 'ReportController@superShow');
	Route::get('/super/attendance/{id}/edit', 'AttendanceController@superEdit');
	Route::put('/super/attendance/{id}', 'AttendanceController@superUpdate');

});