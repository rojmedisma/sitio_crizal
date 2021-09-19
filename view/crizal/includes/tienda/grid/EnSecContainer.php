<!-- Container para acción grid  -->
				<div class="container">
					<div class="row">
						<!-- start product grid left panel -->
						<div class="col-lg-3 col-md-12">
							<div class="side-bar">
								<div class="widget">
									<div id="accordion" class="accordion-style2">
										<div class="card">
											<div class="card-header" id="headingOne">
												<h5 class="mb-0">
													<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Ver por...</button>
												</h5>
											</div>
											<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
												<div class="card-body">
													<ul class="mb-0">
														<li><a href="#!">Región</a></li>
														<li><a href="#!">Variedad</a></li>
														<li><a href="#!">Nombre</a></li>
														<li><a href="#!">Color</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="widget">
									<div class="widget-title">
										<h5>Propiedades</h5>
									</div>
									<ul class="mb-0 ml-2">
										<li class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" id="ten_pecentage">
											<label class="custom-control-label text-left" for="ten_pecentage">Cultivo con certificaciones</label>
										</li>
										<li class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" id="twenty_pecentage">
											<label class="custom-control-label text-left" for="twenty_pecentage">Con servicio de entrega</label>
										</li>
										<li class="custom-control custom-checkbox">
											<input class="custom-control-input" type="checkbox" id="thirty_pecentage">
											<label class="custom-control-label text-left" for="thirty_pecentage">Con descuento</label>
										</li>
									</ul>
								</div>
								<div class="widget">
									<div class="widget-title">
										<h5>Varedades populares</h5>
									</div>
									<div class="media margin-20px-bottom">
										<img class="mr-3" src="img/shop/thumb-01.jpg" alt="...">
										<div class="media-body">
											<a href="#!" class="margin-5px-bottom font-weight-600 text-extra-dark-gray">Ut placerat lacus ac odio</a>
										</div>
									</div>
									<div class="media margin-20px-bottom">
										<img class="mr-3" src="img/shop/thumb-02.jpg" alt="...">
										<div class="media-body">
											<a href="#!" class="margin-5px-bottom font-weight-600 text-extra-dark-gray">Integer posuere felis</a>
										</div>
									</div>
									<div class="media">
										<img class="mr-3" src="img/shop/thumb-03.jpg" alt="...">
										<div class="media-body">
											<a href="#!" class="margin-5px-bottom font-weight-600 text-extra-dark-gray">Aenean ac risus blandit</a>
										</div>
									</div>
								</div>
								
								<div class="widget">
									<div class="offer-banner bg-theme text-center sm-display-none">
										<a href="#!"><img src="img/shop/left-panel-banner.png" alt="" /></a>
									</div>
								</div>
							</div>
						</div>
						<!-- end product grid left panel -->
						<!-- start right panel section -->
						<div class="col-lg-9 col-md-12 padding-35px-left sm-padding-15px-lr">
							<div class="row">
								<div class="col-12">
									<div class="float-left bg-light-gray width-100 padding-10px-tb padding-15px-lr">
										<div class="float-right margin-5px-top xs-no-margin-top xs-width-100 text-center">
											<div class="float-right xs-float-none xs-width-100 xs-margin-15px-bottom">
												<label>Regiones:</label>
												<select class="width-auto display-inline-block no-margin">
													<option value="#?limit=24" selected="selected">Norte</option>
													<option value="#?limit=25">Norte-occidente</option>
													<option value="#?limit=50">Centro-norte</option>
													<option value="#?limit=75">Centro</option>
													<option value="#?limit=100">Sur</option>
												</select>
											</div>
											<div class="float-right margin-20px-right xs-float-none xs-width-100 xs-no-margin-right xs-margin-10px-bottom">
												<label>Buscar:</label>
												<input class="width-auto display-inline-block no-margin" type="text" name="buscar">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row product-grid">
								<?php include_once 'EnProductGrid.php';?>
							</div>
							<div class="row margin-50px-top sm-margin-35px-top">
								<div class="col-12">
									<div class="pagination text-small text-uppercase text-extra-dark-gray">
										<ul>
											<li><a href="#!"><i class="fas fa-long-arrow-alt-left margin-5px-right xs-display-none"></i> Prev</a></li>
											<li class="active"><a href="#!">1</a></li>
											<li><a href="#!">2</a></li>
											<li><a href="#!">3</a></li>
											<li><a href="#!">Next <i class="fas fa-long-arrow-alt-right margin-5px-left xs-display-none"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<!-- end right panel section -->
					</div>
				</div>