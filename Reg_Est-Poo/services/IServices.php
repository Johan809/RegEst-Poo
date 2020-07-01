<?php

interface IServicesBase{
    public function GetById($id);
    public function Create($entity);
    public function Read();
    public function Update($id,$entity);
    public function Delete($id);
} #Interface

?>