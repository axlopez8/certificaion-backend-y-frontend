<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Tersa.gt</title>
<link rel="stylesheet" href="../css/estilos.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.js" integrity="sha512-otOZr2EcknK9a5aa3BbMR9XOjYKtxxscwyRHN6zmdXuRfJ5uApkHB7cz1laWk2g8RKLzV9qv/fl3RPwfCuoxHQ==" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<style>
	body{
		background-image: url(https://image.freepik.com/vector-gratis/fondo-acuarela-cielo-color-pastel_105555-312.jpg);
		background-size: cover;
		background-attachment: fixed;
		background-repeat: no-repeat;
	}
</style>
</head>
<body>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Tabla Productos</h2>
					</div>
					<div class="col-sm-6">
						<a href="#AñadirRegistro" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir Producto</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Cantidad</th>
						<th>Precio_Compra</th>
						<th>Precio_venta</th>
						<th>Proveedor</th>

						<th> </th>

					</tr>
				</thead>
				<tbody>
				<?php
				$json=file_get_contents("http://localhost:3000/productos");
				$datos=json_decode($json, true);
				for($i=0; $i< count($datos); $i++){
						
				
			?>
					<tr>
						
						<td> <?php echo $datos[$i]["idProducto"] ?> </td>
						<td> <?php echo $datos[$i]["Nombre"]  ?></td>
						<td> <?php echo $datos[$i]["Cantidad"]  ?></td>
						<td> <?php echo $datos[$i]["Precio_Compra"]  ?></td>
						<td> <?php echo $datos[$i]["Precio_Venta"]  ?></td>
						<td> <?php echo $datos[$i]["Nombre_Empresa"]  ?></td>

						<td>
							<a href="#EditarRegistro" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" onclick='EdiForm(<?php echo $datos[$i]["idProducto"] ?>,"<?php echo $datos[$i]["Nombre"]?>","<?php echo $datos[$i]["Cantidad"]?>",<?php echo$datos[$i]["Precio_Compra"] ?>,"<?php echo $datos[$i]["Precio_Venta"] ?>","<?php echo $datos[$i]["FK_Proveedor"]?>")'> &#xE254;</i></a>
							<a href=""  class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" onclick='eliminar(<?php echo $datos[$i]["idProducto"] ?>,"<?php echo $datos[$i]["Nombre"] ?>")')">&#xE872;</i></a>
						</td>
					</tr>
					<?php
				}
					?>
					
				</tbody>
			</table>
	</div>
	<br>
	<br>
	<br>
	<center><button style="background-color:green" class="btn btn-secondary btn-lg active" onclick="window.location.href='../menu.php'"> MENU</button></center></div>
<!-- Edit Modal HTML -->
<div id="AñadirRegistro" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Añadir Producto</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" id="Nombre" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Cantidad</label>
						<input type="number" id="Cantidad" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Precio de Compra</label>
						<input type="number" id="Precio_Compra" step="0.01" class="form-control" required>

					</div>
					<div class="form-group">
						<label>Precio de Venta</label>
						<input type="number" id="Precio_Venta" step="0.01" class="form-control" required>

					</div>
					<div id="SEL2" class="form-group">  
                            
                            <label>Nombre del Proveedor</label> 

                            <select id="proveedor" class="form-control"  required>
                            <option selected >---- Nombre de los Proveedores ----</option>
                           
                            <?php
                                $jsonp=file_get_contents("http://localhost:3000/proveedores");
								$datosp=json_decode($jsonp, true);
								for($i=0; $i< count($datosp); $i++){
                            ?>
                            <option value="<?php echo $datosp[$i]["idProveedor"]?>" ><?php echo $datosp[$i]["Nombre_Empresa"]?></option>
                            <?php
                                }  
                            ?>
                            </select>
                            
                        </div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="button" class="btn btn-success" value="Agregar" onclick="agregar()">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="EditarRegistro" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
		<form action="" method="POST" >
				<div class="modal-header">						
					<h4 class="modal-title">Editar Producto</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>ID</label>
						<input type="number" id="id2" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" id="Nombre2" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Cantidad</label>
						<input type="number" id="Cantidad2" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Precio de Compra</label>
						<input type="number" id="Precio_Compra2" step="0.01" class="form-control" required>

					</div>
					<div class="form-group">
						<label>Precio de Venta</label>
						<input type="number" id="Precio_Venta2" step="0.01" class="form-control" required>

					</div>
					<div id="SEL2" class="form-group">  
                            
                            <label>Nombre del Proveedor</label> 

                            <select id="proveedor2" class="form-control"  required>
                            <option selected >---- Nombre de los Proveedores ----</option>
                           
                            <?php
                               
							   for($i=0; $i< count($datosp); $i++){
						   ?>
						   <option value="<?php echo $datosp[$i]["idProveedor"]?>" ><?php echo $datosp[$i]["Nombre_Empresa"]?></option>
                            <?php
                                }  
                            ?>
                            </select>
                            
                        </div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="button" class="btn btn-success" value="Editar" onclick="Editar()">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<script>
// java script para agregar valores de registros.
function agregar(){
	var params={}

	params.Nombre = $('#Nombre').val();
	params.Cantidad =  $('#Cantidad').val();
	params.Precio_Compra = $('#Precio_Compra').val();
	params.Precio_Venta = $('#Precio_Venta').val();
	params.FK_Proveedor = $('#proveedor').val();
	console.log(params)
		axios.post(`http://localhost:3000/productos`,params).then((res)=>{location.reload();}).catch((e)=>{console.log(e)})
	
	
};  

// java script para eliminar valores de registros.
function eliminar(id,Nombre){
	var C = confirm('Desea eliminar '+Nombre);
    if (C == true) {
	
		axios.delete(`http://localhost:3000/productos/${id}`).then((res)=>{location.reload();}).catch((e)=>{console.log(e)})
	}
};

// java script para obtener valores de registros.
function EdiForm(Id,Nombre,Cantidad,Precio_Compra,Precio_Venta,FK_Proveedor){
	console.log (Id,Nombre,Cantidad,Precio_Compra,Precio_Venta,FK_Proveedor)
	$("#id2").val(Id);
	$("#Nombre2").val(Nombre);
	$("#Cantidad2").val(Cantidad);
	$("#Precio_Compra2").val(Precio_Compra);
	$("#Precio_Venta2").val(Precio_Venta);
	$("#proveedor2").val(FK_Proveedor);


};

function Editar(){
	var params={}
	var id = $('#id2').val();
	params.Nombre = $('#Nombre2').val();
	params.Cantidad =  $('#Cantidad2').val();
	params.Precio_Compra = $('#Precio_Compra2').val();
	params.Precio_Venta = $('#Precio_Venta2').val();
	params.FK_Proveedor = $('#proveedor2').val();

	
	try{
		axios.put(`http://localhost:3000/productos/${id}`,params).then((res)=>{
		location.reload();
	})
	}catch(e){
		console.log(e)
	}
};
		
</script>
