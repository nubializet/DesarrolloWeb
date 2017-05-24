<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/coders/server/config.php";

    $module = "home";
    if(isset($_GET["module"]) && $_GET["module"] != "")
    {
      $module = $_GET["module"];
    }    

    define("APP", "/coders");

?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Coders! Web Developers Love.!</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

        <link rel="apple-touch-icon" href="<?php echo APPNAME; ?>/apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo APPNAME; ?>/css/normalize.css">
        <link rel="stylesheet" href="<?php echo APPNAME; ?>/css/materialize.min.css">
        <link rel="stylesheet" href="<?php echo APPNAME; ?>/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo APPNAME; ?>/css/main.css">
        <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
        <script src="<?php echo APPNAME; ?>/js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>        

    <ul id="dropdown1" class="dropdown-content">
     <li><a href="#!" class="pink-text">
        <i class="material-icons">face</i>
        Mi Perfil</a></li>  
     <li class="divider"></li>
     <li><a href="<?php echo APP; ?>/login/" class="pink-text">
        <i class="material-icons">flight_takeoff</i>
         Salir</a></li>
    </ul>
<nav>
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo appname" id="nombreapp">Coders!</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">      
      <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Gerardo Lopez<i class="material-icons right">arrow_drop_down</i></a></li>    
    </ul>
        <ul class="side-nav" id="mobile-demo">
          <li>
            <div class="row">
                <div class="col s4">                          
                  <img src="<?php echo APP; ?>/img/logo.png" alt="logo" class="avatar" style="width: 70px; border-radius: 50%;">              
                </div>
                <div class="col s8">
                  <b class="username">Gerardo A Lopez Vega</b>
                  <span class="email">mcgalv@gmail.com</span>              
                </div>
            </div>
          </li>  
          <li>
            <a href="">
              <i class="material-icons orange-text darken-1">star</i> Favoritos
            </a>
          </li>
          <li>
            <a href="">
              <i class="material-icons blue-text">image</i> Fotos
            </a>
          </li>
          <li>
            <a href="">
              <i class="material-icons green-text darken-1">person</i> Contactos
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="row"><!--Publicacones: Se agregan con JavaScript-->
      <div class="col s6 offset-s3" id="contenedoraplicaciones"><!--Offset: deja la columna en el centro-->

      </div>
    </div>


    <div class="fixed-action-btn click-to-toggle">
       <a id="btn-floating" class="btn-floating btn-large red">
          <i class="large material-icons">mode_edit</i>
        </a>
        <ul>
          <li><a class="btn-floating red mostrar"><i class="material-icons">insert_chart</i></a></li>
          <li><a class="btn-floating yellow darken-1 ocultar"><i class="material-icons">format_quote</i></a></li>
          <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
          <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
        </ul>
    </div>

      <!-- Tap Target Structure -->
      <div class="tap-target blue white-text" data-activates="btn-floating">
        <div class="tap-target-content">
          <h5>Title</h5>
          <p>A bunch of text</p>
        </div>
      </div>
        <script src="ejemplo.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo APPNAME; ?>/js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="<?php echo APPNAME; ?>/js/plugins.js"></script>
        <script src="<?php echo APPNAME; ?>/js/materialize.min.js"></script>
        <script src="<?php echo APPNAME; ?>/js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>

        <script>
          $(".button-collapse").sideNav();

          $(".mostrar").on("click", function(){
            // alert("LOL")
            $('.button-collapse').sideNav('show');
          })

          $(".ocultar").on("click", function(){
            $('.tap-target').tapTarget('open');            
          })

          // $('.tap-target').tapTarget('open');            
          //Practicas con JQuery 21/05/17
          $("#nombreapp").html("<b>Curso desarrollo WEB</b>");
          $("#contenedoraplicaciones").html("");
          $("#contenedoraplicaciones")
              .html("")
              .append("<a id='Agregar' class='btn' href='javascript:;'>CLICK</a>");
          $("#Agregar").on("click", function(e){
                //alert("Hola");
                e.preventDefault();
            });
                //Generar una publicacipon cada vez que se de click al boton 

                $.each(data,function(index, publicacion){
                    console.log(publicacion);
                    $("#contenedoraplicaciones").prepend('<div class="card hoverable" id="publicacion_'+publicacion.id+'"><div class="card-image waves-effect waves-block waves-light"> <img class="activator" src="'+publicacion.foto+'"> </div> <div class="card-content"> <div class="row valign-wrapper"><div class="col s3 "> <img src="'+publicacion.avatar+'" style="border-radius: 50%;"> </div> <div class="col s9"> <b>'+publicacion.usuario+'</b> Publicó . </div> </div> <div class="row"> <div class="col"> <span class="grey-text text-darken-4">'+publicacion.contenido+'</span> </div> </div> <div class="row"> <div class="col s6"> <a href="javascript:;" class="like"><i class="material-icons blue-text">thumb_up</i><span class="likes">' + publicacion.likes +' </span> Me gusta</a> <a href="javascript:;" class="unlike"><i class="material-icons blue-text">thumb_down</i><span class="likes">' + publicacion.likes +' </span> No me gusta</a> </div> <div class="col s6 right-align">'+publicacion.fecha+'</div> </div> </div> </div>');
                });
                //Lee la cantidad de likes de una publicacion 
                 $(".like").on("click", function(e){
                    e.preventDefault();
                    //alert("Le diste Me gusta");
                    var numero_likes = $(this).find(".likes").text();
                    //alert(numero_likes + " Likes");
                    //Aumenta el número de like
                    numero_likes = parseInt(numero_likes);
                    numero_likes = numero_likes + 1;

                    $(this).find(".likes").text(numero_likes);

                  });

                  $(".unlike").on("click", function(e){
                    e.preventDefault();
                    //alert("Le diste NO Me gusta");

                    var numero_likes = $(this).find(".likes").text();
                    //alert(numero_likes + " Likes");
                    //Aumenta el número de like
                    numero_likes = parseInt(numero_likes);
                    numero_likes = numero_likes - 1;

                    $(this).find(".likes").text(numero_likes);


                  });
                        
         
        </script>
    </body>z
</html>
