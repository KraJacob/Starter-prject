<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Repository\AgenceRepository;
use Illuminate\Http\Request;
use App\Http\Resources\AgenceRessource;
use App\Models\Agence;
use Validator;

class AgenceController extends Controller
{
    private $agenceRepository;

    public function __construct(AgenceRepository $agenceRepository){
        $this->agenceRepository = $agenceRepository;
    }

    public function index()
    {
        $agences = $this->agenceRepository->getAllAgence();
        return view('parametrage.agence', compact('agences'));
    }


    public function store(Request $request)//affichage agence
    {
       //return Response($request);
       $input = $request->all();
         $request->validate([
            'nom' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'adresse' => 'required'
        ]);
        $agence = $this->agenceRepository->storeAgence($input);
        return redirect()->back()->withErrors(['success'=>'Enregistrement effectué avec succès']);
    }

    public function show($id)//Affichage d'une agence
    {
        $agence = $this->agenceRepository->showIdAgence($id);
        return new AgenceRessource($agence);
    }

    public function update(Request $request,$id)
    {
        $response= $this->agenceRepository->updateAgence($request,$id);
        if($response){
            return new AgenceRessource($response);
        }else{
            return response()->json(['message'=>"Une erreur est survenue lors de la modification"]);
        }

    }

    public function destroy($id)
    {
        $response = $this->agenceRepository->deleteAgence($id);

        if($response){
           $msg = 'suppression effectué';
       }else{
           $msg = 'Une erreur est survenue lors de la suppression';
       }
       return response()->json(['message'=>$msg]);
    }
}
