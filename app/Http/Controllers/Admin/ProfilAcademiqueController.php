<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use App\Models\Profil_academique;
use App\Models\User;

class ProfilAcademiqueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = User::all();
        return view('admin.profil_academique.add', compact('users'));
    }
    
    public function store(Request $request)
    {
        if ($request["id_profil"] == "no") {
            $profil_academique = Profil_academique::create($request->all());
        } else {
            $profil_academique = Profil_academique::where('id',$request["id_profil"])->update($request->except(['_token','id_profil']));
        }
        
        if ($profil_academique) {
            return response()->json([
                'titre' => 'Succès !',
                'type' => 'success',
                'data' => $profil_academique,
                'message' => "Profil académique enregistré avec succès."
            ]);
        } else {
            return response()->json([
                'titre' => 'Erreur !',
                'type' => 'error',
                'data' => "",
                'message' => "Une erreur est survenue, veuillez reessayer plutard."
            ]);
        }
    }
    
    public function delete($id)
    {
        $profil_academique = Profil_academique::find($id)->delete();
        if ($profil_academique) {
            return response()->json([
                'titre' => 'Succès !',
                'type' => 'success',
                'data' => $profil_academique,
                'message' => "Profil académique supprimé avec succès."
            ]);
        } else {
            return response()->json([
                'titre' => 'Erreur !',
                'type' => 'error',
                'data' => "",
                'message' => "Une erreur est survenue, veuillez reessayer plutard."
            ]);
        }
    }
}
