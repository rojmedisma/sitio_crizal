<table id="tbl_consulta" class="table table-bordered">
	<thead>
		<tr>
			<th scope="col">Opciones</th>
			<th scope="col">Nombre</th>
			<th scope="col">Usuario</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($controlador_obj->getArrTabla() as $arr_tbl_det){ ?>
		<tr>
			<td>
				<?php echo $controlador_obj->getHTMLBtnAbrir($arr_tbl_det['cat_usuario_id']); ?>
				<?php echo $controlador_obj->getHTMLBtnBorrar($arr_tbl_det['cat_usuario_id']); ?>
			</td>
			<td><?php echo concatena_nombre($arr_tbl_det['nombre'], $arr_tbl_det['ap_paterno'], $arr_tbl_det['ap_materno']); ?></td>
			<td><?php echo $arr_tbl_det['usuario']?></td>
		</tr>
		<?php }?>
	</tbody>
</table>

