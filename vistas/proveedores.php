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
						<h2>Tabla Proveedores</h2>
					</div>
					<div class="col-sm-6">
						<a href="#AñadirRegistro" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir Proveedor</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre_Empresa</th>
						<th>Nit_Empresa</th>
						<th>Telefono_Empresa</th>
						<th>Email_Empresa</th>
						<th>Persona</th>
						<th> </th>

					</tr>
				</thead>
				<tbody>
				<?php
				$json=file_get_contents("http://localhost:3000/proveedores");
				$datos=json_decode($json, true);
				for($i=0; $i< count($datos); $i++){
						
				
			?>
					<tr>
						
						<td> <?php echo $datos[$i]["idProveedor"] ?> </td>
						<td> <?php echo $datos[$i]["Nombre_Empresa"]  ?></td>
						<td> <?php echo $datos[$i]["NIT_Empresa"]  ?></td>
						<td> <?php echo $datos[$i]["Telefono_Empresa"]  ?> </td>
						<td> <?php echo $datos[$i]["Email_Empresa"]  ?> </td>
						<td> <?php echo $datos[$i]["Nombres"]  ?> </td>


						<td>
							<a href="#EditarRegistro" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" onclick='EdiForm(<?php echo $datos[$i]["idProveedor"] ?>,"<?php echo $datos[$i]["Nombre_Empresa"]?>","<?php echo $datos[$i]["NIT_Empresa"] ?>",<?php echo $datos[$i]["Telefono_Empresa"]?>, "<?php echo $datos[$i]["Email_Empresa"] ?>","<?php echo $datos[$i]["FK_Persona"]?>")'> &#xE254;</i></a>
							<a href=""  class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" onclick='eliminar(<?php echo $datos[$i]["idProveedor"] ?>,"<?php echo $datos[$i]["Nombre_Empresa"] ?>")'>&#xE872;</i></a>
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
	<center><button style="background-color:green" class="btn btn-secondary btn-lg active" onclick="window.location.href='../menu.php'"> MENU</button></center>	</div>        
</div>
<!-- Edit Modal HTML -->
<div id="AñadirRegistro" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="crear.php" method="POST" >
				<div class="modal-header">						
					<h4 class="modal-title">Añadir Producto</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombre_Empresa</label>
						<input type="text" id="Nombre_Empresa" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Nit_Empresa</label>
						<input type="text" id="NIT_Empresa" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Telefono_Empresa</label>
						<input type="number" id="Telefono_Empresa" step="0.01" class="form-control" required>

					</div>
					<div class="form-group">
						<label>Email_Empresa</label>
						<input type="text" id="Email_Empresa" step="0.01" class="form-control" required>

					</div>
					<div id="SEL2" class="form-group">  
                            
                            <label>Nombre de la Persona</label> 

                            <select id="persona" class="form-control"  required>
                            <option selected >---- Nombre de las Personas ----</option>
                           
                            <?php
                                $jsonp=file_get_contents("http://localhost:3000/personas");
								$datosp=json_decode($jsonp, true);
								for($i=0; $i< count($datosp); $i++){
                            ?>
                            <option value="<?php echo $datosp[$i]["idPersona"]?>" ><?php echo $datosp[$i]["Nombres"]?></option>
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
					<h4 class="modal-title">Editar Proveedor</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>ID</label>
						<input type="number" id="id2" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Nombre_Empresa</label>
						<input type="text" id="Nombre_Empresa2" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Nit_Empresa</label>
						<input type="text" id="NIT_Empresa2" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Telefono_Empresa</label>
						<input type="number" id="Telefono_Empresa2" step="0.01" class="form-control" required>

					</div>
					<div class="form-group">
						<label>Email_Empresa</label>
						<input type="text" id="Email_Empresa2" step="0.01" class="form-control" required>

					</div>
					<div id="SEL2" class="form-group">  
                            
                            <label>Nombre de la Persona</label> 

                            <select id="persona2" class="form-control"  required>
                            <option selected >---- Nombre de las Personas ----</option>
                           
                            <?php
                                
								for($i=0; $i< count($datosp); $i++){
                            ?>
                            <option value="<?php echo $datosp[$i]["idPersona"]?>" ><?php echo $datosp[$i]["Nombres"]?></option>
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

	params.Nombre_Empresa = $('#Nombre_Empresa').val();
	params.NIT_Empresa = $('#NIT_Empresa').val();
	params.Telefono_Empresa = $('#Telefono_Empresa').val();
	params.Email_Empresa = $('#Email_Empresa').val();
	params.FK_Persona = $('#persona').val();
	try{
		axios.post(`http://localhost:3000/proveedores`,params).then((res)=>{
		location.reload();
	})
	}catch(e){
		console.log(e)
	}
	
}; 

// java script para eliminar valores de registros.
function eliminar(id,Nombre_Empresa){
	var C = confirm('Desea eliminar '+Nombre_Empresa);
    if (C == true) {
	
		axios.delete(`http://localhost:3000/proveedores/${id}`).then((res)=>{location.reload();}).catch((e)=>{console.log(e)})
	}
};

// java script para obtener valores de registros.
function EdiForm(Id,Nombre_Empresa,NIT_Empresa,Telefono_Empresa,Email_Empresa,FK_Persona){
	console.log (Id,Nombre_Empresa,NIT_Empresa,Telefono_Empresa,Email_Empresa,FK_Persona)
	$("#id2").val(Id);
	$("#Nombre_Empresa2").val(Nombre_Empresa);
	$("#NIT_Empresa2").val(NIT_Empresa);
	$("#Telefono_Empresa2").val(Telefono_Empresa);
	$("#Email_Empresa2").val(Email_Empresa);
	$("#persona2").val(FK_Persona);
};

function Editar(){
	var params={}
	var id = $('#id2').val();
	params.Nombre_Empresa = $('#Nombre_Empresa2').val();
	params.NIT_Empresa = $('#NIT_Empresa2').val();
	params.Telefono_Empresa = $('#Telefono_Empresa2').val();
	params.Email_Empresa = $('#Email_Empresa2').val();
	params.FK_Persona = $('#persona2').val();
	try{
		axios.put(`http://localhost:3000/proveedores/${id}`,params).then((res)=>{
		location.reload();
	})
	}catch(e){
		console.log(e)
	}
};
</script>
