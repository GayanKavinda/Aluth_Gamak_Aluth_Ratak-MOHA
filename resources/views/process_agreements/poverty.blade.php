@extends('layouts.app')

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->

@section('content')

@can('performance agreement forms access')

<style>
    header h2 {
        color: #23B912;
        font-weight: 600;
    }

    header span {
        color: #EEE6E4 ;
    }

    .btn-custom {
        width: 200px;
    }

    .card-custom {
        background-color: #FCFCFC;
        border: 1px solid #ddd;
        border-radius: 15px;
    }

    .card-custom .card-body {
        padding: 20px;
    }

    .label-custom {
        font-size: 15px;
    }

    .form-control {
        font-size: 15px;
    }
</style>

<div class="container mt-3">
    <header>
        <h2>Poverty <span>Alleviation </span></h2>
    </header>

    <form action="{{ route('process_agreements.store') }}" method="POST">
        @csrf

        <div class="card card-custom">
            <div class="card-body">
                <div class="row g-3">
                    <div class="form-group col-md-6">
                        <label for="field">Field:</label>
                        <input type="text" class="form-control" id="field" name="field" value="Poverty Alleviation" readonly>
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                        <label for="povertyTask">Tasks expected to be performed during the year:</label>
                        <input type="text" class="form-control" id="povertyTask" name="task" value="3.1 Economically sustainable upliftment of families suffering from economic difficulties" readonly>
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                        <label for="povertyPerformanceIndicator">Performance Indicator:</label>
                        <input class="form-control" type="text" id="povertyPerformanceIndicator" name="performance_indicator" value="Economically empowered family migration" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="povertyContractedTarget">Contracted target:</label>
                        <input type="number" class="form-control" id="povertyContractedTarget" name="contracted_target">
                    </div>
                    <hr>
                    @can('1st quarter Create')
                    <div class="form-group col-md-4">
                        <label for="povertyFirstQuarter">1st quarter:</label>
                        <input type="number" class="form-control quarter-input" id="povertyFirstQuarter" name="first_quarter">
                    </div>
                    @endcan
                    @can('2nd quarter Create')
                    <div class="form-group col-md-4">
                        <label for="povertySecondQuarter">2nd quarter:</label>
                        <input type="number" class="form-control quarter-input" id="povertySecondQuarter" name="second_quarter">
                    </div>
                    @endcan
                    @can('3rd quarter Create')
                    <div class="form-group col-md-4">
                        <label for="povertyThirdQuarter">3rd quarter:</label>
                        <input type="number" class="form-control quarter-input" id="povertyThirdQuarter" name="third_quarter">
                    </div>
                    @endcan
                    @can('4th quarter Create')
                    <div class="form-group col-md-4">
                        <label for="povertyFourthQuarter">4th quarter:</label>
                        <input type="number" class="form-control quarter-input" id="povertyFourthQuarter" name="fourth_quarter">
                    </div>
                    @endcan
                </div>
                <hr>
                <div class="row g-3">
                    <div class="form-group col-md-3">
                        <label for="povertyTotal">Total:</label>
                        <input type="number" class="form-control" id="povertyTotal" name="total" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="povertyPercentage">Percentage:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="povertyPercentage" name="percentage" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Save Poverty Alleviation</button>
                <input type="hidden" name="is_edit" value="0">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.quarter-input').on('input', function() {
                var contractedTarget = parseFloat($('#povertyContractedTarget').val()) || 0;
                var firstQuarter = parseFloat($('#povertyFirstQuarter').val()) || 0;
                var secondQuarter = parseFloat($('#povertySecondQuarter').val()) || 0;
                var thirdQuarter = parseFloat($('#povertyThirdQuarter').val()) || 0;
                var fourthQuarter = parseFloat($('#povertyFourthQuarter').val()) || 0;

                var total = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;
                var percentage = (contractedTarget > 0) ? (total / contractedTarget) * 100 : 0;

                $('#povertyTotal').val(total.toFixed(2));
                $('#povertyPercentage').val(percentage.toFixed(2));
            });
        });
    </script>

@endcan

@endsection
