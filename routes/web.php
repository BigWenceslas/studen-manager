<?php

use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use \App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\Admin\PaiementController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin',[NavigationController::class,'Dashboard'])->name('Dashboard')->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', function() {
    return view('auth.login');
})->name('login');

Route::get('language/{locale}',  [LocalizationController::class,'lang'])->name('langue');

Route::resource('users', UsersController::class)->middleware('auth');

Route::delete('users_mass_destroy', [UsersController::class,'massDestroy'])->name('users.mass_destroy');

// Paiement
Route::get('paiement',[NavigationController::class,'paiement'])->name('paiement');
Route::get('paiement-make',[PaiementController::class,'index'])->name('paiement-make');
Route::post('paiement-add',[PaiementController::class,'store'])->name('paiement.add');

Route::get('profil/{id}',[NavigationController::class,'profile'])->name('profil');

Route::get('profilinformation/{id}',[NavigationController::class,'profileinformation'])->name('profilinformation');

Route::get('updatepassword/{id}',[NavigationController::class,'updatepassword'])->name('updatepassword');

Route::post('postupdatepassword',[NavigationController::class,'store'])->name('postupdatepassword');
// Route::post('login-custom',[NavigationController::class,'login'])->name('login-custom');

Route::resource('permissions', PermissionsController::class)->middleware('auth');
Route::delete('permissions_mass_destroy', [PermissionsController::class,'massDestroy'])->name('permissions.mass_destroy');

Route::resource('roles', RolesController::class);

Route::delete('roles_mass_destroy', [RolesController::class,'massDestroy'])->name('roles.mass_destroy');

// Etudiant

Route::get('etudiant',[EtudiantController::class,'index'])->name('etudiant');



