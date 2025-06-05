@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Kadaluarsa</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('products')}}">Produk</a></li>
		<li class="breadcrumb-item active">Kadaluarsa</li>
	</ul>
</div>
@endpush

@section('content')
<div class="row">
	<div class="col-md-12">
	
		<!-- Recent Orders -->
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="datatable-export" class="table table-striped table-bordered table-hover table-center mb-0">
						<thead>
							<tr>
								<th>Nama Obat</th>
								<th>Harga Beli</th>
								<th>Kuantitas</th>
								<th>Status Kadaluarsa</th>
								<th class="action-btn">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($products as $product)
							<tr>
								<td>{{$product->name}}</td>
								<td>{{AppSettings::get('app_currency', '$')}}{{$product->price}}</td>
								<td>{{$product->quantity}}</td>
								<td><span class="btn btn-sm bg-danger-light">PRODUK SUDAH KADALUARSA</span></td>
								<td>
									<div class="actions">
										<a data-id="{{$product->id}}" href="javascript:void(0);" class="btn btn-sm bg-danger-light deletebtn" data-toggle="modal">
											<i class="fe fe-trash"></i> Hapus
										</a>
									</div>
								</td>
							</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- /Recent Orders -->
		
	</div>
</div>

<!-- Delete Modal -->
<x-modals.delete :route="'products'" :title="'Expired Product'" />
<!-- /Delete Modal -->
@endsection

@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush