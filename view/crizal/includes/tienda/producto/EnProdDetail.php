<h3 class="margin-8px-bottom"><?php echo $controlador_obj->getCampoValor('cat_cultivo_id_desc') ?> <span class="label-sale bg-theme text-white text-uppercase font-size14">Sale</span></h3>
<div class="bg-theme separator-line-horrizontal-full margin-20px-bottom"></div>
<p class="rating-text"><span>SKU:</span> <span class="font-500 theme-color">290397</span></p>
<p>Lorem ipsum dolor ut sit ame dolore adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna aliquarm erat volutpat Nostrud duis molestie at dolore.</p>
<div class="margin-20px-bottom">
	<div class="display-inline-block margin-15px-right padding-15px-right border-right border-color-extra-medium-gray">
		<i class="fas fa-star"></i>
		<i class="fas fa-star"></i>
		<i class="fas fa-star"></i>
		<i class="fas fa-star"></i>
		<i class="fas fa-star-half-alt"></i>
	</div>
	<div class="display-inline-block">
		<a class="text-theme-color" href="#!">Reseña</a>
	</div>
</div>
<div class="row">
	<div class="col-12 col-lg-6 col-md-6">
		<label>Origen de la semilla:</label>
		<p><strong><?php echo $controlador_obj->getCampoValor('semilla_origen_desc') ?></strong></p>
	</div>
	<div class="col-12 col-lg-6 col-md-6">
		<label>Forma de producción:</label>
		<p><strong><?php echo $controlador_obj->getCampoValor('produc_metodo_desc') ?></strong></p>
	</div>
	<div class="col-12 col-lg-6 col-md-6">
		<label>Uso de agroquímicos:</label>
		<p><strong><?php echo $controlador_obj->getCampoValor('agroqui_uso_desc') ?></strong></p>
	</div>
</div>
<div class="row margin-20px-bottom">
	<div class="col-lg-12">
		<button type="button" class="butn theme margin-15px-right xs-margin-10px-bottom" data-toggle="modal" data-target="#mdl_aviso_reg"><span><i class="fas fa-arrow-circle-up margin-5px-right"></i> Enviar solicitud</span></button>
	</div>
</div>
<div class="row">
	<div class="col-lg-7">
		<label>Share on:</label>
		<ul class="social-icon-style3">
			<li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
			<li><a href="#!"><i class="fab fa-twitter"></i></a></li>
			<li><a href="#!"><i class="fab fa-instagram"></i></a></li>
			<li><a href="#!"><i class="fab fa-youtube"></i></a></li>
			<li><a href="#!"><i class="fab fa-linkedin-in"></i></a></li>
		</ul>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="mdl_aviso_reg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Aviso</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="text-center  margin-20px-top">
					<p>Para poder crear el vínculo con el productor y generar una solicitud de compra, primero es necesario que te registres en nuestra plataforma.</p>
					<p>Gracias</p>
					<a href="<?=define_controlador('registro', 'inicio', false, array('usuario_tipo'=>2))?>" class="butn theme"><span>Abrir formulario de registro </span></a>
				</div>
				<div class="text-center text-small margin-20px-top">
					<span>Ya estoy registrado <a href="<?= define_controlador('sesion','inicio') ?>">Iniciar sesión</a></span>
				</div>
			</div>
		</div>
	</div>
</div>



<!-- Modal -->
<div class="modal fade" id="mdl_frm_sched" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Solicitud</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="quform" action="quform/getin-touch-one.php" method="post" enctype="multipart/form-data" onclick="">
					<div class="quform-elements">
						<div class="quform-element form-group">
							<div class="quform-input">
								<input id="name" type="text" name="name" placeholder="Nombre" />
							</div>
						</div>
						<div class="quform-element form-group">
							<div class="quform-input">
								<input id="email" type="text" name="email" placeholder="Correo" />
							</div>
						</div>
						<div class="quform-element form-group">
							<div class="quform-input">
								<input id="phone" type="text" name="phone" placeholder="Teléfono" />
							</div>
						</div>
						<div class="quform-element form-group">
							<div class="quform-input">
								<textarea id="message" name="message" rows="3" placeholder="Información adicional"></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="butn text-uppercase" data-dismiss="modal"><span>Enviar </span></button>
			</div>
		</div>
	</div>
</div>