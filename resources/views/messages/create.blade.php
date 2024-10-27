@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- First Card: Filter section -->
            <!-- <div class="card">
                <div class="container mt-3">
                    <a href="{{ route('roles.index') }}" class="btn btn-primary mx-2">Roles</a>
                    <a href="{{ route('permissions.index') }}" class="btn btn-info mx-2">Permissions</a>
                    <a href="{{ route('users.index') }}" class="btn btn-success mx-2">Users</a>
                    <a href="{{ route('process_agreements.index') }}" class="btn btn-danger mx-2">Index</a>
                    <a href="{{ route('process_agreements.create') }}" class="btn btn-primary mx-2">Form</a>
                    <a href="{{ route('messages.index') }}" class="btn btn-info mx-2">Message index</a>
                    <hr>
                    <a href="{{ route('messages.create') }}" class="btn btn-info mx-2">Message Create</a>
                    <hr>
                </div>
            </div> -->
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Second Card: Create Message section (Only visible for admin users) -->
            @if(auth()->check() && (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin')))
            <div class="card">
                <div class="card-header">{{ __('Create Message') }}</div>
                <div class="card-body">
                    <!-- Check if the user is authenticated and is an admin -->
                    @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                        <!-- Existing form for sending messages -->
                        <form method="POST" action="{{ route('messages.store') }}">
                            @csrf

                            <!-- Include district dropdown for super admins and admins -->
                            <div class="form-group">
                                <label for="district">District:</label>
                                <select name="district" id="district" class="form-control">
                                    <option value="All Districts">All Districts</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district }}">{{ $district }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="workplaceField" style="display: none;">
                                <div class="form-group" id="workplaceGroup">
                                    <label for="workplace">Work Place:</label>
                                    <select class="form-control" id="workplace" name="workplace">
                                        <option value="" disabled selected>Select Workplace</option>
                                        <!-- Workplace options will be populated dynamically via AJAX -->
                                    </select>
                                </div>
                            </div>

                            <div id="emailField" style="display: none;">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="subject">Subject:</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>

                            <div class="form-group">
                                <label for="body">Message:</label>
                                <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" id="sendMessageButton">Send Message</button>
                        </form>
                    @endif
                </div>
            </div>
            @endif
<hr>
            <!-- Third Card: New form for sending message to all districts -->
            <div class="card">
                <div class="card-header">Send Message to All Districts</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('messages.sendToAll') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="subjectAll">Subject:</label>
                            <input type="text" class="form-control" id="subjectAll" name="subjectAll" required>
                        </div>

                        <div class="form-group">
                            <label for="bodyAll">Message:</label>
                            <textarea class="form-control" id="bodyAll" name="bodyAll" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" id="sendMessageAllButton">Send Message to All Districts</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    // Disable the "Select Workplace" option
    document.getElementById('workplace').addEventListener('change', function() {
        var selectWorkplaceOption = this.querySelector('option[value=""]');
        selectWorkplaceOption.disabled = true;
    });
    
    // Function to fetch and populate the workplace dropdown based on the selected district
    function updateWorkplaceDropdown(selectedDistrict) {
        if (selectedDistrict !== 'All Districts') {
            $.ajax({
                url: '{{ route("fetch.workplaces") }}',
                type: 'GET',
                data: { district: selectedDistrict },
                success: function(response) {
                    $('#workplace').empty(); // Clear existing options
                    $('#workplace').append($('<option>', { value: '', text: 'Select Workplace' })); // Add default option
                    response.workplaces.forEach(function(workplace) {
                        $('#workplace').append($('<option>', { value: workplace, text: workplace }));
                    });
                    $('#workplaceField').show(); // Show the workplace field
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            $('#workplaceField').hide(); // Hide the workplace field if All Districts is selected
            $('#emailField').hide(); // Also hide the email field
        }
    }

    // Function to fetch and populate the email field based on the selected district and workplace
    function updateEmailField(selectedDistrict, selectedWorkplace) {
        if (selectedDistrict !== 'All Districts' && selectedWorkplace) {
            $.ajax({
                url: '{{ route("fetch.user.email") }}',
                type: 'GET',
                data: { district: selectedDistrict, workplace: selectedWorkplace },
                success: function(response) {
                    if (response.email) {
                        $('#email').val(response.email); // Populate the email field
                        $('#emailField').show(); // Show the email field
                    } else {
                        // If no email is found, clear the email field and hide it
                        $('#email').val('');
                        $('#emailField').hide();
                        console.error('No email found for the selected district and workplace.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            // If either district or workplace is not selected, hide the email field
            $('#email').val('');
            $('#emailField').hide();
        }
    }

    // Handle district change event
    $('#district').change(function() {
        var selectedDistrict = $(this).val();
        updateWorkplaceDropdown(selectedDistrict); // Update the workplace dropdown
        updateEmailField(selectedDistrict, $('#workplace').val()); // Update the email field
    });

    // Handle workplace change event
    $('#workplace').change(function() {
        var selectedDistrict = $('#district').val();
        var selectedWorkplace = $(this).val();
        updateEmailField(selectedDistrict, selectedWorkplace); // Update the email field
    });

    // Initial call to update the workplace dropdown and email field based on the default selected district and workplace
    var defaultDistrict = $('#district').val();
    updateWorkplaceDropdown(defaultDistrict);
    updateEmailField(defaultDistrict, $('#workplace').val());
</script>

@endsection

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->
