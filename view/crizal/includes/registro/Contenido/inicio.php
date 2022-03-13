<!-- start registration form -->
<section>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-11 col-lg-8 col-xl-7">
				<div class="common-block">
					<div class="line-title">
						<h3><?=$controlador_obj->getDatoVistaValor('tit_formulario') ?></h3>
					</div>
					<form action="<?= define_controlador('guardar', 'cat_usuario') ?>" method="post">
						<?= $controlador_obj->frm_crizal->cmpOculto('cat_grupo_id', $controlador_obj->getDatoVistaValor('cat_grupo_id')) ?>
						<?= $controlador_obj->frm_crizal->cmpOculto('activo', 1) ?>
						<?= $controlador_obj->frm_crizal->cmpOculto('controlador_fuente', $controlador_obj->getControlador()) ?>
						<?= $controlador_obj->frm_crizal->cmpOculto('accion_fuente', 'registrado') ?>
						<?php if($controlador_obj->getDatoVistaValor('mostrar_sel_usr_tipo')): ?>
							<div class="row">
								<div class="col-sm-12 margin-10px-bottom">
									<?= $controlador_obj->frm_crizal->cmpSelectDeSubCat('usuario_tipo', 'usuario_tipo', 'Tipo de usuario'); ?>
								</div>
							</div>
						<?php else: ?>
							<?= $controlador_obj->frm_crizal->cmpOculto('usuario_tipo', $controlador_obj->getDatoVistaValor('usuario_tipo')) ?>
							<?= $controlador_obj->frm_crizal->cmpOculto('usuario_tipo_desc', $controlador_obj->getDatoVistaValor('usuario_tipo_desc')) ?>
						<?php endif; ?>

						<div class="row">
							<div class="col-sm-6 margin-10px-bottom">
								<?= $controlador_obj->frm_crizal->cmpTexto('nombre', 'Nombre'); ?>
							</div>
							<div class="col-sm-6 margin-10px-bottom">
								<?= $controlador_obj->frm_crizal->cmpTexto('ap_paterno', 'Apellidos'); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 margin-10px-bottom">
								<?= $controlador_obj->frm_crizal->cmpSelectDeTbl('cat_estado_id', 'cat_estado', 'cat_estado_id', 'descripcion', '', 'Estado'); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 margin-10px-bottom">
								<label>¿Pertenece a una empresa / orrganización?</label>
							</div>
							<div class="col-sm-8 margin-10px-bottom">
								<label>Nombre de la empresa / orrganización</label>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 margin-10px-bottom">
								<?= $controlador_obj->frm_crizal->cmpSelectDeSubCat('es_organizacion', 'no_si'); ?>
							</div>
							<div class="col-sm-8 margin-10px-bottom">
								<?= $controlador_obj->frm_crizal->cmpTexto('organizacion'); ?>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6 margin-10px-bottom">
								<?= $controlador_obj->frm_crizal->cmpCorreo('correo', 'Correo electrónico'); ?>
							</div>
							<div class="col-sm-6 margin-10px-bottom">
								<?= $controlador_obj->frm_crizal->cmpContrasenia('clave', 'Contraseña'); ?>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12 margin-10px-bottom">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="terms-condition">
									<label class="custom-control-label" for="terms-condition">Estoy de acuerdo con los <a href="#!" class="text-theme-color">Términos y condiciones</a></label>
								</div>
							</div>
						</div>
						<button type="submit" class="butn theme btn-block margin-20px-top"><span>Registrarse</span></button>
						<div class="text-center text-small margin-20px-top">
							<span>Ya estoy registrado <a href="<?= define_controlador('sesion', 'inicio') ?>">Iniciar sesión</a></span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end registration form -->