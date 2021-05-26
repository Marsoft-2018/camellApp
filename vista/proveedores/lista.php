<link rel="stylesheet" href="../complementos/sweetalert2/sweetalert2.css">


<?php 
  	//include("menuClientes.php");	
	//include("serviciosDestacados.php");
	require("../modelo/Conexion.php");
	//require("../modelo/categoria.php");
	require("../modelo/combos.php");
	require("../modelo/servicioProveedor.php");
	require("../modelo/perfil.php");
	require("../modelo/proveedor.php");
?>
<?php 
	$objUsu = new Perfil();
	$objUsu->tabla = "proveedores";
	$nombre = $objUsu->cargarNombre($_POST["usuario"]);
?>

<div id="blog" class="blog">
	<div class="container" style="padding:50px;padding-top:0px;padding-bottom:250px;">
	<table class='display table table-striped table-hover dataTable no-footer'>
	        <thead>
	            <tr>
	                <th>Nit/Documento</th>
	                <th>Nombre</th>
	                <th>Dirección</th>
	                <th>Teléfono</th>
	                <th>Ciudad</th>
	                <th>Correo</th>
	                <th colspan='3'>Acciones</th>
	            </tr>
	        </thead>
	        <tbody>
	            while($pro=mysql_fetch_array($sqlEmp)){
	            <tr style='font-size:10px;'>
	                <td style='padding:2px;'>$pro[0]</td>
	                <td style='padding:2px;'>$pro[1]</td>
	                <td style='padding:2px;'>$pro[2]</td>
	                <td style='padding:2px;'>$pro[3]</td>
	                <td style='padding:2px;'>$pro[4]</td>
	                <td style='padding:2px;'>$pro[5]</td>	                    
	                <td style='padding:2px;font-size:15px;text-shadow:0px 1px 2px rgba(80,80,100,0.6);'>
	                    		<a id='$pro[0]' style='padding:1px;height:20px;width:20px;color:#1CB526;' title='Editar proveedor' onclick='cargarProveedor(this.id)'>
	                    			<i class='fa fa-pencil'> </i>
	                    		</a>
	                </td>	
	                <td style='padding:2px;font-size:15px;text-shadow:0px 1px 2px rgba(80,80,100,0.6);'>
	                    		<a id='$pro[0]' style='padding:1px;height:20px;width:20px;color:#F00;' title='Eliminar Proveedor' onclick='eliminarProveedor(this.id)'>
	                    			<i class='fa fa-trash'> </i>
	                    		</a>
	                </td>	
	                <td style='padding:2px;font-size:15px;text-shadow:0px 1px 2px rgba(80,80,100,0.6);'>
	                    		<a id='$pro[0]' style='padding:1px;height:20px;width:20px;color:#00F;' title='Ver pagos al Proveedor' onclick='cargarListaPagosProveedor(this.id)'>
	                    			<i class='fa fa-money'> </i>
	                    		</a>
	                </td>		
	                     </tr>                                
	            }                                
	        </tbody>
	    </table>
	</div>
</div>