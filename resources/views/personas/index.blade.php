@extends('layouts.principal')
@section('css_principal')
	<link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-sweetalert-master/dist/sweetalert.css') }}">
@endsection
@section('title')
	Listado de Personas
@endsection
@section('content')
	@if (session('success'))
	    <div class="col-sm-12">
	        <div class="alert alert-success alert-dismissible fade show" role="alert">
	            {{ session('success') }}
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	            	<span aria-hidden="true">&times;</span>
                </button>
	        </div>
	    </div>
	@endif
	<br>
	<div class="content-fluid">
		<div class="row justify-content-center">
			<div class="col-md-12">
        		<div class="card">
            		<div class="card-header">
                			<div class="row">
                    			<div class="col-md-4">
						<h3>{{ __('Personas') }}</h3>
					</div>
					<div class="col-md-2 offset-md-4">
                        @can('personas-crear')
                        	<button type="button" class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#personaModal" title="Crear nuevo Regisdtro"><i class="fas fa-plus"></i> Agregar</button>
                        @endcan
    				</div>
					<div class="col-md-2">
						<a href="{{ route('home') }}" class="btn btn-sm btn-block rojo"><i class="fas fa-sign-out-alt"></i> Salir</a>
					</div>
            		<div class="card-body">
            			<div class="row text-center">
							<div class="col-md-5 offset-md-4">
								<table id="tblPersonas" class="table table-sm table-bordered table-striped table-hover">
									<thead style="bg-navy">
										<tr>
											<th>Nombre</th>
											<th>CUI</th>
											<th>Estado</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										@foreach($listado as $l)
										<tr>
											<td>{{ $l->nombre }}</td>
											<td>{{ $l->cui }}</td>
											<td>@if($l->estado == 1)
											       Alta
											    @else
											       Baja
											    @endif
											</td>
											@php $Id = Crypt::encrypt($l->id); @endphp
											<td>
												@can('persona-editar')
													<a href="#" onclick="fnEditar('{{$Id}}');" class="btn btn-sm btn-warning" title="Editar Vivienda"><i class="fa fa-edit"></i> Editar</a>
												@endcan
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
        			</div>
    			</div>
    		</div>
		</div>
	</div>
	<!-- Agregar modal -->
	<div class="modal fade" id="personaModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="personaModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    		<div class="modal-content">
	      		<form role="form" method="POST" action="{{ route('grabar_persona') }}">
	      			@csrf
	        		<div class="card card-navy">
	        			<div class="card-header">
	        				<div class="row">
	        					<div class="col-md-4">
	        						Nuevo Registro
	        					</div>
	        					<div class="col-md-2 offset-md-4">
	        						<button type="submit" class="btn btn-sm btn-block verde" title="Grabar"><i class="fas fa-save"></i> Guardar</button>
	        					</div>
	        					<div class="col-md-2">
	        						<button type="button" class="btn btn-sm btn-block rojo" title="Regresar a lista de Personas" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
	        					</div>
	        				</div>
	        			</div>
	        			<div class="card-body">
	        				<div class="row">
	        					<div class="input-group col-md-5 offset-md-1 mb-1">
									<div class="input-group-prepend">
										<label class="input-group-text" for="primer_nombre">Primer Nombre&nbsp;</label>
									</div>
									<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="primer_nombre" name="primer_nombre" required autofocus>
								</div>
								<div class="input-group col-md-5 mb-1">
									<div class="input-group-prepend">
										<label class="input-group-text" for="segundo_nombre">Segundo Nombre&nbsp;</label>
									</div>
									<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="segundo_nombre" name="segundo_nombre">
								</div>
	        				</div>
	        				<div class="row">
	        					<div class="input-group col-md-5 offset-md-1 mb-1">
									<div class="input-group-prepend">
										<label class="input-group-text" for="apellido_paterno">Apellido Paterno&nbsp;</label>
									</div>
									<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="apellido_paterno" name="apellido_paterno" required>
								</div>
								<div class="input-group col-md-5 mb-1">
									<div class="input-group-prepend">
										<label class="input-group-text" for="apellido_materno">Apellido Materno&nbsp;</label>
									</div>
									<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="apellido_materno" name="apellido_materno">
								</div>
	        				</div>
	        				<div class="row">
	        					<div class="input-group col-md-5 offset-md-1 mb-1">
									<div class="input-group-prepend">
										<label class="input-group-text" for="apellido_casada">Apellido de Casada&nbsp;</label>
									</div>
									<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="apellido_casada" name="apellido_casada">
								</div>
								<div class="form-group form-control-sm clearfix mb-1">
                                    <label>Genero&nbsp;&nbsp;&nbsp;</label>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="masculino" name="genero" value="M" checked>
                                        <label for="masculino">&nbsp;&nbsp;&nbsp;Masculino&nbsp;&nbsp;&nbsp;</label>
                                    </div> &nbsp;
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="femenino" name="genero" value="F">
                                        <label for="femenino">&nbsp;&nbsp;&nbsp;Femenino&nbsp;&nbsp;&nbsp;</label>
                                    </div>
                                </div>
	        				</div>
	        				<div class="row">
	        					<div class="input-group col-md-5 offset-md-1 mb-1">
									<div class="input-group-prepend mb-1">
										<label class="input-group-text" for="cui">CUI&nbsp;</label>
									</div>
									<input type="number" min="1" max="9999999999999" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="cui" name="cui" required>
								</div>
								<div class="input-group col-md-5 mb-1">
									<div class="input-group-prepend mb-1">
										<label class="input-group-text" for="fecha_nacimiento">Fecha Nacimiento&nbsp;</label>
									</div>
									<input type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="fecha_nacimiento" name="fecha_nacimiento" required>
								</div>
	        				</div>
	        				<div class="row">
	                            <div class="input-group col-md-1 offset-md-1 mb-3">
	                                <div class="icheck-primary">
	                                    <input type="checkbox" class="form-control" id="estado" name="estado" value="1"/>
	                                    <label for="estado">Activar</label>
	                                </div>
	                            </div>
                        	</div>
                        	<div class="row">
                        		<div class="col-md-10 offset-md-1 mb-1">
									<ul class="nav nav-pills nav-fill ml-auto p-2 mb-1">
				        				<li class="nav-item">
				                        	<a class="nav-link active" href="#telefonos" data-toggle="tab">Teléfono</a>
				                    	</li>
				                    	<li class="nav-item">
				                        	<a class="nav-link" href="#correos" data-toggle="tab">Email</a>
				                    	</li>
				                    	<li class="nav-item">
				                        	<a class="nav-link" href="#viviendas" data-toggle="tab">Vivienda</a>
				                    	</li>
				        			</ul>
				        			<div class="tab-content">
				        				<div class="tab-pane active" id="telefonos">
				        					<div class="row">
				        						<div class="col-md-10 offset-md-1">
				        							<table class="table table-sm table-striped table-hover" id="tbltelefonos">
				        								<thead>
				        									<tr>
				        										<th>Ubicación</th>
				        										<th>Número</th>
				        										<th>Estado</th>
				        										<th></th>
				        									</tr>
				        								</thead>
				        								<tbody>
				        									
				        								</tbody>
				        							</table>
				        						</div>
				        					</div>
				        				</div>
				        				<div class="tab-pane" id="correos">
				        					<div class="row">
				        						<div class="col-md-10 offset-md-1">
				        							<table class="table table-sm table-striped table-hover" id="tblcorreos">
				        								<thead>
				        									<tr>
				        										<th>Correo</th>
				        										<th>Estado</th>
				        										<th></th>
				        									</tr>
				        								</thead>
				        								<tbody></tbody>
				        							</table>
				        						</div>
				        					</div>
				        				</div>
				        				<div class="tab-pane" id="viviendas">
				        					<div class="row">
				        						<div class="col-md-10 offset-md-1">
				        							<table class="table table-sm table-striped table-hover" id="tblviviendas">
				        								<thead>
				        									<tr>
				        										<th>Tipo</th>
				        										<th>Vivienda</th>
				        										<th>Estado</th>
				        										<th></th>
				        									</tr>
				        								</thead>
				        								<tbody></tbody>
				        							</table>
				        						</div>
				        					</div>
				        				</div>
				        			</div>
								</div>
								<div class="col-md-1" style="align-content: inherit;">
        							<a href="#" class="btn btn-sm btn-primary rounded-circle text-center" onclick="AgregarRegistro();">
        								<i class="fas fa-plus"></i>
        							</a>
        						</div>
                        	</div>
	        			</div>
	        		</div>
	      		</form>
	    	</div>
	  	</div>
	</div>
	<!-- /Agregar modal -->
	<!-- Editar modal -->
	<div class="modal fade" id="personaEditModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="personaEditModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    		<div class="modal-content">
	      		<form role="form" method="POST" action="{{ route('actualizar_persona') }}">
	      			@csrf
	      			<div class="card card-navy">
	        			<div class="card-header">
	        				<div class="row">
	        					<div class="col-md-4">
	        						Edición de Registro
	        					</div>
	        					<div class="col-md-2 offset-md-4">
	        						<button type="submit" class="btn btn-sm btn-block verde" title="Grabar"><i class="fas fa-save"></i> Guardar</button>
	        					</div>
	        					<div class="col-md-2">
	        						<button type="button" class="btn btn-sm btn-block rojo" title="Regresar a lista de Personas" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
	        					</div>
	        				</div>
	        			</div>
	        			<div class="card-body">
	        				<div class="row">
	        					<div class="input-group col-md-5 offset-md-1 mb-1">
									<div class="input-group-prepend">
										<label class="input-group-text" for="eprimer_nombre">Primer Nombre&nbsp;</label>
									</div>
									<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="eprimer_nombre" name="eprimer_nombre" required autofocus>
								</div>
								<div class="input-group col-md-5 mb-1">
									<div class="input-group-prepend">
										<label class="input-group-text" for="esegundo_nombre">Segundo Nombre&nbsp;</label>
									</div>
									<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="esegundo_nombre" name="esegundo_nombre">
								</div>
	        				</div>
	        				<div class="row">
	        					<div class="input-group col-md-5 offset-md-1 mb-1">
									<div class="input-group-prepend">
										<label class="input-group-text" for="eapellido_paterno">Apellido Paterno&nbsp;</label>
									</div>
									<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="eapellido_paterno" name="eapellido_paterno" required>
								</div>
								<div class="input-group col-md-5 mb-1">
									<div class="input-group-prepend">
										<label class="input-group-text" for="eapellido_materno">Apellido Materno&nbsp;</label>
									</div>
									<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="eapellido_materno" name="eapellido_materno">
								</div>
	        				</div>
	        				<div class="row">
	        					<div class="input-group col-md-5 offset-md-1 mb-1">
									<div class="input-group-prepend">
										<label class="input-group-text" for="eapellido_casada">Apellido de Casada&nbsp;</label>
									</div>
									<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="eapellido_casada" name="eapellido_casada">
								</div>
								<div class="form-group form-control-sm clearfix mb-1">
                                    <label>Genero&nbsp;&nbsp;&nbsp;</label>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="emasculino" name="egenero" value="M" checked>
                                        <label for="masculino">&nbsp;&nbsp;&nbsp;Masculino&nbsp;&nbsp;&nbsp;</label>
                                    </div> &nbsp;
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="efemenino" name="egenero" value="F">
                                        <label for="femenino">&nbsp;&nbsp;&nbsp;Femenino&nbsp;&nbsp;&nbsp;</label>
                                    </div>
                                </div>
	        				</div>
	        				<div class="row">
	        					<div class="input-group col-md-5 offset-md-1 mb-1">
									<div class="input-group-prepend mb-1">
										<label class="input-group-text" for="ecui">CUI&nbsp;</label>
									</div>
									<input type="number" min="1" max="9999999999999" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="ecui" name="ecui" required>
								</div>
								<div class="input-group col-md-5 mb-1">
									<div class="input-group-prepend mb-1">
										<label class="input-group-text" for="efecha_nacimiento">Fecha Nacimiento&nbsp;</label>
									</div>
									<input type="date" class="form-control" aria-label="Username" aria-describedby="basic-addon1" id="efecha_nacimiento" name="efecha_nacimiento" required>
								</div>
	        				</div>
	        				<div class="row">
	                            <div class="input-group col-md-1 offset-md-1 mb-3">
	                                <div class="icheck-primary">
	                                    <input type="checkbox" class="form-control" id="eestado" name="eestado" value="1"/>
	                                    <label for="eestado">Activar</label>
	                                </div>
	                            </div>
                        	</div>
                        	<div class="row">
                        		<div class="col-md-10 offset-md-1 mb-1">
									<ul class="nav nav-pills nav-fill ml-auto p-2 mb-1">
				        				<li class="nav-item">
				                        	<a class="nav-link active" href="#etelefonos" data-toggle="tab">Teléfono</a>
				                    	</li>
				                    	<li class="nav-item">
				                        	<a class="nav-link" href="#ecorreos" data-toggle="tab">Email</a>
				                    	</li>
				                    	<li class="nav-item">
				                        	<a class="nav-link" href="#eviviendas" data-toggle="tab">Vivienda</a>
				                    	</li>
				        			</ul>
				        			<div class="tab-content">
				        				<div class="tab-pane active" id="etelefonos">
				        					<div class="row">
				        						<div class="col-md-10 offset-md-1">
				        							<table class="table table-sm table-striped table-hover" id="etbltelefonos">
				        								<thead>
				        									<tr>
				        										<th>Ubicación</th>
				        										<th>Número</th>
				        										<th>Estado</th>
				        										<th></th>
				        									</tr>
				        								</thead>
				        								<tbody>
				        									
				        								</tbody>
				        							</table>
				        						</div>
				        					</div>
				        				</div>
				        				<div class="tab-pane" id="ecorreos">
				        					<div class="row">
				        						<div class="col-md-10 offset-md-1">
				        							<table class="table table-sm table-striped table-hover" id="etblcorreos">
				        								<thead>
				        									<tr>
				        										<th>Correo</th>
				        										<th>Estado</th>
				        										<th></th>
				        									</tr>
				        								</thead>
				        								<tbody></tbody>
				        							</table>
				        						</div>
				        					</div>
				        				</div>
				        				<div class="tab-pane" id="eviviendas">
				        					<div class="row">
				        						<div class="col-md-10 offset-md-1">
				        							<table class="table table-sm table-striped table-hover" id="etblviviendas">
				        								<thead>
				        									<tr>
				        										<th>Tipo</th>
				        										<th>Vivienda</th>
				        										<th>Estado</th>
				        										<th></th>
				        									</tr>
				        								</thead>
				        								<tbody></tbody>
				        							</table>
				        						</div>
				        					</div>
				        				</div>
				        			</div>
								</div>
								<div class="col-md-1" style="align-content: inherit;">
        							<a href="#" class="btn btn-sm btn-primary rounded-circle text-center" onclick="AgregareRegistro();">
        								<i class="fas fa-plus"></i>
        							</a>
        						</div>
                        	</div>
	        			</div>
	        		</div>
	      			<input type="hidden" id="eid" name="eid">

	      		</form>
	      	</div>
      	</div>
	</div>
	<!-- /Editar modal -->
@endsection
@section('js_principal')
	<script src="{{ asset('assets/bootstrap-sweetalert-master/dist/sweetalert.js')}}"></script>
	@if(Session::get('type') == 'success')
		@if(Session::has('message'))
	        <script>
	            setTimeout(function() {
			        swal({
			            title: "Trabajo Finalizado",
			            text: "{!! Session::get('message') !!}",
			            type: "success"
			        }/*, function() {
			            window.location = "{{ route('servicios') }}";
			        }*/
			        );
			    }, 1000);
	        </script>
	    @endif
    @endif
    @if(Session::get('type') == 'error')
	    @if(Session::has('message'))
	        <script>
	            swal("Error !!!", "{!! Session::get('message') !!}", "error")
	        </script>
	    @endif
    @endif
	<script type="text/javascript">
		var j = 0;
		var nLineaTelefono = 0;
		var nLineaCorreo   = 0;
		var nLineaVivienda = 0;

		$('#personaModal').on('shown.bs.modal', function() {
		  $('#primer_nombre').focus();
		});

		$(function () {
	        $('#tblPersonas').DataTable({
	          "paging": true,
	          "lengthChange": false,
	          "searching": true,
	          "ordering": true,
	          "info": true,
	          "autoWidth": true,
	          language: {
	                "sProcessing":     "Procesando...",
	                "sLengthMenu":     "Mostrar _MENU_ registros",
	                "sZeroRecords":    "No se encontraron resultados",
	                "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
	                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
	                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
	                "sInfoPostFix":    "",
	                "sSearch":         "Buscar:",
	                "sUrl":            "",
	                "sInfoThousands":  ",",
	                "sLoadingRecords": "Cargando...",
	                "oPaginate": {
	                                "sFirst":    "Primero",
	                                "sLast":     "Último",
	                                "sNext":     "Siguiente",
	                                "sPrevious": "Anterior"
	                            }
	            },
	            dom: 'Bfrtip',
	        });
		});

		function AgregarRegistro(){
			var navLinks = document.querySelectorAll('.nav-link');
			navLinks.forEach(function(navLink) {
			    // Verificar si el elemento tiene la clase "active"
			    if (navLink.classList.contains('active')) {
			        var href = navLink.getAttribute('href');
			        if (href == '#telefonos') {
			        	AgregarLineaTelefono();
			        }
			        if (href == '#correos') {
			        	AgregarLineaEmail();
			        }
			        if (href == '#viviendas') {
			        	AgregarLineaViviendas();
			        }
			    }
			});
		}

		function AgregareRegistro(){
			var navLinks = document.querySelectorAll('.nav-link');
			navLinks.forEach(function(navLink) {
			    // Verificar si el elemento tiene la clase "active"
			    if (navLink.classList.contains('active')) {
			        var href = navLink.getAttribute('href');
			        if (href == '#etelefonos') {
			        	AgregareLineaTelefono();
			        }
			        if (href == '#ecorreos') {
			        	AgregarLineaEmail();
			        }
			        if (href == '#eviviendas') {
			        	AgregarLineaViviendas();
			        }
			    }
			});
		}

		function AgregarLineaTelefono(){
			var html = '';
			html += '<tr>'
			html += '<td>'
			html += '<select id="telefonos['+nLineaTelefono+'][tipo_telefono]" name="telefonos['+nLineaTelefono+'][tipo_telefono]" class="form-control" data-required="true">';
			html += '<option value="">Seleccionar...</option>';
			html += '<option value="0">Residencia</option>';
			html += '<option value="1">Oficina</option>';
			html += '<option value="2">Celular</option>';
			html += '</select>'
			html += '</td>'
			html += '<td>'
			html += '<input type="number" class="form-control" id="telefonos['+nLineaTelefono+'][numero]" name="telefonos['+nLineaTelefono+'][numero]">'
			html += '</td>'
			html += '<td>';
            html += '<input type="checkbox" class="form-control check" id="telefonos['+nLineaTelefono+'][estado]" name="telefonos['+nLineaTelefono+'][estado]" value="1"/>';
            html += '</td>';
            html += '<td>';
            html += '<button class="btn btn-sm btn-danger eliminar">Eliminar</button>'
            html += '</td>';	
			html += '</tr>'
			$('#tbltelefonos tbody').append(html);
            $('.eliminar').on('click',eliminar);
		}

		function AgregareLineaTelefono(){
			var html = '';
			html += '<tr>'
			html += '<td>'
			html += '<select id="telefonos['+nLineaTelefono+'][tipo_telefono]" name="telefonos['+nLineaTelefono+'][tipo_telefono]" class="form-control" data-required="true">';
			html += '<option value="">Seleccionar...</option>';
			html += '<option value="0">Residencia</option>';
			html += '<option value="1">Oficina</option>';
			html += '<option value="2">Celular</option>';
			html += '</select>'
			html += '</td>'
			html += '<td>'
			html += '<input type="number" class="form-control" id="telefonos['+nLineaTelefono+'][numero]" name="telefonos['+nLineaTelefono+'][numero]">'
			html += '</td>'
			html += '<td>';
            html += '<input type="checkbox" class="form-control check" id="telefonos['+nLineaTelefono+'][estado]" name="telefonos['+nLineaTelefono+'][estado]" value="1"/>';
            html += '</td>';
            html += '<td>';
            html += '<button class="btn btn-sm btn-danger eliminar">Eliminar</button>'
            html += '</td>';	
			html += '</tr>';

			nLineaTelefono += 1;

			// $('#etbltelefonos tbody tr').remove();
			$('#etbltelefonos tbody').append(html);
            $('.eliminar').on('click',eliminar);
		}

		function AgregarLineaEmail(){
			var html = '';
			html += '<tr>'
			html += '<td>'
			html += '<input type="email" class="form-control" id="correos['+nLineaCorreo+'][email]" name="correos['+nLineaCorreo+'][email]">'
			html += '</td>'
			html += '<td>';
            html += '<input type="checkbox" class="form-control check" id="correos['+nLineaTelefono+'][estado]" name="correos['+nLineaTelefono+'][estado]" value="1"/>';
            html += '</td>';
            html += '<td>';
            html += '<button class="btn btn-sm btn-danger eliminar">Eliminar</button>'
            html += '</td>';	
			html += '</tr>'
			$('#tblcorreos tbody').append(html);
            $('.eliminar').on('click',eliminar);
		}

		function AgregarLineaViviendas(){
			var html = '';
			html += '<tr>'
			html += '<td>'
			html += '<select id="viviendas['+nLineaVivienda+'][tipo]" name="viviendas['+nLineaVivienda+'][tipo]" class="form-control" data-required="true">';
			html += '<option value="">Seleccionar...</option>';
			html += '<option value="0">Propietario</option>';
			html += '<option value="1">Inquilino</option>';
			html += '</select>'
			html += '</td>'
			html += '<td>'
			html += '<select id="viviendas['+nLineaVivienda+'][vivienda_id]" name="viviendas['+nLineaVivienda+'][vivienda_id]" class="form-control" data-required="true">';
			html += '<option value="">Seleccionar...</option>';
			@foreach($viviendas as $vivienda)
                html += '<option value="{{ $vivienda->id }}">{{ $vivienda->direccion }}</option>';
            @endforeach
			html += '</select>'
			html += '</td>'
			html += '<td>';
            html += '<input type="checkbox" class="form-control check" id="viviendas['+nLineaVivienda+'][estado]" name="viviendas['+nLineaVivienda+'][estado]" value="1"/>';
            html += '</td>';
            html += '<td>';
            html += '<button class="btn btn-sm btn-danger eliminar">Eliminar</button>'
            html += '</td>';	
			html += '</tr>'
			$('#tblviviendas tbody').append(html);
            $('.eliminar').on('click',eliminar);
		}

		function eliminar()
        {
            var whichtr = $(this).closest("tr");
            whichtr.remove(); 
            return false;
        }

    	function fnEditar(id){
    		$.ajax({
                url: "{{ route('editar_persona') }}",
                type: "POST",
                dataType: 'json',
                data: {"_token": "{{ csrf_token() }}",
                       id : id},
                success: function(response){
                	$('#tbletelefonos').empty();
                	// console.log(response);
                	nLineaTelefono = 0;
					nLineaCorreo   = 0;
					nLineaVivienda = 0;

                	$('#eid').val(id);
                	$('#eprimer_nombre').val(response['registro']['primer_nombre']);
                	$('#esegundo_nombre').val(response['registro']['segundo_nombre']);
                	$('#eapellido_paterno').val(response['registro']['apellido_paterno']);
                	$('#eapellido_materno').val(response['registro']['apellido_materno']);
                	$('#eapellido_casada').val(response['registro']['apellido_casada']);
                	$('#ecui').val(response['registro']['cui']);
                	$('#efecha_nacimiento').val(response['registro']['fecha_nacimiento']);
                	if (response['registro']['genero'] == 'M') {
                		$('#emasculino').prop('checked', true);
                	}else{
                		$('#efemenino').prop('checked', true);
                	}
                	if (response['registro']['estado'] == 1) {
                		$('#eestado').prop('checked', true);
                	}else{
                		$('#eestado').prop('checked', false);
                	}

                	var html = '';
                	for (var i = 0; i < response['telefonos'].length; i++) {
						html += '<tr>'
						html += '<td>'
						html += '<select id="telefonos['+nLineaTelefono+'][tipo_telefono]" name="telefonos['+nLineaTelefono+'][tipo_telefono]" class="form-control" data-required="true">';
						html += '<option value="">Seleccionar...</option>';
						if (response['telefonos'][i]['tipo_numero'] == 0) {
							html += '<option value="0" selected)>Residencia</option>';
						}else{
							html += '<option value="0")>Residencia</option>';
						}
						if (response['telefonos'][i]['tipo_numero'] == 1) {
							html += '<option value="1" selected>Oficina</option>';
						}else{
							html += '<option value="1">Oficina</option>';
						}
						if (response['telefonos'][i]['tipo_numero'] == 2) {
							html += '<option value="2" selected>Celular</option>';
						}else{
							html += '<option value="2">Celular</option>';
						}
						html += '</select>'
						html += '</td>'
						html += '<td>'
						html += '<input type="number" class="form-control" id="telefonos['+nLineaTelefono+'][numero]" name="telefonos['+nLineaTelefono+'][numero]" value="'+response['telefonos'][i]['numero']+'">'
						html += '</td>'
						html += '<td>';
						if (response['telefonos'][i]['estado'] === 1) {
							html += '<input type="checkbox" class="form-control check" id="telefonos['+nLineaTelefono+'][estado]" name="telefonos['+nLineaTelefono+'][estado]" value="1" checked/>';	
						}else{
							html += '<input type="checkbox" class="form-control check" id="telefonos['+nLineaTelefono+'][estado]" name="telefonos['+nLineaTelefono+'][estado]" value="1"/>';
						}
			            html += '</td>';
			            html += '<td>';
			            html += '<button class="btn btn-sm btn-danger eliminar">Eliminar</button>'
			            html += '</td>';	
						html += '</tr>';

						// $('#telefonos['+nLineaTelefono+'][tipo_telefono]').val(response['telefonos'][i]['tipo_numero']);
						nLineaTelefono += 1;
					}

					$('#etbltelefonos tbody tr').remove();
					$('#etbltelefonos tbody').append(html);
		            $('.eliminar').on('click',eliminar);

                	$('#personaEditModal').modal('show');
                },
                error: function(error){
                    console.log(error);
                }
            });
    	}

	</script>
@endsection