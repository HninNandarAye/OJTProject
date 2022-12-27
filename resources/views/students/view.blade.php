@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <h2 class="text-center">@lang("public.student_list")</h2>
        <div class="d-flex justify-content-end mb-3">
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="date" id="date" class="form-control" placeholder="@lang('public.select_date')">
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="student_table">
            <thead>
                <tr>
                    <th>@lang("public.no")</th>
                    <th>@lang("public.roll_no")</th>
                    <th>@lang("public.name")</th>
                    <th>@lang("public.age")</th>
                    <th>@lang("public.study_year")</th>
                    <th>@lang("public.registered_date")</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //to show datepicker
        $("#date").datepicker({
            dateFormat: "yy-mm-dd",
        });
        //to show student list with datatable
        $('#student_table').DataTable({
            searching: false,
            lengthChange: false,
            processing: true,
            serverSide: true,
            language: {
                "info": "{{ __('public.info') }}",
                "infoEmpty": "{{ __('public.infoEmpty') }}",
                "emptyTable": "{{ __('public.emptyTable') }}",

                "paginate": {
                    "first": "{{ __('public.first') }}",
                    "last": "{{ __('public.last') }}",
                    "next": "{{ __('public.next') }}",
                    "previous": "{{ __('public.previous') }}"
                },
            },
            ajax: {
                url: "{{ url('/students/student-list') }}",
                type: 'GET',
                data: function(d) {
                    d.date = $('#date').val();//sent date to search data
                }
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
                }
            ]
        });
    });
    //to append student data into table
    $(document).on('change', '#date', function() {
        $('#student_table').DataTable().draw(true);
    });
</script>
@endsection