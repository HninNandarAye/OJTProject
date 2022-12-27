@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-5 mx-auto mt-5">
        <div class="card" style="background-color: #afda97;">
            <div class="card-header">
                <h2>@lang("public.update_title")</h2>
            </div>
            <form action="/students/edit" method="post" class="m-3">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label>@lang("public.study_year")</label>
                    <input type="text" id="study_year" name="study_year" value="{{ old('study_year') }}" class="form-control" placeholder="@lang('public.select_year')" autofocus>
                    @error('study_year')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                    <label>@lang("public.roll_no")</label>
                    <select id="roll_no" name="roll_no" class="roll_no form-select">
                    </select>
                    @error('roll_no')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>@lang("public.name")</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>@lang("public.age")</label>
                    <input type="text" name="age" id="age" value="{{ old('age') }}" class="form-control">
                    @error('age')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4 mb-3  d-flex justify-content-center">
                    <input type="submit" value="@lang('public.btnupdate')" class="btn me-2" id="form-btn">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        //to show datepicker
        $("#study_year").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });
        //add search box in select box
        $('.roll_no').select2({
            theme: 'bootstrap-5'
        });
        $("#study_year").on('change', function() {
            var study_year = $("#study_year").val();    
            console.log(study_year);        
            if (study_year == "") {
                $('#roll_no').empty();
                $("#name").val("");
                $("#age").val("");
            } else {
                $.ajax({
                    type: 'GET',
                    url: '/students/select/roll_no',
                    data: {
                        'studyYear': study_year//sending study year to filter
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#roll_no').empty();
                        $('#roll_no').append(`<option value="">{{ __('public.select_rollno') }}</option>`);
                        var roll_no_byyear = data.student;
                        roll_no_byyear.forEach(element => {
                            $('#roll_no').append(`<option value="${element.id}">${element.roll_no}</option>`);
                        });
                    }
                });
            }

        });
        $("#roll_no").on('change', function() {
            var id_byRollNo = $("#roll_no").val();
            if (id_byRollNo == "") {
                $("#name").val("");
                $("#age").val("");
            } else {
                $.ajax({
                    type: 'GET',
                    url: '/students/select/student_info',
                    data: {
                        'id': id_byRollNo,//sending id number to update student according to id
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#id").val(data.student.id);
                        $("#name").val(data.student.name);
                        $("#age").val(data.student.age);
                    },
                });
            }
        });
    });
</script>

<!-- this is update successful alert box -->
@if(session('updateinfo'))
<script>
    swal({
        title: "{{ __('public.update_alert') }}",
        icon: "success"
    }).then(function() {
        window.location.href = "{{ url('/students/view') }}";
    });
</script>@endif
@endsection