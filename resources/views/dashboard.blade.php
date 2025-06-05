@extends('layouts.app')

@push('page-css')
@endpush

@push('page-header')
<div class="col-sm-12">
	<h3 class="page-title">Selamat Datang {{auth()->user()->name}}!</h3>
	<ul class="breadcrumb">
		<li class="breadcrumb-item active">Dashboard</li>
	</ul>
</div>
@endpush

@section('content')
	
	<div class="row">
		<div class="col-xl-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-body">
					<div class="dash-widget-header">
						<span class="dash-widget-icon text-primary border-primary">
							<i class="fe fe-money"></i>
						</span>
						<div class="dash-count">
							<h3>{{$total_produk}}</h3>
						</div>
					</div>
					<div class="dash-widget-info">
						<h6 class="text-muted">Total Produk</h6>
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
							<i class="fe fe-credit-card"></i>
						</span>
						<div class="dash-count">
							<h3>{{$total_categories}}</h3>
						</div>
					</div>
					<div class="dash-widget-info">
						
						<h6 class="text-muted">Kategori Produk</h6>
						<div class="progress progress-sm">
							<div class="progress-bar bg-success w-50"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-body">
					<div class="dash-widget-header">
						<span class="dash-widget-icon text-danger border-danger">
							<i class="fe fe-folder"></i>
						</span>
						<div class="dash-count">
							<h3>{{$total_expired_products}}</h3>
						</div>
					</div>
					<div class="dash-widget-info">
						
						<h6 class="text-muted">Produk Kadaluarsa</h6>
						<div class="progress progress-sm">
							<div class="progress-bar bg-danger w-50"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-3 col-sm-6 col-12">
			<div class="card">
				<div class="card-body">
					<div class="dash-widget-header">
						<span class="dash-widget-icon text-warning border-warning">
							<i class="fe fe-users"></i>
						</span>
						<div class="dash-count">
							<h3>{{$outstok}}</h3>
						</div>
					</div>
					<div class="dash-widget-info">
						
						<h6 class="text-muted">Total Stok Habis</h6>
						<div class="progress progress-sm">
							<div class="progress-bar bg-warning w-50"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-6">
		
			<div class="card card-table">
				<div class="card-header">
					<h4 class="card-title ">Barang Keluar Hari Ini</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-center mb-0">
							<thead>
								<tr>
									<th>Obat</th>
									<th>Kuantitas</th>
									<th>Total Harga</th>
									<th>Tanggal</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($latest_sales as $sale)
									@if(!empty($sale->product->purchase))
										<tr>
											<td>{{$sale->product->purchase->name}}</td>
											<td>{{$sale->quantity}}</td>
											<td>
												{{AppSettings::get('app_currency', 'Rp')}} {{($sale->total_price)}}
											</td>
											<td>{{date_format(date_create($sale->created_at),"d M, Y")}}</td>
											
										</tr>
									@endif
								@endforeach
																
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>

		<div class="col-md-12 col-lg-6">
						
			<!-- Pie Chart -->
			<div class="card card-chart">
				<div class="card-header">
					<h4 class="card-title">Simple Grafik</h4>
				</div>
				<div class="card-body">
					<div style="width:65%;">
						{!! $pieChart->render() !!}
					</div>
				</div>
			</div>
			<!-- /Pie Chart -->
			
		</div>	
		
		
	</div>
	<div class="row">
		<div class="col-md-12">
		
			<!-- Latest Customers -->
			
			<!-- /Latest Customers -->
			
		</div>
	</div>
@endsection

@push('page-js')

@endpush

