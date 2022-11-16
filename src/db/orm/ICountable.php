<?php

namespace App\db\orm;

interface ICountable {

    public static function validadorCamposUpdate(int $id, array $movie);

    public static function validadorCamposCreate(array $movie);

    }