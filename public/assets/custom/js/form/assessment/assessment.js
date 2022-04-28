$(function () {
    alertAddAssessment = function(that, id, route){
        Swal.fire({
            title: "Are you sure?",
            text: "You will make a test assessment!",
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
                        location.reload();
                    }
                });
            }
        });
    };
});