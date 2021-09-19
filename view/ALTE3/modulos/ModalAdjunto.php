<?php if($controlador_obj->getUsarLibFileInput()){?>
<div class="modal fade" id="mdl_adjuntar">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Adjuntar archivo</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="frm_adjunto" role="form" method="post" action="" enctype="multipart/form-data">
				<div class="modal-body">
					<input type="hidden" name="adjunto_tipo" id="adjunto_tipo" value="pruebas">
					<div class="form-group">
						<label for="exampleInputFile">Seleccionar archivo</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="archivo_subir"  name="archivo_subir">
								<label class="custom-file-label" for="archivo_subir">Seleccionar archivo</label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary" id="btn_adjuntar">Adjuntar</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<?php }?>