<?php

class Util{
    public $carreras = [
        1 => 'Redes',
        2 => 'Software',
        3 => 'Multimedia',
        4 => 'Mecatronica',
        5 => 'Seguridad Informatica'
    ];
    
    public function IncrementarID($array){
        $total = count($array);
        $ultimoId = $array[$total-1];
        return $ultimoId;
    } #function
    
    public function filtro($listado, $prop, $value){
        $newList = [];
    
        foreach($listado as $item){
            if($item->$prop == $value){
                array_push($newList, $item);
            }
        }
    
        return $newList;
    } #function
    
    public function ItemIndex($listado, $prop, $value){
        $index = 0;
        foreach($listado as $key => $item){
            if($item->$prop == $value){
                $index = $key;
            }
        }
    
        return $index;
    } #function

    public function GetCookieTime(){
        return time() + 60*60*24*30;
    } #function

    public function UpImage($dir,$name,$tmpFile,$type,$size){
        $ok = false;

        if( ($type == 'image/gif') || ($type == 'image/jpeg') || ($type == 'image/jpg') || ($type == 'image/png') || ($type == 'image/JPG') || ($type == 'image/pjpeg') && ($size < 1000000) ){
            
            if(!file_exists($dir)){
                mkdir($dir,0777,true);

                if(file_exists($dir)){
                    $this->UpFile($dir.$name,$tmpFile);
                    $ok = true;
                } #3 if
            } #2 if
            else{
                $this->UpFile($dir.$name,$tmpFile);
                $ok = true;
            }

        } #1 if
        else{
            $ok = false;
        }
        return $ok;
    } #function
    
    private function UpFile($name, $tmpFile){
        if(file_exists($name)){
            unlink($name);
        }
        move_uploaded_file($tmpFile,$name);
    } #function
} #Class
?>