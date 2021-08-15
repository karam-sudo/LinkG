<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

    Route::group(['middleware'=>['guest']],function(){
    Route::get('/', function()
    {
        return view('auth.login');
    });
    });



 //==============================Translate all pages============================
 Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

     //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('check.status');


   //==============================services============================
   Route::group(['namespace' => 'Services'], function () {

        Route::resource('Services', 'ServiceController');

        Route::post('Upload_service_attachment', 'ServiceController@Upload_attachment')->name('Upload_service_attachment');

        Route::get('Download_service_attachment/{Servicename}/{filename}', 'ServiceController@Download_attachment')->name('Download_service_attachment');

        Route::post('Delete_service_attachment', 'ServiceController@Delete_attachment')->name('Delete_service_attachment');
    });

    //  Route::view('add_parent','livewire.show_Form');

    //==============================Projects============================
    Route::group(['namespace' => 'Projects'], function () {

        Route::resource('Projects', 'ProjectController');

        Route::post('Upload_project_attachment', 'ProjectController@Upload_attachment')->name('Upload_project_attachment');

        Route::get('Download_project_attachment/{projectsname}/{filename}', 'ProjectController@Download_attachment')->name('Download_project_attachment');

        Route::post('Delete_project_attachment', 'ProjectController@Delete_attachment')->name('Delete_project_attachment');


    });



    //==============================Positions============================
    Route::group(['namespace' => 'Positions'], function () {

        Route::resource('Positions', 'PositionController');

    });


    //==============================TeanMembers============================

   /* Route::group(['namespace' => 'TeamMembers'], function () {

        Route::resource('TeamMembers', 'TeamMemberController');

        Route::get('/Get_positions/{id}', 'TeamMemberController@Get_positions');

        Route::post('Upload_attachment', 'TeamMemberController@Upload_attachment')->name('Upload_attachment');

        Route::get('Download_member_attachment/{membername}/{filename}', 'TeamMemberController@Download_attachment')->name('Download_member_attachment');

        Route::post('Delete_member_attachment', 'TeamMemberController@Delete_attachment')->name('Delete_member_attachment');




    });*/


    //==============================Employees============================

    Route::group(['namespace' => 'Employees'], function () {

        Route::resource('Employees', 'EmployeeController');

        Route::get('/Get_positions/{id}', 'EmployeeController@Get_positions');

        Route::post('Upload_Employee_attachment', 'EmployeeController@Upload_attachment')->name('Upload_Employee_attachment');

        Route::get('Download_Employee_attachment/{Employeename}/{filename}', 'EmployeeController@Download_attachment')->name('Download_Employee_attachment');

        Route::post('Delete_member_attachment', 'EmployeeController@Delete_attachment')->name('Delete_Employee_attachment');




    });

    Route::group(['namespace' => 'Gallery'], function () {

        Route::resource('Gallery', 'GalleryController');

        Route::post('Upload_Gallery_attachment', 'GalleryController@Upload_attachment')->name('Upload_Gallery_attachment');

        Route::get('Download_Gallery_attachment/{Galleriesdesc}/{filename}', 'GalleryController@Download_attachment')->name('Download_Gallery_attachment');

        Route::post('Delete_Gallery_attachment', 'GalleryController@Delete_attachment')->name('Delete_Gallery_attachment');




    });

     //==============================permissions============================

     Route::group(['middleware' => ['auth']], function() {

        Route::resource('roles','\App\Http\Controllers\Spatie\RoleController');
        Route::resource('users','\App\Http\Controllers\Spatie\UserController');



    });



    });


//Route::get('/developers', 'DevelopersController@index');





