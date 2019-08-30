@extends('panel.layouts.template')

@section('content')
<!-- ============================================================== -->
<!-- pageheader  -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Dashboard </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end pageheader  -->
<!-- ============================================================== -->

<div class="ecommerce-widget">
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Lorem Ipsum</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">$12099</h1>
                    </div>
                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                        <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
                    </div>
                </div>
                <div id="sparkline-revenue"></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Lorem Ipsum</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">$12099</h1>
                    </div>
                    <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                        <span><i class="fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
                    </div>
                </div>
                <div id="sparkline-revenue2"></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Lorem Ipsum</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">0.00</h1>
                    </div>
                    <div class="metric-label d-inline-block float-right text-primary font-weight-bold">
                        <span>N/A</span>
                    </div>
                </div>
                <div id="sparkline-revenue3"></div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-muted">Lorem Ipsum</h5>
                    <div class="metric-value d-inline-block">
                        <h1 class="mb-1">$28000</h1>
                    </div>
                    <div class="metric-label d-inline-block float-right text-secondary font-weight-bold">
                        <span>-2.00%</span>
                    </div>
                </div>
                <div id="sparkline-revenue4"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{url('assets/panel/vendor/charts/chartist-bundle/chartist.css')}}">
<link rel="stylesheet" href="{{url('assets/panel/vendor/charts/morris-bundle/morris.css')}}">
<link rel="stylesheet" href="{{url('assets/panel/vendor/charts/c3charts/c3.css')}}">
@endpush

@push('scripts')
<!-- chart chartist js -->
<script src="{{url('assets/panel/vendor/charts/chartist-bundle/chartist.min.js')}}"></script>
<!-- sparkline js -->
<script src="{{url('assets/panel/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
<!-- morris js -->
<script src="{{url('assets/panel/vendor/charts/morris-bundle/raphael.min.js')}}"></script>
<script src="{{url('assets/panel/vendor/charts/morris-bundle/morris.js')}}"></script>
<!-- chart c3 js -->
<script src="{{url('assets/panel/vendor/charts/c3charts/c3.min.js')}}"></script>
<script src="{{url('assets/panel/vendor/charts/c3charts/d3-5.4.0.min.js')}}"></script>
<script src="{{url('assets/panel/vendor/charts/c3charts/C3chartjs.js')}}"></script>
<script src="{{url('assets/panel/libs/js/dashboard-ecommerce.js')}}"></script>
@endpush