<?php

namespace App\DAO\impl;

use App\DAO\IMoviesDAO;
use App\DTO\MovieDTO;


class MoviesJsonDAO implements IMoviesDAO
{

    private $datos;

    function create(MovieDTO $movie): bool
    {
        return false;
    }


    function read(): array
    {

        $datos = file_get_contents(base_path("src/data/peliculas.json"));

        $datosDecodificados = json_decode($datos, true);

        $result = array();

        foreach ($datosDecodificados as $movie) {
            array_push(
                $result,
                new MovieDTO(
                    $movie['id'],
                    $movie['titulo'],
                    $movie['anyo'],
                    $movie['duracion']
                )
            );
        }
        return $result;
    }


    function findById(int $id): MovieDTO
    {

        $peliculas = $this->read();

        foreach ($peliculas as $peliculaBuscada) {
            if ($peliculaBuscada->id() == ($id)) {
                return $peliculaBuscada;
            }
        }
        throw new \Exception("Error: Pelicula con el id {$id} no existe");
    }


    function update(int $id, MovieDTO $movie): bool
    {
        return false;
    }


    function delete(int $id): bool
    {
        return false;
    }
}
