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
        $materias = implode(', ', $item->matFavs); #Convirtiendo las materias de Array a String

        if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['carrera']) && isset($_FILES['profilePic']) && isset($_POST['matFavs'])){

            $est_edit = new Estudiante();
            $est_edit->estadoInicial($idEst,$_POST['nombre'],$_POST['apellido'],$_POST['status'],$_POST['carrera'],$_POST['matFavs']);

            $service->Update($idEst,$est_edit);

            header('Location:../Index.php');
            exit();
        }

    }else{
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
                Editar Estudiante
            </div>
            <div class="card-body border border-success rounded-bottom">
                <form enctype="multipart/form-data" action="edit.php?id=<?php echo $item->id?>" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" value="<?php echo $item->nombre?>" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre.">
                    </div>
                
                    <div class="form-group">
                        <label for="apellido">Apellido: </label>
                        <input type="text" value="<?php echo $item->apellido?>" class="form-control" id="apellido" name="apellido" placeholder="Ingrese el apellido.">
                    </div>

                    <!--Seccion img-->
                    <label for="profile">Foto de Perfil: </label>
                    <div class="card" style="width: 15rem;">
                        <?php if($item->profilePic == null || $item->profilePic == ''):?>
                            <img class="bd-placeholder-img card-img-top" src="<?php echo '../assets/img/default.jpg'; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                        <?php else: ?>
                            <img class="bd-placeholder-img card-img-top" src="<?php echo '../assets/img/estudiantes/' . $item->profilePic; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                        <?php endif;?>
                    </div>

                    <div class="form-group">
                        <input type="file" class="form-control-file" id="profile" name="profilePic">
                    </div>
                    
                    <!--Radiobutton para el estado-->
                    <label>Estado:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1" value="Activo" <?php if($item->status == 'Activo'){ echo 'checked';}?>>
                        <label class="form-check-label" for="status1">Activo</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status2" value="Inactivo" <?php if($item->status == 'Inactivo'){ echo 'checked';}?>>
                        <label class="form-check-label" for="status2">Inactivo</label>
                    </div>
                    <br>

                    <div class="form-group">
                        <label for="carrera">Carrera</label>
                        <select class="form-control" id="carrera" name="carrera">
                            <option value="">Seleccione la Carrera.</option>
                            <?php foreach ($util->carreras as $id => $value):?>
                                
                                <?php if($id == $item->carrera):?>
                                    <option selected value="<?php echo $id; ?>"><?php echo $value; ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $id; ?>"><?php echo $value; ?></option>
                                <?php endif; ?>

                            <?php endforeach;?>
                        </select>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="matFavs">Materias Favoritas:</label>
                        <textarea class="form-control" id="matFavs" name="matFavs" rows="3"><?php echo $materias;?></textarea>
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
<?php $layout->piePagina();?>