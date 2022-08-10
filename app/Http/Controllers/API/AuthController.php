<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Personne;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PersonneController;
use App\Models\Commande;
use Termwind\Components\Dd;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    public function findOneUser($id)
    {
        return User::find($id);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $personne_to_update = Personne::where('id',$user->personne_id)->get()->first();

        $personne_to_update->update([
            'civilite' => $request->civilite,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'adress' => $request->adress,
            'disponibilite' => $request->disponibilite,
        ]);
        
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
       $user = User::findOrFail($request->id);
       $user->delete([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $personne_to_delete = Personne::where('id',$user->personne_id)->get()->first();
        $personne_to_delete->delete([
            'civilite' => $request->civilite,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'adress' => $request->adress,
            'disponibilite' => $request->disponibilite,
        ]);

        $personne = Personne::find($request->id);
        if ($personne) {
            $personne->delete();
            return response()->json([
                'success' => 'Personne supprimée avec success',
            ], 200);
        }


    }

    // public function search($roleCompte)
    // {
    //     return User::where('roleCompte', $roleCompte)->get();
    // }
   


 

    public function register(Request $request)
    {
        // $personne = PersonneController->store($request);
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'civilite' => 'required|string',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'telephone' => 'required|string',
            'adresse' => 'required|string',
            'disponibilite' => 'required|string',   
            'dateOuverture'=> 'required|string',
            'roleCompte' => 'required|string',
        ]);
        $personne = Personne::create([
            'civilite' => $request->civilite,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'adresse' => $request->adress,
            'disponibilite' => $request->disponibilite,
        ]);


        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'dateOuverture' => $request->dateOuverture,
            'roleCompte' => $request->roleCompte,
            'personne_id' => Personne::latest()->first()->id,

        ]);
    }



    public function login(Request $request)
    {
        $user = new User();
        $token = $user->createToken('MyApp')->accessToken;
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'dateOuverture' => $request->dateOuverture,
            'token'=>$token,
        ];

        if (auth()->attempt($data)) {
            $user = User::user();
            $token = $user->createToken('myToken')->accessToken;
            // $token = auth()->user()->createToken('MyApp')->accessToken;
            return response()->json(['token'=>$token], 200);
        }else{
            return response()->json(['error'=>'unauthorized'], 401);
        }
    }

    public function userInfo()
    {
        $user = auth()->user();
        return response()->json(['user'=>$user], 200);
    }
}
