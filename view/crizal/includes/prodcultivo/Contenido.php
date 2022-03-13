<section class="box-hover">
	<div class="container">
		<div class="section-heading">
			<h3>Variedad de maíz</h3>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="horizontaltab tab-style4">
					<ul class="resp-tabs-list hor1">
						<li class="margin-30px-left <?=$controlador_obj->getEsPestaniaSel('inicio') ?>">
							<a href="<?= define_controlador('prodcultivo', 'inicio', false, array('cultivo_id'=>$controlador_obj->getCultivoId())) ?>">
								<span class="count font-size100 md-font-size80 alt-font font-weight-700">1</span>
								<div class="tab-box">
									<h6>Detalla</h6><span>tu variedad maíz</span>
								</div>
							</a>
						</li>
						<li class="margin-30px-left <?=$controlador_obj->getEsPestaniaSel('inventario') ?>">
							<a href="<?= define_controlador('prodcultivo', 'inventario', false, array('cultivo_id'=>$controlador_obj->getCultivoId())) ?>">
								<span class="count font-size100 md-font-size80 alt-font font-weight-700">2</span>
								<div class="tab-box">
									<h6>Indica</h6><span> su disponibilidad</span>
								</div>
							</a>
						</li>
						<li class="margin-30px-left <?=$controlador_obj->getEsPestaniaSel('fotos') ?>">
							<a href="<?= define_controlador('prodcultivo', 'fotos', false, array('cultivo_id'=>$controlador_obj->getCultivoId())) ?>">
								<span class="count font-size100 md-font-size80 alt-font font-weight-700">3</span>
								<div class="tab-box">
									<h6>Sube</h6><span>imágenes</span>
								</div>
							</a>
						</li>
					</ul>
					<div class="resp-tabs-container box-shadow-large bg-white hor_1">
						<div>
							<div class="bg-white box-shadow-primary padding-30px-all xs-padding-20px-all">
								<?php include_once $controlador_obj->getAccion().'/Contenido.php'; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
