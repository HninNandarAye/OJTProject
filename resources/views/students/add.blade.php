@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-5 mx-auto mt-5">
        <div class="card" style="background-color: #afda97;">
            <div class="card-header">
                <h2>Adding Student</h2>
            </div>
            <form action="" method="post" class="m-3">
                @csrf
                @method('post')
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Roll No</label>
                    <input type="text" name="roll_no" value="{{ old('roll_no') }}" class="form-control">
                    @error('roll_no')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Age</label>
                    <input type="text" name="age" value="{{ old('age') }}" class="form-control">
                    @error('age')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4 mb-3  d-flex justify-content-center">
                    <input type="submit" value="Add" class="btn me-2" id="form-btn" style="width:100px">
                    <input type="reset" value="Cancel" class="btn btn-secondary" style="width:100px">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(session('insertinfo'))
<script>
    swal({
        title: "正常に登録しました。",
        icon: "success"
    }).then(function() {
        window.location.href = "{{ url('/students/show') }}";
    });
</script>
@endif
@endsection