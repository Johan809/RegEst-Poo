<?php
class Estudiante{
    public $id;
    public $nombre;
    public $apellido;
    public $status;
    public $carrera;
    public $profilePic;
    public $matFavs;

    public function estadoInicial($id,$nombre,$apellido,$status,$carrera,$mats){
        $matFavs = explode(',',$mats); #Convirtiendo las materias de string a array

        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->status = $status;
        $this->carrera = $carrera;
        $this->matFavs = $matFavs;
    }

    public function Set($element){
        foreach($element as $key => $value){
            $this->{$key} = $value;
        }
    }

} #class

?>