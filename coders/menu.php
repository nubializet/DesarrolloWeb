
<!-- Barra de perfil-->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="#!" class="pink-text">
    <i class="material-icons">face</i>
    Mi Perfil</a></li>  
  <li class="divider"></li>
  <li><a href="<?php echo APP; ?>/login.php" class="pink-text">
    <i class="material-icons">flight_takeoff</i>
    Salir</a></li>
</ul>
<!-- Icono de notificaciones-->
<ul id='ddMensajes' class='dropdown-content'>
  <li><a href="#!">one</a></li>
  <li><a href="#!">two</a></li>
  <li class="divider"></li>
  <li><a href="#!">three</a></li>
  <li><a href="#!"><i class="material-icons">view_module</i>four</a></li>
  <li><a href="#!"><i class="material-icons">cloud</i>five</a></li>
</ul>

<!-- Barra desplegable-->
<nav>
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo appname" id="nombreapp">Coders!</a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">  

      <li>
         <a class='dropdown-button' href='#' data-hover="false" data-activates='ddMensajes'>
         <i class="material-icons right">notifications</i>
         </a>
      </li> 

      <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Gerardo Lopez<i class="material-icons right">arrow_drop_down</i></a></li>    
    </ul>
    <ul class="side-nav" id="mobile-demo">
      <li>
        <div class="row">
            <div class="col s4">  
            <form id="formLogo" enctype="multipart/form-data">
                        
              <img src="<?php echo APP; ?>/img/logo.png" alt="logo" class="avatar" style="width: 70px; border-radius: 50%;">     
              <input type="file" name="logo" id="logo" accept="image/*">    
              </form>     
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
        <a href="contactos.php">
          <i class="material-icons green-text darken-1">person</i> Contactos
        </a>
      </li>
    </ul>
  </div>
</nav>
