<!-- start login section -->
<section>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10 col-lg-7 col-xl-6">
				<div class="common-block">
					<div class="line-title">
						<h3>Ingresar correo y contraseña</h3>
					</div>
					<?php if($controlador_obj->getEsInfoIncorrecta()): ?>
						<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Acceso denegado!</strong> Nombre de usuario o contraseña incorrectos.
						</div>
					<?php endif; ?>
					<form method="post" action="<?= define_controlador('sesion', 'autentificar') ?>" >
						<input name="url_uri" type="hidden" value="<?php echo $controlador_obj->getUrlUri(); ?>">
						<div class="row">
							<div class="col-sm-12 margin-10px-bottom">
								<div class="form-group">
									<label>Usuario</label>
									<input type="mail" id="usuario" name="usuario" placeholder="Ingresa tu correo electrónico">
								</div>
							</div>
							<div class="col-sm-12 margin-10px-bottom">
								<div class="form-group">
									<label>Contraseña </label>
									<input name="clave" id="clave" type="password" placeholder="Ingresa tu contraseña">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 margin-10px-bottom">
								<a href="forgot-password.html" class="m-link-muted">Olvidé mi contraseña</a>
							</div>
						</div>
						<button type="submit" class="butn theme btn-block margin-20px-top"><span>Ingresar</span></button>
						<div class="text-center text-small margin-20px-top">
							<span>Aún no tengo una cuenta: <a href="<?= define_controlador('registro', 'inicio') ?>">Registrarse</a></span>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end under construction section -->
