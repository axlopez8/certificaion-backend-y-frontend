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
						<h2>Tabla Clientes</h2>
					</div>
					<div class="col-sm-6">
						<a href="#AñadirRegistro" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir Cliente</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>DPI</th>
						<th>NIT</th>
						<th>Telefono</th>
						<th>Email</th>
						<th> </th>

					</tr>
				</thead>
				<tbody>
				<?php
				$json=file_get_contents("http://localhost:3000/clientes");
				$datos=json_decode($json, true);
				for($i=0; $i< count($datos); $i++){
						
				
			?>
					<tr>
						
						<td> <?php echo $datos[$i]["idCliente"] ?> </td>
						<td> <?php echo $datos[$i]["Nombres"]  ?></td>
						<td> <?php echo $datos[$i]["Apellidos"]  ?></td>
						<td> <?php echo $datos[$i]["DPI"]  ?></td>
						<td> <?php echo $datos[$i]["NIT"]  ?></td>
						<td> <?php echo $datos[$i]["Telefono"]  ?> </td>
						<td> <?php echo $datos[$i]["Email"]  ?> </td>


						<td>
							<a href="#EditarRegistro" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" onclick='EdiForm(<?php echo $datos[$i]["idCliente"] ?>,"<?php echo $datos[$i]["idPersona"]?>")'> &#xE254;</i></a>
							<a href=""  class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" onclick='eliminar(<?php echo $datos[$i]["idCliente"] ?>,"<?php echo $datos[$i]["Nombres"] ?>")'>&#xE872;</i></a>
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
	<center><button style="background-color:green" class="btn btn-secondary btn-lg active" onclick="window.location.href='../menu.php'"> MENU</button></center>
	</div>        
</div>
<!-- Edit Modal HTML -->
<div id="AñadirRegistro" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="crear.php" method="POST" >
				<div class="modal-header">						
					<h4 class="modal-title">Añadir Cliente</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
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
					<h4 class="modal-title">Editar Clientes</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>

				<div class="modal-body">
				
					<div class="form-group">
						<label>ID</label>
						<input type="number" id="id2" class="form-control" readonly>
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
	params.FK_Persona = $('#persona').val();
	console.log(params)
	
	axios.post(`http://localhost:3000/clientes`,params).then((res)=>{location.reload();}).catch((e)=>{console.log(e)})
}; 

// java script para eliminar valores de registros.
function eliminar(id,persona){
	var C = confirm('Desea eliminar '+persona);
    if (C == true) {
		axios.delete(`http://localhost:3000/clientes/${id}`).then((res)=>{location.reload();}).catch((e)=>{console.log(e)})
	}
};

// java script para obtener valores de registros.
function EdiForm(Id,persona){
	$("#id2").val(Id);
	$("#persona2").val(persona);
};

function Editar(){
	var params={}
	var id=$('#id2').val();
	params.FK_Persona = $('#persona2').val();
	axios.put(`http://localhost:3000/clientes/${id}`,params).then((res)=>{location.reload();}).catch((e)=>{console.log(e)})

};
</script>
