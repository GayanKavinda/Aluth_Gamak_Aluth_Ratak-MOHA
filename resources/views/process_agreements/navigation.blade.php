@extends('layouts.app')

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->

@section('content')
<div class="container mt-3">
    <h4>Navigate Each Sections</h4><hr>
    <div class="btn-group" role="group" aria-label="Button Group">
        <a href="{{ route('process_agreements.create') }}" class="btn btn-primary">Economic Form</a>
        <a href="{{ route('social') }}" class="btn btn-danger">Social Form</a>
        <a href="{{ route('process_agreements.poverty') }}" class="btn btn-success mx-2">Poverty alleviation</a>
        <a href="{{ route('process_agreements.health_and_nutrition') }}" class="btn btn-primary">Health and Nutrition</a>
        <a href="{{ route('agriculture') }}" class="btn btn-primary">Go to Agriculture</a>
        <a href="{{ route('environment') }}" class="btn btn-primary">Environment Form</a>
        <a href="{{ route('government_revenue') }}" class="btn btn-primary">Government Revenue</a>
        <a href="{{ route('public_expenditure') }}" class="btn btn-primary">Public Expenditure</a>
        <a href="{{ route('other-details') }}" class="btn btn-primary">Enter Other Details</a>

    </div>
</div>
@endsection