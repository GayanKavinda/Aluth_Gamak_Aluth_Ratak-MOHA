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
    color: #F30131;
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
        <h2>Health and <span>Nutrition </span></h2>
    </header>
    <br>
    <form action="{{ route('process_agreements.store') }}" method="POST">
        @csrf

        <div class="card card-custom">
            <div class="card-body">
            <div class="row g-3">
            <div class="form-group col-md-6">
                <label for="field">Field:</label>
                <input type="text" class="form-control" id="field" name="field" value="Health and Nutrition" readonly>
            </div>
            <div class="form-group col-md-10">
                <label for="healthTasks">Tasks expected to be performed during the year:</label>
                <select class="form-control" id="healthTasks" name="task">
                    <option value="">Select Task</option>
                    <option value="4.1 Maintaining the nutritional status of low-income pregnant mothers with nutritional needs until delivery">4.1 Maintaining the nutritional status of low-income pregnant mothers with nutritional needs until delivery</option>
                    <option value="4.2 Increasing the nutritional level of low-income children with nutritional needs">4.2 Increasing the nutritional level of low-income children with nutritional needs</option>
                </select>
            </div>
            <br>
            <!-- Performance Indicator for Health and Nutrition Tasks -->
            <div class="form-group col-md-6">
                <label for="healthPerformanceIndicator">Performance Indicator:</label>
                <input class="form-control" type="text" id="healthPerformanceIndicator" name="performance_indicator" readonly>
            </div>

            <!-- Contracted target for Health and Nutrition Tasks -->
            <div class="form-group col-md-6">
                <label for="healthContractedTarget">Contracted target:</label>
                <input type="number" class="form-control" id="healthContractedTarget" name="contracted_target">
            </div>
<hr>
            <!-- Quarter fields for Health and Nutrition Tasks -->
            @can('1st quarter Create')
            <div class="form-group col-md-4">
                <label for="healthFirstQuarter">1st quarter:</label>
                <input type="number" class="form-control" id="healthFirstQuarter" name="first_quarter">
            </div>
            @endcan

            @can('2nd quarter Create')
            <div class="form-group col-md-4">
                <label for="healthSecondQuarter">2nd quarter:</label>
                <input type="number" class="form-control" id="healthSecondQuarter" name="second_quarter">
            </div>
            @endcan

            @can('3rd quarter Create')
            <div class="form-group col-md-4">
                <label for="healthThirdQuarter">3rd quarter:</label>
                <input type="number" class="form-control" id="healthThirdQuarter" name="third_quarter">
            </div>
            @endcan

            @can('4th quarter Create')
            <div class="form-group col-md-4">
                <label for="healthFourthQuarter">4th quarter:</label>
                <input type="number" class="form-control" id="healthFourthQuarter" name="fourth_quarter">
            </div>
            @endcan
            </div>
            <hr>
            <div class="row g-3">
            <!-- Total and Percentage fields for Health and Nutrition Tasks -->
            <div class="form-group col-md-3">
                <label for="healthTotal">Total:</label>
                <input type="number" class="form-control" id="healthTotal" name="total" readonly>
            </div>
            <div class="form-group col-md-3">
                <label for="healthPercentage">Percentage:</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="healthPercentage" name="percentage" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
            </div>
            <br>
            
            <!-- Save button -->
            <button type="submit" class="btn btn-primary">Save Health and Nutrition</button>

        <!-- Hidden input field to capture edit status -->
        <input type="hidden" name="is_edit" value="0">

        <!-- Hidden input field to capture user_id -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            </div>
        </div>
        </div>
    </form>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Show Performance Indicator input and additional fields when health and nutrition tasks are selected
        $('#healthTasks').change(function() {
            var selectedTask = $(this).val();
            if (selectedTask === '4.1 Maintaining the nutritional status of low-income pregnant mothers with nutritional needs until delivery') {
                $('#healthPerformanceIndicator').val('Number of Pregnant Mothers');
            } else if (selectedTask === '4.2 Increasing the nutritional level of low-income children with nutritional needs') {
                $('#healthPerformanceIndicator').val('Child migration facilitating improved nutrition');
            }
        });

        // Calculate total and percentage when quarter fields change for Agriculture Tasks
        $('.form-control').on('input', function() {
            var firstQuarter = parseFloat($('#healthFirstQuarter').val()) || 0;
            var secondQuarter = parseFloat($('#healthSecondQuarter').val()) || 0;
            var thirdQuarter = parseFloat($('#healthThirdQuarter').val()) || 0;
            var fourthQuarter = parseFloat($('#healthFourthQuarter').val()) || 0;

            var total = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;

            // Retrieve contracted target
            var contractedTarget = parseFloat($('#healthContractedTarget').val()) || 1; // Default to 1 to prevent division by zero

            // Calculate percentage
            var percentage = (total / contractedTarget) * 100;

            $('#healthTotal').val(total.toFixed(2));
            $('#healthPercentage').val(percentage.toFixed(2));
        });
    });
</script>

@endcan

@endsection
