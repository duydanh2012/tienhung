@extends('admin.layouts.index')
@section('title', 'Admin')
@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">DashBoard</h1>
            <!--//app-card-->
            <div class="row g-4 mb-4">

                <!--//col-->
                <div class="col-6 col-lg-6">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Bài viết</h4>
                            <div class="stats-figure">{{ countPost() }}</div>
                        </div>
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->
                <div class="col-6 col-lg-6">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h4 class="stats-type mb-1">Người dùng</h4>
                            <div class="stats-figure">{{ countUser() }}</div>
                        </div>
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->
            </div>
            <!--//row-->
            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-chart h-100 shadow-sm">
                        <div class="app-card-header p-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h4 class="app-card-title">Số lượt xem</h4>
                                </div>
                                <!--//col-->
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body p-3 p-lg-4">
                            <div class="mb-3 d-flex">
                                <select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                                    <option value="1" selected>This week</option>
                                    <option value="2">Today</option>
                                    <option value="3">This Month</option>
                                    <option value="3">This Year</option>
                                </select>
                            </div>
                            <div class="chart-container">
                                <canvas id="canvas-linechart"></canvas>
                            </div>
                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->
                <div class="col-12 col-lg-6">
                    <div class="app-card app-card-chart h-100 shadow-sm">
                        <div class="app-card-header p-3">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h4 class="app-card-title">Số bài viết</h4>
                                </div>
                                <!--//col-->
                                <div class="col-auto">
                                    <!--//card-header-actions-->
                                </div>
                                <!--//col-->
                            </div>
                            <!--//row-->
                        </div>
                        <!--//app-card-header-->
                        <div class="app-card-body p-3 p-lg-4">
                            <div class="mb-3 d-flex">
                                <select class="form-select form-select-sm ms-auto d-inline-flex w-auto">
                                    <option value="1" selected>This week</option>
                                    <option value="2">Today</option>
                                    <option value="3">This Month</option>
                                    <option value="3">This Year</option>
                                </select>
                            </div>
                            <div class="chart-container">
                                <canvas id="canvas-barchart"></canvas>
                            </div>
                        </div>
                        <!--//app-card-body-->
                    </div>
                    <!--//app-card-->
                </div>
                <!--//col-->

            </div>


        </div>
        <!--//container-fluid-->
    </div>
    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script>
    <script src="assets/js/index-charts.js"></script>

@endsection
