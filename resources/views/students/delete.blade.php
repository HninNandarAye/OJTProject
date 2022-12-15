@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <table class="table table-bordered table-striped data-table">
            <thead class="align-middle" style="height: 45px;">
                <tr>
                    <th>No</th>
                    <th>Roll No</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Registered Date</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="ModalDelete" tabindex="-1" role="idalog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{_("Student Delete") }}</h5>
            </div>
            <div class="modal-body">You sure you want to delete ?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btndelete" class="btn btn-danger">{{_("Yes")}}</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#alert-success').hide();
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('students.delete') }}",
            columns: [{
                    data: 'SrNo',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    searchable: false,
                    sortable: false,
                },
                {
                    data: 'roll_no',
                    name: 'roll_no'
                },
                {
                    data: 'name',
                    name: 'name'

                },
                {
                    data: 'age',
                    name: 'age'

                },
                {
                    data: 'created_at',
                    name: 'created_at'

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $("[name='table_length']").addClass("mb-4");
        var id;
        $(document).on('click', '.delete', function() {
            id = $(this).attr('id');
            console.log(id);
            $("#ModalDelete").modal('show');
        });
        $('#btndelete').click(function() {
            $.ajax({
                type: 'GET',
                url: "/students/destroy/",
                data: {
                    'id': id
                },
                dataType: "json",
                beforeSend: function() {
                    $('#btndelete').text('Deleting...');
                },
                success: function(data) {
                    $('#btndelete').text('Yes');
                    $('#ModalDelete').modal('hide');
                    window.location.href = "{{ route('students.show')}}";
                }
            });
        });
    });
</script>
@endsection