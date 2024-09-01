<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Asignatura; //? Se llama al modelo Asignatura
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //? Paquete para hacer validaciones

class controladorAsignatura extends Controller
{
    public function ver_asignaturas(){
        $asignaturas = Asignatura::all(); //? Se trae todo lo que esté en la tabla a la que está ligada ese modelo

        if($asignaturas->isEmpty()){ //? Si no se encuentra nada en la tabla, (->isEmpty) se va a devolver ese mensaje
            return response()->json(['msg' => 'No hay asignaturas creadas'], 200);
        }
        
        return response()->json($asignaturas, 200);
    }

    public function crear_asignatura(Request $request){ //? Función para crear una asignatura que recibe como parámetro el objeto request
        $validator = Validator::make($request->all(),[ //? Se usa el paquete Validator para hacer validaciones en los datos que ingresen por la request
            'nombre'=>'required|max:100|unique:asignatura'
        ]);

        if ($validator->fails()){ //? Se definde el mensaje que se va a enviar si la validación falla
            $data = [
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors()
            ];
            return response()->json($data, 400);
        }

        $asignatura = Asignatura::create([ //? Se crea una asignatura con la clase Asignatura, pasándole los atributos del request
            'nombre' => $request->nombre
        ]);

        if(!$asignatura){ //? Si por alguna razón interna no se puede crear la asignatura devuelve un mensaje con un status 500 (servidor)
            return response()->json(['msg'=>'Error a la hora de crear la asignatura'], 500);
        }

        return response()->json($asignatura, 201); //? Si la asigatura sí se logra crear, se devuelve un mensaje con el objeto asignatura y el status 201
    }

    public function mostrar_asignatura($id){ //? Función para mostrar un asignatura por id
        $asignatura = Asignatura::find($id);

        if(!$asignatura){
            return response()->json(['msg'=>'Asignatura no encontrada'], 404);
        }

        return response()->json($asignatura, 200);
    }

    public function editar_asignatura($id, Request $request){ //? Función para editar la información de una asignatura
        $asignatura = Asignatura::find($id);

        if(!$asignatura){
            return response()->json(['msg'=>'Asignatura no encontrada'], 404);
        }

        $validator = Validator::make($request->all(),[ //? Se usa el paquete Validator para hacer validaciones en los datos que ingresen por la request
            'nombre'=>'required|max:100|unique:asignatura'//? Si se quiere hacer un patch para no tener que actualizar todos los datos (si hay varios), sólo se le quita el required en el validator
        ]);

        if ($validator->fails()){ //? Se definde el mensaje que se va a enviar si la validación falla
            $data = [
                'msg' => 'Error en la validación de los datos',
                'errors' => $validator->errors()
            ];
            return response()->json($data, 400);
        }

        $asignatura->nombre = $request->nombre; //? Se actualiza el dato en el modelo de asignatura, con el del request
        // if($request->has('nombre')){ // Para el caso de patch en el que no sea obligatorio que se edite el nombre
        //     $asignatura->nombre = $request->nombre;
        // }
        $asignatura->save(); //? Se guardan los cambios hechos a la asignatura

        $data = [
            'msg'=>'Asignatura editada con éxito',
            'Asignatura'=>$asignatura
        ];

        return response()->json($data, 200);
    }

    public function eliminar_asignatura($id){
        $asignatura = Asignatura::find($id);

        if(!$asignatura){
            return response()->json(['msg'=>'Asignatura no encontrada'], 404);
        }
        
        $asignatura->delete(); //? Se usa el método delete() para eliminar la asignatura del modelo

        return response()->json(['msg'=>'Asignatura eliminada con éxito'], 200);
    }
}

//? Este es un contolador creado con el comando php artisan make:controller api/controladorAsignatura