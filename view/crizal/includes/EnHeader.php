<div id="top-bar">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-xs-12">
				<div class="top-bar-info">

				</div>
			</div>
			<div class="col-xs-12 col-md-3 xs-display-none">
				<ul class="top-social-icon">
					<?php if($controlador_obj->getUsuarioId()): ?>
						<li><a href="<?= define_controlador('sesion', 'desautentificar') ?>"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
					<?php else: ?>
						<li><a href="<?= define_controlador('sesion', 'inicio') ?>"><i class="fas fa-sign-in-alt"></i> Iniciar sesión</a></li>
					<?php endif; ?>
					<li><a href="<?= define_controlador('principal', 'inicio') ?>#sec_ingreso"><i class="fas fa-user-plus"></i> Registrarse</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="navbar-default">
	<!-- start top search -->
	<div class="top-search bg-theme">
		<div class="container">
			<form class="search-form" action="search.html" method="GET" accept-charset="utf-8">
				<div class="input-group">
					<span class="input-group-addon cursor-pointer">
						<button class="search-form_submit fas fa-search font-size18 text-white" type="submit"></button>
					</span>
					<input type="text" class="search-form_input form-control" name="s" autocomplete="off" placeholder="Type & hit enter...">
					<span class="input-group-addon close-search"><i class="fas fa-times font-size18 line-height-28 margin-5px-top"></i></span>
				</div>
			</form>
		</div>
	</div>
	<!-- end top search -->
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-lg-12">
				<div class="menu_area alt-font">
					<nav class="navbar navbar-expand-lg navbar-light no-padding">
						<div class="navbar-header navbar-header-custom">
							<!-- start logo -->
							<a href="<?php echo define_controlador() ?>" class="navbar-brand logodefault"><img id="logo" src="/<?php echo DIR_LOCAL; ?>/assets/img/logo.png" alt="logo"></a>
							<!-- end logo -->
						</div>
						<div class="navbar-toggler"></div>
						<!-- menu area -->
						<ul class="navbar-nav ml-auto" id="nav" style="display: none;">
							<li>
								<a href="<?= define_controlador() ?>">Inicio</a>
							</li>
							<?php if($controlador_obj->tienePermiso('as-productor')): ?>
							<li>
								<a href="<?= define_controlador('productor', 'inicio') ?>">Productor/a</a>
							</li>
							<?php endif;?>
							<li>
								<a href="<?= define_controlador('tienda', 'grid') ?>">Granero</a>
							</li>
							<li>
								<a href="#!">Más información</a>
								<ul>
									<li>
										<a href="#!">About Us</a>
									</li>
									<li>
										<a href="#!">Our Team</a>
									</li>
									<li>
										<a href="#!">Services</a>
									</li>
									<li>
										<a href="#!">Service Detail</a>
									</li>
									<li>
										<a href="#!">Contact Us</a>
									</li>
									<li>
										<a href="#!">FAQ</a>
									</li>
									<li>
										<a href="#!">Additional Pages</a>
									</li>
								</ul>
							</li>
						</ul>
						<!-- end menu area -->
						<!-- start attribute navigation -->
						<div class="attr-nav sm-no-margin sm-margin-70px-right xs-margin-65px-right">
							<ul>
								<li class="dropdown sm-margin-20px-right xs-margin-15px-right">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="fas fa-user"></i>
									</a>
									<ul class="dropdown-menu cart-list">
										<li>
											<p><?=$controlador_obj->usuario_dato('nombre').' '.$controlador_obj->usuario_dato('ap_paterno'); ?></p>
											<p><?=$controlador_obj->usuario_dato('usuario'); ?></p>
										</li>
									</ul>
								</li>
								<li class="search"><a href="#!"><i class="fas fa-search"></i></a></li>
							</ul>
						</div>
						<!-- end attribute navigation -->
					</nav>
				</div>
			</div>
		</div>
	</div>
</div>