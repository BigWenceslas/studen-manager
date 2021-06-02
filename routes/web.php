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
use App\Http\Controllers\Admin\ProfilAcademiqueController;
use App\Http\Controllers\NiveauxController;
use App\Http\Controllers\FilieresController;
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

Route::resource('users', UsersController::class)->middleware(['auth','admin']);

Route::delete('users_mass_destroy', [UsersController::class,'massDestroy'])->name('users.mass_destroy');

// Paiement
Route::get('paiement',[NavigationController::class,'paiement'])->name('paiement');
Route::get('paiement/{id}',[NavigationController::class,'paiementEdit'])->name('paiement.edit');
Route::get('paiement-make',[PaiementController::class,'index'])->name('paiement-make');
Route::post('paiement-add',[PaiementController::class,'store'])->name('paiement.add');

// Profil Academique
Route::get('profil-academique',[NavigationController::class,'ProfilAcademique'])->name('profil-academique');
Route::get('profil-academique/{id}',[NavigationController::class,'ProfilAcademiqueEdit'])->name('profil-academique.edit')->middleware('admin');
Route::get('profil-academique-make',[ProfilAcademiqueController::class,'index'])->name('profil-academique-make')->middleware('admin');
Route::post('profil-academique-add',[ProfilAcademiqueController::class,'store'])->name('profil-academique.add')->middleware('admin');
Route::get('profil-academique-delete/{id}',[ProfilAcademiqueController::class,'delete'])->name('profil-academique.destroy')->middleware('admin');

// Filieres
Route::get('filieres',[FilieresController::class,'filieres'])->name('filieres');
Route::get('filieres-make',[FilieresController::class,'index'])->name('filieres-make');
Route::post('filieres-add',[FilieresController::class,'store'])->name('filieres-add');
Route::delete('filieres-delete',[FilieresController::class,'delete'])->name('filieres-delete');

// Niveaux
Route::get('niveaux',[NiveauxController::class,'niveaux'])->name('niveaux')->middleware('admin');
Route::get('niveaux-make',[NiveauxController::class,'index'])->name('niveaux-make')->middleware('admin');
Route::post('niveaux-add',[NiveauxController::class,'store'])->name('niveaux-add')->middleware('admin');
Route::delete('niveaux-delete',[NiveauxController::class,'delete'])->name('niveaux-delete')->middleware('admin');;

Route::get('profil/{id}',[NavigationController::class,'profile'])->name('profil');

Route::get('profilinformation/{id}',[NavigationController::class,'profileinformation'])->name('profilinformation');

Route::get('updatepassword/{id}',[NavigationController::class,'updatepassword'])->name('updatepassword');

Route::post('postupdatepassword',[NavigationController::class,'store'])->name('postupdatepassword');
// Route::post('login-custom',[NavigationController::class,'login'])->name('login-custom');

Route::resource('permissions', PermissionsController::class)->middleware(['auth','admin']);
Route::delete('permissions_mass_destroy', [PermissionsController::class,'massDestroy'])->name('permissions.mass_destroy');

Route::resource('roles', RolesController::class)->middleware('admin');

Route::delete('roles_mass_destroy', [RolesController::class,'massDestroy'])->name('roles.mass_destroy');

// Etudiant

Route::get('etudiant',[EtudiantController::class,'index'])->name('etudiant');



