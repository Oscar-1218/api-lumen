<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\User;
use Carbon\Carbon; //con esto puedo utilizar el tiempo
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Support\Facades\Hash;

class LibroController extends Controller{
    public function index(){
        
        $datosLibro = Libro::all(); //de libro muestra ::todo
        return response()-> json($datosLibro); //responde en format json
    }

####### CREATE
    public function create(Request $request){
        $datosLibro = new Libro;
        if($request->hasFile('imagen')){ // esto retorna = {}, el nombre lo retorna con: $request->file('imagen')->getClientOriginalName(); 
        
            $nombreOriginalDeArchivo = $request->file('imagen')->getClientOriginalName();
            $nuevoNombre = Carbon::now()->timestamp."_".$nombreOriginalDeArchivo ; // devuelve el tiempo en un formato numerico.,luego concateno el tiempo+_el nombredelarchivo 
            $carpetaDestino = './upload/'; //se creará esta carpeta
            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);
            $datosLibro->titulo= $request->titulo;
            $datosLibro->breve_desc= $request->breve_desc;
            $datosLibro->imagen= ltrim($carpetaDestino,'.').$nuevoNombre;
            $datosLibro->save(); 
        }
        
        return response()->json($nuevoNombre);
    }

### READ
    public function read($id){
        $datosLibro = new Libro; 
        return response()->json($datosLibro->find($id));
    }

### UPDATE
    public function update(Request $request, $id){
        $datosLibro = Libro::find($id);
        if($request->input('titulo') || $request->input('breve_desc')){
            $datosLibro->titulo = $request->input('titulo');
            $datosLibro->breve_desc = $request->input('breve_desc');
            $datosLibro->save();
        }
        
        if($request->hasFile('imagen')){
            $rutaArchivo = base_path('public').$datosLibro->imagen;
            if(file_exists($rutaArchivo)){ //si el archivo existe.
                unlink($rutaArchivo); //accion: BORRAR
            } 

            $nombreOriginalDeArchivo = $request->file('imagen')->getClientOriginalName();
            $nuevoNombre = Carbon::now()->timestamp."_".$nombreOriginalDeArchivo ; // devuelve el tiempo en un formato numerico.,luego concateno el tiempo+_el nombredelarchivo              
            $carpetaDestino = './upload/'; 
            $request->file('imagen')->move($carpetaDestino, $nuevoNombre);
            
            $datosLibro->imagen= ltrim($carpetaDestino,'.').$nuevoNombre;
            $datosLibro->save(); 
        }
         
        
        return response()->json($datosLibro->find($id));
    }

##### DELETE
    public function delete($id){
        $datosLibro = Libro::find($id);
        if($datosLibro){
            $rutaArchivo = base_path('public').$datosLibro->imagen;
            if(file_exists($rutaArchivo)){ 
                unlink($rutaArchivo); 
            } 
            $datosLibro->delete();
        }
    
        return response()->json('Fue eliminado con exito');
    }

    
    public function store(Request $request){
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> $request->password ]);
            return response()->json(['message' => 'Usuario registrado exitosamente']);      
    }



}


//La Tec. Sup. Des. Software Son de gestión pública y otorgan títulos oficiales. //fuente aulasvirtuales.bue T. sup des. software.


