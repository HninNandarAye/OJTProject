@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <h2 class="text-center">@lang("public.view")</h2>
        <table class="table table-bordered table-striped data-table">
            <thead class="align-middle" style="height: 45px;">
                <tr>
                    <th>@lang("public.no")</th>
                    <th>@lang("public.roll-no")</th>
                    <th>@lang("public.name")</th>
                    <th>@lang("public.age")</th>
                    <th>@lang("public.registered-date")</th>
                    <th>@lang("public.delete")</th>
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
                <h5 class="modal-title">@lang("public.modal-title")</h5>
            </div>
            <div class="modal-body">@lang("public.modal-body")</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang("public.btnclose")</button>
                <button type="button" id="btndelete" class="btn btn-danger">@lang("public.btnyes")</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#alert-success').hide();
        var table = $('.data-table').DataTable({
            lengthChange: false,
            processing: true,
            serverSide: true,
            language: {
                "search": "{{ __('public.search') }}",
                "info": "{{ __('public.info') }}",
                "infoEmpty": "{{ __('public.infoEmpty') }}",                
                "emptyTable": "{{ __('public.emptyTable') }}",
                "infoFiltered": "{{ __('public.infoFiltered') }}",
                "zeroRecords": "{{__('public.zeroRecords') }}",
                "paginate": {
                    "first": "{{ __('public.first') }}",
                    "last": "{{ __('public.last') }}",
                    "next": "{{ __('public.next') }}",
                    "previous": "{{ __('public.previous') }}"
                },
            },
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