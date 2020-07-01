<?php
 require_once '../services/IServices.php';
 require_once 'estudiante.php';
 require_once 'CookieEstService.php';
 require_once '../layout/layout.php';
 require_once '../help/util.php';
 
 $layout = new Layout(true);
 $util = new Util();
 $service = new CookieEstService();

    if(isset($_GET['id'])){
        $idEst = $_GET['id'];
        $item = $service->GetById($idEst);
        $carrera = $util->carreras[$item->carrera]; #obtener la carrera

    }else{
        header('Location:../Index.php');
        exit();
    }
    
?>
<?php $layout->Cabecera(); ?>
<!--Inicio main-->
<main role="main">
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <h2 class="text-center">Detalles del Estudiante</h2>
        <hr>
    </div>
</div>

<div class="row responsive margenes">
    <div class="col-md-3"></div>
    <div class="col-md-2"></div>
    <div class="col-md-6">
        <div class="card" style="width: 18rem; margin-left: -4%;">

            <!--Seccion img-->
            <?php if($item->profilePic == null || $item->profilePic == ''):?>
                <img class="bd-placeholder-img card-img-top" src="<?php echo '../assets/img/default.jpg'; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
            <?php else: ?>
                <img class="bd-placeholder-img card-img-top" src="<?php echo '../assets/img/estudiantes/' . $item->profilePic; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
            <?php endif;?>

            <div class="card-body">
                <h5 class="card-title"><?php echo $item->nombre . " " . $item->apellido; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Carrera: <?php echo $carrera;?></h6>
                <p class="card-text">Estado: <u><?php echo $item->status?></u></p>
                <i><b><label>Materias Favoritas: </label></b></i>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach($item->matFavs as $value): ?>
                    <?php if($value == null || $value == ""): ?>
                        <li class="list-group-item">No hay materias favoritas :(</li>
                    <?php else:?>
                        <li class="list-group-item"><?php echo $value; ?></li>
                    <?php endif;?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
</main>
<!--Fin main-->
<?php $layout->piePagina(); ?>
