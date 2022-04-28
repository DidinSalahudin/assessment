$(function () {
    // Summernote
    $('#summernote').summernote();

    $("#add-question-detail").click(function(){
        var index;
        var total_row = $('#table-question-detail tbody tr').length;
        if(total_row > 0){
            index = $('#table-question-detail tbody tr:last').data('index') + 1;
        } else {
            index = 0;
        }
        
        var addRow = '<tr data-index="'+index+'">';
        addRow += '<input type="hidden" name="questiondetail['+index+'][id]" value="">';
        addRow += '<td><input type="file" name="questiondetail['+index+'][question_image]" ></td>';
        addRow += '<td><input type="file" name="questiondetail['+index+'][answer_image]" ></td>';
        addRow += '<td><select class="custom-select rounded-0" name="questiondetail['+index+'][answer]"><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option><option value="E">E</option><option value="F">F</option></select></td>';
        addRow += '<td><a href="javascript:void(0);" class="btn btn-sm btn-danger" id="delete-question-detail">X</a></td>';
        addRow += '</tr>';
        $("#tbody-question-detail").append(addRow);
    });

    $("#tbody-question-detail").on('click','#delete-question-detail',function(){
        $(this).parent().parent().remove();
    });

    deleteupdateForm = function(that, id, route){
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            showCancelButton: true,
            closeOnConfirm: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: route,
                    data: {id: id},
                    dataType: 'json',
                    method: 'POST',
                    success: function(response){
                        if(response){
                            var row = $(that).parents('tr').remove();
                            Swal.fire({
                                title: "Deleted!", 
                                text: "Your data has been deleted.", 
                                icon: "success"
                            });
                        } else {
                            Swal.fire(
                                "Failed!", 
                                "Your data not deleted.", 
                                "error"
                            );
                        }
                    }
                });
            }
        });
    };
});
