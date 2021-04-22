<?php
namespace App\Http\Repository;
use App\Models\TypeProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeProduitRepository{

    public function getAllTypeProduit()
    {
        return TypeProduit::paginate(10);
    }

    public function storeTproduit($info)
    {
       return TypeProduit::create($info);
    }

    public function TypeProduitShow($id)
    {
      return TypeProduit::Find($id);
    }

    public function updateTypeProduit(Request $request,$idTypeprod){
        $typeprod = TypeProduit::where('id', $idTypeprod)->first();
        $input = $request->all();
        $typeprod->libelle = $input['libelle'];
       return $typeprod->save();
    }

    public function deleteTypeprod($id){
         $objtprod = TypeProduit::where('id', $id)->first();
         $objtprod->statut = 'SUPPRIMER';
         return $objtprod->save();
    }


}
