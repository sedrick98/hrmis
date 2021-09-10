@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection
@section('content')
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-danger">
                        {{-- <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg">9.823</div>
                                <div>Members online</div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="c-icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a></div>
                            </div>
                        </div> --}}
                        
                        {{-- <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                </div>
                            </div>
                            <canvas class="chart chartjs-render-monitor" id="card-chart1" height="70" style="display: block; width: 189px; height: 70px;" width="189"></canvas>
                        </div> --}}
                        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg">100</div>
                                <div>ROUTED DOCUMENT</div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="c-icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                    </svg>
                                </button>
                                {{-- <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-success">
                        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg">100</div>
                                <div>OPEN DOCUMENT</div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="c-icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                    </svg>
                                </button>
                                {{-- <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg">100</div>
                                <div>CLOSED DOCUMENT</div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="c-icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                    </svg>
                                </button>
                                {{-- <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            
                {{-- <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-value-lg">9.823</div>
                                <div>Members online</div>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="c-icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas class="chart chartjs-render-monitor" id="card-chart4" height="70" width="189" style="display: block; width: 189px; height: 70px;"></canvas>
                        <div id="card-chart4-tooltip" class="c-chartjs-tooltip bottom top" style="opacity: 0; left: 133.409px; top: 100.6px;"><div class="c-tooltip-header"><div class="c-tooltip-header-item">April</div></div><div class="c-tooltip-body"><div class="c-tooltip-body-item"><span class="c-tooltip-body-item-color" style="background-color: rgba(255, 255, 255, 0.2);"></span><span class="c-tooltip-body-item-label">My First dataset</span><span class="c-tooltip-body-item-value">82</span></div></div></div></div>
                    </div>
                </div> --}}
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    {{-- <div class="container mt-5">
                        <h2 class="mb-4">Datatables Example</h2>
                        <table class="table table-bordered yajra-datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Phone</th>
                                    <th>DOB</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Sukarno</td>
                                    <td>me@me.com</td>
                                    <td>s1234</td>
                                    <td>12312312</td>
                                    <td>123123231</td>
                                    <td>asdasdasdsa</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> --}}
                    {{-- <div>
                        <h4 class="card-title mb-0">Traffic</h4>
                        <div class="small text-muted">September 2019</div>
                    </div>
                    <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                        <div class="btn-group btn-group-toggle mx-3" data-toggle="buttons">
                            <label class="btn btn-outline-secondary">
                                <input id="option1" type="radio" name="options" autocomplete="off"> Day
                            </label>
                            <label class="btn btn-outline-secondary active">
                                <input id="option2" type="radio" name="options" autocomplete="off" checked=""> Month
                            </label>
                            <label class="btn btn-outline-secondary">
                                <input id="option3" type="radio" name="options" autocomplete="off"> Year
                            </label>
                        </div>
                        <button class="btn btn-primary" type="button">
                            <svg class="c-icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cloud-download"></use>
                            </svg>
                        </button>
                    </div> --}}
                </div>
                {{-- <div class="c-chart-wrapper" style="height:300px;margin-top:40px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas class="chart chartjs-render-monitor" id="main-chart" height="300" width="938" style="display: block; width: 938px; height: 300px;"></canvas>
                </div> --}}
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
            {{-- <div class="card-footer">
                <div class="row text-center">
                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">Visits</div><strong>29.703 Users (40%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">Unique</div><strong>24.093 Users (20%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">Pageviews</div><strong>78.706 Views (60%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">New Users</div><strong>22.123 Users (80%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md mb-sm-2 mb-0">
                        <div class="text-muted">Bounce Rate</div><strong>40.15%</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        
        {{-- <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-header bg-facebook content-center">
                        <svg class="c-icon c-icon-3xl text-white my-4">
                        <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-facebook-f"></use>
                        </svg>
                    </div>
                    <div class="card-body row text-center">
                        <div class="col">
                            <div class="text-value-xl">89k</div>
                            <div class="text-uppercase text-muted small">friends</div>
                        </div>
                        <div class="c-vr"></div>
                        <div class="col">
                            <div class="text-value-xl">459</div>
                            <div class="text-uppercase text-muted small">feeds</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-header bg-twitter content-center">
                        <svg class="c-icon c-icon-3xl text-white my-4">
                            <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-twitter"></use>
                        </svg>
                    </div>
                    <div class="card-body row text-center">
                        <div class="col">
                            <div class="text-value-xl">973k</div>
                            <div class="text-uppercase text-muted small">followers</div>
                        </div>
                        <div class="c-vr"></div>
                        <div class="col">
                            <div class="text-value-xl">1.792</div>
                            <div class="text-uppercase text-muted small">tweets</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-header bg-linkedin content-center">
                        <svg class="c-icon c-icon-3xl text-white my-4">
                            <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-linkedin"></use>
                        </svg>
                    </div>
                    <div class="card-body row text-center">
                        <div class="col">
                            <div class="text-value-xl">500+</div>
                            <div class="text-uppercase text-muted small">contacts</div>
                        </div>
                        <div class="c-vr"></div>
                        <div class="col">
                            <div class="text-value-xl">292</div>
                            <div class="text-uppercase text-muted small">feeds</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
@section('after-scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
$(function () {
    var table = $('.yajra-datatable').DataTable();
});
    // var Chart = Chart;
    
    // var Chart = Chart.BarController;
    // console.log(Chart);
    // Chart.register(Chart);
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
@endsection