<?php

namespace App\factories;

use App\DAO\impl\MoviesDBDAO;
use App\services\impl\MoviesService;
use App\DAO\IMoviesDAO;
use App\services\IMoviesService;

class MoviesFactory {

    public static function getService(): IMoviesService{
        return new MoviesService();
    }


    public static function getDAO(): IMoviesDAO{
        return new MoviesDBDAO();
    }


}