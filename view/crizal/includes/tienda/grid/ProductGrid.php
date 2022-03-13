<div class="row product-grid">
	<?php while ($arr_det = $controlador_obj->rs_cvo->fetch_object()):?>
		<div class="col-xl-4 col-sm-6">
			<div class="product-details">
				<div class="product-img">
					<div class="label-offer bg-black">Disponible</div>
					<img src="<?php echo $arr_det->ruta_archivo.$arr_det->nom_arc_sist ?>" alt="" />
					<div class="product-cart">
						<a href="<?php echo define_controlador('tienda', 'producto', false, array('cultivo_id'=>$arr_det->cultivo_id))?>"><i class="fas fa-plus"></i></a>
					</div>
				</div>
				<div class="product-info">
					<a href="<?php echo define_controlador('tienda', 'producto', false, array('cultivo_id'=>$arr_det->cultivo_id))?>"><?php echo $arr_det->cat_cultivo_id_desc?></a>
				</div>
			</div>
		</div>
	<?php endwhile;?>
</div>
<div class="row margin-50px-top sm-margin-35px-top">
	<div class="col-12">
		<?=$controlador_obj->zebra_pagination->render(); ?>
	</div>
</div>