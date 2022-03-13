<!-- Container para acción grid  -->
<div class="container">
	<div class="row">
		<!-- start product grid left panel -->
		<div class="col-lg-3 col-md-12">
			<?php include_once 'SideBar.php'; ?>
		</div>
		<!-- end product grid left panel -->
		<!-- start right panel section -->
		<div class="col-lg-9 col-md-12 padding-35px-left sm-padding-15px-lr">
			<div class="row">
				<div class="col-12">
					<div class="float-left bg-light-gray width-100 padding-10px-tb padding-15px-lr">
						<div class="float-right margin-5px-top xs-no-margin-top xs-width-100 text-center">
							<div class="float-right xs-float-none xs-width-100 xs-margin-15px-bottom">

							</div>
							<div class="float-right">
								<form action="<?= define_controlador("tienda", "grid") ?>" method="post">
									<div class="input-group">
										<input type="text" name="buscar" placeholder="Buscar" value="<?= $controlador_obj->getCampoValor("buscar") ?>">
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
			<?php include_once 'ProductGrid.php'; ?>
		</div>
		<!-- end right panel section -->
	</div>
</div>