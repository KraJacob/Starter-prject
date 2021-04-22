<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Http\Repository\UniteRepository;
use App\Http\Resources\UniteResource;
use Illuminate\Http\Request;
use Validator;

class UniteController extends BaseController
{
    private $uniteRepository;

    public function __construct(UniteRepository $uniteRepository)
    {
        $this->uniteRepository = $uniteRepository;
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $unites = $this->uniteRepository->getAll();

        return UniteResource::collection($unites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return UniteResource|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'libelle' => 'required',
            'code' => 'required|unique:unites'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        try {
          $unite = $this->uniteRepository->create($input);
          return new UniteResource($unite);
        }catch (\Exception $exception){
            return $this->sendError('Exception', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return UniteResource
     */
    public function show($id)
    {
        $unite = $this->uniteRepository->getOne($id);
        return  new UniteResource($unite);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $uniteId
     * @return UniteResource|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $uniteId)
    {
        $input = $request->all();
        $input['unite_id'] = $uniteId;
        try {
            $response = $this->uniteRepository->update($input);
            if ($response){
                return new UniteResource($response);
            }else{
                return response()->json(['message'=>'Une erreur est survenue lors de la modification']);
            }
        }catch(\Exception $exception){
            return $this->sendError('Exception', $exception->getMessage());
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
        try {
            $response = $this->uniteRepository->delete($id);
            if ($response){
                return response()->json(['success'=> true, 'message'=>'suppression effectuée']);
            }else{
                return response()->json(['success'=> false, 'message'=>'une est survenue lors de la suppression']);
            }
        }catch (\Exception $exception){
            return $this->sendError('Exception', $exception->getMessage());
        }
    }
}
