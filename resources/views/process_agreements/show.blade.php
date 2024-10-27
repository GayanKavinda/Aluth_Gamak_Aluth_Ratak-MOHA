@extends('layouts.app')

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->

@section('title', 'Process Agreement Details')

@section('content')
<div class="container" style="font-family: 'Nunito', sans-serif;">
    <h1 class="mb-3" style="color: #FFFFFF;">Process Agreement Details</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('process_agreements.index') }}" class="btn btn-warning">Back</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4" style="font-family: 'Nunito', sans-serif;">
            <label for="field" class="form-label label-large">Field</label>
            <input type="text" id="field" class="form-control" value="{{ $processAgreement->field }}" readonly>
        </div>
        <div class="col-md-6" style="font-family: 'Nunito', sans-serif;">
            <label for="task" class="form-label label-large">Task</label>
            <input type="text" id="task" class="form-control" value="{{ $processAgreement->task }}" readonly>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4" style="font-family: 'Nunito', sans-serif;">
            <label for="performance_indicator" class="form-label label-large">Performance Indicator</label>
            <input type="text" id="performance_indicator" class="form-control" value="{{ $processAgreement->performance_indicator }}" readonly>
        </div>
        <div class="col-md-4" style="font-family: 'Nunito', sans-serif;">
            <label for="contracted_target" class="form-label label-large">Contracted Target</label>
            <input type="number" id="contracted_target" class="form-control" value="{{ $processAgreement->contracted_target }}" readonly>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3" style="font-family: 'Nunito', sans-serif;">
            <label for="first_quarter" class="form-label label-large">1st Quarter</label>
            <input type="number" id="first_quarter" class="form-control" value="{{ $processAgreement->first_quarter }}" readonly>
        </div>
        <div class="col-md-3" style="font-family: 'Nunito', sans-serif;">
            <label for="second_quarter" class="form-label label-large">2nd Quarter</label>
            <input type="number" id="second_quarter" class="form-control" value="{{ $processAgreement->second_quarter }}" readonly>
        </div>
        <div class="col-md-3" style="font-family: 'Nunito', sans-serif;">
            <label for="third_quarter" class="form-label label-large">3rd Quarter</label>
            <input type="number" id="third_quarter" class="form-control" value="{{ $processAgreement->third_quarter }}" readonly>
        </div>
        <div class="col-md-3" style="font-family: 'Nunito', sans-serif;">
            <label for="fourth_quarter" class="form-label label-large">4th Quarter</label>
            <input type="number" id="fourth_quarter" class="form-control" value="{{ $processAgreement->fourth_quarter }}" readonly>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4" style="font-family: 'Nunito', sans-serif;">
            <label for="total" class="form-label label-large">Total</label>
            <input type="number" id="total" class="form-control" value="{{ $processAgreement->total }}" readonly>
        </div>
        <div class="col-md-4" style="font-family: 'Nunito', sans-serif;">
            <label for="percentage" class="form-label label-large">Percentage</label>
            <div class="input-group">
                <div class="input-group-text">%</div>
                <input type="number" id="percentage" class="form-control" value="{{ $processAgreement->percentage }}" readonly>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <!-- Pie Chart -->
        <div class="col-md-6">
            <div class="card" style="background-color: #FFFFFF;">
                <div class="card-body">
                    <canvas id="quarterChart" width="300" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Radar Chart -->
        <div class="col-md-6">
            <div class="card" style="background-color: #FFFFFF;">
                <div class="card-body">
                    <canvas id="quarterRadarChart" width="300" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

<style>
.label-large {
    font-size: 16px; /* Adjust the font size as needed */
    color: #FFFFFF;
}

#quarterChart {
    max-width: 100%;
    max-height: 100%;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Pie Chart
    const pieCtx = document.getElementById('quarterChart').getContext('2d');
    const pieData = {
        labels: ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter', 'Total', 'Percentage'],
        datasets: [{
            label: 'Quarterly Data',
            data: [
                @json($processAgreement->first_quarter),
                @json($processAgreement->second_quarter),
                @json($processAgreement->third_quarter),
                @json($processAgreement->fourth_quarter),
                @json($processAgreement->total),
                @json($processAgreement->percentage)
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.9)',
                'rgba(54, 162, 235, 0.9)',
                'rgba(255, 206, 86, 0.9)',
                'rgba(75, 192, 192, 0.9)',
                'rgba(153, 102, 255, 0.9)',
                'rgba(255, 159, 64, 0.9)'
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
    };
    const pieConfig = {
        type: 'pie',
        data: pieData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw;
                            return label;
                        }
                    }
                }
            }
        },
    };
    new Chart(pieCtx, pieConfig);

    // Radar Chart
    const radarCtx = document.getElementById('quarterRadarChart').getContext('2d');
    const radarData = {
        labels: ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter', 'Total', 'Percentage'],
        datasets: [{
            label: 'Quarterly Data',
            data: [
                @json($processAgreement->first_quarter),
                @json($processAgreement->second_quarter),
                @json($processAgreement->third_quarter),
                @json($processAgreement->fourth_quarter),
                @json($processAgreement->total),
                @json($processAgreement->percentage)
            ],
            fill: true,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 206, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)'
            ],
            pointBackgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 206, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)'
            ],
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 206, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)'
            ]
        }]
    };
    const radarConfig = {
        type: 'radar',
        data: radarData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            elements: {
                line: {
                    borderWidth: 3
                }
            },
            scales: {
                r: {
                    angleLines: {
                        display: false
                    },
                    suggestedMin: 0,
                    suggestedMax: 100
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw;
                            return label;
                        }
                    }
                }
            }
        },
    };
    new Chart(radarCtx, radarConfig);
});
</script>
@endsection
