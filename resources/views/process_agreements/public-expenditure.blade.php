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
    color: #F36B01;
    font-weight: 600;
}

header span {
    color: #EEE6E4 ;
}

.btn-custom {
    width: 200px; /* Adjust the width as needed */
}

.card-custom {
    background-color: #FCFCFC; /* Replace with your desired color */
    border: 1px solid #ddd; /* Optional: Add a border */
    border-radius: 15px;
}

.card-custom .card-body {
    padding: 20px; /* Optional: Add padding to the card body */
}

.label-custom {
    font-size: 15px; /* Adjust the font size as needed */
}

.form-control {
    font-size: 15px;
}

</style>

<div class="container mt-3">
    <header>
        <h2>Public <span>Expenditure </span></h2>
    </header>
    <form action="{{ route('process_agreements.store') }}" method="POST">
        @csrf

        <!-- New section for Public Expenditure -->
        <div class="card card-custom">
            <div class="card-body">
            <div class="row g-3">
                <div class="form-group col-md-4">
                    <label for="field">Field:</label>
                    <input type="text" class="form-control" id="field" name="field" value="Public Expenditure" readonly>
                </div>
                <hr>
            <div class="form-group col-md-6">
                <label for="environmentTasks">Tasks expected to be performed during the year:</label>
                <input type="text" class="form-control" id="expenditureTasks" name="task" value="8.1 Reducing recurring costs" readonly>
            </div>

                <!-- Performance Indicator for Public Expenditure Tasks -->
                <div class="form-group col-md-6">
                    <label for="expenditurePerformanceIndicator">Performance Indicator:</label>
                    <input class="form-control" type="text" id="expenditurePerformanceIndicator" name="performance_indicator" value="Expenditure" readonly>
                </div>

                <!-- Contracted target, Quarters, Total, Percentage fields for Public Expenditure Tasks -->
                <div class="form-group col-md-6">
                    <label for="expenditureContractedTarget">Contracted target:</label>
                    <input type="number" class="form-control expenditure-form-control" id="expenditureContractedTarget" name="contracted_target" step="0.01">
                </div>
                <!-- Other quarter fields here... -->
                <!-- 1st Quarter -->
                @can('1st quarter Create')
                <div class="form-group col-md-4">
                    <label for="expenditureFirstQuarter">1st quarter:</label>
                    <input type="number" class="form-control expenditure-form-control" id="expenditureFirstQuarter" name="first_quarter" step="0.01">
                </div>
                @endcan

                <!-- 2nd Quarter -->
                @can('2nd quarter Create')
                <div class="form-group col-md-4">
                    <label for="expenditureSecondQuarter">2nd quarter:</label>
                    <input type="number" class="form-control expenditure-form-control" id="expenditureSecondQuarter" name="second_quarter" step="0.01">
                </div>
                @endcan

                <!-- 3rd Quarter -->
                @can('3rd quarter Create')
                <div class="form-group col-md-4">
                    <label for="expenditureThirdQuarter">3rd quarter:</label>
                    <input type="number" class="form-control expenditure-form-control" id="expenditureThirdQuarter" name="third_quarter" step="0.01">
                </div>
                @endcan

                <!-- 4th Quarter -->
                @can('4th quarter Create')
                <div class="form-group col-md-4">
                    <label for="expenditureFourthQuarter">4th quarter:</label>
                    <input type="number" class="form-control expenditure-form-control" id="expenditureFourthQuarter" name="fourth_quarter" step="0.01">
                </div>
                @endcan
            </div>
            <hr>
            <div class="row g-3">
                <div class="form-group col-md-3">
                    <label for="expenditureTotal">Total:</label>
                    <input type="number" class="form-control" id="expenditureTotal" name="total" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="expenditurePercentage">Percentage:</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="expenditurePercentage" name="percentage" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
                <!-- Save button -->
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

        <!-- Hidden input field to capture edit status -->
        <input type="hidden" name="is_edit" value="0">

        <!-- Hidden input field to capture user_id -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

    </form>
</div>

<script>
    $(document).ready(function() {
        // Calculate total and percentage when quarter fields change for Public Expenditure Tasks
        $('.expenditure-form-control').on('input', function() {
            var contractedTarget = parseFloat($('#expenditureContractedTarget').val()) || 0;
            var firstQuarter = parseFloat($('#expenditureFirstQuarter').val()) || 0;
            var secondQuarter = parseFloat($('#expenditureSecondQuarter').val()) || 0;
            var thirdQuarter = parseFloat($('#expenditureThirdQuarter').val()) || 0;
            var fourthQuarter = parseFloat($('#expenditureFourthQuarter').val()) || 0;

            var total = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;
            var percentage = (total / contractedTarget) * 100 || 0;

            $('#expenditureTotal').val(total.toFixed(2));
            $('#expenditurePercentage').val(percentage.toFixed(2));
        });
    });

</script>

@endcan

@endsection
