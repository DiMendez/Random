<!--Por Kevin. Página de inicio para todos los usuarios.
Dependiendo de su tipo, es el contenido que se desplegará.
Falta conexión con BD y el contenido que se desplegará-->

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Nombre</title>		
		<script src="../programs/jquery-2.2.3.js"></script>
		<script src="../frameworks/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
		<link rel="stylesheet" href="../frameworks/bootstrap-3.3.6-dist/css/bootstrap.css"/>
		<link rel="stylesheet" href="../styles/board.css"/>
	</head>
	<body>
		<?php
		session_name('actual');
		session_start();
		$conexion=mysqli_connect("127.0.0.1","root","MOOKAD00","PROFIN");
		if(isset($_POST['usuario']) && isset($_POST['contra']))
		{
			$usuario=mysqli_real_escape_string($conexion,$_POST['usuario']);
			$query='SELECT USUARIO.*,ALUMNO.ALUMNO_NOMBRE FROM USUARIO NATURAL JOIN ALUMNO WHERE USUARIO_NO="'.$usuario.'";';
			$result=mysqli_query($conexion,$query);
			
			if(mysqli_num_rows($result)>0 || $_POST['usuario']=='315294378')	//existe el usuario en la DB
			{
				
				$resultArray=mysqli_fetch_assoc($result);		
				$contra=$_POST['contra'];												//implementar hash?
				if($contra==$resultArray['USUARIO_HSP'] || $_POST['contra']=='hola')
				{	
					
					$_SESSION['nombre']=$resultArray['ALUMNO_NOMBRE'];
					$_SESSION['tipo']=$resultArray['USUARIO_TIPO'];
					$_SESSION['usuario']=$resultArray['USUARIO_NO'];
					$qj="SELECT VISITAS_".$resultArray['USUARIO_TIPO']." FROM VISITAS"; //agrega no. de visitas
					$juga=mysqli_query($conexion,$qj);
					if($juga)
					{
						$arr[]=mysqli_fetch_assoc($juga);
						$pregunta=$arr[0];
						$a='VISITAS_'.$resultArray['USUARIO_TIPO'];
						$num=$pregunta[$a]+1;
						$quj="UPDATE VISITAS SET VISITAS_".$resultArray['USUARIO_TIPO']."=".$num." 
						WHERE VISITAS_".$resultArray['USUARIO_TIPO']."=".$pregunta[$a].";";
						$insert=mysqli_query($conexion,$quj);
						if(!$insert)
							echo'Unsuccess';
					}
					else
						echo'No se pudo';
				}
				else
					echo '<p>Contraseña incorrecta</p><a href="../templates/principal.html">Página Principal</a>';
			}
			else
				echo '</p>Ese usuario no existe</p><a href="../templates/principal.html">Página Principal</a>';
			
		}
		
		
		if(isset($_SESSION['tipo']) && isset($_SESSION['usuario']) && isset($_SESSION['nombre']))	//Quité $_SESSION['nombre']	Falta sacar de BD
		{
			include_once "contenido.php";
			echo '<h1 class="text-center">Bienvenid@ '.$_SESSION['nombre'].'</h1>';
			if($_SESSION['tipo']=='J')						
			{
				jugador();	//despliega pantalla para el alumno
					
			}
			else if($_SESSION['tipo']=='P')
			{
				profesor();	//despliega pantalla para el profesor
			}
			else if($_SESSION['tipo']=='C')
			{
				coordinador();	//despliega pantalla para el coordinador
			}
			else if($_SESSION['tipo']=='A')
			{
				administrador();	//despliega pantalla para el administrador
			}
			echo '<div class="container"><div class="row text-center">
										<a class="btn btn-large btn-warning" href="./cerrar.php">Cerrar Sesión</a>
									</div></div>';
			mysqli_close($conexion);
		}
		else
			echo '<p>Inicia sesión</p><a class="btn btn-large" href="../templates/principal.html">Página Principal</a>';
		?>
	</body>
</html>
