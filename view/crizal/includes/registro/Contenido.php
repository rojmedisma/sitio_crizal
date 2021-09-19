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
											<div class="form-group">
												<label>Nombre</label>
												<input type="text" name="name" placeholder="Your name here">
											</div>
										</div>
										<div class="col-sm-6 margin-10px-bottom">
											<div class="form-group">
												<label>Your User Name</label>
												<input type="text" name="username" placeholder="Your user name here">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6 margin-10px-bottom">
											<div class="form-group">
												<label>Email Address</label>
												<input type="email" name="email" placeholder="Your email here">
											</div>
										</div>
										<div class="col-sm-6 margin-10px-bottom">
											<div class="form-group">
												<label>Contact Number</label>
												<input type="text" name="phone" placeholder="+40-123 456 789">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6 margin-10px-bottom">
											<div class="form-group">
												<label>Password</label>
												<input type="password" name="password" placeholder="Your password here">
											</div>
										</div>
										<div class="col-sm-6 margin-10px-bottom">
											<div class="form-group">
												<label>Re-Password</label>
												<input type="password" name="re-password" placeholder="Your re-password here">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 margin-10px-bottom">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="terms-condition">
												<label class="custom-control-label" for="terms-condition">I agree to the <a href="#!" class="text-theme-color">Terms & Conditions</a></label>
											</div>
										</div>
									</div>
									<button type="button" class="butn theme btn-block margin-20px-top"><span>Register</span></button>
									<div class="text-center text-small margin-20px-top">
										<span>Already have an account? <a href="login.html">Login</a></span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- end registration form -->
