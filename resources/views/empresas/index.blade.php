@extends('layouts.principal')
@section('css_principal')
	<link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-sweetalert-master/dist/sweetalert.css') }}">
@endsection
@section('title')
	Listado de Empresas
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
								<h3>{{ __('Empresas') }}</h3>
							</div>
							<div class="col-md-2 offset-md-4">
	                            @can('empresas-crear')
	                            	<button type="button" class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#empresaModal" title="Crear nueva Empresa"><i class="fas fa-plus"></i> Agregar</button>
	                            @endcan
	                        </div>
							<div class="col-md-2">
								<a href="{{ route('home') }}" class="btn btn-sm btn-block rojo"><i class="fas fa-sign-out-alt"></i> Salir</a>
							</div>
	                    </div>
	                </div>

	                <div class="card-body">
	                    <div class="row text-center">
							<div class="col-md-5 offset-md-4">
								<table id="tblEmpresas" class="table table-sm table-bordered table-striped table-hover">
									<thead style="bg-navy">
										<tr>
											<th>Razón Social</th>
											<th>Nombre</th>
											<th>Estado</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										@foreach($listado as $l)
										<tr>
											<td>{{ $l->razon_social }}</td>
											<td>{{ $l->nombre_comercial }}</td>
											<td>@if($l->estado == 1)
											       Alta
											    @else
											       Baja
											    @endif
											</td>
											@php $Id = Crypt::encrypt($l->id); @endphp
											<td>
												@can('empresas-editar')
													<a href="#" onclick="fnEditar('{{$Id}}');" class="btn btn-sm btn-warning" title="Editar Empresa"><i class="fa fa-edit"></i> Editar</a>
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
	<div class="modal fade" id="empresaModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="empresaModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<form role="form" method="POST" action="{{ route('grabar_empresa') }}">
	      			@csrf
	        		<div class="card card-navy">
	        			<div class="card-header">
	        				<div class="row">
	        					<div class="col-md-4">
	        						Nueva Empresa
	        					</div>
	        					<div class="col-md-2 offset-md-4">
	        						<button type="submit" class="btn btn-sm btn-block verde" title="Grabar"><i class="fas fa-save"></i> Guardar</button>
	        					</div>
	        					<div class="col-md-2">
	        						<button type="button" class="btn btn-sm btn-block rojo" title="Regresar a lista de Empresas" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
	        					</div>
	        				</div>
	        			</div>
	        			<div class="card-body">
	        				<br>
	        				<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-3">
										<div class="input-group-prepend">
										<label class="input-group-text" for="razon_social">Razón Social&nbsp;</label>
										</div>
										<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="razon_social" name="razon_social" value="{{ old('razon_social') }}" autofocus required>
								</div>
							</div>
							<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-3">
										<div class="input-group-prepend">
										<label class="input-group-text" for="nombre_comercial">Nombre Comercial&nbsp;</label>
										</div>
										<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="nombre_comercial" name="nombre_comercial" value="{{ old('nombre_comercial') }}" autofocus required>
								</div>
							</div>
							<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-3">
										<div class="input-group-prepend">
										<label class="input-group-text" for="direccion">Dirección&nbsp;</label>
										</div>
										<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="direccion" name="direccion" value="{{ old('direccion') }}" autofocus required>
								</div>
							</div>
							<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-3">
										<div class="input-group-prepend">
										<label class="input-group-text" for="telefonos">Teléfonos&nbsp;</label>
										</div>
										<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="telefonos" name="telefonos" value="{{ old('telefonos') }}" autofocus required>
								</div>
							</div>

			        		<div class="row">
	                            <div class="input-group col-md-1 offset-md-1 mb-3">
	                                <div class="icheck-primary">
	                                    <input type="checkbox" class="form-control" id="estado" name="estado" value="1"/>
	                                    <label for="estado">Activar</label>
	                                </div>
	                            </div>
	                            <div class="col-md-2 offset-md-8">
	                            	<a href="#" class="btn btn-sm btn-block btn-primary" title="Agregar Servicio"  onclick="fnLineaServicios();">
	                            		<i class="fas fa-plus">&nbsp; Agreggar</i>
	                            	</a>
	                            </div>
	                        </div>
	                        <hr>
	                        <div class="row">
	                        	<div class="col-md-10 offset-md-1">
	                        		<table class="table table-sm table-striped table-hover" id="tblServicios">
	                        			<thead>
	                        				<tr>
	                        					<th>Servicio</th>
	                        					<th>Valor</th>
	                        					<th>Día</th>
	                        				</tr>
	                        			</thead>
	                        			<tbody></tbody>
	                        		</table>
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
	<div class="modal fade" id="editempresaModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="editempresaModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<form role="form" method="POST" action="{{ route('actualizar_empresa') }}">
	      			@csrf
	        		<div class="card card-navy">
	        			<div class="card-header">
	        				<div class="row">
	        					<div class="col-md-4">
	        						Edición de Empresa
	        					</div>
	        					<div class="col-md-2 offset-md-4">
	        						<button type="submit" class="btn btn-sm btn-block verde" title="Grabar"><i class="fas fa-save"></i> Guardar</button>
	        					</div>
	        					<div class="col-md-2">
	        						<button type="button" class="btn btn-sm btn-block rojo" title="Regresar a lista de Empresas" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
	        					</div>
	        				</div>
	        			</div>
	        			<div class="card-body">
	        				<br>
	        				<input type="hidden" id="eid" name="eid">
	        				<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-3">
										<div class="input-group-prepend">
										<label class="input-group-text" for="erazon_social">Razón Social&nbsp;</label>
										</div>
										<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="erazon_social" name="erazon_social" autofocus required>
								</div>
							</div>
							<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-3">
										<div class="input-group-prepend">
										<label class="input-group-text" for="enombre_comercial">Nombre Comercial&nbsp;</label>
										</div>
										<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="enombre_comercial" name="enombre_comercial" required>
								</div>
							</div>
							<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-3">
										<div class="input-group-prepend">
										<label class="input-group-text" for="edireccion">Dirección&nbsp;</label>
										</div>
										<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="edireccion" name="edireccion">
								</div>
							</div>
							<div class="row">
								<div class="input-group col-md-10 offset-md-1 mb-3">
										<div class="input-group-prepend">
										<label class="input-group-text" for="etelefonos">Teléfonos&nbsp;</label>
										</div>
										<input type="text" class="form-control " aria-label="Username" aria-describedby="basic-addon1" id="etelefonos" name="etelefonos">
								</div>
							</div>
			        		<div class="row">
	                            <div class="input-group col-md-1 offset-md-1 mb-3">
	                                <div class="icheck-primary">
	                                    <input type="checkbox" class="form-control" id="eestado" name="eestado" value="1"/>
	                                    <label for="eestado">Activar</label>
	                                </div>
	                            </div>
	                        	<div class="col-md-2 offset-md-8">
	                            	<a href="#" class="btn btn-sm btn-block btn-primary" title="Agregar Servicio"  onclick="fnLineaServicios();">
	                            		<i class="fas fa-plus">&nbsp; Agreggar</i>
	                            	</a>
	                            </div>
	                        </div>
	                        <br>
	                        <div class="row">
	                        	<div class="col-md-10 offset-md-1">
	                        		<table class="table table-sm table-striped table-hover" id="tblServicios">
	                        			<thead>
	                        				<tr class="text-center">
	                        					<th>Servicio</th>
	                        					<th>Valor</th>
	                        					<th>Día</th>
	                        				</tr>
	                        			</thead>
	                        			<tbody></tbody>
	                        		</table>
	                        	</div>
	                        </div>
	        			</div>
	        		</div>
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

		$('#empresaModal').on('shown.bs.modal', function() {
		  $('#razon_social').focus();
		});

		$(function () {
	        $('#tblEmpresas').DataTable({
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

    	function fnEditar(id){
    		$.ajax({
                url: "{{ route('editar_empresa') }}",
                type: "POST",
                dataType: 'json',
                data: {"_token": "{{ csrf_token() }}",
                       id : id},
                success: function(response){
                	console.log(response[1]);
                	$('#eid').val(id);
                	$('#erazon_social').val(response[0]['razon_social']);
                	$('#enombre_comercial').val(response[0]['nombre_comercial']);
                	$('#edireccion').val(response[0]['direccion']);
                	$('#etelefonos').val(response[0]['telefonos']);
                	if (response[0]['estado'] == 1) {
                		$('#eestado').prop('checked', true);
                	}

                	$('#editempresaModal').modal('show');

                	var html = '';
                	for (var i = 0; i < response[1].length; i++) {
                		html += '<tr>';
	                	html += '<td>'
						html += '<select class="custom-select" id="servicios['+j+'][servicio]" name="servicios['+j+'][servicio]" value="'+response[1][j]['servicio_id']+'">'
						html += '<option value="" selected>Seleccionar...</option>'
						if (response[1][j]['servicio_id'] == 1) {
							html += '<option value="1" selected>Recolección de Basura</option>'
						}else{
							html += '<option value="1">Recolección de Basura</option>'
						}

						if (response[1][j]['servicio_id'] == 2) {
							html += '<option value="2" selected>Seguridad y Mantenimiento</option>'
						}else{
							html += '<option value="2">Seguridad y Mantenimiento</option>'
						}

						if (response[1][j]['servicio_id'] == 3) {
							html += '<option value="3" selected>Transportación de Agua</option>'
						}else{
							html += '<option value="3">Transportación de Agua</option>'
						}
						
						html += '</select>'
						html += '</td>'
						html += '<td>'
						html += '<input type="number" min="1" max="999" step="any" class="form-control" placeholder="0.00" aria-label="Username" aria-describedby="basic-addon1" id="servicios['+j+'][valor]" name="servicios['+j+'][valor]" value="'+response[1][j]['valor']+'" required>'
						html += '</td>'
						html += '<td>'
						html += '<input type="number" min="1" max="31" step="1" class="form-control" placeholder="DD" aria-label="Username" aria-describedby="basic-addon1" id="servicios['+j+'][dia]" name="servicios['+j+'][dia]" value="'+response[1][j]['dia']+'" required>'
						html += '</td>'
						html += '<td>'
						html += '<a href="#" class="btn btn-sm btn-block btn-danger borrar"><i class="fas fa-sign-out-alt">&nbsp;Eliminar</i></a>'
						html += '</td>'
	                	html += '</tr>';
	                	j += 1;
                	}
                	$('#tblServicios tbody').append(html);
                },
                error: function(error){
                    console.log(error);
                }
            });
    	}

    	function fnLineaServicios(){
    		var html = '';
    		j += 1;

    		html += '<tr>'
    		html += '<td>'
			html += '<select class="custom-select" id="servicios['+j+'][servicio]" name="servicios['+j+'][servicio]">'
			html += '<option value="" selected>Seleccionar...</option>'
			html += '<option value="1">Recolección de Basura</option>'
			html += '<option value="2">Seguridad y Mantenimiento</option>'
			html += '<option value="3">Transportación de Agua</option>'
			html += '</select>'
			html += '</td>'
			html += '<td>'
			html += '<input type="number" min="1" max="999" step="any" class="form-control" placeholder="0.00" aria-label="Username" aria-describedby="basic-addon1" id="servicios['+j+'][valor]" name="servicios['+j+'][valor]" required>'
			html += '</td>'
			html += '<td>'
			html += '<input type="number" min="1" max="31" step="1" class="form-control" placeholder="DD" aria-label="Username" aria-describedby="basic-addon1" id="servicios['+j+'][dia]" name="servicios['+j+'][dia]" required>'
			html += '</td>'
			html += '<td>'
			html += '<a href="#" class="btn btn-sm btn-block btn-danger borrar"><i class="fas fa-sign-out-alt">&nbsp;Eliminar</i></a>'
			html += '</td>'
			html += '</tr>'

			$('#tblServicios tbody').append(html);
    	}

    	$(document).on('click', '.borrar', function(event) {
	  		event.preventDefault();
		  	$(this).closest('tr').remove();
		});
	</script>
@endsection