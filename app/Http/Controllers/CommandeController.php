<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Commande::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return ($request);
        $commande = Commande::create([
            'numero' => $request->numero,
            'nombreColis' => $request->nombreColis,
            'poids' => $request->poids,
            'dateEnregistrement' => $request->dateEnregistrement,
            'lieuDepart' => $request->lieuDepart,
            'lieuDestination' => $request->lieuDestination,
            'Description' => $request->Description,
            'uploadPhoto' => $request->uploadPhoto,
            'residenceAdresse' => $request->residenceAdresse,
            'envoyeur_id' => 1,
            'livreur_id' => 1
        ]);
        return $commande;
        // dd($request->dateOuverture);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Commande::find($id);
    }

    public function allCommande()
    {
        return Commande::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $commande = Commande::find($id);
        if ($commande) {
            $commande->update([
                'numero' => $request->numero,
                'nombreColis' => $request->NombreColis,
                'poids' => $request->Poids,
                'dateEnregistrement' => $request->dateEnregistrement,
                'lieuDepart' => $request->lieuDepart,
                'lieuDestination' => $request->lieuDestination,
                'Description' => $request->Description,
                'uploadPhoto' => $request->uploadPhoto,
                'residenceAdresse' => $request->residenceAdresse,
                'personne_id' => $request->personne_id,
                
            ]);
            return response()->json([
                'success' => 'Commande modifiée avec success',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $commande = Commande::find($id);
        if ($commande) {
            $commande->delete();
            return response()->json([
                'success' => 'Commande supprimée avec success',
            ], 200);
        }
    }
}