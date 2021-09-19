<?php foreach($controlador_obj->getArrTabla() as $cultivo_id=>$arr_det):?>
	<div class="col-xl-4 col-sm-6">
		<div class="product-details">
			<div class="product-img">
				<div class="label-offer bg-black">Disponible</div>
				<img src="<?php echo $arr_det['ruta_archivo'].$arr_det['nom_arc_sist'] ?>" alt="" />
				<div class="product-cart">
					<a href="<?php echo define_controlador('tienda', 'producto', false, array('cultivo_id'=>$cultivo_id))?>"><i class="fas fa-plus"></i></a>
				</div>
			</div>
			<div class="product-info">
				<a href="<?php echo define_controlador('tienda', 'producto', false, array('cultivo_id'=>$cultivo_id))?>"><?php echo $arr_det['cat_cultivo_id_desc']?></a>
			</div>
		</div>
	</div>
<?php endforeach;?>

