<table id="tbl_consulta" class="table table-bordered">
	<thead>
		<tr>
			<th scope="col">Id</th>
			<th scope="col">Fecha</th>
			<th scope="col">Usuario Id</th>
			<th scope="col">Campo Id Nombre</th>
			<th scope="col">Campo Id Valor</th>
			<th scope="col">Evento</th>
			<th scope="col">Estatus</th>
			<th scope="col">Descripción</th>
			<th scope="col">Dirección IP</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($controlador_obj->getArrTabla() as $arr_tbl_det){ ?>
		<tr>
			<td><?php echo $arr_tbl_det['log_id']?></td>
			<td><?php echo $arr_tbl_det['fecha']." ".$arr_tbl_det['hora']?></td>
			<td><?php echo $arr_tbl_det['cat_usuario_id']?></td>
			<td><?php echo $arr_tbl_det['cmp_id_nom']?></td>
			<td><?php echo $arr_tbl_det['cmp_id_val']?></td>
			<td><?php echo $arr_tbl_det['evento']?></td>
			<td><?php echo $arr_tbl_det['estatus']?></td>
			<td><?php echo $arr_tbl_det['descripcion']?></td>
			<td><?php echo $arr_tbl_det['remote_addr']?></td>
		</tr>
		<?php }?>
	</tbody>
</table>
