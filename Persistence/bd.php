<? 

	function ConnServ(){

		$conn = mysqli_connect("172.16.1.100","remoto","remoto24","pagoonline");
		//$conn = mysqli_connect("172.16.1.40","remoto","remoto24","pagoonline");
		return $conn;
	
	}

	function exeQry($Qry){
		
		$result = mysqli_query(ConnServ(), $Qry);
		if (!$result) { die("ERROR AL EJECUTAR LA CONSULTA:".mysqli_error()); }
		return $result;
		mysqli_close(ConnServ());

	}

	function execSP($Qry) {
		$conn = ConnServ();
		$result = mysqli_query($conn, $Qry);
		if (!$result) {
			$error = mysqli_error($conn);
			die("ERROR AL EJECUTAR LA CONSULTA: " . $error);
		}
		
		// Obtener mensaje del procedimiento almacenado
		$mensaje = "";
		$spMessageResult = mysqli_query($conn, "SELECT @mensaje AS mensaje");
		if ($spMessageResult) {
			$row = mysqli_fetch_assoc($spMessageResult);
			$mensaje = $row['mensaje'];
			mysqli_free_result($spMessageResult);
		} else {
			$error = mysqli_error($conn);
			die("ERROR AL OBTENER MENSAJE DEL PROCEDIMIENTO: " . $error);
		}
	
		mysqli_close($conn);
		
		return $mensaje;
	}

	function qryExe($tabla, $peticion){

		$Qry = "SELECT * FROM ".$tabla." ".$peticion;
		
		$result = mysqli_query(ConnServ(), $Qry);

		if (!$result) { die("ERROR AL EJECUTAR LA CONSULTA:".mysqli_error()); }
		return $result;
		mysqli_close(ConnServ());	

	} 


	function datalistOcu($tabla, $peticion, $id, $campo, $desc, $recupera){	
	
		$Qry = qryExe($tabla, $peticion);
	
		while ($row = mysqli_fetch_array($Qry)) {

			$checked = ($recupera == $row[$id]) ? "selected" : "";
	
			$result .= '<option id="'.$row[$id].'" data-codigo="'.$row[$id].'" value="'.$row[$campo].'" '.$checked.'>'.$row[$desc].'</option>';
	
		}
	
		return $result;
	
	} 

	// FUNCION SABER ID
	function myID($tabla, $id, $campo, $palabra){
		
		$Qry = exeQry("SELECT $id FROM $tabla WHERE $campo = '".$palabra."'");
		$Data = mysqli_fetch_array($Qry);
		return $Data[$id];
	
	}

		// ACCESO A LA PLATAFORMA
	function Login($Log){
		
		$Result = exeQry($Log);

		if (!$Result) { 

			die("ERROR AL EJECUTAR LA CONSULTA:".mysqli_error()); 

		}else{

			if (mysqli_num_rows($Result) > 0) {

				$LogRes = mysqli_fetch_array($Result);

				$GenImg = ($LogRes["sexo"] == "MASCULINO") ? 'M.png' : 'F.png';

				$ImgUs = (empty($LogRes["foto"])) ? $GenImg : $LogRes["foto"];

				if ($LogRes["estatus"] == "ALTA") {
					
					// COOKIE DE USUARIO NI
					setcookie("US_ID_ADMCOMER", $LogRes["IDU"], time()+43200, "/");
					setcookie("US_NAME_ADMCOMER", $LogRes["nombre"], time()+43200, "/");
					setcookie("US_PERFIL_ADMCOMER", $LogRes["perfil"], time()+43200, "/");
					setcookie("US_FOTO_ADMCOMER", $ImgUs, time()+43200, "/");

					// MSJ DE BIENVENIDA
					echo '<script>msj("Usuario Bienvenido");</script>';

				}else{

					// MSJ DE INACTIVIDAD 
          			echo '<script>msj("Usuario Inactivo");</script>';

				}	 

			}else{

				// MSJ DE NO EXISTE
				echo '<script>msj("Usuario No Existe");</script>';
				
			}

		}

	}

	// Realizar una consulta a MYSQLI
	function MaxID($tabla, $ID){

		$MAX = exeQry("SELECT MAX($ID) AS IDULT FROM $tabla");
		$REG = mysqli_fetch_array($MAX);
		$result = $REG["IDULT"];
		return $result;

	}

	// Función para conexión con SQL SERVER 
	function ConexionServidorVisual(){

		 $serverName = "SERVERHAP2018\SERVERHAP2017"; 
		// $serverName = "193.0.0.123"; 
		$connectionInfo = array("Database"=>"HospitalAranda", "UID"=>"sa", "PWD"=>"Dbsqlsys17");
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		return $conn;
	}
	

?>