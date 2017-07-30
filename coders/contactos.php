<?php 
session_start();

if(!isset($_SESSION["login"]))
{
  echo "<script>location.href='login.php';</script>;";
}
    require_once $_SERVER["DOCUMENT_ROOT"] . "/coders/config.php";

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
<!-- Barra de menu-->
  <?php require_once "menu.php";?> 
  <!-- TXT para mensaje-->
      <div id="modalChat" class="modal">
        <div class="modal-content">
          <h4>Nuevo Mensaje</h4>
          <div class="row">
            <div class="input-field col s12">
              <textarea id="mensaje" name="mensaje" class="materialize-textarea"></textarea>
              <label for="textarea1">Mensaje:</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-action waves-effect waves-green btn-flat mensaje-send">Enviar</a>

          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
        </div>
      </div>

<!-- Formulario para ingresar el correo del usuario a quien se agregar como contacto -->
<div class="row">
        <div class="col s4">

          <div class="row">
            <div class="col s12">
              <form id="InvitarForm" action="">
                <div class="row">
                  <div class="col s12">            
                    <div class="input-field inline">
                      <input name="email" id="email" type="email" class="validate">
                      <label for="email" data-error="El formato es incorrecto" data-success="right">Email</label>              
                      <button type="submit" class="btn waves-effect waves-light">Invitar</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <div id="listaSolicitud">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col s8">
          <div id="listaContactos"></div>
        </div>      

      </div>

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo APPNAME; ?>/js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="<?php echo APPNAME; ?>/js/plugins.js"></script>
        <script src="<?php echo APPNAME; ?>/js/materialize.min.js"></script>
        <script src="<?php echo APPNAME; ?>/js/main.js"></script>

        <script>
          $(".button-collapse").sideNav();
          $('.modal').modal();//Abre el area txt del mensaje

        mostrar_contactos = function(contactos)
        {
          var lista = '<ul class="collection with-header">';
          lista += '<li class="collection-header"><h4>Contactos</h4></li>';
          if(contactos.length > 0)
          {           
             $.each(contactos, function(indice, elemento){
              
              var usuario = elemento.contacto;
              lista += '<li class="collection-item">';
              lista += '<div>';
              lista += '<b>' + usuario["nombre"] + " " + usuario["apellido"] + '</b>';
              lista += "<br>";
              lista += usuario["username"];
              lista += '<a id="' + usuario["id"] + '" href="#!" class="secondary-content chat">'
              lista += '<i class="material-icons">chat</i></a>'              
              lista += '</div>';
              lista += '</li>';
            });
          }
          else
          {
            lista += '<li class="collection-item">';
            lista += '<div>No hay contactos.</div>';
            lista += '</li>';            
          }
          lista += '</ul>';
          //Mostrar la lista de contactos
          $("#listaContactos")
            .html(lista).find(".chat").on("click", function(){
                var idUsuario = $(this).attr("id");
               $('#modalChat').data("id", idUsuario).modal('open');
                
            });                  
        }

        obtener_datos = function()
        {
          $.getJSON("views/contactoService.php?obtener=", function(res){
            console.log(res);
            if(res.success)
            {
              mostrar_contactos(res.data);
            }
            else
            {
              mostrar_contactos([]);
            }
          });
        }();

          enviar_solicitud = function(data)//Envia la solicitud de contactos(invitar)
          {
            $.getJSON("views/contactoService.php?invitar=", data, function(res){
              console.log(res);
              if(res.success)
              {
                alert("Se ha enviado la solicitud correctamente.")
              }
              else
              {
                alert(res.error);
              }
            });
          }

        aceptar_solicitud = function(idsolicitud, elem)
        {
          $.getJSON("views/contactoService.php?aceptar=", {"id" : idsolicitud}, function(res){
            if(res.success)
            {
              elem.parents("li").remove();
              
              var elementos_lista = $("#listaSolicitud").find("li.collection-item");              
              if(elementos_lista.length == 0)
              {
                var vacio = '<li class="collection-item">';
                vacio += '<div>No hay solicitudes pendientes.</div>';
                vacio += '</li>';
                $("#listaSolicitud > ul").append(vacio);
              }
            }
          });
        }

        obtener_solicitudes = function()
        {
          $.getJSON("views/contactoService.php?solicitudes=", function(res){
            console.log(res);
            if(res.success)
            {
              console.log(res.data);
              mostrar_solicitudes(res.data);
            }
            else
            {
              mostrar_solicitudes([]);
            }
          });
        }();

        //Dar clic en el boton enviar del mensaje
        $(".mensaje-send").on("click", function(){
          // alert("ok")
          var mensaje = $("#modalChat").find("#mensaje").val();
          console.log(mensaje)
          var idcontacto = $("#modalChat").data("id");//Obteniene el id del contacto 
          console.log(idcontacto)
          //Parametros que se envian en el POST
          var params = {
            "mensaje" : mensaje,
            "idcontacto" : idcontacto
          }
          $.post("views/contactoService.php?mensaje=", params, function(res){
            console.log(res);
            es = $.parseJSON(res);
            console.log(res);
            if(res.success)//Si fue exitoso limpiar las variables
            {
              $("#modalChat").find("#mensaje").val("");
              $("#modalChat").removeData("id");
            }
          });

          $("#modalChat").modal("close");
        });


          $("#InvitarForm").on("submit", function(e){
            e.preventDefault();
            var data = $(this).serialize();
            // console.log(data);
            enviar_solicitud(data);
          });
          //Lee las solicitudes y las muestra en la pagina
          mostrar_solicitudes = function(solicitudes)
          {
           var lista = '<ul class="collection with-header">';
          lista += '<li class="collection-header"><h4>Solicitudes Pendientes</h4></li>';
          if(solicitudes.length > 0)
          {     //Recorrido de un elemento      
            $.each(solicitudes, function(indice, elemento){
              
              var usuario = elemento.idusuario[0];
              lista += '<li class="collection-item">';
              lista += '<div>';
              lista += '<b>' + usuario["nombre"] + " " + usuario["apellido"] + '</b>';
              lista += "<br>";
              lista += elemento["fecha"];
              lista += '<a id="' + elemento["idsolicitud"] + '" href="#!" class="secondary-content aceptar tooltipped" data-tooltip="Aceptar Solicitud de Contacto.">'
              lista += '<i class="material-icons">check</i></a>'
              lista += '</div>';
              lista += '</li>';
            });
          }
          else
          {
            lista += '<li class="collection-item">';
            lista += '<div>No hay solicitudes pendientes.</div>';
            lista += '</li>';            
          }
          lista += '</ul>';
          $("#listaSolicitud")
            .html(lista)
            .find(".aceptar")
            .on("click", function(){
              alert("OK");
              var idsolicitud = $(this).attr("id");
              aceptar_solicitud(idsolicitud, $(this));
            });
          $('.tooltipped').tooltip({position: "right", delay: 200});
               
         }


          // obtener_datos();
        </script>
    </body>
</html>
