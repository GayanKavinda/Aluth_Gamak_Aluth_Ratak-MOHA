@extends('layouts.app')

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->

@section('content')

@can('performance agreement forms access')

<!-- <div class="container mt-3">
    <a href="{{ route('roles.index') }}" class="btn btn-primary mx-2">Roles</a>
    <a href="{{ route('permissions.index') }}" class="btn btn-info mx-2">Permissions</a>
    <a href="{{ route('users.index') }}" class="btn btn-success mx-2">Users</a>
    <a href="{{ route('process_agreements.index') }}" class="btn btn-danger mx-2">Index</a>
    <a href="{{ route('process_agreements.create') }}" class="btn btn-primary mx-2">Form</a>
</div> -->

<style>
    header h2 {
    color: #DE344B;
    font-weight: 600;
    /*#01CAF3/*
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
        <h2>If there are more, <span>use this part</span></h2>
    </header>
    <br>
    <form action="{{ route('process_agreements.store') }}" method="POST">
        @csrf

        <div class="card card-custom">
            <div class="card-body">
            <div class="row g-3">
        <!-- Other Details Collapse Section -->

                    <div class="form-group col-md-8">
                        <label for="otherField">Field:</label>
                        <input type="text" class="form-control" id="otherField" name="field" placeholder="Enter Field">
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                        <label for="otherTasks">Tasks expected to be performed during the year:</label>
                        <input type="text" class="form-control" id="otherTasks" name="task" placeholder="Enter Task">
                    </div>
                    <br>
                    <div class="form-group col-md-6">
                        <label for="otherPerformanceIndicator">Performance Indicator:</label>
                        <input type="text" class="form-control" id="otherPerformanceIndicator" name="performance_indicator" placeholder="Enter Performance Indicator">
                    </div>

                    <div class="form-group col-md-5">
                        <label for="otherContractedTarget">Contracted target:</label>
                        <input type="number" class="form-control" id="otherContractedTarget" name="contracted_target" placeholder="Enter Contracted Target">
                    </div>
                    <hr>

                    @can('1st quarter Create')
                    <div class="form-group col-md-4">
                        <label for="otherFirstQuarter">1st quarter:</label>
                        <input type="number" class="form-control" id="otherFirstQuarter" name="first_quarter" placeholder="Enter 1st Quarter">
                    </div>
                    @endcan

                    @can('2nd quarter Create')
                    <div class="form-group col-md-4">
                        <label for="otherSecondQuarter">2nd quarter:</label>
                        <input type="number" class="form-control" id="otherSecondQuarter" name="second_quarter" placeholder="Enter 2nd Quarter">
                    </div>
                    @endcan

                    @can('3rd quarter Create')
                    <div class="form-group col-md-4">
                        <label for="otherThirdQuarter">3rd quarter:</label>
                        <input type="number" class="form-control" id="otherThirdQuarter" name="third_quarter" placeholder="Enter 3rd Quarter">
                    </div>
                    @endcan

                    @can('4th quarter Create')
                    <div class="form-group col-md-4">
                        <label for="otherFourthQuarter">4th quarter:</label>
                        <input type="number" class="form-control" id="otherFourthQuarter" name="fourth_quarter" placeholder="Enter 4th Quarter">
                    </div>
                    @endcan
                </div>
                <hr>
                <div class="row g-3">
                    <div class="form-group col-md-3">
                        <label for="otherTotal">Total:</label>
                        <input type="number" class="form-control" id="otherTotal" name="total" readonly>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="otherPercentage">Percentage:</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="otherPercentage" name="percentage" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                    <!-- Save button for Other details section -->
                    <button type="submit" class="btn btn-primary" id="saveOtherButton">Save Other Details</button>
        </div>

<script>
    // Calculate total and percentage when quarter fields change
    $('.form-control').on('input', function() {
        var contractedTarget = parseFloat($('#otherContractedTarget').val()) || 0;
        var firstQuarter = parseFloat($('#otherFirstQuarter').val()) || 0;
        var secondQuarter = parseFloat($('#otherSecondQuarter').val()) || 0;
        var thirdQuarter = parseFloat($('#otherThirdQuarter').val()) || 0;
        var fourthQuarter = parseFloat($('#otherFourthQuarter').val()) || 0;

        var total = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;
        var percentage = (total / contractedTarget) * 100 || 0;

        $('#otherTotal').val(total.toFixed(2));
        $('#otherPercentage').val(percentage.toFixed(2));
    });

</script>

@endcan

@endsection
