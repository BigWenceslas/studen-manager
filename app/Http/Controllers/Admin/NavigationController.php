<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Paiement;
use App\Models\Profil_academique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Spatie\Permission\Models\Role;

class NavigationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Dashboard()
    {
        $user = User::get()->count();
        $paiements = Paiement::get()->count();
        return view("admin.dashboard", compact('user','paiements'));
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.profil.index', compact('user','roles'));
    }

    public function profileinformation($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get()->pluck('name', 'name');
        return view('admin.profil.informations', compact('user','roles'));
    }

    public function updatepassword($id)
    {
        $user = User::findOrFail($id);
        return view('admin.profil.password', compact('user'));
    }

    public function paiement()
    {
        $paiements = auth()->user()->roles()->pluck('name')[0] != "etudiant" ? Paiement::with("user")->get() :  Paiement::with("user")->where("user_id",auth()->user()->id)->get();
        return view('admin.paiement.index', compact('paiements'));
    }

    public function paiementEdit($id)
    {
        $paiement = Paiement::with("user")->where("id",$id)->get()[0];
        // dd($paiement);
        return view('admin.paiement.edit', compact('paiement'));
    }

    public function ProfilAcademique()
    {
        $profils = auth()->user()->roles()->pluck('name')[0] != "etudiant" ? Profil_academique::with("user")->get() : Profil_academique::with("user")->where("user_id",auth()->user()->id)->get();
        return view('admin.profil_academique.index', compact('profils'));
    }

    public function ProfilAcademiqueEdit($id)
    {
        $profil = Profil_academique::with("user")->where("id",$id)->get()[0];
        $users = User::all();
        return view('admin.profil_academique.edit', compact('profil','users'));
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => 'nullable|confirmed',
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        dd('Password change successfully.');
    }

}
