@extends('layouts.app')

@section('content')

<style>
    .card-header h4 {
        font-size: 18px; /* Adjust the font size as needed */
    }

    .btn {
        font-size: 14px; /* Adjust the font size of buttons */
    }

    /* You can add more CSS rules to adjust font size for other elements */
</style>


<div class="container m-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Create Permission
                        <a href=" {{ url('permissions')}} " class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ url ('permissions')}}" method="POST">
                    @csrf

                        <div class="mb-3">
                        <label for="">Permission Name</label>
                        <input type="text" name="name" class="form-control"> 
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->