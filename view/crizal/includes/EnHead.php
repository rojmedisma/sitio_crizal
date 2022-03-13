<!-- metas globales -->
		<meta charset="utf-8">
		<meta name="author" content="Ismael Rojas" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="keywords" content="Máiz, Granero virtual, Productores de maíz, Comprar maíz, Variedades de maíz" />
		<meta name="description" content="Directorio de productores de máiz" />
		<!-- title  -->
		<title><?php echo $controlador_obj->getTituloPagina(); ?></title>
		<!-- favicon -->
		<link rel="shortcut icon" href="<?php echo DIR_PLANTILLA; ?>/img/logos/favicon.png">
		<link rel="apple-touch-icon" href="<?php echo DIR_PLANTILLA; ?>/img/logos/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo DIR_PLANTILLA; ?>/img/logos/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo DIR_PLANTILLA; ?>/img/logos/apple-touch-icon-114x114.png">
		<!-- plugins -->
		<link rel="stylesheet" href="<?php echo DIR_PLANTILLA; ?>/css/plugins.css" />
		<?php if($controlador_obj->getControlador()=='principal'):?>
			<!-- revolution slider css -->
			<link rel="stylesheet" href="<?php echo DIR_PLANTILLA; ?>/css/rev_slider/settings.css">
			<link rel="stylesheet" href="<?php echo DIR_PLANTILLA; ?>/css/rev_slider/layers.css">
			<link rel="stylesheet" href="<?php echo DIR_PLANTILLA; ?>/css/rev_slider/navigation.css">
		<?php endif;?>
		<!-- search css -->
		<link rel="stylesheet" href="<?php echo DIR_PLANTILLA; ?>/search/search.css" />
		<!-- quform css -->
		<link rel="stylesheet" href="<?php echo DIR_PLANTILLA; ?>/quform/css/base.css">
		<!-- custom css -->
		<link href="<?php echo DIR_PLANTILLA; ?>/css/styles.css" rel="stylesheet" id="colors">
		<link rel="stylesheet" href="/<?php echo DIR_LOCAL; ?>/assets/css/crizal/main.css">
		<link rel="stylesheet" href="/<?php echo DIR_LOCAL; ?>/assets/css/<?php echo CARPETA_PROYECTO; ?>/zebra_pagination_mod.css">
