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
    color: #F3D201;
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
        <h2>Social <span>Section </span></h2>
    </header>
    <br>
    <form action="{{ route('process_agreements.store') }}" method="POST">
        @csrf

        <div class="card card-custom">
            <div class="card-body">
            <div class="row g-3">
                <div class="form-group col-md-4">
                    <label for="field">Field:</label>
                    <input type="text" class="form-control" id="field" name="field" value="Social" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="socialTasks">Tasks expected to be performed during the year:</label>
                    <select class="form-control" id="socialTasks" name="task">
                        <option value="">Select Task</option>
                        <option value="2.1 Getting children who do not go to school">2.1 Getting children who do not go to school</option>
                        <option value="2.2 Liberating and socializing those who are victims of drugs">2.2 Liberating and socializing those who are victims of drugs</option>
                        <option value="2.3 Liberating and socializing families selling illegal drugs">2.3 Liberating and socializing families selling illegal drugs</option>
                    </select>
                </div>
                <br>

                <!-- Performance Indicator for Social Tasks -->
                <div class="form-group col-md-6">
                    <label for="socialPerformanceIndicator">Performance Indicator:</label>
                    <input class="form-control" type="text" id="socialPerformanceIndicator" name="performance_indicator" readonly>
                </div>

                <!-- Contracted target, Quarters, Total, Percentage fields for Social Tasks -->
                <div class="form-group col-md-6">
                    <label for="socialContractedTarget">Contracted target:</label>
                    <input type="number" class="form-control" id="socialContractedTarget" name="contracted_target">
                </div>
                <br>

                <!-- Other quarter fields here... -->
                @can('1st quarter Create')
                <div class="form-group col-md-4">
                    <label for="socialFirstQuarter">1st quarter:</label>
                    <input type="number" class="form-control" id="socialFirstQuarter" name="first_quarter">
                </div>
                @endcan

                @can('2nd quarter Create')
                <div class="form-group col-md-4">
                    <label for="socialSecondQuarter">2nd quarter:</label>
                    <input type="number" class="form-control" id="socialSecondQuarter" name="second_quarter">
                </div>
                @endcan

                @can('3rd quarter Create')
                <div class="form-group col-md-4">
                    <label for="socialThirdQuarter">3rd quarter:</label>
                    <input type="number" class="form-control" id="socialThirdQuarter" name="third_quarter">
                </div>
                @endcan

                @can('4th quarter Create')
                <div class="form-group col-md-4">
                    <label for="socialFourthQuarter">4th quarter:</label>
                    <input type="number" class="form-control" id="socialFourthQuarter" name="fourth_quarter">
                </div>
                @endcan
            </div>
            <hr>
            <div class="row g-3">
                <div class="form-group col-md-3">
                    <label for="socialTotal">Total:</label>
                    <input type="number" class="form-control" id="socialTotal" name="total" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="socialPercentage">Percentage:</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="socialPercentage" name="percentage" readonly>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
    // Show Performance Indicator input and additional fields when social tasks are selected
    $('#socialTasks').change(function() {
        var selectedTask = $(this).val();
        if (selectedTask === '2.1 Getting children who do not go to school') {
            $('#socialPerformanceIndicator').val('Migration of school-going children');
        } else if (selectedTask === '2.2 Liberating and socializing those who are victims of drugs' || selectedTask === '2.3 Liberating and socializing families selling illegal drugs') {
            $('#socialPerformanceIndicator').val('Drug-free and social transition');
        }
    });

    // Calculate total and percentage when quarter fields change for Social Tasks
    $('.form-control').on('input', function() {
        var contractedTarget = parseFloat($('#socialContractedTarget').val()) || 0;
        var firstQuarter = parseFloat($('#socialFirstQuarter').val()) || 0;
        var secondQuarter = parseFloat($('#socialSecondQuarter').val()) || 0;
        var thirdQuarter = parseFloat($('#socialThirdQuarter').val()) || 0;
        var fourthQuarter = parseFloat($('#socialFourthQuarter').val()) || 0;

        var total = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;
        var percentage = (total / contractedTarget) * 100 || 0;

        $('#socialTotal').val(total.toFixed(2));
        $('#socialPercentage').val(percentage.toFixed(2));
    });
});


</script>

@endcan
@endsection
