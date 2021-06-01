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
        if ($request['tranche_1'] != "") {
            $verify_paiement = Paiement::where("user_id", $request['user_id'])->where("tranche_1", $request['tranche_1'])->where("annee_academique", $request['annee_academique'])->get();
            if (count($verify_paiement) > 0) {
                $paiement = Paiement::where('id',$verify_paiement[0]->id)->update([
                    'tranche_2' => "Oui",
                    'date_paiement_tranche_2' => date('Y-m-d H:i:s')
                ]);
                return response()->json([
                    'titre' => 'Succès !',
                    'type' => 'success',
                    'data' => $paiement,
                    'message' => "Paiement transféré vers la 2e tranche car 1ere tranche déjà payée."
                ]);
            }
        }else{
            $verify_paiement = Paiement::where("user_id", $request['user_id'])->where("tranche_2", $request['tranche_2'])->where("annee_academique", $request['annee_academique'])->get();
            if (count($verify_paiement) > 0) {
                $paiement = Paiement::where('id',$verify_paiement[0]->id)->update([
                    'tranche_1' => "Oui",
                    'date_paiement_tranche_1' => date('Y-m-d H:i:s')
                ]);
                return response()->json([
                    'titre' => 'Succès !',
                    'type' => 'success',
                    'data' => $paiement,
                    'message' => "Paiement transféré vers la 1ere tranche car 2e tranche déjà payée."
                ]);
            }
        }
        if (count($verify_paiement) <= 0) {
            $paiement = Paiement::create($request->all());
            if ($paiement) {
                return response()->json([
                    'titre' => 'Succès !',
                    'type' => 'success',
                    'data' => $paiement,
                    'message' => "Paiement enregistré avec succès."
                ]);
            } else {
                return response()->json([
                    'titre' => 'Erreur !',
                    'type' => 'error',
                    'data' => "",
                    'message' => "Une erreur est survenue lors de la sauvegarde du paiement, veuillez reessayer plutard."
                ]);
            }
        }
    }
}
