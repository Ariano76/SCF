<?php 

session_start();

if (!isset($_SESSION['usuario'])) {
	header("Location:../index.php");	
}else {
	if ($_SESSION['usuario'] == 'ok') {
		$nombreUsuario = $_SESSION['nombreUsuario'];		
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<!--meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administración SCF</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	
	<!-- jQuery -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<!-- DataTables CSS -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">  
	<!-- DataTables JS -->
  	<!--script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js">
  	</script-->

  	<!-- libreria para utilizar iconos en nuestras paginas  -->
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">  	

  	
  	<!-- tabla reportes -->
  	<style>
  		table.dataTable thead {background: linear-gradient(to right, #0575E6, #0575E6);
  			color:white;}
  			.success {
  				background: #c7efd9;
  				border: #bbe2cd 1px solid;
  			}
  			.error {
  				background: #fbcfcf;
  				border: #f3c6c7 1px solid;
  			}
  			.firma {
  				background: #FFF3CD;
  				border: #f3c6c7 1px solid;
  			}
  			div#response.display-block {
  				display: block;
  			}
  			/* ============ desktop view ============ */
  			@media all and (min-width: 992px) {

  				.dropdown-menu li{
  					position: relative;
  				}
  				.dropdown-menu .submenu{ 
  					display: none;
  					position: absolute;
  					left:100%; top:-7px;
  				}
  				.dropdown-menu .submenu-left{ 
  					right:100%; left:auto;
  				}

  				.dropdown-menu > li:hover{ background-color: #f1f1f1 }
  				.dropdown-menu > li:hover > .submenu{
  					display: block;
  				}
  			}	
/* ============ desktop view .end// ============ */

/* ============ small devices ============ */
@media (max-width: 991px) {

	.dropdown-menu .dropdown-menu{
		margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
	}

}	
/* ============ small devices .end// ============ */
</style>

<script type="text/javascript">
//	window.addEventListener("resize", function() {
//		"use strict"; window.location.reload(); 
//	});


document.addEventListener("DOMContentLoaded", function(){

    	/////// Prevent closing from click inside dropdown
    	document.querySelectorAll('.dropdown-menu').forEach(function(element){
    		element.addEventListener('click', function (e) {
    			e.stopPropagation();
    		});
    	})

		// make it as accordion for smaller screens
		if (window.innerWidth < 992) {

			// close all inner dropdowns when parent is closed
			document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
				everydropdown.addEventListener('hidden.bs.dropdown', function () {
					// after dropdown is hidden, then find all submenus
					this.querySelectorAll('.submenu').forEach(function(everysubmenu){
					  	// hide every submenu as well
					  	everysubmenu.style.display = 'none';
					  });
				})
			});
			
			document.querySelectorAll('.dropdown-menu a').forEach(function(element){
				element.addEventListener('click', function (e) {

					let nextEl = this.nextElementSibling;
					if(nextEl && nextEl.classList.contains('submenu')) {	
				  		// prevent opening link if link needs to open dropdown
				  		e.preventDefault();
				  		console.log(nextEl);
				  		if(nextEl.style.display == 'block'){
				  			nextEl.style.display = 'none';
				  		} else {
				  			nextEl.style.display = 'block';
				  		}

				  	}
				  });
			})
		}
		// end if innerWidth
	}); 
	// DOMContentLoaded  end
</script>

</head>
<body>

	<?php $url="http://".$_SERVER['HTTP_HOST']."/scf" ?>
	<?php 
	if ($_SESSION['rolusuario']==4) { // ANALISTA FINANZAS
		?>
		<!--nav class="navbar navbar-expand-md navbar-dark bg-primary"-->
		<nav class="navbar navbar-expand-md navbar-light bg-white border border-dark">
			<div class="container-fluid">		
				<a class="navbar-brand" href="<?php echo $url."/administrador/inicio.php" ?>">
					<img src="https://www.savethechildren.org.pe/wp-content/themes/save-the-children/images/logo-save-the-children.svg" alt="" width="" height="">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					</a>
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<li>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tareas</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?php echo $url."/coordinador/paquetes_aprobacion.php"?>">Aprobar paquetes</a>
								<a class="dropdown-item" href="<?php echo $url."/validacion.php"?>">Limpieza de datos</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo $url."/repo_validacion_dni.php"?>">Documentos con incidencias</a>
							</div>
						</li>
						<li>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Data Historica</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?php echo $url."/coordinador/paquetes_aprobacion.php"?>">Cargar bases internas</a>
								<a class="dropdown-item" href="<?php echo $url."/validacionDH.php"?>">Limpieza de datos</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo $url."/repo_validacionDH_dni.php"?>">Documentos con incidencias</a>
								<a class="dropdown-item" href="<?php echo $url."/repo_validacionDH_nombres.php"?>">Nombres con incidencias</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo $url."/cotejo_beneficiarios.php"?>">Cotejar Nuevos Datos Historicos</a>
							</div>
						</li>			
						<li>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Migrar Datos</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?php echo $url."/administrador/seccion/migrar_data_historica.php" ?>">Datos Validados</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo $url."/administrador/seccion/migrar_data_beneficiario.php" ?>">Beneficiarios</a>
							</div>
						</li>
						<li>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Reportes Control</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?php echo $url."/reportes/reporte_001.php" ?>">Número de beneficiarios</a>
								<a class="dropdown-item" href="<?php echo $url."/reportes/reporte_002.php" ?>">Número de hogares con embarazadas</a>
							</div>
						</li>					

						<a class="nav-item nav-link" href="<?php echo $url."/administrador/seccion/cerrar.php"?>">Cerrar</a>
						<a class="nav-item nav-link" href="<?php echo $url;?>">Ver sitio web</a>
					</div>
				</div>
			</div>
		</nav>
		<?php 
	} elseif($_SESSION['rolusuario']==5) { // COORDINADOR FINANZAS
		?>
		<nav class="navbar navbar-expand-md navbar-light bg-white border border-dark">
			<div class="container-fluid">		
				<a class="navbar-brand" href="<?php echo $url."/administrador/inicio.php" ?>">
					<img src="https://www.savethechildren.org.pe/wp-content/themes/save-the-children/images/logo-save-the-children.svg" alt="" width="" height="">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					</a>
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<li>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Migrar Datos</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?php echo $url."/administrador/seccion/migrar_data_historica.php" ?>">Datos Historicos Nuevos Validados</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo $url."/administrador/seccion/migrar_data_beneficiario.php" ?>">Nuevos Beneficiarios Validados</a>
							</div>
						</li>
						<li>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Reportes Control</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?php echo $url."/reportes/reporte_001.php" ?>">Número de beneficiarios</a>
								<a class="dropdown-item" href="<?php echo $url."/reportes/reporte_002.php" ?>">Número de hogares con embarazadas</a>
								<a class="dropdown-item" href="<?php echo $url."/reportes/reporte_003.php" ?>">Hogares con familiares con discapacidad</a>
							</div>
						</li>
						<li>
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Finanzas</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?php echo $url."/administrador/seccion/paquete_finanzas.php" ?>">Crear Paquete</a>
								<a class="dropdown-item" href="<?php echo $url."/administrador/seccion/generar_paquete.php" ?>">Consultar Paquetes</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo $url."/administrador/seccion/generar_paquete.php" ?>">Enviar Proveedor Pago</a>
							</div>
						</li>						
						<a class="nav-item nav-link" href="<?php echo $url."/administrador/seccion/cerrar.php"?>">Cerrar</a>
						<a class="nav-item nav-link" href="<?php echo $url;?>">Ver sitio web</a>
					</div>
				</div>
			</div>
		</nav>
		<?php	
	}else{ // ROL GERENCIA
		?>
		<nav class="navbar navbar-expand-md navbar-light bg-white border border-dark">
			<div class="container-fluid">		
				<a class="navbar-brand" href="<?php echo $url."/administrador/inicio.php" ?>">
					<img src="https://www.savethechildren.org.pe/wp-content/themes/save-the-children/images/logo-save-the-children.svg" alt="" width="" height="">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					</a>
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav">
						<a class="nav-item nav-link" href="<?php echo $url."/administrador/seccion/cerrar.php"?>">Cerrar</a>
						<a class="nav-item nav-link" href="<?php echo $url;?>">Ver sitio web</a>
					</div>
				</div>
			</div>
		</nav>
		<?php	
	}
	?>


	<div class="container">
		<br><br>
		<div class="row">