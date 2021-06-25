<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Genero;
use App\Models\Artista;

class ApiController extends Controller
{
    //

    public function obtenerGeneros(){
        $curl = curl_init(); 

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.deezer.com/genre",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            //CURLOPT_ENCONDING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT =>30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: deezerdevs-deezer.p.rapidapi.com",
                "x-rapidapi-key: SIGN-UP-FOR-KEY"
            ],

        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if($err){
            echo "curl error #:". $err;
        }else{
            $objeto = json_decode($response);
            foreach ($objeto->data as $genero){
                echo json_encode($genero);
                //echo json_encode($objeto);
                $verificar = Genero::where('name',$genero->name)->first();
                if(!$verificar)
                    $nuevoGenero = new Genero();

                $nuevoGenero->name = $genero->name;
                $nuevoGenero->id = $genero->id;
                $nuevoGenero->picture_small = $genero->picture_small;

                $nuevoGenero->save();
                
                if(isset($genero->picture))
                echo "<img src='$genero->picture' alt=''>";

                if(isset($genero->picture_small))
                echo "<img src='$genero->picture_small' alt=''>";

                if(isset($genero->picture_medium))
                echo "<img src='$genero->picture_medium' alt=''>";

                if(isset($genero->picture_big))
                echo "<img src='$genero->picture_big' alt=''>";

                if(isset($genero->picture_xl))
                echo "<img src='$genero->picture_xl' alt=''>";

            echo "<hr>";


            }

        }
    }
    public function obtenerGeneroId($id){
        $generoId = Genero::where('id', $id)->first();
        return ['genero'=>$generoId];
    }
    public function obtenerArtistaId($id){
        $artistaId = Artista::where('id', $id)->first();
        return ['artista'=>$artistaId];
    }
}
