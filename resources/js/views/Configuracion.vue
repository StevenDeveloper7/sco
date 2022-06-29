<template>


    <div>

        <div class="content-wrapper">

            <div class="row">

                <div class=" col-md-12 ">
                    <div class="media align-items-center bg-white mb-20">
                    <span class="avatar  bg-primary"><i class="fa fa-table"></i></span>
                    <div class="media-body">
                        <h3><strong>Configuración</strong></h3>
                    </div>
                    </div>
                </div>

            </div>

        <section class="content">

            <div class="row">

                <div class="col-md-6">
                <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Información Personal</h3>
              </div>
              <div class="card-body">

                 <div class="box card-inverse bg-img" style="background-image: url(images/fondo-clientes.jpg); padding-top: 150px">

              <div class="flexbox align-items-center px-20" data-overlay="4">
                <div class="flexbox align-items-center mr-auto">
                  <a href="#" >
                    <img class="avatar avatar-xl avatar-bordered"  alt="foto">
                  </a>
                  <div class="pl-10 d-none d-md-block">

                  </div>
                </div>

                <ul class="flexbox flex-justified text-center py-20">

                  <li class="pl-10">
                    <label for="file-upload" class="subir">
                    <i class="fa fa-camera" style="width:50px;"></i>
                    </label>
                    <input id="file-upload" type="file" name="foto" class="form-control-file" style='display: none;'>
                  </li>
                </ul>

              </div>
            </div>

                 <div class="form-group row">
        			<div class="col-md-4">

                        <label for="tipo_documento">Tipo Documento</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-id-card"></i></span>
						  </div>
						   <select class="custom-select" >
                            <option value="0" disabled>Seleccione</option>
                            <option ></option>
                            </select>
						</div>
						<!-- /.input group -->

					</div>
					<div class="col-md-4">
                      <label for="documento">Número Documento</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-id-card"></i></span>
						  </div>
						   <input id="documento" type="number" class="form-control" >
						</div>
						<!-- /.input group -->
				  	</div>
                     <div class="col-md-4">
					  <label for="nombre">Nombre Completo</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <input id="nombre" type="text" class="form-control" >

						</div>
						<!-- /.input group -->
				  	</div>
				</div>

          <div class="form-group row">

            <div class="col-md-4">
					 <label for="telefono">Teléfono</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-phone"></i></span>
						  </div>
						   <input id="telefono" type="number" class="form-control" >
						</div>
						<!-- /.input group -->
				  	</div>

            <div class="col-md-4">
					  <label for="direccion">Dirección</label>
						<div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-map-marker"></i></span>
						  </div>
						   <input id="direccion" type="text" class="form-control" >
						</div>
						<!-- /.input group -->
				  	</div>

            <div class="col-md-4">
					   <label for="email">Email</label>
						  <div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-at"></i></span>
						  </div>
						   <input id="email" type="text" class="form-control" >
						</div>
						<!-- /.input group -->
				  	</div>
            </div>

        <div class="form-group row">
        		<div class="col-md-4">
              <label for="tipo_documento">Role</label>
						  <div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						  </div>
						   <select class="custom-select" >
                  <option value="0" disabled>Seleccione</option>
                  <option></option>
              </select>
						</div>
						<!-- /.input group -->
			    	</div>
             <div class="col-md-4">
					   <label for="password">Password</label>
						  <div class="input-group">
						  <div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-key"></i></span>
						  </div>
						   <input id="password" type="password" class="form-control" >
						</div>
						<!-- /.input group -->
				  	</div>

            </div>

              </div>
              <div class="card-footer clearfix">

                    <button type="submit" class="btn btn-bold btn-pure btn-success float-right btn-rounded" style="margin-top:10px; margin-right:10px; margin-bottom:10px;">Guardar</button>
                </div>
              <!-- /.card-body -->
            </div>
            </div>

            <div class="col-md-6">

               <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Información sobre Comisiones</h3>
                    </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="comision_lente">Comisión Lente</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-percent"></i></span>
                                        </div>
                                        <input id="comision_lente" type="number" class="form-control" >
                                        </div>
                                        <!-- /.input group -->
                                </div>

                                 <div class="col-md-4">
                                    <label for="comision_montura">Comisión Montura</label>
                                        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-money"></i></span>
                                        </div>
                                        <input id="comision_montura" type="number" class="form-control" >
                                        </div>
                                        <!-- /.input group -->
                                </div>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <button type="submit" class="btn btn-bold btn-pure btn-success float-right btn-rounded" style="margin-top:10px; margin-right:10px; margin-bottom:10px;" >Guardar</button>
                        </div>

                    </div>

            </div>


            </div>

        </section>

        </div>
    </div>



</template>

<script>



</script>
