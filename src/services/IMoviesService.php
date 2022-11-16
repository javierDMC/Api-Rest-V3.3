<?php


namespace App\services;

use App\DTO\MovieDTO;

interface IMoviesService
{
    public function all(): array;
    public function find($id): MovieDTO;
}