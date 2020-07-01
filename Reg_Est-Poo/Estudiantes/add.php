<?php
  require_once '../services/IServices.php';
  require_once 'estudiante.php';
  require_once 'CookieEstService.php';
  require_once '../layout/layout.php';
  require_once '../help/util.php';
  
  $layout = new Layout(true);
  $util = new Util();
  $service = new CookieEstService();

    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera']) && isset($_FILES['profilePic']) && isset($_POST['matFavs']) ){
        $newEst = new Estudiante();

        $newEst->estadoInicial(0,$_POST['nombre'],$_POST['apellido'],"Activo",$_POST['carrera'],$_POST['matFavs']);
        
        $service->Create($newEst);

        header('Location:../Index.php');
        exit();
    }

?>
<?php $layout->Cabecera();?>
<!--Inicio main-->
<main role="main">
<div class="row responsive margenes" id="formulario">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Agregar Estudiante
            </div>
            <div class="card-body border border-success rounded-bottom">
                <form enctype="multipart/form-data" action="add.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre.">
                    </div>
                
                    <div class="form-group">
                        <label for="apellido">Apellido: </label>
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese el apellido.">
                    </div>

                    <div class="form-group">
                        <label for="profile">Foto de Perfil: </label>
                        <input type="file" class="form-control-file" id="profile" name="profilePic">
                    </div>
                    
                    <div class="form-group">
                        <label for="carrera">Carrera</label>
                        <select class="form-control" id="carrera" name="carrera">
                            <option value="">Seleccione la Carrera.</option>
                            <?php foreach ($util->carreras as $id => $value):?>
                                <option value="<?php echo $id; ?>"><?php echo $value; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="matFavs">Materias Favoritas:</label>
                        <textarea class="form-control" id="matFavs" name="matFavs" rows="3"></textarea>
                        <caption>Escriba sus materias favoritas separadas por comas</caption>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-outline-primary" type="submit">Agregar</button>
                    </div>
                </form>                              
            </div>
        </div>
    </div>
</div>
</main>
<!--Fin main-->
<?php $layout->piePagina()?>