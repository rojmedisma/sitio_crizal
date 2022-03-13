<!-- start page title section -->
			<section class="page-title-section bg-img cover-background" data-overlay-dark="7" data-background="/<?php echo DIR_LOCAL; ?>/assets/img/SecPageTitle02.png">
				<div class="container">
					<div class="row">
						<div class="col-md-7 col-sm-12">
							<h1><?php echo $controlador_obj->getTituloPagina(); ?></h1>
						</div>
						<div class="col-md-5 col-sm-12">
							<ul class="text-right xs-text-left sm-margin-8px-top xs-margin-5px-top">
								<li><a href="<?php echo define_controlador()?>">Inicio</a></li>
								<?php if($controlador_obj->getPaginaAnterior(0, 'titulo_pagina')!=""):?>
								<li><a href="<?php echo define_controlador($controlador_obj->getPaginaAnterior(0, 'controlador'), $controlador_obj->getPaginaAnterior(0, 'accion'), false);?>"><?php echo $controlador_obj->getPaginaAnterior(0, 'titulo_pagina'); ?></a></li>
								<?php endif;?>
								<li><a href="#!"><?php echo $controlador_obj->getTituloPagina(); ?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<!-- end page title section -->