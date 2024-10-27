@extends('layouts.app')

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Process Agreement</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('process_agreements.update', $processAgreement->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Field -->
                        <div class="form-group row">
                            <label for="field" class="col-md-4 col-form-label text-md-right">Field</label>
                            <div class="col-md-6">
                                <input id="field" type="text" class="form-control" name="field" value="{{ $processAgreement->field }}" disabled>
                            </div>
                        </div>

                        <!-- Task -->
                        <div class="form-group row">
                            <label for="task" class="col-md-4 col-form-label text-md-right">Task</label>
                            <div class="col-md-6">
                                <input id="task" type="text" class="form-control" name="task" value="{{ $processAgreement->task }}" disabled>
                            </div>
                        </div>

                        <!-- Performance Indicator -->
                        <div class="form-group row">
                            <label for="performance_indicator" class="col-md-4 col-form-label text-md-right">Performance Indicator</label>
                            <div class="col-md-6">
                                <input id="performance_indicator" type="text" class="form-control" name="performance_indicator" value="{{ $processAgreement->performance_indicator }}" disabled>
                            </div>
                        </div>

                        <!-- Contracted Target -->
                        <div class="form-group row">
                            <label for="contracted_target" class="col-md-4 col-form-label text-md-right">Contracted Target</label>
                            <div class="col-md-6">
                                <input id="contracted_target" type="number" class="form-control @error('contracted_target') is-invalid @enderror" name="contracted_target" value="{{ old('contracted_target', $processAgreement->contracted_target) }}" @unless(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin')) @endunless readonly>

                                @error('contracted_target')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <!-- 1st Quarter -->
                        <div class="form-group row">
                            <label for="first_quarter" class="col-md-4 col-form-label text-md-right">1st Quarter</label>
                            <div class="col-md-6">
                                <input id="first_quarter" type="number" class="form-control quarter-field" name="first_quarter" step="0.01" value="{{ old('first_quarter', $processAgreement->first_quarter) }}" @can('1st quarter Edit') readonly @endcan >
                                
                            </div>
                        </div>


                        <!-- 2nd Quarter -->
                        <div class="form-group row">
                            <label for="second_quarter" class="col-md-4 col-form-label text-md-right">2nd Quarter</label>
                            <div class="col-md-6">
                                <input id="second_quarter" type="number" class="form-control @error('second_quarter') is-invalid @enderror" name="second_quarter" step="0.01" value="{{ old('second_quarter', $processAgreement->second_quarter) }}" @can('2nd quarter Edit') readonly @endcan @unless(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin')) @endunless>

                                @error('second_quarter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <!-- 3rd Quarter -->
                        <div class="form-group row">
                            <label for="third_quarter" class="col-md-4 col-form-label text-md-right">3rd Quarter</label>
                            <div class="col-md-6">
                                <input id="third_quarter" type="number" class="form-control @error('third_quarter') is-invalid @enderror" name="third_quarter" step="0.01" value="{{ old('third_quarter', $processAgreement->third_quarter) }}" @can('3rd quarter Edit') readonly @endcan @unless(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin')) @endunless>

                                @error('third_quarter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <!-- 4th Quarter -->
                        <div class="form-group row">
                            <label for="fourth_quarter" class="col-md-4 col-form-label text-md-right">4th Quarter</label>
                            <div class="col-md-6">
                                <input id="fourth_quarter" type="number" class="form-control @error('fourth_quarter') is-invalid @enderror" name="fourth_quarter" step="0.01" value="{{ old('fourth_quarter', $processAgreement->fourth_quarter) }}" @can('4th quarter Edit') readonly @endcan @unless(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin')) @endunless>

                                @error('fourth_quarter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Total input -->
                        <div class="form-group row">
                            <label for="total" class="col-md-4 col-form-label text-md-right">Total</label>
                            <div class="col-md-6">
                                <input id="total" type="number" class="form-control" name="total" value="{{ $processAgreement->total }}" disabled>
                            </div>
                        </div>

                        <!-- Percentage input -->
                        <div class="form-group row">
                            <label for="percentage" class="col-md-4 col-form-label text-md-right">Percentage</label>
                            <div class="col-md-6">
                                <input id="percentage" type="number" class="form-control" name="percentage" value="{{ $processAgreement->percentage }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Process Agreement
                                </button>
                                <a href="{{ route('process_agreements.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
    // Function to handle checkbox change and toggle field readonly attribute
    $('.quarter-checkbox').change(function(){
        var fieldId = $(this).data('field-id');
        var isChecked = $(this).is(":checked");
        
        // Toggle the readonly attribute of the corresponding field
        $('#' + fieldId).prop('readonly', !isChecked);
    });


    // Calculate total and percentage when any input field changes
    $('.form-control').on('input', function() {
        var contractedTarget = parseFloat($('#contracted_target').val()) || 0;
        var firstQuarter = parseFloat($('#first_quarter').val()) || 0;
        var secondQuarter = parseFloat($('#second_quarter').val()) || 0;
        var thirdQuarter = parseFloat($('#third_quarter').val()) || 0;
        var fourthQuarter = parseFloat($('#fourth_quarter').val()) || 0;

       // Check if the quarter fields are readonly
        var firstQuarterReadonly = $('#first_quarter').prop('readonly');
        var secondQuarterReadonly = $('#second_quarter').prop('readonly');
        var thirdQuarterReadonly = $('#third_quarter').prop('readonly');
        var fourthQuarterReadonly = $('#fourth_quarter').prop('readonly');

        // Calculate total including locked quarters
        var total = firstQuarter + (secondQuarterReadonly ? 0 : secondQuarter) + (thirdQuarterReadonly ? 0 : thirdQuarter) + (fourthQuarterReadonly ? 0 : fourthQuarter);
        var percentage = (total / contractedTarget) * 100 || 0;

        $('#total').val(total.toFixed(2));
        $('#percentage').val(percentage.toFixed(2));
    }); 
});
</script>

@endsection
