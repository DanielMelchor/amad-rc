@extends('layouts.principal')
@section('css_principal')
	<link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-sweetalert-master/dist/sweetalert.css') }}">
@endsection
@section('title')
	Listado de Viviendas
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
								<h3>{{ __('Viviendas') }}</h3>
							</div>
							<div class="col-md-2 offset-md-4">
				                            @can('viviendas-crear')
				                            	<button type="button" class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#viviendaModal" title="Crear nueva Vivienda"><i class="fas fa-plus"></i> Agregar</button>
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
								<table id="tblViviendas" class="table table-sm table-bordered table-striped table-hover">
									<thead style="bg-navy">
										<tr>
											<th>Residencial</th>
											<th>Dirección</th>
											<th>Estado</th>
											<th>&nbsp;</th>
										</tr>
									</thead>
									<tbody>
										@foreach($listado as $l)
										<tr>
											<td>{{ $l->nombre_comercial }}</td>
											<td>{{ $l->direccion }}</td>
											<td>@if($l->estado == 1)
											       Alta
											    @else
											       Baja
											    @endif
											</td>
											@php $Id = Crypt::encrypt($l->id); @endphp
											<td>
												@can('viviendas-editar')
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
	<div class="modal fade" id="viviendaModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="viviendaModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<form role="form" method="POST" action="{{ route('grabar_vivienda') }}">
	      			@csrf
	        		<div class="card card-navy">
	        			<div class="card-header">
	        				<div class="row">
	        					<div class="col-md-4">
	        						Nueva Vivienda
	        					</div>
	        					<div class="col-md-2 offset-md-4">
	        						<button type="submit" class="btn btn-sm btn-block verde" title="Grabar"><i class="fas fa-save"></i> Guardar</button>
	        					</div>
	        					<div class="col-md-2">
	        						<button type="button" class="btn btn-sm btn-block rojo" title="Regresar a lista de Viviendas" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
	        					</div>
	        				</div>
	        			</div>
	        			<div class="card-body">
	        				<br>
	        				<div class="row">
	        					<div class="input-group col-md-10 offset-md-1 mb-3">
	        						<div class="input-group-prepend">
    									<label class="input-group-text" for="empresa_id">Ubicación</label>
  									</div>
	        						<select class="custom-select" id="empresa_id" name="empresa_id" required>
	        							<option value="" selected>Seleccionar...</option>
	        							@foreach($empresas as $empresa)
	        								<option value="{{ $empresa->id }}">{{$empresa->nombre_comercial }}</option>
	        							@endforeach
	        						</select>
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
			                            <div class="input-group col-md-1 offset-md-1 mb-3">
			                                <div class="icheck-primary">
			                                    <input type="checkbox" class="form-control" id="estado" name="estado" value="1"/>
			                                    <label for="estado">Activar</label>
			                                </div>
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
	<div class="modal fade" id="editviviendaModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="editviviendaModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<form role="form" method="POST" action="{{ route('actualizar_vivienda') }}">
	      			@csrf
	        		<div class="card card-navy">
	        			<div class="card-header">
	        				<div class="row">
	        					<div class="col-md-4">
	        						Edición de Vivienda
	        					</div>
	        					<div class="col-md-2 offset-md-4">
	        						<button type="submit" class="btn btn-sm btn-block verde" title="Grabar"><i class="fas fa-save"></i> Guardar</button>
	        					</div>
	        					<div class="col-md-2">
	        						<button type="button" class="btn btn-sm btn-block rojo" title="Regresar a lista de Viviendas" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i> Cerrar</button>
	        					</div>
	        				</div>
	        			</div>
	        			<div class="card-body">
	        				<br>
	        				<input type="hidden" id="eid" name="eid">
	        				<div class="row">
	        					<div class="input-group col-md-10 offset-md-1 mb-3">
	        						<div class="input-group-prepend">
    									<label class="input-group-text" for="eempresa_id">Ubicación</label>
  									</div>
	        						<select class="custom-select" id="eempresa_id" name="eempresa_id" required>
	        							<option value="" selected>Seleccionar...</option>
	        							@foreach($empresas as $empresa)
	        								<option value="{{ $empresa->id }}">{{$empresa->nombre_comercial }}</option>
	        							@endforeach
	        						</select>
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
							</div>
			        		<div class="row">
	                            <div class="input-group col-md-1 offset-md-1 mb-3">
	                                <div class="icheck-primary">
	                                    <input type="checkbox" class="form-control" id="eestado" name="eestado" value="1"/>
	                                    <label for="eestado">Activar</label>
	                                </div>
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

		$('#viviendaModal').on('shown.bs.modal', function() {
		  $('#direccion').focus();
		});

		$(function () {
		        $('#tblViviendas').DataTable({
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
	                url: "{{ route('editar_vivienda') }}",
	                type: "POST",
	                dataType: 'json',
	                data: {"_token": "{{ csrf_token() }}",
	                       id : id},
	                success: function(response){
	                	console.log(response[1]);
	                	$('#eid').val(id);
	                	$('#eempresa_id').val(response[0]['empresa_id']);
	                	$('#edireccion').val(response[0]['direccion']);
	                	if (response[0]['estado'] == 1) {
	                		$('#eestado').prop('checked', true);
	                	}

	                	$('#editviviendaModal').modal('show');
	                },
	                error: function(error){
	                    console.log(error);
	                }
	            });
	    	}

	</script>
@endsection