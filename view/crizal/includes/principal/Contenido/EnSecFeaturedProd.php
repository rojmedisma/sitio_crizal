<?php if(count($controlador_obj->getArrTblViCultivos())): ?>
	<div class="container lg">
		<div class="text-center margin-40px-bottom xs-margin-35px-bottom">
			<h2 class="no-margin font-weight-600 font-size28 xs-font-size26">Nuestro granero</h2>
		</div>
		<div class="product-grid featured-products owl-theme owl-carousel">
			<?php foreach($controlador_obj->getArrTblViCultivos() as $cultivo_id => $arr_det): ?>
				<div>
					<div class="product-details">
						<div class="product-img">
							<div class="label-offer bg-red">Sale</div>
							<img src="<?= $arr_det['ruta_archivo'] . $arr_det['nom_arc_sist'] ?>" alt="<?= $arr_det['cat_cultivo_id_desc'] ?>" />
							<div class="product-cart">
								<a href="<?php echo define_controlador('tienda', 'producto', false, array('cultivo_id' => $cultivo_id)) ?>"><i class="fas fa-plus"></i></a>
							</div>
						</div>
						<div class="product-info">
							<a href="#!"><?= $arr_det['cat_cultivo_id_desc'] ?></a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<a href="<?php echo define_controlador('tienda', 'grid') ?>" class="butn"><span>Inventario completo</span></a>
			</div>
		</div>
	</div>
<?php endif; ?>
<!-- end special section -->