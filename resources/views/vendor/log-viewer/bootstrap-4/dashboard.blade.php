{{--@extends('layouts.master')--}}

@section('title', 'Log Viewer')

@section('header')
    <div class="row mb-2">
        <div class="col-md-6 col-sm-6 col-6">
            <h1 class="m-0 text-dark">Log Viewer <span class="small text-muted">By <a
                        href="https://github.com/ARCANEDEV/LogViewer">ARCANEDEV</a></span></h1>
        </div>
    </div>
@endsection

@section('content')
    @if(count($percents)>0)
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <canvas id="stats-doughnut-chart" height="300" class="mb-3"></canvas>
            </div>

            <div class="col-md-6 col-lg-9">
                <div class="row">
                    @foreach($percents as $level => $item)
                        <div class="col-sm-6 col-md-12 col-lg-4 mb-3">
                            <div class="box level-{{ $level }} {{ $item['count'] === 0 ? 'empty' : '' }}">
                                <div class="box-icon">
                                    {!! log_styler()->icon($level) !!}
                                </div>

                                <div class="box-content">
                                    <span class="box-text">{{ $item['name'] }}</span>
                                    <span class="box-number">
                                    {{ $item['count'] }} entries - {!! $item['percent'] !!} %
                                </span>
                                    <div class="progress" style="height: 3px;">
                                        <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <h1>No Error</h1>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('node_modules/chart.js/dist/Chart.min.js') }}"></script>
    <script>
        $(function () {
            new Chart(document.getElementById("stats-doughnut-chart"), {
                type: 'pie',
                data: {!! $chartData !!},
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        });
    </script>
@endpush
