<?php

namespace App\DAO;
use App\DTO\MovieDTO;
 
interface IMoviesDAO {
 
    public static function create(MovieDTO $movie): bool;
    public static function read(): array;
    public static function findById(int $id): MovieDTO;
    public static function update(int $id, MovieDTO $movie): bool;
    public static function delete(int $id): bool;
}
