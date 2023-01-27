<?php
    
namespace App\Http\Controllers\Controller;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
 


use Illuminate\Http\Client\Request as ClientRequest; 
use Illuminate\Support\Facades\Hash;

    class StoreUserController extends Controller{
        /**
        *@return void
        */

        public function store(Request $request){
            User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password) ]);
                return response()->json(['message' => 'Usuario registrado exitosamente']);      
        }

    }
    
    //aksa
?>