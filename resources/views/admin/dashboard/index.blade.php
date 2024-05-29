@extends('layouts.admin.index')
@section('conteudo')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts">
<style>
    .apexcharts-tooltip {
        z-index: 10000 !important;
    }
</style>
<div class="content-inner container-fluid pb-0" id="page_layout">
    {{-- @dd(Auth::user()->it_tipo_utlizador) --}}

    @if(Auth::user()->it_tipo_utilizador==0 || Auth::user()->it_tipo_utilizador==3 )
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span><b>Financiamentos Aprovados</b></span>
                            <div class="mt-2">
                                <h2 class="counter">{{ $financiamento_p }}</h2>
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div>
                            {{-- <span>New Leads</span> --}}
                        </div>
                         <div>
                            @php
                            if($financiamento_p>0 && $financiamentos>0){
                            $porcetangem=( $financiamento_p/ $financiamentos)*100;
                            }
                            else{
                            $porcetangem=0;
                            }
                            @endphp

                            <span>{{ $porcetangem }}%</span>
                        </div>
                    </div>
                     <div class="mt-3">
                        <div class="progress bg-soft-danger shadow-none w-100" style="height: 6px">
                            <div class="progress-bar bg-danger" data-toggle="progress-bar" role="progressbar"
                                aria-valuenow="{{  $porcetangem }}" aria-valuemin="0" aria-valuemax="{{  $porcetangem }}"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span><b>Requisição por Recursos Materias Aprovados</b></span>
                            <div class="mt-2">
                                <h2 class="counter">{{ $produto_p }}</h2>
                            </div>
                        </div>
                        <div>
                            {{-- <span class="badge bg-info">This Month</span> --}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div>
                            {{-- <span>This Month</span> --}}
                        </div>
                   <div>
                            @php
                            if($produto_p>0 && $produtos>0){

                            $porcetangem=( $produto_p/ $produtos)*100;
                            }
                            else{
                            $porcetangem=0;
                            }
                            @endphp
                            <span class="counter">{{ $porcetangem }}%</span>
                        </div>
                    </div>
               <div class="mt-3">
                        <div class="progress bg-soft-info shadow-none w-100" style="height: 6px">
                            <div class="progress-bar bg-info" data-toggle="progress-bar" role="progressbar"
                                aria-valuenow="{{ $porcetangem }}" aria-valuemin="0" aria-valuemax="{{ $porcetangem }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span><b>Organizações Aprovadas</b></span>
                            <div class="mt-2">
                                <h2 class="counter">{{ $organizacao_p }}</h2>
                            </div>
                        </div>
                        <div>
                            {{-- <span class="badge bg-success">This Month</span> --}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div>
                            {{-- <span>This Month</span> --}}
                        </div>
                       <div>
                            @php
                            if($organizacao_p>0 && $organizacaos>0){
                            $porcetangem=( $organizacao_p/ $organizacaos)*100;
                            }
                            else{
                            $porcetangem=0;
                            }
                            @endphp
                            <span class="counter">{{ $porcetangem }}%</span>
                        </div>
                    </div>
                   <div class="mt-3">
                        <div class="progress bg-soft-info shadow-none w-100" style="height: 6px">
                            <div class="progress-bar bg-success" data-toggle="progress-bar" role="progressbar"
                                aria-valuenow="{{ $porcetangem }}" aria-valuemin="0" aria-valuemax="{{ $porcetangem }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Financiamentos para os Centros de Caridade</h4>

                </div><!-- end card header -->

                <div class="card-body p-0 pb-2">
                    <div>
                        <div id="audiences_metrics_charts" data-url="{{ url('/financiamento-ong') }}" data-colors='["--vz-success", "--vz-light"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Financiamentos de Pedidos feitos pelos Centros de Caridaed</h4>

                </div><!-- end card header -->

                <div class="card-body p-0 pb-2">
                    <div>
                        <div id="financiamento" data-url="{{ url('/financiamento') }}" data-colors='["--vz-success", "--vz-light"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->





        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Financiamentos Realizados por Pessoas Individuais</h4>

                    </div><!-- end card header -->

                    <div class="card-body p-0 pb-2">
                        <div>
                            <div id="individual" data-url="{{ url('/financiamento-individual') }}" data-colors='["--vz-success", "--vz-light"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Financiamentos Realizados Empresa</h4>

                    </div><!-- end card header -->

                    <div class="card-body p-0 pb-2">
                        <div>
                            <div id="empresa" data-url="{{ url('/financiamento-empresa') }}" data-colors='["--vz-success", "--vz-light"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->





            </div>


            {{-- GRAFICOS DE PRODUTOS --}}
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Produtos para os Centros de Caridade</h4>

                        </div><!-- end card header -->

                        <div class="card-body p-0 pb-2">
                            <div>
                                <div id="produto-ong" data-url="{{ url('/produto-ong') }}" data-colors='["--vz-success", "--vz-light"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Produtos de Pedidos feitos pelos Centros de Caridaed</h4>

                        </div><!-- end card header -->

                        <div class="card-body p-0 pb-2">
                            <div>
                                <div id="produto" data-url="{{ url('/produto') }}" data-colors='["--vz-success", "--vz-light"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->





                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Produtos Realizados por Pessoas Individuais</h4>

                            </div><!-- end card header -->

                            <div class="card-body p-0 pb-2">
                                <div>
                                    <div id="produto-individual" data-url="{{ url('/produto-individual') }}" data-colors='["--vz-success", "--vz-light"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Produtos Realizados Empresa</h4>

                            </div><!-- end card header -->

                            <div class="card-body p-0 pb-2">
                                <div>
                                    <div id="produto-empresa" data-url="{{ url('/produto-empresa') }}" data-colors='["--vz-success", "--vz-light"]' class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->




                    @if (Auth::user()->it_tipo_utilizador==0)
                    <div class="col-xl-4">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Usuarios Por Nivel de Acesso</h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted fs-16"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                        </a>

                                    </div>
                                </div>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div id="project_category_pie_chart" data-url="{{ url('/project-category-data') }}"></div>

                                <!-- Aqui você pode adicionar mais informações sobre as categorias de projetos -->
                                <!-- Por exemplo, uma tabela com a contagem de projetos em cada categoria -->

                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    @endif
                    </div>


</div>

    @else
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span><b>Doações em Analise</b></span>
                            <div class="mt-2">
                                <h2 class="counter">{{ $analise }}</h2>
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div>
                            {{-- <span>New Leads</span> --}}
                        </div>
                       <div>
                       {{-- @php
                            if($financiamento_p>0 && $financiamentos>0){
                            $porcetangem=( $financiamento_p/ $financiamentos)*100;
                            }
                            else{
                            $porcetangem=0;
                            }
                            @endphp

                            <span>{{ $porcetangem }}%</span>--}}
                        </div>
                    </div>
                   <div class="mt-3">
                   {{--<div class="progress bg-soft-danger shadow-none w-100" style="height: 6px">
                            <div class="progress-bar bg-danger" data-toggle="progress-bar" role="progressbar"
                                aria-valuenow="{{  $porcetangem }}" aria-valuemin="0" aria-valuemax="{{ $porcetangem }}"></div>
                        </div>--}}
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span><b>Doações Aprovadas</b></span>
                            <div class="mt-2">
                                <h2 class="counter">{{ $aprovado }}</h2>
                            </div>
                        </div>
                        <div>
                            {{-- <span class="badge bg-info">This Month</span> --}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div>
                            {{-- <span>This Month</span> --}}
                        </div>
                        <div>
                            {{--   @php
                            if($produto_p>0 && $produtos>0){

                            $porcetangem=( $produto_p/ $produtos)*100;
                            }
                            else{
                            $porcetangem=0;
                            }
                            @endphp
                            <span class="counter">{{ $porcetangem }}%</span>--}}
                        </div>
                    </div>
                  <div class="mt-3">
                  {{--     <div class="progress bg-soft-info shadow-none w-100" style="height: 6px">
                            <div class="progress-bar bg-info" data-toggle="progress-bar" role="progressbar"
                                aria-valuenow="{{ $porcetangem }}%" aria-valuemin="0" aria-valuemax="{{ $porcetangem }}"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span><b>Doações Rejeitadas</b></span>
                            <div class="mt-2">
                                <h2 class="counter">{{ $rejeitado }}</h2>
                            </div>
                        </div>
                        <div>
                            {{-- <span class="badge bg-success">This Month</span> --}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <div>
                            {{-- <span>This Month</span> --}}
                        </div>
                      <div>
                      {{--   @php
                            if($organizacao_p>0 && $organizacaos>0){
                            $porcetangem=( $organizacao_p/ $organizacaos)*100;
                            }
                            else{
                            $porcetangem=0;
                            }
                            @endphp
                            <span class="counter">{{ $porcetangem }}%</span>--}}
                        </div>
                    </div>
                     <div class="mt-3">
                     {{--  <div class="progress bg-soft-info shadow-none w-100" style="height: 6px">
                            <div class="progress-bar bg-success" data-toggle="progress-bar" role="progressbar"
                                aria-valuenow="{{ $porcetangem }}" aria-valuemin="0" aria-valuemax="{{ $porcetangem }}"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<!-- Footer Section Start -->
<footer class="footer">
    <div class="footer-body">
        <ul class="left-panel list-inline mb-0 p-0">
            <li class="list-inline-item"><a href="javascript:void(0);">Privacy Policy</a></li>
            <li class="list-inline-item"><a href="javascript:void(0);">Terms of Use</a></li>
        </ul>
        <div class="right-panel">
            ©<script>
                2022
            </script> <span data-setting="app_name">Qompac UI</span>, Made with
            <span class="text-gray">
                <svg class="icon-16" width="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z"
                        fill="currentColor"></path>
                </svg>
            </span> by <a href="https://iqonic.design/" target="_blank">IQONIC Design</a>.
        </div>
    </div>
</footer>
<!-- Footer Section End -->
</main>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
{{-- SCRIPT GRAFICOS DE FINANCIAMENTO --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartElement = document.querySelector("#audiences_metrics_charts");
        const dataUrl = chartElement.getAttribute('data-url');


        fetch(dataUrl)
            .then(response => response.json())
            .then(data => {
                const options = {
                    series: data.series,
                    chart: {
                        type: 'bar',
                        height: 306,
                        stacked: true,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '30%',
                            borderRadius: 6
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontWeight: 400,
                        fontSize: '8px',
                        offsetX: 0,
                        offsetY: 0,
                        markers: {
                            width: 9,
                            height: 9,
                            radius: 4
                        }
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    grid: {
                        show: false
                    },
                    xaxis: {
                        categories: data.categories,
                        axisTicks: {
                            show: false
                        },
                        axisBorder: {
                            show: true,
                            strokeDashArray: 1,
                            height: 1,
                            width: '100%',
                            offsetX: 0,
                            offsetY: 0
                        }
                    },
                    yaxis: {
                        show: false
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
shared: true,
intersect: false,
x: {
    show: true
},
y: {
    formatter: function (val) {
        return val.toFixed(2) + " Kz"; // Adiciona "Kz" ao valor
    }
}
}
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartElement = document.querySelector("#financiamento");
        const dataUrl = chartElement.getAttribute('data-url');


        fetch(dataUrl)
            .then(response => response.json())
            .then(data => {
                const options = {
                    series: data.series,
                    chart: {
                        type: 'bar',
                        height: 306,
                        stacked: true,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '30%',
                            borderRadius: 6
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontWeight: 400,
                        fontSize: '8px',
                        offsetX: 0,
                        offsetY: 0,
                        markers: {
                            width: 9,
                            height: 9,
                            radius: 4
                        }
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    grid: {
                        show: false
                    },
                    xaxis: {
                        categories: data.categories,
                        axisTicks: {
                            show: false
                        },
                        axisBorder: {
                            show: true,
                            strokeDashArray: 1,
                            height: 1,
                            width: '100%',
                            offsetX: 0,
                            offsetY: 0
                        }
                    },
                    yaxis: {
                        show: false
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
shared: true,
intersect: false,
x: {
    show: true
},
y: {
    formatter: function (val) {
        return val.toFixed(2) + " Kz"; // Adiciona "Kz" ao valor
    }
}
}
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartElement = document.querySelector("#individual");
        const dataUrl = chartElement.getAttribute('data-url');


        fetch(dataUrl)
            .then(response => response.json())
            .then(data => {
                const options = {
                    series: data.series,
                    chart: {
                        type: 'bar',
                        height: 306,
                        stacked: true,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '30%',
                            borderRadius: 6
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontWeight: 400,
                        fontSize: '8px',
                        offsetX: 0,
                        offsetY: 0,
                        markers: {
                            width: 9,
                            height: 9,
                            radius: 4
                        }
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    grid: {
                        show: false
                    },
                    xaxis: {
                        categories: data.categories,
                        axisTicks: {
                            show: false
                        },
                        axisBorder: {
                            show: true,
                            strokeDashArray: 1,
                            height: 1,
                            width: '100%',
                            offsetX: 0,
                            offsetY: 0
                        }
                    },
                    yaxis: {
                        show: false
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
shared: true,
intersect: false,
x: {
    show: true
},
y: {
    formatter: function (val) {
        return val.toFixed(2) + " Kz"; // Adiciona "Kz" ao valor
    }
}
}
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartElement = document.querySelector("#empresa");
        const dataUrl = chartElement.getAttribute('data-url');


        fetch(dataUrl)
            .then(response => response.json())
            .then(data => {
                const options = {
                    series: data.series,
                    chart: {
                        type: 'bar',
                        height: 306,
                        stacked: true,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '30%',
                            borderRadius: 6
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontWeight: 400,
                        fontSize: '8px',
                        offsetX: 0,
                        offsetY: 0,
                        markers: {
                            width: 9,
                            height: 9,
                            radius: 4
                        }
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    grid: {
                        show: false
                    },
                    xaxis: {
                        categories: data.categories,
                        axisTicks: {
                            show: false
                        },
                        axisBorder: {
                            show: true,
                            strokeDashArray: 1,
                            height: 1,
                            width: '100%',
                            offsetX: 0,
                            offsetY: 0
                        }
                    },
                    yaxis: {
                        show: false
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
shared: true,
intersect: false,
x: {
    show: true
},
y: {
    formatter: function (val) {
        return val.toFixed(2) + " Kz"; // Adiciona "Kz" ao valor
    }
}
}
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartElement = document.querySelector("#project_category_pie_chart");
        const dataUrl = chartElement.getAttribute('data-url');

        fetch(dataUrl)
            .then(response => response.json())
            .then(data => {
                const options = {
                    series: data.map(item => item.user_count),
                    labels: data.map(item => item.tipo_utilizador),
                    chart: {
                        type: 'donut',
                        height: 306
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    },
                    colors: ["#008FFB", "#00E396", "#FEB019", "#FF4560", "#775DD0", "#546E7A", "#26a69a", "#D10CE8"],
                    legend: {
                        show: true,
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontWeight: 400,
                        fontSize: '8px',
                        offsetX: 0,
                        offsetY: 0,
                        markers: {
                            width: 9,
                            height: 9,
                            radius: 4
                        }
                    }
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            });
    });
</script>

{{-- SCRIPT GRAFICOS DE PRODUTOS --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartElement = document.querySelector("#produto-ong");
        const dataUrl = chartElement.getAttribute('data-url');


        fetch(dataUrl)
            .then(response => response.json())
            .then(data => {
                const options = {
                    series: data.series,
                    chart: {
                        type: 'bar',
                        height: 306,
                        stacked: true,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '30%',
                            borderRadius: 6
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontWeight: 400,
                        fontSize: '8px',
                        offsetX: 0,
                        offsetY: 0,
                        markers: {
                            width: 9,
                            height: 9,
                            radius: 4
                        }
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    grid: {
                        show: false
                    },
                    xaxis: {
                        categories: data.categories,
                        axisTicks: {
                            show: false
                        },
                        axisBorder: {
                            show: true,
                            strokeDashArray: 1,
                            height: 1,
                            width: '100%',
                            offsetX: 0,
                            offsetY: 0
                        }
                    },
                    yaxis: {
                        show: false
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
shared: true,
intersect: false,
x: {
    show: true
},
y: {
    formatter: function (val) {
        return val.toFixed(2) + " Kz"; // Adiciona "Kz" ao valor
    }
}
}
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartElement = document.querySelector("#produto");
        const dataUrl = chartElement.getAttribute('data-url');


        fetch(dataUrl)
            .then(response => response.json())
            .then(data => {
                const options = {
                    series: data.series,
                    chart: {
                        type: 'bar',
                        height: 306,
                        stacked: true,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '30%',
                            borderRadius: 6
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontWeight: 400,
                        fontSize: '8px',
                        offsetX: 0,
                        offsetY: 0,
                        markers: {
                            width: 9,
                            height: 9,
                            radius: 4
                        }
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    grid: {
                        show: false
                    },
                    xaxis: {
                        categories: data.categories,
                        axisTicks: {
                            show: false
                        },
                        axisBorder: {
                            show: true,
                            strokeDashArray: 1,
                            height: 1,
                            width: '100%',
                            offsetX: 0,
                            offsetY: 0
                        }
                    },
                    yaxis: {
                        show: false
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
shared: true,
intersect: false,
x: {
    show: true
},
y: {
    formatter: function (val) {
        return val.toFixed(2) + " Kz"; // Adiciona "Kz" ao valor
    }
}
}
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartElement = document.querySelector("#produto-individual");
        const dataUrl = chartElement.getAttribute('data-url');


        fetch(dataUrl)
            .then(response => response.json())
            .then(data => {
                const options = {
                    series: data.series,
                    chart: {
                        type: 'bar',
                        height: 306,
                        stacked: true,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '30%',
                            borderRadius: 6
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontWeight: 400,
                        fontSize: '8px',
                        offsetX: 0,
                        offsetY: 0,
                        markers: {
                            width: 9,
                            height: 9,
                            radius: 4
                        }
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    grid: {
                        show: false
                    },
                    xaxis: {
                        categories: data.categories,
                        axisTicks: {
                            show: false
                        },
                        axisBorder: {
                            show: true,
                            strokeDashArray: 1,
                            height: 1,
                            width: '100%',
                            offsetX: 0,
                            offsetY: 0
                        }
                    },
                    yaxis: {
                        show: false
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
shared: true,
intersect: false,
x: {
    show: true
},
y: {
    formatter: function (val) {
        return val.toFixed(2) + " Kz"; // Adiciona "Kz" ao valor
    }
}
}
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartElement = document.querySelector("#produto-empresa");
        const dataUrl = chartElement.getAttribute('data-url');


        fetch(dataUrl)
            .then(response => response.json())
            .then(data => {
                const options = {
                    series: data.series,
                    chart: {
                        type: 'bar',
                        height: 306,
                        stacked: true,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '30%',
                            borderRadius: 6
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        horizontalAlign: 'center',
                        fontWeight: 400,
                        fontSize: '8px',
                        offsetX: 0,
                        offsetY: 0,
                        markers: {
                            width: 9,
                            height: 9,
                            radius: 4
                        }
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    grid: {
                        show: false
                    },
                    xaxis: {
                        categories: data.categories,
                        axisTicks: {
                            show: false
                        },
                        axisBorder: {
                            show: true,
                            strokeDashArray: 1,
                            height: 1,
                            width: '100%',
                            offsetX: 0,
                            offsetY: 0
                        }
                    },
                    yaxis: {
                        show: false
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
shared: true,
intersect: false,
x: {
    show: true
},
y: {
    formatter: function (val) {
        return val.toFixed(2) + " Kz"; // Adiciona "Kz" ao valor
    }
}
}
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            });
    });
</script>
@endsection
