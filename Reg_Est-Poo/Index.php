<?php
  require_once 'services/IServices.php';
  require_once 'Estudiantes/estudiante.php';
  require_once 'Estudiantes/CookieEstService.php';
  require_once 'layout/layout.php';
  require_once 'help/util.php';
  
  $Layout = new Layout(false);
  $util = new Util();
  $service = new CookieEstService();

  $listado = $service->Read();

  if(!empty($listado)){
    if(isset($_GET['carreraId'])){
      $listado = $util->filtro($listado,'carrera',$_GET['carreraId']);
    }
  }

?>
<?php $Layout->Cabecera();?>
<!--Inicio main-->
<main role="main">

<section class="jumbotron text-center">
  <div class="container">
    <h1>Registro de Estudiantes</h1>
    <p class="lead text-muted">CRUD POO PHP y Bootstrap</p>
    <p>
      <a href="Estudiantes/add.php" class="btn btn-success my-2"><i class="far fa-plus-square"></i> Agregar Estudiante</a>
    </p>
  </div>
</section>

<div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
        <div class="col-md-7 border border-info rounded-pill margen-filtro">
          <h6>Filtrar por Carrera: </h6>
          <a href="Index.php" class="btn btn-secondary">Todas</a>
          <a href="Index.php?carreraId=1" class="btn btn-success">Redes</a>
          <a href="Index.php?carreraId=2" class="btn btn-primary">Software</a>
          <a href="Index.php?carreraId=5" class="btn btn-info">Seguridad</a>
          <a href="Index.php?carreraId=3" class="btn btn-warning text-light">Multimedia</a>
          <a href="Index.php?carreraId=4" class="btn btn-danger">Mecatronica</a>
        </div>
    </div>
      <?php if(empty($listado)):?>

        <h3 class="text-center">No hay Estudiantes registrados</h3>

      <?php else: ?>

        <div class="row">
          <?php foreach($listado as $estudiante):?>

            <?php $carrera = $util->carreras[$estudiante->carrera]; #obtener la carrera?> 
            
            <div class="col-md-4">
              <?php if($estudiante->status == 'Inactivo'):?>
                <div class="card margen-card text-muted bg-light border border-secondary" style="width: 15rem;">
              <?php else: ?>
                <div class="card margen-card border border-primary" style="width: 15rem;">
              <?php endif; ?>

                <!--Seccion img-->
                <?php if($estudiante->profilePic == null || $estudiante->profilePic == ''):?>
                  <img class="bd-placeholder-img card-img-top" src="<?php echo 'assets/img/default.jpg'; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                <?php else: ?>
                  <img class="bd-placeholder-img card-img-top" src="<?php echo 'assets/img/estudiantes/' . $estudiante->profilePic; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                <?php endif;?>

                <div class="card-body">
                  <h5 class="card-title"><?php echo $estudiante->nombre . " " . $estudiante->apellido; ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted">Carrera: <?php echo $carrera;?></h6>
                  <p class="card-text">Estado: <u><?php echo $estudiante->status?></u></p>

                  <div class="btn-group btn-group-toggle text-white" data-toggle="buttons">
                    <a href="Estudiantes/edit.php?id=<?php echo $estudiante->id?>" class="btn btn-info btn-sm"><i class="far fa-edit"></i> Editar</a>
                    <a href="Estudiantes/details.php?id=<?php echo $estudiante->id?>" class="btn btn-dark btn-sm"><i class="fas fa-info-circle"></i> Detalles</a>
                    <a onclick="eliminar()" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</a>
                  </div>

                </div>
              </div>
            </div>

          <?php endforeach; ?>
        </div>
      <?php endif;?>
    
  </div>
</div>

</main>
<!--Fin main-->
<?php $Layout->piePagina()?>
<!--script para la confirmacion antes de eliminar-->
<script>
  function eliminar() {
    var opcion = confirm('¿Esta seguro de eliminar este registro?');
    if(opcion === true){
        window.location="Estudiantes/remove.php?id=<?php echo $estudiante->id?>";
    }else{
        window.location="Index.php";
    }
}
</script>