@extends('layouts.app')

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->

@section('content')

<!-- Font Awesome for icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Required Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    .search-bar input.form-control {
        border-width: 2px;
        border-style: solid;
        /* border-color: #9D979A;  */
        /* Adjust the color as needed */
    }

    /* Custom styles */
    .form-inline .form-group {
            margin-right: 10px;
        }

        .form-inline label {
            margin-right: 5px;
        }

        .form-inline .form-control {
            font-size: 0.9rem; /* Adjusted font size for dropdown fields */
            width: auto;
        }

        .form-inline .btn {
            margin-top: 0; /* Align the buttons with the form controls */
        }

        .form-inline {
            font-size: 0.9rem; /* Overall font size adjustment */
        }

        .form-inline .form-group,
        .form-inline .btn {
            display: flex;
            align-items: center;
        }

        .form-inline .btn {
            display: inline-flex;
            align-items: center;
        }

        .form-inline .btn i,
        .form-inline .btn span {
            margin-right: 5px;
        }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">Process Agreements (Aluth Gamak Aluth Ratak)</div>

                <br>

            <div class="card-body">
            <form action="{{ route('process_agreements.index') }}" method="GET" class="search-bar">
            <div class="mb-3" style="text-align: center; color:#9733EE; font-size:13px">
                <span>** Enter search criteria to filter and display data on the dashboard. **</span>
            </div>
                    <div class="input-group input-group-sm">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search agreements...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-sm" type="submit">
                                <i class="fas fa-search"></i>
                                <span>Search</span>
                            </button>
                        </div>
                    </div>
                </form>


                <br>
                <div class="container mt-3">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <form method="GET" action="{{ route('process_agreements.index') }}" class="form-inline" id="filterForm">
                            <!-- Display district dropdown for super admins and admins -->
                            @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                            <div class="form-group mx-2">
                                <label for="district" class="mr-2">District:</label>
                                <select name="district" id="district" class="form-control">
                                    <option value="">All Districts</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district }}" @if ($userDistrict == $district) selected @endif>{{ $district }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <!-- Display year dropdown for all users -->
                            <div class="form-group mx-2">
                                <label for="year" class="mr-2">Year:</label>
                                <select name="year" id="year" class="form-control">
                                    <option value="All Years">All Years</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}" @if ($selectedYear == $year) selected @endif>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Display field dropdown -->
                            <div class="form-group mx-2">
                                <label for="field" class="mr-2">Field:</label>
                                <select name="field" id="field" class="form-control">
                                    <option value="">All Fields</option>
                                    @foreach($fields as $field)
                                        <option value="{{ $field }}" {{ $selectedField == $field ? 'selected' : '' }}>{{ $field }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i>
                                <span>Filter</span>
                            </button>
                        </form>

                        <!-- Delete All Data button -->
                        <div>
                            @role('super-admin')
                            <form id="deleteForm" action="{{ route('process_agreements.deleteFiltered') }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                <input type="hidden" name="district" value="{{ $userDistrict }}">
                                <input type="hidden" name="year" value="{{ $selectedYear }}">
                                <button type="submit" class="btn btn-grad btn-sm">
                                    <i class="fas fa-trash"></i>
                                    <span>Delete All Data</span>
                                </button>
                            </form>
                            @endrole
                        </div>
                    </div>
                </div>
            </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <!-- Contract Period section -->
                                <h5 class="card-title">Contract Period for {{ $selectedYear }}</h5>
                                <!-- Show district for super admins and admins -->
                                @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                                    @if ($userDistrict !== 'All Districts')
                                        <p>District: {{ $userDistrict }}</p>
                                    @else
                                        <p>District: All Districts</p>
                                    @endif
                                @endif
                                <!-- Show year for all users -->
                                <!-- <p>District: {{ auth()->user()->district }}</p> -->
                                <p>Year: {{ $selectedYear }}</p>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="contract-period-addon">From</span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $selectedYear }}-01-01" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">to {{ $selectedYear }}-12-31</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <!-- Progress related quarter section -->
                                <h5 class="card-title">Progress Related Quarter for {{ $selectedYear }}</h5>
                                <!-- Show district for super admins and admins -->
                                @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                                    @if ($userDistrict !== 'All Districts')
                                        <p>District: {{ $userDistrict }}</p>
                                    @else
                                        <p>District: All Districts</p>
                                    @endif
                                @endif
                                <!-- Show year for all users -->
                                <p>Year: {{ $selectedYear }}</p>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="progress-quarter-addon">From</span>
                                    </div>
                                    <input type="text" class="form-control" value="{{ $selectedYear }}-10-01" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">to {{ $selectedYear }}-12-31</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progress report table -->
                <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                    @can('create agreement')
                    <a href="{{ route('process_agreements.navigation') }}" class="btn btn-secondary btn-sm">Create Process Agreement</a>  
                    @endcan
                    <div>
                        <a href="{{ route('download.csv', ['year' => $selectedYear, 'district' => $userDistrict, 'search' => request('search'), 'field' => request('field')]) }}" class="btn btn-primary btn-sm glow-star" style="background-color: #0BAF8C; color: #ffffff;">
                            <box-icon name='paper-plane' type='solid' animation='tada' color='#ffffff' style="vertical-align: middle; margin-right: 5px;"></box-icon>
                            <span style="vertical-align: middle;">Download CSV</span>
                        </a>
                        <a href="{{ route('download.excel', ['year' => $selectedYear, 'district' => $userDistrict, 'search' => request('search'), 'field' => request('field')]) }}" class="btn btn-success btn-sm glow-star">
                            <box-icon name='spreadsheet' type='solid' animation='flashing' color='#ffffff' style="vertical-align: middle; margin-right: 5px;"></box-icon>
                            <span style="vertical-align: middle;">Download Excel</span>
                        </a>
                        <a href="{{ route('download.pdf', ['year' => $selectedYear, 'district' => $userDistrict, 'search' => request('search'), 'field' => request('field')]) }}" class="btn-grade btn-sm glow-star">
                            <box-icon name='file-pdf' type='solid' animation='spin' color='#ffffff' style="vertical-align: middle; margin-right: 5px;"></box-icon>
                            <span style="vertical-align: middle;">Download PDF</span>
                        </a>
                    </div>
                </div>
             
                    <hr>

                    @if ($processAgreements->isEmpty())
                        <p>No process agreements found.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <!-- Hide district column header for primary users -->
                                        @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                                            <th>User Name and Email Address</th>
                                        @endif

                                        <!-- Hide district column header for primary users -->
                                        @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                                            <th>district</th>
                                        @endif

                                        <th>Field</th>
                                        <th>Task</th>
                                        <th>Performance Indicator</th>
                                        <th>Contracted Target</th>
                                        <th>1st Quarter</th>
                                        <th>2nd Quarter</th>
                                        <th>3rd Quarter</th>
                                        <th>4th Quarter</th>
                                        <th>Total</th>
                                        <th>Percentage</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($processAgreements->reverse() as $processAgreement)
                                        <tr>
                                            <td><span style="font-size: 13.5px;">{{ $processAgreement->id }}</td>
                                            <!-- Check if the user is a super admin or admin before displaying user information -->
                                            @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                                                <td><span style="font-size: 13.5px;">{{ $processAgreement->user->name }} ({{ $processAgreement->user->email }})</td>
                                            @endif
                                            
                                            <!-- Conditionally display district column for super admin and admin -->
                                            @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                                                <td><span style="font-size: 13.5px;">{{ $processAgreement->user->district ?? '-' }}</td>
                                            @endif

                                            <td><span style="font-size: 13.5px;">{{ $processAgreement->field }}</td>
                                            <td><span style="font-size: 13.5px;">{{ $processAgreement->task }}</td>
                                            <td><span style="font-size: 13.5px;">{{ $processAgreement->performance_indicator ?? '-' }}</td>
                                            <td><span style="font-size: 13.5px;">{{ $processAgreement->contracted_target ?? '-' }}</td>
                                            <td><span style="font-size: 13.5px;">{{ $processAgreement->first_quarter ?? '-' }}</td>
                                            <td><span style="font-size: 13.5px;">{{ $processAgreement->second_quarter ?? '-' }}</td>
                                            <td><span style="font-size: 13.5px;">{{ $processAgreement->third_quarter ?? '-' }}</td>
                                            <td><span style="font-size: 13.5px;">{{ $processAgreement->fourth_quarter ?? '-' }}</td>
                                            <td><span style="font-size: 13.5px;">{{ $processAgreement->total ?? '-' }}</td>
                                            <td><span style="font-size: 13.5px;">{{ $processAgreement->percentage }}%</td> <!-- Display percentage with % symbol -->
                                            <td>
                                            <div class="btn-group" role="group" aria-label="Action buttons">
                                            @can('view agreement')
                                                <a href="{{ route('process_agreements.show', $processAgreement->id) }}" class="btn btn-outline-primary btn-sm mr-1">
                                                    <box-icon name='check-shield' type='solid' color='#0ca042'></box-icon> View
                                                </a>
                                            @endcan

                                            @can('update agreement')
                                                <a href="{{ route('process_agreements.edit', $processAgreement->id) }}" class="btn btn-outline-warning btn-sm mr-1">
                                                    <box-icon name='edit' type='solid' color='#9a600c'></box-icon> Edit
                                                </a>
                                            @endcan
                                                <form action="{{ route('process_agreements.destroy', $processAgreement->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                            @can('delete agreement')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this process agreement?')">
                                                        <box-icon name='tired' type='solid' color='#9f0b0b'></box-icon> Delete
                                                    </button>
                                            @endcan
                                                </form>
                                            </div>
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <!-- First Page Button -->
                                <li class="page-item">
                                    <a class="page-link" href="#" id="firstPageBtn" aria-label="First">
                                        First
                                    </a>
                                </li>
                                <!-- Pagination Links -->
                                <!-- Previous Page Button -->
                                <li class="page-item {{ $processAgreements->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $processAgreements->previousPageUrl() }}" aria-label="Previous">
                                        Previous
                                    </a>
                                </li>
                                <!-- Page Numbers -->
                                @for ($i = 1; $i <= $processAgreements->lastPage(); $i++)
                                    <li class="page-item {{ $i == $processAgreements->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $processAgreements->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <!-- Next Page Button -->
                                <li class="page-item {{ !$processAgreements->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $processAgreements->nextPageUrl() }}" aria-label="Next">
                                        Next
                                    </a>
                                </li>
                                <!-- Last Page Button -->
                                <li class="page-item">
                                    <a class="page-link" href="#" id="lastPageBtn" aria-label="Last">
                                        Last
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    @endif     
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <style>
    .table-sm td {
    font-size: 14px;
    }
</style> -->

<script>
    // Function to fetch workplaces based on the selected district
    function fetchWorkplaces(district) {
        // Fetch workplaces via AJAX
        $.ajax({
            url: "{{ route('fetch.workplaces') }}",
            method: 'GET',
            data: {
                district: district
            },
            success: function(response) {
                // Clear existing options
                $('#workplace').empty();
                // Add default option
                $('#workplace').append('<option value="">Select Workplace</option>');
                // Add fetched workplaces as options
                $.each(response.workplaces, function(key, value) {
                    $('#workplace').append('<option value="' + key + '">' + value + '</option>');
                });
            }
        });
    }

    // Document ready function
    $(document).ready(function() {
        // Fetch workplaces when district dropdown value changes
        $('#district').change(function() {
            var district = $(this).val();
            fetchWorkplaces(district);
        });

        // Fetch workplaces initially if district is pre-selected
        var selectedDistrict = $('#district').val();
        if (selectedDistrict) {
            fetchWorkplaces(selectedDistrict);
        }
    });

    // Function to navigate to the first page
    $('#firstPageBtn').click(function(e) {
        e.preventDefault();
        window.location.href = '{{ $processAgreements->url(1) }}';
    });

    // Function to navigate to the last page
    $('#lastPageBtn').click(function(e) {
        e.preventDefault();
        window.location.href = '{{ $processAgreements->url($processAgreements->lastPage()) }}';
    });

    // Function to confirm delete action
    function confirmDelete() {
        return confirm('Are you sure you want to delete the filtered data?');
    }

    function confirmDelete() {
        // Prompt the admin to type the confirmation phrase
        let confirmation = prompt("To confirm deletion, type 'DELETE':");
        
        // Check if the admin typed the correct phrase
        if (confirmation !== null && confirmation.toUpperCase() === 'DELETE') {
            return true; // Proceed with form submission
        } else {
            alert("Deletion cancelled or incorrect confirmation phrase.");
            return false; // Cancel form submission
        }
    }

</script>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<style>
             
.btn-grad {
    background-image: linear-gradient(to right, #DA22FF 0%, #9733EE  51%, #DA22FF  100%);
    margin: 10px;
    padding: 6px 12px; /* Adjusted padding for a smaller button */
    text-align: center;
    text-transform: uppercase;
    transition: 0.5s;
    background-size: 200% auto;
    color: white;            
    box-shadow: 0 0 20px #eee;
    border-radius: 10px;
    display: block;
}

.btn-grad:hover {
    background-position: right center; /* change the direction of the change here */
    color: #fff;
    text-decoration: none;
}

.btn-grade {
        background-image: linear-gradient(to right, #D31027 0%, #EA384D 51%, #D31027 100%);
        /* margin: 10px; */
        padding: 5px 15px; /* Adjust padding for a smaller size */
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
        box-shadow: 0 0 20px #eee;
        /* border-radius: 10px; */
        display: inline-block; /* Changed to inline-block for proper sizing */
        font-size: 12px; /* Adjust font size for smaller button */
    }

    .btn-grade:hover {
        background-position: right center;
        color: #fff;
        text-decoration: none;
    }       
        
</style>
@endsection
