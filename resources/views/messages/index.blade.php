@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Message section -->
    <div class="alert alert-info" role="alert" id="user-message" style="display: none;">
        <strong>Important:</strong> This messages will be removed after two weeks. Please check your messages regularly. If you have any Issues Contact Ministry of Home Affairs Development Division.
    </div>

    <div class="row">
        <!-- Left side for selecting user -->
        <div class="col-md-3">    
            <div class="card">
                <div class="card-header">{{ __('Select User') }}</div>
                <div class="card-body">
                    @php
                        $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'dark'];
                        $colorIndex = 0;
                    @endphp
                    @foreach($users as $user)
                        <button type="button" class="btn btn-{{ $colors[$colorIndex % count($colors)] }} mb-2 user-btn" data-user-id="{{ $user->id }}">
                            {{ $user->name }} - {{ $user->district }} - {{ $user->workplace }}
                        </button>
                        @php
                            $colorIndex++;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Middle section for displaying messages -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ __('Messages') }}
                </div>
                <div class="card-body" id="user-messages">
                    <!-- Messages for the selected user will be displayed here -->
                </div>
            </div>
        </div> 

        <!-- Right side for delete buttons -->
        @if(auth()->user()->hasRole('super-admin'))
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    {{ __('Delete Messages') }}
                </div>
                <div class="card-body">
                        <button class="btn btn-sm btn-danger mb-2" id="deleteAllBtn">Delete Single User Message</button>                   
                        <button class="btn btn-sm custom-color-btn" id="deleteAllUsersMessagesBtn">Delete All Users' Messages</button>
                </div>
            </div>
        </div> 
        @endif
    </div>
</div>

<style>
    .user-btn {
        font-size: 13px; /* Adjust the font size as needed */
    }

    /* Custom color button */
    .custom-color-btn {
        background-color: #5F13B4;
        color: #fff;
        border-color: #5F13B4;
    }

    /* Animation */
    @keyframes fadeInOut {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }

    .slide-up-down {
        animation: slideUpDown 0.5s ease-in-out;
    }

    .alert {
        animation: fadeInOut 2s infinite;
    }

    /* Animation */
    @keyframes bounceUpDown {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .alert {
        animation: bounceUpDown 1s infinite;
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var selectedUserId;

    $(document).ready(function() {
        // Show the message section with a "bump" effect
        $('#user-message').slideDown();
        
        $('.user-btn').click(function() {
            selectedUserId = $(this).data('user-id');
            fetchUserMessages(selectedUserId);
        });

        $('#deleteAllBtn').click(function() {
            if (confirm('Are you sure you want to delete all messages for the selected user?')) {
                deleteAllMessages(selectedUserId);
            }
        });

        $('#deleteAllUsersMessagesBtn').click(function() {
            if (confirm('Are you sure you want to delete all messages for all users?')) {
                deleteAllUsersMessages();
            }
        });
    });

    function fetchUserMessages(userId) {
        $.ajax({
            url: '/messages/' + userId,
            type: 'GET',
            success: function(response) {
                displayUserMessages(response.userMessages);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function displayUserMessages(userMessages) {
        var messagesHtml = '';
        if (userMessages.length === 0) {
            messagesHtml = '<p>No messages found</p>';
        } else {
            $.each(userMessages, function(index, message) {
                messagesHtml += '<div class="message">';
                messagesHtml += '<p><strong>Subject:</strong> ' + message.subject + '</p>';
                messagesHtml += '<p><strong>Body:</strong> ' + message.body + '</p>';
                messagesHtml += '</div>';
            });
        }
        $('#user-messages').html(messagesHtml);
    }

    function deleteAllMessages(userId) {
        $.ajax({
            url: '/messages/' + userId + '/delete-all',
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('All messages deleted successfully.');
                fetchUserMessages(userId); // Refresh messages after deletion
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Failed to delete messages. Please try again.');
            }
        });
    }

    function deleteAllUsersMessages() {
        $.ajax({
            url: '/messages/delete-all-users-messages',
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('All users\' messages deleted successfully.');
                // Optionally, refresh the page or update UI
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Failed to delete users\' messages. Please try again.');
            }
        });
    }
</script>
@endsection

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->
