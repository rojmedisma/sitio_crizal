<div class="navbar-header navbar-header-custom">
	<!-- start logo -->
	<a href="index.html" class="navbar-brand"><img id="logo" src="/<?php echo DIR_LOCAL; ?>/assets/img/logo_232x86.png" alt="logo"></a>
	<!-- end logo -->
</div>
<div class="navbar-toggler"></div>
<!-- menu area -->
<ul class="navbar-nav ml-auto" id="nav" style="display: none;">
	<li>
		<a href="<?php echo define_controlador()?>">Home</a>
	</li>
	<li>
		<a href="<?php echo define_controlador('inventory')?>">Inventory</a>
	</li>
	<li>
		<a href="#!">More</a>
		<ul>
			<li>
				<a href="#sec_about_us">About Us</a>
			</li>
			<li>
				<a href="#sec_feat_vehi">Featured Vehicles</a>
			</li>
			<li>
				<a href="#sec_visit_us">Visit Us</a>
			</li>
			<li>
				<a href="#sec_faq">FAQ</a>
			</li>
		</ul>
	</li>
</ul>
<!-- end menu area -->
<!-- start attribute navigation -->
<div class="attr-nav sm-no-margin sm-margin-70px-right xs-margin-65px-right">
	<ul>
		<li class="search"><a href="#!"><i class="fas fa-search"></i></a></li>
	</ul>
</div>
<!-- end attribute navigation -->
