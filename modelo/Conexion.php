<?php
    /*
	abstract class  Conectar{
        protected $Servidor="localhost";
        protected $Usuario="root";
        protected $Contrasena="";
        protected $base="appsolutec123";
        
        
        protected $Conexion;
        public function __construct(){
            $this->Conexion= mysql_connect($this->Servidor,$this->Usuario,$this->Contrasena)or die('no se conecto');        
            mysql_select_db($this->base,$this->Conexion);
            return $this->Conexion; 
        }
        public function cerrarConexion(){
            mysql_close($this->Conexion);
        }
    }*/

    abstract class  Conectar{
        protected $Servidor="localhost";
        protected $Usuario="root";
        protected $Contrasena="";
        protected $base="appsolutec";
        protected $link;
        protected $Conexion;

        public function __construct(){
            $this->link = "mysql:host=".$this->Servidor.";dbname=".$this->base;
            $this->Conexion = new PDO($this->link,$this->Usuario,$this->Contrasena);
            $this->Conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->Conexion->query(" SET NAMES 'utf8';");
            return $this->Conexion; 
        }
        public function cerrarConexion(){
            $this->Conexion = null;
        }
    }

?>