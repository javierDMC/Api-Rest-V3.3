<?php

namespace App\services\impl;
 
use App\services\IMoviesService;
use App\DTO\MovieDTO;
use App\DAO\impl\MoviesStaticDAO;
use App\DAO\impl\MoviesJsonDAO;
use App\DAO\IMoviesDAO;
use App\factories\MoviesFactory;

class MoviesService implements IMoviesService {

    public function all(): array {
        return MoviesFactory::getDAO()->read();
    }
 
    public function find($id): MovieDTO {
        return MoviesFactory::getDAO()->findById($id);
    }

    public static function insert(MovieDTO $movie): bool {
        return MoviesFactory::getDAO()->create($movie);
    }

    public static function delete(int $id): bool {
        return MoviesFactory::getDAO()->delete($id);
    }

    public static function update(int $id, MovieDTO $movie): bool {
        return MoviesFactory::getDAO()->update($id, $movie);
    }
         
    
}