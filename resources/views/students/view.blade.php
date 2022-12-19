@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <h2 class="text-center">@lang("public.student-list")</h2>
        <div class="d-flex justify-content-end mb-3">
            <div class="row">                
                <div class="col-md-12">
                    <input type="text" name="date" id="date" class="form-control" placeholder="@lang('public.select-date')">
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="student-table">
            <thead>
                <tr>
                    <th>@lang("public.no")</th>
                    <th>@lang("public.roll-no")</th>
                    <th>@lang("public.name")</th>
                    <th>@lang("public.age")</th>
                    <th>@lang("public.registered-date")</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#date").datepicker({
            dateFormat: "yy-mm-dd",
        });
        
        $('#student-table').DataTable({
            searching: false,
            lengthChange: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('/students/student-list') }}",
                type: 'GET',
                data: function(d) {
                    d.date = $('#date').val();
                }
            },
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
                }
            ]
        });
    });

    $(document).on('change', '#date', function() {               
        $('#student-table').DataTable().draw(true);
    });
</script>
@endsection