@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-5 mx-auto mt-5">
        <div class="card" style="background-color: #d1e189;">
            <div class="card-header">
                <h2>Updating Student</h2>
            </div>
            <form action="/students/edit" method="post" class="m-3">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <input type="hidden" name="id" id="id" value="{{ old('id') }}">
                    <label>Roll No</label>
                    <select id="roll_no" name="roll_no" class="form-select">
                        <option value="" name="roll_no">ロール番号を選択してください。</option>
                        @foreach($students as $student)
                        <option name="roll_no" value={{ $student->roll_no }}  {{ $student->roll_no ==old('roll_no') ? 'selected': '' }}>{{$student->roll_no}}</option>
                        @endforeach
                    </select>
                    @error('roll_no')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Age</label>
                    <input type="text" name="age" id="age" value="{{ old('age') }}" class="form-control">
                    @error('age')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4 mb-3  d-flex justify-content-center">
                    <input type="submit" value="Update" class="btn me-2" id="form-btn" >
                    <input type="reset" value="Cancel" class="btn btn-secondary" style="width:100px">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('js/studentByRollNo.js') }}" defer></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(session('updateinfo'))
<script>
    swal({
        title: "正常に登録しました。",
        icon: "success"
    }).then(function() {
        window.location.href = "{{ url('/students/show') }}";
    });
</script>@endif
@endsection