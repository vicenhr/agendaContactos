<nav>
            <?php
				if (isset($_SESSION["rol"])){
					if ($_SESSION["rol"]=="1"){
			
					}
			?>
        <ul>
          	<li><a href="tabContactos.php" class="menu">Contactos</a></li>
          	<!-- 
		  	<li><a href="#" class="menu">ABC //</a></li>
			-->
  			<li><a href="logout.php" class="menu">Salir</a></li>
        </ul>

			<?php
				} else {
			?>
			<ul>
				<li> <a href="index.php" class="menu">Iniciar Sesion</a> </li>
			</ul>
			<?php
				}
			?>
        </nav>