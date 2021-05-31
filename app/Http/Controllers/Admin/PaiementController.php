<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use App\Models\Paiement;

class PaiementController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('admin.paiement.add');
    }
    
    public function store(Request $request)
    {
        $paiement = Paiement::create($request->all());
        if ($paiement) {
            return response()->json([
                'type' => 'success',
                'data' => $paiement
            ]);
        } else {
            return response()->json([
                'type' => 'error',
                'data' => ""
            ]);
        }
    }
}
