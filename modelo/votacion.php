<?php 
	
	class Votar extends Conectar{
		public $tipoUsuario;
		public $UsuarioVotante;
		public $UsuarioCalificado;		
		private $sqlVotosBueno;
		private $sqlVotosRegular;
		private $sqlVotosMalos;
		private $sqlOpiniones;
		function cargarVotosBuenos(){
			if($this->tipoUsuario == "Cliente"){
				$this->sqlVotosBuenos = mysql_query("SELECT COUNT(calificacion) AS total FROM calificacionproveedor WHERE idProveedor ='$this->UsuarioCalificado' AND calificacion='Bueno' GROUP BY calificacion;");	
			}else{
				$this->sqlVotosBuenos = mysql_query("SELECT COUNT(calificacion) AS total FROM calificacioncliente WHERE idCliente ='$this->UsuarioCalificado' AND calificacion='Bueno' GROUP BY calificacion;");
			}			
			return $this->sqlVotosBuenos;
		}
		function cargarVotosRegular(){
			if($this->tipoUsuario == "Cliente"){
				$this->sqlVotosRegular = mysql_query("SELECT COUNT(calificacion) AS total FROM calificacionproveedor WHERE idProveedor ='$this->UsuarioCalificado' AND calificacion='Regular' GROUP BY calificacion;");	
			}else{
				$this->sqlVotosRegular = mysql_query("SELECT COUNT(calificacion) AS total FROM calificacioncliente WHERE idCliente ='$this->UsuarioCalificado' AND calificacion='Regular' GROUP BY calificacion;");
			}			
			return $this->sqlVotosRegular;
		}
		function cargarVotosMalos(){
			if($this->tipoUsuario == "Cliente"){
				$this->sqlVotosMalos = mysql_query("SELECT COUNT(calificacion) AS total FROM calificacionproveedor WHERE idProveedor ='$this->UsuarioCalificado' AND calificacion='Malo' GROUP BY calificacion;");	
			}else{
				$this->sqlVotosMalos = mysql_query("SELECT COUNT(calificacion) AS total FROM calificacioncliente WHERE idCliente ='$this->UsuarioCalificado' AND calificacion='Malo' GROUP BY calificacion;");
			}			
			return $this->sqlVotosMalos;
		}

		function verOpiniones($tUsuario,$usuario,$tipoVoto){
			if($tUsuario == 1){
				$this->sqlOpiniones = mysql_query("SELECT cl.nombres,cp.calificacion,cp.opinion,cp.fechaRegistro FROM calificacionproveedor cp INNER JOIN clientes cl ON cl.`id` = cp.`idCliente` WHERE cp.idProveedor ='$usuario' AND cp.calificacion='$tipoVoto';");	
			}else{
				$this->sqlOpiniones = mysql_query("SELECT pv.nombres,cc.calificacion,cc.opinion FROM calificacioncliente cc INNER JOIN proveedores pv ON pv.`id` = cc.`idProveedor` WHERE cc.idCliente ='$usuario' AND cc.calificacion='$tipoVoto';");
			}			
			return $this->sqlOpiniones;
		}

		function agregar($voto,$opinion){
			if($this->tipoUsuario == "Cliente"){
				mysql_query("INSERT INTO  calificacionproveedor(`idCliente`,`idProveedor`,`calificacion`,`opinion`) VALUES('$this->UsuarioVotante','$this->UsuarioCalificado','$voto','$opinion');");	
			}else{
				mysql_query("INSERT INTO  calificacioncliente(`idCliente`,`idProveedor`,`calificacion`,`opinion`) VALUES('$this->UsuarioVotante','$this->UsuarioCalificado','$voto','$opinion');");
			}
		}
	}


?>