@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-5 mx-auto mt-5">
        <div class="card" style="background-color: #afda97;">
            <div class="card-header">
                <h2>@lang("public.add_title") </h2>
            </div>
            <form action="" method="post" class="m-3">
                @csrf
                @method('post')
                <div class="mb-3">
                    <label>@lang("public.name")</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>@lang("public.roll_no")</label>
                    <input type="text" name="roll_no" value="{{ old('roll_no') }}" class="form-control" placeholder="@lang('public.roll_no_pattern')">
                    @error('roll_no')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>@lang("public.age")</label>
                    <input type="text" name="age" value="{{ old('age') }}" class="form-control">
                    @error('age')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>@lang("public.study_year")</label>
                    <input type="text" name="study_year" value="{{ old('study_year') }}" id="study_year" class="form-control">
                    @error('study_year')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4 mb-3  d-flex justify-content-center">
                    <input type="submit" value="@lang('public.btnadd')" class="btn me-2" id="form-btn" style="width:100px">
                    <input type="reset" value="@lang('public.btncancel')" class="btn btn-secondary" style="width:100px">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    //to show date picker
    $("#study_year").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
</script>

<!-- to show successful alert box -->
@if(session('insertinfo'))
<script>
    swal({
        title: "{{ __('public.add_alert') }}",
        icon: "success"
    }).then(function() {
        window.location.href = "{{ url('/students/view') }}";
    });
</script>
@endif
@endsection