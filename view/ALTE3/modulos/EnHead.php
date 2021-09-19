<!-- Head -->
<meta charset="utf-8">
<meta name="Description" content="<?php echo $controlador_obj->getTituloPagina(); ?>">
<meta name="Keywords" content="Ismael Rojas, desarrollador, videoconferencias, mesa trabajo"/>
<meta name="author" content="Ismael Rojas Medina">
<meta name="copyright" content="Ismael Rojas Medina">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="distribution" content="global">
<meta name="robots" content="follow">
<title><?php echo $controlador_obj->getTituloPagina(); ?></title>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="/library/AdminLTE_3/plugins/fontawesome-free/css/all.min.css">
<!-- IonIcons -->
<!-- <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
<?php if($controlador_obj->getUsarLibVista()){?>
<!-- DataTables -->
<link rel="stylesheet" href="/library/AdminLTE_3/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<?php }?>
<?php if($controlador_obj->getUsarLibForma()){?>
<!-- 	<<	Para los formularios -->
<!-- daterange picker -->
<link rel="stylesheet" href="/library/AdminLTE_3/plugins/daterangepicker/daterangepicker.css">
<!-- Select2 -->
<link rel="stylesheet" href="/library/AdminLTE_3/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/library/AdminLTE_3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- 	>>	Para los formularios -->
<?php }?>
<?php if($controlador_obj->getConMenuLateralFijo()){?>
<!-- overlayScrollbars -->
<link rel="stylesheet" href="/library/AdminLTE_3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<?php }?>
<?php if($controlador_obj->getUsarLibToastr()){?>
<!-- Toastr: Para las alertas -->
<link rel="stylesheet" href="/library/AdminLTE_3/plugins/toastr/toastr.min.css">
<?php }?>

<!-- Theme style -->
<link rel="stylesheet" href="/library/AdminLTE_3/dist/css/adminlte.min.css">
<!-- Google Font: Source Sans Pro -->
<!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
<!-- Principal (Estilos personalizados) -->
<link rel="stylesheet" href="/<?php echo DIR_LOCAL; ?>/assets/css/Principal.css">
<?php if($controlador_obj->getUsarLibForma()){?>
<!-- Para los formularios -->
<link rel="stylesheet" href="/<?php echo DIR_LOCAL; ?>/assets/css/Forma.css">
<?php }?>