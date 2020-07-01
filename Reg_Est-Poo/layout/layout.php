<?php

class Layout{
  private $p;
  private $dir;

  function __construct($page){
    $this->p = $page;
    $this->dir = ($this->p) ? "../": "";
  }

  public function Cabecera(){
    $header = <<<EOF
      <!DOCTYPE html>
      <html lang="en"><head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
          <title>Registro de Estudiantes ITLA</title>
          
      <link rel="stylesheet" href="{$this->dir}assets\css\bootstrap.min.css" type="text/css">
      <link rel="stylesheet" href="{$this->dir}assets\css\style.css"  type="text/css">
      <script src="https://kit.fontawesome.com/ca95e6a565.js" crossorigin="anonymous"></script>
      </head>
      
        <body>
          <header>
        <div class="collapse bg-dark" id="navbarHeader">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-md-7 py-4">
                <h4 class="text-white">Acerca de</h4>
                <p class="text-muted">Registro de Estudiantes en php usando Poo. Hecho por Saul Johan Alonzo Placencia, matricula 2018-6764. Con motivo a la tarea de la 8va semana. Programacion Web.</p>
              </div>
              <div class="col-sm-4 offset-md-1 py-4">
                <h4 class="text-white">Repositorio en Github</h4>
                <ul class="list-unstyled">
                  <li><a href="https://github.com/Johan809/RegEst-Poo" target="_blank" class="text-white">Registro Estudiantes POO- Programacion Web</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
          <div class="container d-flex justify-content-between">
            <a href="{$this->dir}Index.php" class="navbar-brand d-flex align-items-center">
              <strong><i class="far fa-address-book"></i> Home Page</strong>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
        </div>
      </header>
    EOF;
    echo $header;
  }

  public function piePagina(){
    $footer = <<<EOF
      <footer class="footer mt-auto py-3 bg-dark text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Volver Arriba</a>
        </p>
        <p>Registro de Estudiantes ITLA - 2018-6764</p>
        <p>Plantilla de © Bootstrap</p>
      </div>
      </footer>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="{$this->dir}assets\js\bootstrap.min.js"></script>
    
      </body>
      </html>
    EOF;
    echo $footer;
  }
} #Class

?>