<!-- start registration form -->
			<section>
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-11 col-lg-8 col-xl-7">
							<div class="common-block">
								<div class="line-title">
									<h3>Registro para compradores</h3>
								</div>
								<form method="post">
									<div class="row">
										<div class="col-sm-6 margin-10px-bottom">
											<?=$controlador_obj->frm_crizal->cmpTexto('nombre', 'Nombre'); ?>
										</div>
										<div class="col-sm-6 margin-10px-bottom">
											<?=$controlador_obj->frm_crizal->cmpTexto('ap_paterno', 'Apellidos'); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6 margin-10px-bottom">
											<?=$controlador_obj->frm_crizal->cmpCorreo('correo', 'Correo electrónico'); ?>
										</div>
										<div class="col-sm-6 margin-10px-bottom">
											<?=$controlador_obj->frm_crizal->cmpContrasenia('clave', 'Contraseña'); ?>
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
									<button type="button" class="butn theme btn-block margin-20px-top"><span>Registrarse</span></button>
									<div class="text-center text-small margin-20px-top">
										<span>Ya estoy registrado <a href="<?= define_controlador('sesion','inicio') ?>">Iniciar sesión</a></span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- end registration form -->
