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
        <h2>Environment <span>Section </span></h2>
    </header>
    <form action="{{ route('process_agreements.store') }}" method="POST">
        @csrf

        <div class="card card-custom">
            <div class="card-body">
            <div class="row g-3">
            <!-- Field for Environment -->
            <div class="form-group col-md-6">
                <label for="field">Field:</label>
                <input type="text" class="form-control" id="field" name="field" value="Environment" readonly>
            </div>
            <br>    
            <!-- Tasks for Environment -->
            <div class="form-group col-md-6">
                <label for="environmentTasks">Tasks expected to be performed during the year:</label>
                <input type="text" class="form-control" id="environmentTasks" name="task" value="6.1 Carrying out planting projects that contribute to environmental conservation/ including urban forestry" readonly>
            </div>
            <br>
            <!-- Performance Indicator for Environment -->
            <div class="form-group col-md-6">
                <label for="environmentPerformanceIndicator">Performance Indicator:</label>
                <input class="form-control" type="text" id="environmentPerformanceIndicator" name="performance_indicator" readonly>
            </div>

            <!-- Contracted target, Quarters, Total, Percentage fields for Environment -->
            <div class="form-group col-md-6">
                <label for="environmentContractedTarget">Contracted target:</label>
                <input type="number" class="form-control" id="environmentContractedTarget" name="contracted_target">
            </div>
            <hr>

            @can('1st quarter Create')
            <div class="form-group col-md-4">
                <label for="environmentFirstQuarter">1st quarter:</label>
                <input type="number" class="form-control" id="environmentFirstQuarter" name="first_quarter">
            </div>
            @endcan

            @can('2nd quarter Create')
            <div class="form-group col-md-4">
                <label for="environmentSecondQuarter">2nd quarter:</label>
                <input type="number" class="form-control" id="environmentSecondQuarter" name="second_quarter">
            </div>
            @endcan

            @can('3rd quarter Create')
            <div class="form-group col-md-4">
                <label for="environmentThirdQuarter">3rd quarter:</label>
                <input type="number" class="form-control" id="environmentThirdQuarter" name="third_quarter">
            </div>
            @endcan

            @can('4th quarter Create')
            <div class="form-group col-md-4">
                <label for="environmentFourthQuarter">4th quarter:</label>
                <input type="number" class="form-control" id="environmentFourthQuarter" name="fourth_quarter">
            </div>
            @endcan
            <hr>
            <div class="row g-3">
            <div class="form-group col-md-3">
                <label for="environmentTotal">Total:</label>
                <input type="number" class="form-control" id="environmentTotal" name="total" readonly>
            </div>
            <div class="form-group col-md-3">
                <label for="environmentPercentage">Percentage:</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="environmentPercentage" name="percentage" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            </div>
            <br>
                    <!-- Save button -->
                    <button type="submit" class="btn btn-primary btn-custom" >Save</button>

                    <!-- Hidden input fields -->
                    <input type="hidden" name="is_edit" value="0">
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                </div>
            </div>    
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Show Performance Indicator input and additional fields when agriculture tasks are selected
        $('#environmentPerformanceIndicator').val('Number of Project');

        // Calculate total and percentage when quarter fields change for Agriculture Tasks
        $('.form-control').on('input', function() {
            var firstQuarter = parseFloat($('#environmentFirstQuarter').val()) || 0;
            var secondQuarter = parseFloat($('#environmentSecondQuarter').val()) || 0;
            var thirdQuarter = parseFloat($('#environmentThirdQuarter').val()) || 0;
            var fourthQuarter = parseFloat($('#environmentFourthQuarter').val()) || 0;

            var total = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;

            // Retrieve contracted target
            var contractedTarget = parseFloat($('#environmentContractedTarget').val()) || 1; // Default to 1 to prevent division by zero

            // Calculate percentage
            var percentage = (total / contractedTarget) * 100;

            $('#environmentTotal').val(total.toFixed(2));
            $('#environmentPercentage').val(percentage.toFixed(2));
        });
    });
</script>

@endcan

@endsection
