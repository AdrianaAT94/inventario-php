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
        <a class="navbar-brand" href="convoc_inst.php"><img class="img_logo" src="img/logo.png" /></a>
      </div>      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
    <li class="<?php if (isset($active_instructores)){echo $active_instructores;}?>"><a href="perfil_instructor.php"><i  class='glyphicon glyphicon-user'></i> Perfil</a></li>
    <li class="<?php if (isset($active_elem_con)){echo $active_elem_con;}?>"><a href="convoc_inst.php"><i  class='glyphicon glyphicon-plane'></i> Convocatorias</a></li> 
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