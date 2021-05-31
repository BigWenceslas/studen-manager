<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use App\Models\Niveau;

class NiveauxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function niveaux()
    {
        $niveaux = Niveau::orderBy('intitule', 'asc')->get();
        return view('admin.niveaux.index', compact('niveaux'));
    }
    public function index()
    {
        return view('admin.niveaux.add');
    }
    
    public function store(Request $request)
    {
        $niveau = Niveau::create($request->all());
        return redirect()->route('niveaux');
    }
   
    public function delete(Request $request)
    {
        $niveau = Niveau::find($request->id);
        $niveau->delete();
        return redirect()->route('niveaux');
    }
}
