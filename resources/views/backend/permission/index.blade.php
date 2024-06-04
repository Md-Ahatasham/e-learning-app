@extends('layouts.master')
@section('content')


<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<!-- Info boxes -->
		<div class="row justify-content-around body_padding_top">
			<div class="col-md-10">
				<div class="row card add_new_button_design mr-0">
					<div class="">
						@can('permission-create')
						<button class="btn btn-info btn-round ml-auto btn-sm add_button_to_right" data-toggle="modal" data-target="#modal-default">
							<em class="fa fa-plus"></em> Add Permission</button>
						@endcan
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<table id="permission" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>#Sl</th>
									<th>Permission Name</th>
									<th class="text-center">Action</th>

								</tr>
							</thead>
							<tbody>
								@if(isset($all_permissions) && !empty($all_permissions))
								@php $i=1 @endphp
								@foreach($all_permissions as $permission)
								<tr>
									<td>{{$i}}</td>
									<td>{{$permission->name}}</td>

									<td class="text-center">
										<div class="row form-button-action">
											<div class="col-6 text-right">
												<!-- @can('permission-edit')
											<button type="button" data-toggle="tooltip" title="" class="btn  btn-info btn-xs " data-original-title="Edit Task">
												<em class="fa fa-edit"></em>
											</button>
											@endcan -->
											</div>
											<div class="col-6 text-left">
												@can('permission-delete')
												<form action="{{ route('permission.destroy',$permission->id) }}" method="post">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-danger btn-xs"><em class='fas fa-trash-alt'></em></button>
												</form>
												@endcan
											</div>
										</div>
									</td>
								</tr>
								@php $i++; @endphp
								@endforeach
								@endif
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
	</div>


	<!---- category add modal ---------------------------------------------------->

	<div class="modal fade" id="modal-default">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header cat_modal_header">
					<h5 class="modal-title">Manage Permission</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{route('permission.store')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}

						<div class="row">

							<div class="col-sm-12">
								<div class="form-group form-group-default">
									<label>Add Permission</label>
									<input name="name" type="text" class="form-control">

									<input name="guard_name" value="web" type="hidden" class="form-control">
								</div>
							</div>

						</div>
				</div>
				<div class="modal-footer justify-content-center">

					<input type="submit" class="btn btn-info btn-sm" value="Save">
				</div>
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /end of category add modal ------------------------------------------------------->

</section>

@endsection