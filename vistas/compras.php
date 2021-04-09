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
							<h2>Tabla Compras</h2>
						</div>
						<div class="col-sm-6">
							<a href="#AñadirRegistro" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir Compra</span></a>
						</div>
					</div>
				</div>
				<?php
				$json=file_get_contents("http://localhost:3000/compras");
				$datos=json_decode($json, true);
				for($i=0; $i< count($datos); $i++){
						
				
			?>
				
					<div class="card bg-secondary text-white mb-3">
						<div class="card-body">
							<h5 class="card-title">Compra No.<?php echo $datos[$i]["idCompra"] ?></h5>
							<p class="card-text m-auto">Vendedor:<?php echo $datos[$i]["Nombre_Empresa"] ?></p>
						</div>
						<div class="card-body">
							<div class="table-responsive-sm">
								<table class="table table-striped table-bordered table-sm">
									<thead class="thead-dark">
										<tr>
											<th class="text-center" scope="col">Cantidad.</th>
											<th class="text-center" scope="col">Producto</th>
											<th class="text-center" scope="col">Precio</th>
											<th class="text-center" scope="col">Sub_Total</th>
										</tr>
									</thead>

									<tbody>
										<?php
										$jsonp=file_get_contents("http://localhost:3000/detalles_compras/".$datos[$i]["idCompra"]);
										$datosp=json_decode($jsonp, true);
										$total=0; 
										for($ii=0; $ii< count($datosp); $ii++) {
										?>
											<tr>
												<td class="text-center table-secondary"><?php echo $datosp[$ii]["Cantidad"] ?> </td>
												<td class="table-secondary"><?php echo $datosp[$ii]["Nombre"]  ?> </td>
												<td class="table-secondary"><?php echo $datosp[$ii]["Precio_Compra"]  ?> </td>
												<td class="text-center table-secondary"><?php echo $datosp[$ii]["sub_total"] ;
																						$total = $total + $datosp[$ii]["sub_total"] ?> </td>
											</tr>
										<?php } ?>
										<tr>
											<td class="table-dark text-right" colspan="3">SubTotal</td>
											<td class="table-secondary text-center">Q.<?php echo $total;
																						$total = 0; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="card-footer">
							<p class="card-subtitle">Total: Q.<?php echo $datos[$i]["Total_Monto"]; ?></p>
							<p class="card-subtitle">Pago: Q.<?php echo $datos[$i]["Total_Pagado"]; ?> </p>
							<p class="card-subtitle">Estado: <?php if($datos[$i]["FK_Estado"]==1){echo"Cancelado";}else if ($datos[$i]["FK_Estado"]==2){echo"Deuda";} ?> </p>
						</div>
					</div>
				<?php } ?>
			</div>
			<br>
			<br>
			<br>
			<center><button style="background-color:green" class="btn btn-secondary btn-lg active" onclick="window.location.href='../menu.php'"> MENU</button></center>	</div>        
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="AñadirRegistro" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="crear.php" method="POST">
					<div class="modal-header">
						<h4 class="modal-title">Añadir Compra</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div id="SEL2" class="form-group">

						<label>Nombre del Proveedor</label>

						<select id="proveedor" class="form-control" required>
							<option selected>---- Nombre de los Proveedores ----</option>

							<?php
							$json2=file_get_contents("http://localhost:3000/proveedores");
							$datos2=json_decode($json2, true);
							$json3=file_get_contents("http://localhost:3000/productos");
							$datos3=json_decode($json3, true);
							for($i2=0; $i2< count($datos2); $i2++) {
							?>
								<option value="<?php echo $datos2[$i2]["idProveedor"]?>"><?php echo $datos2[$i2]["Nombre_Empresa"] ?></option>
							<?php
							}
							?>
						</select>

					</div>
					<?php

					for($i3=0; $i3< count($datos3); $i3++) {
					?>
						<input type="hidden" id="p<?php echo $datos3[$i3]["idProducto"] ?>" value="<?php echo $datos3[$i3]["Precio_Compra"] ?>" />
					<?php
					}
					?>
					<div id="Pro1" class="form-group">

						<label>Producto</label>

						<select id="Producto1" class="form-control" required>
							<option selected>---- Productos ----</option>

							<?php
							for($i3=0; $i3< count($datos3); $i3++)  {
							?>
								<option value="<?php echo $datos3[$i3]["idProducto"] ?>"><?php echo $datos3[$i3]["Nombre"] ?> -- <?php echo $datos3[$i3]["Precio_Compra"] ?></option>

							<?php
							}
							?>
						</select>

						<input type="number" id="cantidad1" class="form-control" required>

					</div>
					<div id="Pro2" class="form-group">

						<label>Producto</label>

						<select id="Producto2" class="form-control" required>
							<option selected>---- Productos ----</option>

							<?php
							for($i3=0; $i3< count($datos3); $i3++)  {
							?>
								<option value="<?php echo $datos3[$i3]["idProducto"] ?>"><?php echo $datos3[$i3]["Nombre"] ?> -- <?php echo $datos3[$i3]["Precio_Compra"] ?></option>

							<?php
							}
							?>
						</select>

						<input type="number" id="cantidad2" class="form-control" required>

					</div>
					<div id="Pro3" class="form-group">

						<label>Producto</label>

						<select id="Producto3" class="form-control" required>
							<option selected>---- Productos ----</option>

							<?php
							for($i3=0; $i3< count($datos3); $i3++)  {
								?>
									<option value="<?php echo $datos3[$i3]["idProducto"] ?>"><?php echo $datos3[$i3]["Nombre"] ?> -- <?php echo $datos3[$i3]["Precio_Compra"] ?></option>

							<?php
							}
							?>
						</select>

						<input type="number" id="cantidad3" class="form-control" required>

					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Total_Monto</label>
							<input type="number" id="monto" class="form-control" required readonly>
						</div>
						<div class="form-group">
							<label>Total_Pagado</label>
							<input type="number" id="pago" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Estado</label>
							<input type="text" id="estado" class="form-control" readonly required>
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
</body>

</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
	var monto1 = 0
	var monto2 = 0
	var monto3 = 0
	$(document).on("change", "#pago", function() {
		if (document.getElementById("pago").value >= document.getElementById("monto").value) {
			document.getElementById('estado').value = "Cancelado"
		} else {
			document.getElementById('estado').value = "Deuda"
		}
	});

	$(document).on("change", "#cantidad1", function() {
		var d = document.getElementById("Producto1").value
		monto1 = document.getElementById("p" + d).value * document.getElementById("cantidad1").value
		document.getElementById("monto").value = monto1 + monto2 + monto3
	});
	$(document).on("change", "#cantidad2", function() {
		var d = document.getElementById("Producto2").value
		monto2 = document.getElementById("p" + d).value * document.getElementById("cantidad2").value
		document.getElementById("monto").value = monto1 + monto2 + monto3
	});
	$(document).on("change", "#cantidad3", function() {
		var d = document.getElementById("Producto3").value
		monto3 = document.getElementById("p" + d).value * document.getElementById("cantidad3").value
		document.getElementById("monto").value = monto1 + monto2 + monto3
	});

	// java script para agregar valores de registros.
	async function sumar(can,pro){
		var prov={};
		var cant=parseInt(can);
		var prod=parseInt(pro);
		await axios.get(`http://localhost:3000/productos/${prod}`).then((res)=>{
			//location.reload();
			prov=res.data
		}).catch((e)=>{console.log(e)})
		prov.Cantidad=prov.Cantidad+cant;
		await axios.put(`http://localhost:3000/productos/${prod}`,prov).then((res)=>{
			//location.reload();
		}).catch((e)=>{console.log(e)})

	}
	async function agregar() {
		var fac=0;
		var params={};
		params.Total_Monto = parseFloat( $('#monto').val());
		params.Total_Pagado = parseFloat($('#pago').val());
		params.FK_Proveedor = parseInt( $('#proveedor').val());
		if($('#estado').val()=="Cancelado"){params.FK_Estado = 1;}
		if($('#estado').val()=="Deuda"){params.FK_Estado = 2;}
		await axios.post(`http://localhost:3000/compras`,params).then((res)=>{fac=parseInt(res.data.compra)}).catch((e)=>{console.log(e)})

		if($('#cantidad1').val()> 0 && $('#Producto1').val()> 0){
			var paramsc={};
			paramsc.FK_Compra=fac;
			paramsc.Cantidad=parseInt($('#cantidad1').val());
			paramsc.sub_total=monto1;
			paramsc.FK_Producto=parseInt($('#Producto1').val());
			await	axios.post(`http://localhost:3000/detalles_compras`,paramsc).then((res)=>{sumar(paramsc.Cantidad,paramsc.FK_Producto);}).catch((e)=>{console.log(e)})
			
		}
		if($('#cantidad2').val()> 0 && $('#Producto2').val()> 0){
			var paramsc={};
			paramsc.FK_Compra=fac;
			paramsc.Cantidad=parseInt($('#cantidad2').val());
			paramsc.sub_total=monto2;
			paramsc.FK_Producto=parseInt($('#Producto2').val());
			await axios.post(`http://localhost:3000/detalles_compras`,paramsc).then((res)=>{sumar(paramsc.Cantidad,paramsc.FK_Producto);}).catch((e)=>{console.log(e)})
			
		}
		if($('#cantidad3').val()> 0 && $('#Producto3').val()> 0){
			var paramsc={};
			paramsc.FK_Compra=fac;
			paramsc.Cantidad=parseInt($('#cantidad3').val());
			paramsc.sub_total=monto3;
			paramsc.FK_Producto=parseInt($('#Producto3').val());
			await axios.post(`http://localhost:3000/detalles_compras`,paramsc).then((res)=>{sumar(paramsc.Cantidad,paramsc.FK_Producto);}).catch((e)=>{console.log(e)})
			
		}
		if(fac!=0){
			location.reload();
		}
		
	};
</script>