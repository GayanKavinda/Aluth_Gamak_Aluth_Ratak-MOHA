@extends('layouts.app')

@section('content')

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->

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
        <h2>Agriculture <span>Section </span></h2>
    </header>
    <br>
    <form action="{{ route('process_agreements.store') }}" method="POST">
        @csrf

        <div class="card card-custom">
            <div class="card-body">
            <div class="row g-3">
            <div class="form-group col-md-6">
                <label for="field" class="label-custom">Field:</label>
                <input type="text" class="form-control" id="field" name="field" value="Agriculture" readonly>
            </div>
            <br>
            <div class="form-group col-md-6">
                <label for="agricultureTasks" class="label-custom">Tasks expected to be performed during the year:</label>
                <input type="text" class="form-control" id="agricultureTasks" name="task" value="5.1 Sustainable garden design" readonly>
            </div>
            <br>
            <!-- Performance Indicator for Agriculture Tasks -->
            <div class="form-group col-md-6">
                <label for="agriculturePerformanceIndicator" class="label-custom">Performance Indicator:</label>
                <input class="form-control" type="text" id="agriculturePerformanceIndicator" name="performance_indicator" readonly>
            </div>     
            
            <!-- Contracted target for Agriculture Tasks -->
            <div class="form-group col-md-6">
                <label for="agricultureContractedTarget" class="label-custom">Contracted target:</label>
                <input type="number" class="form-control" id="agricultureContractedTarget" name="contracted_target" step="0.01">
            </div>
            <hr>
            
            <!-- Quarter fields for Agriculture Tasks -->
            @can('1st quarter Create')
            <div class="form-group col-md-4">
                <label for="agricultureFirstQuarter" class="label-custom">1st quarter:</label>
                <input type="number" class="form-control" id="agricultureFirstQuarter" name="first_quarter" step="0.01">
            </div>
            @endcan

            @can('2nd quarter Create')
            <div class="form-group col-md-4">
                <label for="agricultureSecondQuarter" class="label-custom">2nd quarter:</label>
                <input type="number" class="form-control" id="agricultureSecondQuarter" name="second_quarter" step="0.01">
            </div>
            @endcan

            @can('3rd quarter Create')
            <div class="form-group col-md-4">
                <label for="agricultureThirdQuarter" class="label-custom">3rd quarter:</label>
                <input type="number" class="form-control" id="agricultureThirdQuarter" name="third_quarter" step="0.01">
            </div>
            @endcan

            @can('4th quarter Create')
            <div class="form-group col-md-4">
                <label for="agricultureFourthQuarter" class="label-custom">4th quarter:</label>
                <input type="number" class="form-control" id="agricultureFourthQuarter" name="fourth_quarter" step="0.01">
            </div>
            @endcan
        </div>  
        <hr>
        <div class="row g-3">
            <!-- Total and Percentage fields for Agriculture Tasks -->
            <div class="form-group col-md-3">
                <label for="agricultureTotal">Total:</label>
                <input type="number" class="form-control" id="agricultureTotal" name="total" readonly>
            </div>

            <div class="form-group col-md-3">
                <label for="agriculturePercentage">Percentage:</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="agriculturePercentage" name="percentage" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
        </div>
        <br>
            <!-- Save button -->
            <button type="submit" class="btn btn-primary btn-custom">Save Agriculture</button>

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
        // Show Performance Indicator input and additional fields when agriculture tasks are selected
        $('#agriculturePerformanceIndicator').val('Number of Gardens');

        // Calculate total and percentage when quarter fields change for Agriculture Tasks
        $('.form-control').on('input', function() {
            var firstQuarter = parseFloat($('#agricultureFirstQuarter').val()) || 0;
            var secondQuarter = parseFloat($('#agricultureSecondQuarter').val()) || 0;
            var thirdQuarter = parseFloat($('#agricultureThirdQuarter').val()) || 0;
            var fourthQuarter = parseFloat($('#agricultureFourthQuarter').val()) || 0;

            var total = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;

            // Retrieve contracted target
            var contractedTarget = parseFloat($('#agricultureContractedTarget').val()) || 1; // Default to 1 to prevent division by zero

            // Calculate percentage
            var percentage = (total / contractedTarget) * 100;

            $('#agricultureTotal').val(total.toFixed(2));
            $('#agriculturePercentage').val(percentage.toFixed(2));
        });
    });
</script>

@endcan
@endsection
