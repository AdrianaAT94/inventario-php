  <?php
    if (isset($title))
    {
  ?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="logo">
        <a class="navbar-brand" href="index.php"><img class="img_logo" src="img/logo.png" /></a>
      </div>      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php if (isset($active_productos)){echo $active_productos;}?>"><a href="stock.php"><i class='glyphicon glyphicon-barcode'></i> Inventario</a></li>
    <li class="<?php if (isset($active_categoria)){echo $active_categoria;}?>"><a href="categorias.php"><i class='glyphicon glyphicon-tags'></i> Categorías</a></li>
    <li class="<?php if (isset($active_reportes)){echo $active_reportes;}?>"><a href="reportes.php"><i  class='glyphicon glyphicon-signal'></i> Reportes</a></li>
    <li class="<?php if (isset($active_instructores)){echo $active_instructores;}?>"><a href="instructores.php"><i  class='glyphicon glyphicon-user'></i> Instructores</a></li>
    <li class="<?php if (isset($active_aulas)){echo $active_aulas;}?>"><a href="aulas.php"><i  class='glyphicon glyphicon-book'></i> Aulas</a></li>
    <li class="<?php if (isset($active_campos)){echo $active_campos;}?>"><a href="campos.php"><i  class='glyphicon glyphicon-plane'></i> Campos de vuelo</a></li>
    <li class="<?php if (isset($active_convocatorias)){echo $active_convocatorias;}?>"><a href="convocatorias.php"><i  class='glyphicon glyphicon-plane'></i> Convocatorias</a></li>
    <li class="<?php if (isset($active_elem_con)){echo $active_elem_con;}?>"><a href="elem_convoc.php"><i  class='glyphicon glyphicon-plane'></i> Inv. para Conv.</a></li>
    <li class="desplegable <?php if (isset($active_historico)){echo $active_historico;}?>"><a href="#"><i  class='glyphicon glyphicon-list-alt'></i> Historicos</a>
      <ul class="nav navbar-nav desplegable">
        <li><a href="historico_inv.php">Inventario</a></li>
        <li><a href="historico_cat.php">Categorías</a></li>
        <li><a href="historico_inst.php">Instructores</a></li>
        <li><a href="historico_aul.php">Aulas</a></li>
        <li><a href="historico_cam.php">Campos de vuelo</a></li>
        <?php if ($_SESSION['admin'] == 1) { ?>
        <li><a href="historico_users.php">Usuarios</a></li>
      <?php } ?>
        <li><a href="historico_invcon.php">Inventario para Convocatorias</a></li>
      </ul>
    </li>   
    <?php if ($_SESSION['admin'] == 1) { ?>
      <li class="<?php if (isset($active_usuarios)){echo $active_usuarios;}?>"><a href="usuarios.php"><i  class='glyphicon glyphicon-user'></i> Usuarios</a></li>
    <?php } else { ?>
      <li class="<?php if (isset($active_usuarios)){echo $active_usuarios;}?>"><a href="usuarios.php"><i  class='glyphicon glyphicon-user'></i> Usuario</a></li>
    <?php } ?>
       </ul>
      <ul class="nav navbar-nav navbar-right">
    <li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  <?php
    }
  ?>