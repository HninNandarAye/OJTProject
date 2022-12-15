@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <h2 class="text-center">学生一覧</h2>
        <div class="d-flex justify-content-end mb-3">
            <label class="me-2">日付</label>
            <input type="text" name="" id="date">
        </div>
        @if(session('info'))
        <div class="alert alert-success" id="showinfo" style="height: 50px;">
            <p>{{ session('info') }}</p>
        </div>
        @endif
        <div>
            <h3 id="noStu" class="text-center mt-3">対象データが見つかりませんでした。</h3>
        </div>
        <div id="tablediv">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>                        
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Registered Date</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('students.show') }}",
            columns: [
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

    });
    setTimeout(fade_out, 5000);
    function fade_out() {
        $("#showinfo").fadeOut().empty();
    }
</script>

<!-- <script text="javascript">
    $(document).ready(function() {
        $("#date").datepicker({
            dateFormat: "yy-mm-dd",
        });

        $('#table').dataTable({
            "searching": false,
            "lengthChange": false,
            "language": {                
                "info": "_START_ から _END_ まで _TOTAL_ 人の生徒を表示しする",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "次へ",
                    "previous": "前へ"
                },
            }
        });
        $("#noStu").hide();
        $("#date").on('change', function() {
            var registerDate = $("#date").val();
            $.ajax({
                type: 'GET',
                url: '/students/search/',
                data: {
                    'registerDate': registerDate
                },
                dataType: "json",
                success: function(data) {
                    if (data.students.length > 0) {
                        $("#noStu").hide();
                        $("#tablediv").show();
                        // $("#table").show();
                        var table = $('#table').DataTable();
                        table.clear().draw();
                        for (var i = 0; i < data.students.length; i++) {
                            var date = new Date(data.students[i].created_at);
                            var register_date = date.getDate();
                            var register_month = date.getMonth() + 1;
                            var register_year = date.getFullYear();
                            // register_year = register_year.toString().substr(2,2);                                              
                            table.row.add([`${i + 1}`, data.students[i].name, data.students[i].age, data.students[i].roll_no, register_year + "-" + register_month + "-" + register_date]).draw();
                        }
                    } else {
                        $("#tablediv").hide();
                        $("#noStu").show();
                    }
                }
            });
            //}

        })
    })


   
</script> -->
@endsection