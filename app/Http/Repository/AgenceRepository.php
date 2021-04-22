<?php
namespace App\Http\Repository;
use App\Models\Agence;
use Illuminate\Http\Request;

class AgenceRepository{

    public function getAllAgence()
    {
        return Agence::where('statut', 'ACTIVE')->paginate(10);
    }

    public function storeAgence($input)
    {
       return Agence::create($input);
    }

    public function showIdAgence($id){
        return  Agence::find($id);
    }

    public function updateAgence(Request $request,$agenceId){
        $agence = Agence::find($agenceId);
        $input = $request->all();
        $agence->nom = $input['nom'];
        $agence->contact = $input['contact'];
        $agence->email = $input['email'];
        $agence->adresse = $input['adresse'];
       return $agence->save() ? $agence : null;
    }

    public function deleteAgence($id){
       $objAgence = Agence::where('id', $id)->first();
        $objAgence->statut = 'SUPPRIMER';
        return $objAgence->save();
    }
}
