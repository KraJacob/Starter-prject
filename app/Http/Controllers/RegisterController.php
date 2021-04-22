<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Agence;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'prenom' => 'required',
            'contact' => 'required',
            'login' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'agence_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('gest_mag')->accessToken;
        $success['nom'] =  $user->nom;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['login' => $request->login, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('gest_mag')-> accessToken;
            $success['user'] =  $user;
            $userAgenceId = $user->agence_id;
           // $success['agence'] =  $userAgenceId;
            $success['agence'] =  Agence::where('id', $userAgenceId)->first();

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
}
