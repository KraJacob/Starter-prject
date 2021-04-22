<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Repository\TypeProduitRepository;
use App\Http\Resources\TypeProduitResource;
use App\Models\TypeProduit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class TypeProduitController extends Controller
{
    private $typeProduitRepository;

    public function __construct(TypeProduitRepository  $typeProduitRepository){
        $this->typeProduitRepository = $typeProduitRepository;
    }

    public function index()
    {
        $typeproduit = $this->typeProduitRepository->getAllTypeProduit();
        return new TypeProduitResource($typeproduit);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
           'libelle' => 'required'
       ]);

       if($validator->fails()){
           return $validator->errors();
       }

       $tproduit = $this->typeProduitRepository->storeTproduit($input);
       return new TypeProduitResource($tproduit);
    }

    public function show($id)
    {
       $typeProduit = $this->typeProduitRepository->TypeProduitShow($id);
       return new TypeProduitResource($typeProduit);
    }



    public function update(Request $request,$id)
    {
        $response= $this->typeProduitRepository->updateTypeProduit($request,$id);
        if($response){
            $msg = 'Modification effectuée';
        }else{
            $msg = 'Une erreur est survenue lors de la modification';
        }
        return response()->json(['message'=>$msg]);
    }


    public function destroy($id)
    {
        $response = $this->typeProduitRepository->deleteTypeprod($id);
        if($response){
           $msg = 'suppression effectué';
       }else{
           $msg = 'Une erreur est survenue lors de la modification';
       }
       return response()->json(['message'=>$msg]);
    }
}
