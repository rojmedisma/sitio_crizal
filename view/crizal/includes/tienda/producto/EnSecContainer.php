<!-- Container para acción producto -->
				<div class="container">
                    <!-- Start Product Section -->
                    <div class="row margin-90px-bottom md-margin-70px-bottom sm-margin-50px-bottom">
                        <div class="col-lg-5 sm-text-center sm-margin-30px-bottom">
                            <!-- product left start -->
                            <div class="xzoom-container">
                                <img class="xzoom5 margin-30px-bottom" id="xzoom-magnific" src="<?php echo $controlador_obj->getDatoVistaValor('adj_1er_adj_ref'); ?>" xoriginal="<?php echo $controlador_obj->getDatoVistaValor('adj_1er_adj_ref'); ?>" alt="" />
                                <div class="xzoom-thumbs no-margin">
									<?php foreach($controlador_obj->getDatoVistaValor('arr_tbl_adj') as $adjunto_id => $arr_det):?>
									<a href="<?php echo $arr_det['ruta_archivo'].$arr_det['nom_arc_sist']; ?>"><img class="xzoom-gallery5" width="80" src="<?php echo $arr_det['ruta_archivo'].$arr_det['nom_arc_sist']; ?>" xpreview="<?php echo $arr_det['ruta_archivo'].$arr_det['nom_arc_sist']; ?>" alt="" title="The description goes here"></a>
									<?php endforeach;?>
                                </div>
                            </div>
                            <!-- product left end -->
                        </div>
                        <div class="col-lg-7 padding-40px-left sm-padding-15px-lr">
                            <div class="product-detail">
                                <?php include_once 'EnProdDetail.php';?>
                            </div>
                        </div>
                    </div>
                    <!-- End Product Section -->
                    <!-- Start Product Description -->
                    <div class="row margin-70px-bottom md-margin-70px-bottom sm-margin-50px-bottom">
                        <?php include_once 'EnProdDesc.php';?>
                    </div>
                    <!-- End Product Description -->
                    <!-- Start Related Product -->
                    <?php //include_once 'RelatedProducts.php';?>
                    <!-- End Related Product -->
                </div>

