@extends('layouts.app')

@push('page-css')
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
@endpush

@push('page-header')
<div class="col-sm-7 col-auto">
	<h3 class="page-title">Laporan</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
		<li class="breadcrumb-item active">Generate Laporan</li>
	</ul>
</div>
<div class="col-sm-5 col">
	<a href="#generate_report" data-toggle="modal" class="btn btn-primary float-right mt-2">Generate Laporan</a>
</div>
@endpush


@section('content')
	
<div class="row">
	@isset($sales)
	<div class="col-xl-3 col-sm-6 col-12">
		<div class="card">
			<div class="card-body">
				<div class="dash-widget-header">
					<span class="dash-widget-icon text-primary border-primary">
						<i class="fe fe-money"></i>
					</span>
					<div class="dash-count">
						<h3>{{AppSettings::get('app_currency', '$')}} {{$total_cash}}</h3>
					</div>
				</div>
				<div class="dash-widget-info">
					<h6 class="text-muted">Total Pendapatan</h6>
					<div class="progress progress-sm">
						<div class="progress-bar bg-primary w-50"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 col-12">
		<div class="card">
			<div class="card-body">
				<div class="dash-widget-header">
					<span class="dash-widget-icon text-success">
						<i class="fe fe-activity"></i>
					</span>
					<div class="dash-count">
						<h3>{{$total_sales}}</h3>
					</div>
				</div>
				<div class="dash-widget-info">
					
					<h6 class="text-muted">Total Penjualan</h6>
					<div class="progress progress-sm">
						<div class="progress-bar bg-success w-50"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endisset
	<div class="col-md-12">
	
		@isset($sales)
			<!--  Sales -->
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table id="datatable-export" class="table table-hover table-center mb-0">
							<thead>
								<tr>
									<th>Nama Obat</th>
									<th>Kuantitas</th>
									<th>Total Harga</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($sales as $sale)
									@if (!(empty($sale->product->purchase)))
										<tr>
											<td>{{$sale->product->purchase->name}}</td>
											<td>{{$sale->quantity}}</td>
											<td>{{AppSettings::get('app_currency', '$')}} {{($sale->total_price)}}</td>
											<td>{{date_format(date_create($sale->created_at),"d M, Y")}}</td>
											
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- / sales -->
		@endisset

		@isset($products)
			<!-- Products -->
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table id="datatable-export" class="table table-hover table-center mb-0">
							<thead>
								<tr>
									<th>Nama Produk</th>
									<th>Kategori</th>
									<th>Harga</th>
									<th>Kuantitas</th>
									<th>Diskon</th>
									<th>Tgl Kadaluarsa</th>
									<th class="action-btn">Action</th>
								</tr>
							</thead>
							<tbody>

								@foreach ($products as $product)
									@if (!(empty($product->purchase)))
										<tr>
											<td>
												<h2 class="table-avatar">
													@if(!empty($product->purchase->image))
													<span class="avatar avatar-sm mr-2">
														<img class="avatar-img" src="{{asset('storage/purchases/'.$product->purchase->image)}}" alt="product image">
													</span>
													@endif
													{{$product->purchase->name}}
												</h2>
											</td>
											<td>{{$product->purchase->category->name}}</td>
											<td>{{AppSettings::get('app_currency', '$')}} {{$product->price}}
											</td>
											<td>{{$product->purchase->quantity}}</td>
											<td>{{$product->discount}}%</td>
											<td>
											{{date_format(date_create($product->purchase->expiry_date),"d M, Y")}}</span>										
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
									@endif
								@endforeach
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /Products -->
		@endisset
		
		@isset($purchases)
			<!-- Purchases-->
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table id="datatable-export" class="table table-hover table-center mb-0">
							<thead>
								<tr>
									<th>Nama Obat</th>
									<th>Kategori Obat</th>
									<th>Harga Beli</th>
									<th>Kuantitas</th>
									<th>Supplier</th>
									<th>Tgl Kadaluarsa</th>
									<th class="action-btn">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($purchases as $purchase)
									@if(!empty($purchase->supplier) && !empty($purchase->category))
									<tr>
										<td>
											<h2 class="table-avatar">
												@if(!empty($purchase->image))
												<span class="avatar avatar-sm mr-2">
													<img class="avatar-img" src="{{asset('storage/purchases/'.$purchase->image)}}" alt="product image">
												</span>
												@endif
												{{$purchase->name}}
											</h2>
										</td>
										<td>{{$purchase->category->name}}</td>
										<td>{{AppSettings::get('app_currency', '$')}}{{$purchase->price}}</td>
										<td>{{$purchase->quantity}}</td>
										<td>{{$purchase->supplier->name}}</td>
										<td>{{date_format(date_create($purchase->expiry_date),"d M, Y")}}</td>
										<td>
											<div class="actions">
												{{-- <a class="btn btn-sm bg-success-light" href="{{route('edit-purchase',$purchase)}}">
													<i class="fe fe-pencil"></i> Edit
												</a> --}}
												<a data-id="{{$purchase->id}}" href="javascript:void(0);" class="btn btn-sm bg-danger-light deletebtn" data-toggle="modal">
													<i class="fe fe-trash"></i> Hapus
												</a>
											</div>
										</td>
									</tr>
									@endif
								@endforeach
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /Purchases -->
		@endisset
	</div>
</div>

<!-- Generate Modal -->
<div class="modal fade" id="generate_report" aria-hidden="true" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Generate Laporan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{route('reports')}}">
					@csrf
					<div class="row form-row">
						<div class="col-12">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Dari</label>
										<input type="date" name="from_date" class="form-control">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label>Sampai</label>
										<input type="date" name="to_date" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Sumber</label>
								<select class="form-control select" name="resource"> 
									<option value="products">Produk</option>
									<option value="purchases">Pembelian</option>
									<option value="sales">Penjualan</option>
								</select>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Lihat Data</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Generate Modal -->
@endsection


@push('page-js')
	<!-- Select2 JS -->
	<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
@endpush



