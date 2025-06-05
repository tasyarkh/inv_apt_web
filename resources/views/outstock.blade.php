@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Stok Habis</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('products')}}">Obat</a></li>
		<li class="breadcrumb-item active">Stok Habis</li>
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
					<table id="datatable-export" class=" table table-hover table-center mb-0">
						<thead>
							<tr>
								<th>Nama Obat</th>
								<th>Kategori</th>
								<th>Harga</th>
								<th>Kuantitas</th>
								<th>Diskon</th>
								<th>Kadaluarsa</th>
								<th class="action-btn">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($products as $product)
							<tr>
								<td>
									{{$product->name}}
								</td>
								<td>{{$product->category->name}}</td>
								<td>{{AppSettings::get('app_currency', '$')}}{{$product->price}}</td>
								<td><span class="btn btn-sm bg-danger-light">Only {{$product->quantity}}</span></td>
								<td>{{$product->discount}}%</td>
								<td>
									<span class="btn btn-sm bg-success-light">
										{{date_format(date_create($product->expiry_date),"d M, Y")}}</span>	</span>
								</td>
								<td>
									<div class="actions">
										{{-- <a class="btn btn-sm bg-success-light" href="{{route('edit-product',$product)}}">
											<i class="fe fe-pencil"></i> Edit
										</a> --}}
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
<x-modals.delete :route="'products'" :title="'OutStock Product'" />
<!-- /Delete Modal -->
@endsection

@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush