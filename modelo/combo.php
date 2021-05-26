<?php 
	class combo extends conectar{
		public function llenarCombos($nombreTabla, $filtro){
	        $host = "localhost"; $nbre_DB = "alha"; $usuario = "root"; $password = "";
	        try{
	            $sql = "SELECT Id, Nbre FROM ".$nombreTabla." WHERE Activo = 1 ";
	            if($filtro!=null){ $sql=$sql." AND ".$filtro; }
	            $sql=$sql." ORDER BY Nbre ASC";
	            $dsn = "mysql:host=".$host.";dbname=".$nbre_DB;
	            $pdo = new PDO($dsn, $usuario, $password);
	            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	            $pdo->query("SET NAMES 'utf8';");
	            $rows = array();
	            $stmt = $pdo->prepare($sql);
	            $stmt->execute();
	            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	        }catch(PDOException $e){ echo "Ocurrio un ERROR: " . $e->getMessage(); }  
	        return json_encode($rows);
	    }
	}

 ?>