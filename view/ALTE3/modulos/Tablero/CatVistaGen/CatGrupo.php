<table id="tbl_consulta" class="table table-bordered">
	<thead>
		<tr>
			<th scope="col">Id</th>
			<th scope="col">Nombre</th>
			<th scope="col">Descripción</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($controlador_obj->getArrTabla() as $arr_tbl_det){ ?>
		<tr>
			<td>
				<?php echo $controlador_obj->getHTMLBtnAbrir($arr_tbl_det['cat_grupo_id']); ?>
				<?php echo $controlador_obj->getHTMLBtnBorrar($arr_tbl_det['cat_grupo_id']); ?>
			</td>
			<td><?php echo $arr_tbl_det['tit_corto']; ?></td>
			<td><?php echo $arr_tbl_det['descripcion']?></td>
		</tr>
		<?php }?>
	</tbody>
</table>


