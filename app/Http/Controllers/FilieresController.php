<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use App\Models\Filiere;

class FilieresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function filieres()
    {
        $filieres = Filiere::orderBy('intitule', 'asc')->get();
        return view('admin.filieres.index', compact('filieres'));
    }
    public function index()
    {
        return view('admin.filieres.add');
    }
    
    public function store(Request $request)
    {
        $niveau = Filiere::create($request->all());
        return redirect()->route('filieres');
    }
   
    public function delete(Request $request)
    {
        $filiere = Filiere::find($request->id);
        $filiere->delete();
        return redirect()->route('filieres');
    }
}
