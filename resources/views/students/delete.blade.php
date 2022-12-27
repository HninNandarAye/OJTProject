@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <h2 class="text-center">@lang("public.student_list")</h2>
        <table class="table table-bordered table-striped data-table">
            <thead class="align-middle" style="height: 45px;">
                <tr>
                    <th>@lang("public.no")</th>
                    <th>@lang("public.roll_no")</th>
                    <th>@lang("public.name")</th>
                    <th>@lang("public.age")</th>
                    <th>@lang("public.study_year")</th>
                    <th>@lang("public.registered_date")</th>
                    <th>@lang("public.delete")</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!-- this is delete modal confirm box -->
<div class="modal fade" id="modal_delete" tabindex="-1" role="idalog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang("public.modal_title")</h5>
            </div>
            <div class="modal-body">@lang("public.modal_body")</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang("public.btnclose")</button>
                <button type="button" id="btndelete" class="btn btn-danger">@lang("public.btnyes")</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        //to show student list with datatable
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
            ajax: {
                "url": "{{ url('students/delete') }}"
            },
            columns: [{
                    data: 'no',
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
                    data: 'study_year',
                    name: 'study_year'
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
        var id;
        //to show confirm box for deleting
        $(document).on('click', '.delete', function() {
            id = $(this).attr('id');
            $("#modal_delete").modal('show');
        });
        //to delete when click delete button on confirm box
        $('#btndelete').click(function() {
            $.ajax({
                type: 'GET',
                url: "/students/destroy/",
                data: {
                    'id': id
                },
                dataType: "json",
                beforeSend: function() {
                    $('#btndelete').text("{{ __('public.deleting') }}");
                },
                success: function(data) {
                    $('#btndelete').text("{{ __('public.btnyes') }}");
                    $('#modal_delete').modal('hide');
                    window.location.href = "{{ url('students/view') }}";
                }
            });
        });
    });
</script>
@endsection