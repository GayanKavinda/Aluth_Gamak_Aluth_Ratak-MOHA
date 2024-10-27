@extends('layouts.app')

@section('content')

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->

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
    color: #F040DB;
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
            <h2>Economic <span>Section </span></h2>
    </header>
    <br>
    <form action="{{ route('process_agreements.store') }}" method="POST">
        @csrf

        <div class="card card-custom">
        <div class="card-body">
        <div class="row g-3">
            <div class="form-group col-md-6">
                <label for="field">Field:</label>
                <input type="text" class="form-control" id="field" name="field" value="Economic" readonly>
            </div>
            
            <div class="form-group col-md-6">
                <label for="economicTasks">Tasks expected to be performed during the year:</label>
                <select class="form-control" id="economicTasks" name="task">
                    <option value="">Select Task</option>
                    <option value="1.1 Creation of small scale or medium scale entrepreneurs">1.1 Creation of small scale or medium scale entrepreneurs</option>
                    <option value="1.2 Creation of industrial or agricultural export products">1.2 Creation of industrial or agricultural export products</option>
                </select>
            </div>

            <!-- Performance Indicator for Economic Tasks -->
            <div class="form-group col-md-6">
                <label for="economicPerformanceIndicator">Performance Indicator:</label>
                <input class="form-control" type="text" id="economicPerformanceIndicator" name="performance_indicator" readonly>
            </div>

            <!-- Contracted target, Quarters, Total, Percentage fields for Economic Tasks -->
            <div class="form-group col-md-6">
                <label for="economicContractedTarget">Contracted target:</label>
                <input type="number" class="form-control" id="economicContractedTarget" name="contracted_target">
            </div>
            <hr>

            <!-- Other quarter fields here... -->
            @can('1st quarter Create')
            <div class="form-group col-md-4">
                <label for="economicFirstQuarter">1st quarter:</label>
                <input type="number" class="form-control" id="economicFirstQuarter" name="first_quarter">
            </div>
            @endcan

            @can('2nd quarter Create')
            <div class="form-group col-md-4">
                <label for="economicSecondQuarter">2nd quarter:</label>
                <input type="number" class="form-control" id="economicSecondQuarter" name="second_quarter">
            </div>
            @endcan

            @can('3rd quarter Create')
            <div class="form-group col-md-4">
                <label for="economicThirdQuarter">3rd quarter:</label>
                <input type="number" class="form-control" id="economicThirdQuarter" name="third_quarter">
            </div>
            @endcan

            @can('4th quarter Create')
            <div class="form-group col-md-4">
                <label for="economicFourthQuarter">4th quarter:</label>
                <input type="number" class="form-control" id="economicFourthQuarter" name="fourth_quarter">
            </div>
            @endcan
        </div>
        <hr>
        <div class="row g-3">
            <div class="form-group col-md-3">
                <label for="economicTotal">Total:</label>
                <input type="number" class="form-control" id="economicTotal" name="total" readonly>
            </div>
            <div class="form-group col-md-3">
                <label for="economicPercentage">Percentage:</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="economicPercentage" name="percentage" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
            </div>
        </div>
        <br>
            
            <!-- Save button -->
            <button type="submit" class="btn btn-primary">Save Economic</button>

        <!-- Hidden input field to capture edit status -->
        <input type="hidden" name="is_edit" value="0">

        <!-- Hidden input field to capture user_id -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    </div>
    </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Show Performance Indicator input and additional fields when economic tasks are selected
        $('#economicTasks').change(function() {
            var selectedTask = $(this).val();
            if (selectedTask === '1.1 Creation of small scale or medium scale entrepreneurs') {
                $('#economicPerformanceIndicator').val('Number of Entrepreneurs');
            } else if (selectedTask === '1.2 Creation of industrial or agricultural export products') {
                $('#economicPerformanceIndicator').val('Number of Projects');
            }
        });

        // Calculate total and percentage when quarter fields change
        $('.form-control').on('input', function() {
            var contractedTarget = parseFloat($('#economicContractedTarget').val()) || 0;
            var firstQuarter = parseFloat($('#economicFirstQuarter').val()) || 0;
            var secondQuarter = parseFloat($('#economicSecondQuarter').val()) || 0;
            var thirdQuarter = parseFloat($('#economicThirdQuarter').val()) || 0;
            var fourthQuarter = parseFloat($('#economicFourthQuarter').val()) || 0;

            var total = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;
            var percentage = (total / contractedTarget) * 100 || 0;

            $('#economicTotal').val(total.toFixed(2));
            $('#economicPercentage').val(percentage.toFixed(2));
        });
    });
</script>

@endcan

@endsection
