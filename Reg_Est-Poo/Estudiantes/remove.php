<?php
    require_once '../services/IServices.php';
    require_once 'estudiante.php';
    require_once 'CookieEstService.php';
    require_once '../help/util.php';

    $service = new CookieEstService();
    
    if(isset($_GET['id'])){
        $idEst = $_GET['id'];
        $service->Delete($idEst);
    }

    header('Location:../Index.php');
    exit();
?>