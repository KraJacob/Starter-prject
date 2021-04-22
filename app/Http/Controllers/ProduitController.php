<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProduitResssource;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Produit;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Validator;
use App\Http\Resources\ProduitResssource as ProduitResource;

class ProduitController extends BaseController
{

    public function index()
    {
        try {
            $products = Produit::paginate(10);
            return ProduitResource::collection($products);
        }catch(\Exception $exception){
            return $this->sendError('Exception', $exception->getMessage());
        }

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nom' => 'required',
            'qte_init' => 'required',
            'qte_stock' => 'required',
            'agence_id' => 'required',
            'type_produit_id' => 'required'
        ]);
        try {
            $ref = $this->generateRef($input['nom']);
            $input['ref'] = $ref;
            $input['prix_unitaire'] = 0;
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $product = Produit::create($input);

            return new ProduitResssource($product);
        }catch(\Exception $exception){
            return $this->sendError('Exception', $exception->getMessage());
        }

    }

    private function generateRef($produit)
    {
        try {
            $number = random_int(1000, 99999);
            $prod = Str::substr($produit, 0,4);
            $ref = $prod.'-'.$number;
            if(Produit::where('ref', $ref)->first()){
                $this->generateRef($produit);
            }else{
                return $ref;
            }
        } catch (\Exception $e) {

           // return null;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ProduitResource
     */
    public function show($id)
    {
        $product = Produit::find($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return new ProduitResssource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return ProduitResource|Response
     */
    public function update(Request $request, $productId)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nom' => 'required',
            'qte_init' => 'required',
            'qte_stock' => 'required',
            'type_produit_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        try {
            $product = Produit::find($productId);
            $product->nom = $input['nom'];
            $product->qte_init = $input['qte_init'];
            $product->qte_stock = $input['qte_stock'];
            $product->type_produit_id = $input['type_produit_id'];
            $product->save();

            return new ProduitResource($product);
        }catch(\Exception $exception){
            return $this->sendError('Exception', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($productId)
    {
        try {
            $product = Produit::find($productId);
            $product->statut = "SUPPRIMER";
            $product->save();

            return $this->sendResponse([], 'ProduitResssource supprime avec succes');
        }catch(\Exception $exception){
            return $this->sendError('Exception', $exception->getMessage());
        }

    }
}
