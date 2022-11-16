<?php

namespace App\db\orm;

use App\db\orm\DB;
use App\DAO\impl\MoviesDBDAO;
use App\db\orm\ICountable;
use App\DTO;
use App\services\impl\MoviesService;
use App\services\IMoviesService;
use App\factories\MoviesFactory;
use App\response\HTTPResponse;
use App\DTO\MovieDTO;


class Validator implements ICountable{

    public static function validadorCamposUpdate(int $id, array $movie){
        //utilizo el isset para comprobar que cada uno de las propiedades del objeto no son null
        if(isset($movie['titulo'], $movie['anyo'], $movie['duracion'])){
            $pelicula = self::nuevaMovie($movie);
            MoviesFactory::getService()::update($id, $pelicula);
            HTTPResponse::json(200, "Recurso actualizado");   
        }else{
            throw new \Exception("Error al actualizar el recurso", 400);
        }
        
    }

    public static function validadorCamposCreate(array $movie){
        //utilizo el isset para comprobar que cada uno de las propiedades del objeto no son null
        if(isset($movie['titulo'], $movie['anyo'], $movie['duracion'])){
            $pelicula = self::nuevaMovie($movie);
            MoviesFactory::getService()::insert($pelicula);
            HTTPResponse::json(201, "Recurso creado");  
        }else{
            throw new \Exception("Error al insertar el recurso", 400);
        }
    }

    public static function nuevaMovie(array $movie):MovieDTO{
        $movie = new MovieDTO(null, $movie['titulo'], $movie['anyo'], $movie['duracion']);
        return $movie;
    }
}