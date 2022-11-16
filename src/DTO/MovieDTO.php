<?php 

namespace App\DTO;
use JsonSerializable;
 
class MovieDTO implements JsonSerializable{
 
    /**
     * @param $id int 
     * @param $titulo string 
     * @param $anyo int 
     * @param $duracion int 
     */
    function __construct(private ?int $id, private ?string $titulo, private ?int $anyo, private ?int $duracion) 
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->anyo = $anyo;
        $this->duracion = $duracion;
    }
 
 
    /**
     * @return int
     */
    public function id(): int {
        return $this->id;
    }
 
    /**
     * @return string
     */
    public function titulo(): string {
        return $this->titulo;
    }
 
    /**
     * @return int
     */
    public function anyo(): int {
        return $this->anyo;
    }
 
    /**
     * @return int
     */
    public function duracion(): int {
        return $this->duracion;
    }
    /**
     * Specify data which should be serialized to JSON
     * Serializes the object to a value that can be serialized natively by json_encode().
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value of any type other than a resource .
     */
    function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'anyo' => $this->anyo,
            'duracion' => $this->duracion
        ];      
    }
}