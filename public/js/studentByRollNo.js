$(document).ready(function () {
    $('.roll_no').select2({
        theme: 'bootstrap-5'
    });
    $("#roll_no").on('change', function () {
        var roll_no = $("#roll_no").val();
        if (roll_no == "") {
            $("#name").val("");
            $("#age").val("");
        } else {
            $.ajax({
                type: 'GET',
                url: '/students/select/',
                data: { 'rollNo': roll_no },
                dataType: "json",
                success: function (data) {
                    console.log(data.student[0].name);
                    $("#id").val(data.student[0].id);
                    $("#name").val(data.student[0].name);
                    $("#age").val(data.student[0].age);

                },
            })
        }
        console.log(roll_no);

    })
})
