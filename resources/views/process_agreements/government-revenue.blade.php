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
        <h2>Government <span>Revenue </span></h2>
    </header>
    <br>
    <form action="{{ route('process_agreements.store') }}" method="POST">
        @csrf

        <!-- New section for Government Revenue -->
        <div class="card card-custom">
            <div class="card-body">
            <div class="row g-3">
                <div class="form-group col-md-4">
                    <label for="field">Field:</label>
                    <input type="text" class="form-control" id="field" name="field" value="Government Revenue" readonly>
                </div>
                <br>
                <div class="form-group col-md-6">
                    <label for="revenueTasks">Tasks expected to be performed during the year:</label>
                    <select class="form-control" id="revenueTasks" name="task">
                        <option value="">Select Task</option>
                        <option value="7.1 Increase in government revenue">7.1 Increase in government revenue</option>
                        <option value="7.2 Increasing state revenue through district coffee plantation">7.2 Increasing state revenue through district coffee plantation</option>
                        <option value="7.3 Income from tourist bungalows run by the concerned District Secretariat">7.3 Income from tourist bungalows run by the concerned District Secretariat</option>
                    </select>
                </div>
                <br>
                <!-- Performance Indicator for Government Revenue Tasks -->
                <div class="form-group col-md-6">
                    <label for="revenuePerformanceIndicator">Performance Indicator:</label>
                    <input class="form-control" type="text" id="revenuePerformanceIndicator" name="performance_indicator" readonly>
                </div>

                <!-- Contracted target, Quarters, Total, Percentage fields for Government Revenue Tasks -->
                <div class="form-group col-md-6">
                    <label for="revenueContractedTarget">Contracted target:</label>
                    <input type="number" class="form-control revenue-form-control" id="revenueContractedTarget" name="contracted_target" step="0.01">
                </div>
                <hr>
                <!-- Other quarter fields here... -->
                <!-- 1st Quarter -->
                @can('1st quarter Create')
                <div class="form-group col-md-4">
                    <label for="revenueFirstQuarter">1st quarter:</label>
                    <input type="number" class="form-control revenue-form-control" id="revenueFirstQuarter" name="first_quarter" step="0.01">
                </div>
                @endcan

                <!-- 2nd Quarter -->
                @can('2nd quarter Create')
                <div class="form-group col-md-4">
                    <label for="revenueSecondQuarter">2nd quarter:</label>
                    <input type="number" class="form-control revenue-form-control" id="revenueSecondQuarter" name="second_quarter">
                </div>
                @endcan

                <!-- 3rd Quarter -->
                @can('3rd quarter Create')
                <div class="form-group col-md-4">
                    <label for="revenueThirdQuarter">3rd quarter:</label>
                    <input type="number" class="form-control revenue-form-control" id="revenueThirdQuarter" name="third_quarter">
                </div>
                @endcan

                <!-- 4th Quarter -->
                @can('4th quarter Create')
                <div class="form-group col-md-4">
                    <label for="revenueFourthQuarter">4th quarter:</label>
                    <input type="number" class="form-control revenue-form-control" id="revenueFourthQuarter" name="fourth_quarter">
                </div>
                @endcan
            </div>
                <hr>
                <div class="row g-3">
                <div class="form-group col-md-3">
                    <label for="revenueTotal">Total:</label>
                    <input type="number" class="form-control" id="revenueTotal" name="total" readonly>
                </div>
                <div class="form-group col-md-3">
                    <label for="revenuePercentage">Percentage:</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="revenuePercentage" name="percentage" readonly>
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>
                </div>
                <br>
                <!-- Save button -->
                <button type="submit" class="btn btn-primary">Save Government Revenue</button>
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
        // Show Performance Indicator input and additional fields when revenue tasks are selected
        $('#revenueTasks').change(function() {
            var selectedTask = $(this).val();
            if (selectedTask === '7.1 Increase in government revenue') {
                $('#revenuePerformanceIndicator').val('Improved tax collection and fiscal policies');
            } else if (selectedTask === '7.2 Increasing state revenue through district coffee plantation') {
                $('#revenuePerformanceIndicator').val('Expansion and efficient management of coffee plantations');
            } else if (selectedTask === '7.3 Income from tourist bungalows run by the concerned District Secretariat') {
                $('#revenuePerformanceIndicator').val('Increased occupancy and revenue from tourist bungalows');
            }
        });

        // Calculate total and percentage when quarter fields change for Revenue Tasks
        $('.revenue-form-control').on('input', function() {
            var contractedTarget = parseFloat($('#revenueContractedTarget').val()) || 0;
            var firstQuarter = parseFloat($('#revenueFirstQuarter').val()) || 0;
            var secondQuarter = parseFloat($('#revenueSecondQuarter').val()) || 0;
            var thirdQuarter = parseFloat($('#revenueThirdQuarter').val()) || 0;
            var fourthQuarter = parseFloat($('#revenueFourthQuarter').val()) || 0;

            var total = firstQuarter + secondQuarter + thirdQuarter + fourthQuarter;
            var percentage = (total / contractedTarget) * 100 || 0;

            $('#revenueTotal').val(total.toFixed(2));
            $('#revenuePercentage').val(percentage.toFixed(2));
        });
    });

</script>

@endcan

@endsection
