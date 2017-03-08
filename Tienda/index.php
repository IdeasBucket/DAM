<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Tienda Juan Antonio</title>
    <link rel="stylesheet" href="css/estilo.css">
  </head>
  <body>
    <div class="pagina">
<? include ("plantilla/cabecera.php"); ?>

<div class="contenedor">

<? include "plantilla/categorias.php";?>

<div class="productos">



	<?php
		$consulta=mysql_query("select * from productos ORDER BY id DESC",$conexion);
		$nro_reg=mysql_num_rows($consulta);


		if ($nro_reg==0){
			echo 'no se han encontrado productos para mostrar';
		}

		$reg_por_pagina=12;
		if (isset($_GET['num'])){
			$nro_pagina=$_GET['num'];
		}else{
			$nro_pagina=1;
		}



		if (is_numeric($nro_pagina))
			$inicio=(($nro_pagina-1)*$reg_por_pagina);
		else
			$inicio=0;

		$consulta=mysql_query("select * from productos order by id DESC limit  $inicio,$reg_por_pagina",$conexion);
		$can_paginas=ceil($nro_reg/$reg_por_pagina);
	?>

	<?php

		while($filas= mysql_fetch_array($consulta)) {
			$id=$filas['id'];
			$imagen=$filas['imagen'];
			$nombre=$filas['nombre'];
			$desc=$filas['descripcion'];
			$precio=$filas['precio'];
			$enStock=$filas['cuanto_hay'];
			$fecha=$filas['fecha'];


		?>

<?php include"plantilla/caja.php";?>

		<?php
			}
	?>



												<!--Empiezo Paginación-->

	<div id ="paginador" align="center">
	<?php

		if($nro_pagina>1)
   			echo "<a href='index.php?num=".($nro_pagina-1)."'>Anterior</a> ";

		for ($i=1;$i<=$can_paginas;$i++){
			if ($i==$nro_pagina)
				echo "<span>$i </span> ";
				//echo $i."  ";
			else
    			echo "<a href='index.php?num=$i'>$i</a> ";

		}
		if($nro_pagina<$can_paginas)
   			echo "<a href='index.php?num=".($nro_pagina+1)."'>Siguiente</a> ";
	?>






</div>
</div>
</div>

<? include"plantilla/footer.php";?>


</div>
  </body>
</html>
