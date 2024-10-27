<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link href="{{ asset('/css/sidebar.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container"></div>
    <aside class="sidebar">
        <div class="logo">
            <img src="img/gov-logo.png" alt="logo">
            <h2>Performance Agreement</h2>
        </div>
        <ul class="links">
            @can('main menu sidebar')
            <h5>Main Menu</h5>
            <li>
                <span class="material-symbols-outlined">dashboard</span>
                <a href="{{ route('home') }}">Dashboard</a>
            </li>
            <li>
                <span class="material-symbols-outlined">show_chart</span>
                <a href="{{ route('process_agreements.index') }}">Process Agreements </a>
            </li>
            @can('create message users')
            <li>
                <span class="material-symbols-outlined">flag</span>
                <a href="{{ route('messages.create') }}">Create Message</a>
            </li>
            @endcan
            <li>
                <span class="material-symbols-outlined">mail</span>
                <a href="{{ route('messages.index') }}">
                    Messages
                    @if(auth()->user()->hasRole('primary-user'))
                        @php
                            $unreadMessageCount = auth()->user()->unreadMessagesCount();
                        @endphp
                        @if($unreadMessageCount > 0)
                            <span class="badge badge-border">{{ $unreadMessageCount }}</span>
                        @endif
                    @endif
                </a>
            </li>
            @can('view activity logs')
            <li>
                <span class="material-symbols-outlined">track_changes</span>
                <a href="{{ route('activity.logs.index') }}">Activity Logs</a>
            </li>
            @endcan
            @endcan
            @can('performance agreement forms sidebar')
            <hr>
            <h5>Advanced Forms</h5>
            <li>
                <span class="material-symbols-outlined">balance</span>
                <a href="{{ route('process_agreements.create') }}">Economic Form</a>
            </li>
            <li>
                <span class="material-symbols-outlined">group</span>
                <a href="{{ route('social') }}">Social Form</a>
            </li>
            <li>
                <span class="material-symbols-outlined">ambient_screen</span>
                <a href="{{ route('process_agreements.poverty') }}">Poverty alleviation</a>
            </li>
            <li>
                <span class="material-symbols-outlined">pacemaker</span>
                <a href="{{ route('process_agreements.health_and_nutrition') }}">Health and Nutrition</a>
            </li>
            <li>
                <span class="material-symbols-outlined">agriculture</span>
                <a href="{{ route('agriculture') }}">Go to Agriculture</a>
            </li>
            <li>
                <span class="material-symbols-outlined">water</span>
                <a href="{{ route('environment') }}">Environment Form</a>
            </li>
            <li>
                <span class="material-symbols-outlined">ambient_screen</span>
                <a href="{{ route('government_revenue') }}">Government Revenue</a>
            </li>
            <li>
                <span class="material-symbols-outlined">public</span>
                <a href="{{ route('public_expenditure') }}">Public Expenditure</a>
            </li>
            <li>
                <span class="material-symbols-outlined">book</span>
                <a href="{{ route('other-details') }}">Other Data</a>
            </li>
            @endcan
            <hr>
            @can('account sidebar')
            <h5>Account</h5>
            <li>
                <span class="material-symbols-outlined">bar_chart</span>
                <a href="{{ route('users.index') }}">Users</a>
            </li>
            <li>
                <span class="material-symbols-outlined">star</span>
                <a href="{{ route('roles.index') }}">Roles</a>
            </li>
            <li>
                <span class="material-symbols-outlined">settings</span>
                <a href="{{ route('permissions.index') }}">Permissions</a>
            </li>
            <li>
                <span class="material-symbols-outlined">Logout</span>
                <a href="#" onclick="logout()">Logout</a>
            </li>
            @endcan
            @can('account logout users')
            <h5>Account</h5>
            <li>
                <span class="material-symbols-outlined">Logout</span>
                <a href="#" onclick="logout()">Logout</a>
            </li>
            @endcan
        </ul>
    </aside>

    <script>
        function logout() {
            // Submit the logout form
            document.getElementById('logout-form').submit();
        }
    </script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</body>
</html>
