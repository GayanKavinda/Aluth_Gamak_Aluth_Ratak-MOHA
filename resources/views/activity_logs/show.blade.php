@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Activity Log Details</h1>
    <div class="card" style="border-radius: 15px;">
        <div class="card-header">
            Activity ID: {{ $activity->id }}
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $activity->description }}</p>
            <p><strong>Subject:</strong> {{ $subject }}</p>
            <p><strong>Causer:</strong> {{ $activity->causer ? $activity->causer->name : 'System' }}</p>
            <p><strong>Properties:</strong></p>
            @if($properties)
                <ul>
                    @foreach($properties as $key => $value)
                        @if(is_array($value))
                            <li><strong>{{ ucfirst($key) }}:</strong>
                                <ul>
                                    @foreach($value as $subKey => $subValue)
                                        <li>{{ ucfirst($subKey) }}: {{ $subValue }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</li>
                        @endif
                    @endforeach
                </ul>
            @else
                <p>No properties available.</p>
            @endif
            <p><strong>Created At:</strong> {{ $activity->created_at }}</p>
        </div>
    </div>
    <a href="{{ route('activity.logs.index') }}" class="btn btn-secondary mt-3">Back to Activity Logs</a>
</div>
@endsection

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->