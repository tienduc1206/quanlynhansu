$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('.btn_insert_degree').on('click', function () {
        var date = new Date();
        var degreeCode = 'MBC' + date.getTime();
        $('.degreeName_error').text('');
        $('#degreeCode').val(degreeCode);
    });

    function allData() {
        $.ajax({
            type: "get",
            url: "degree/all",
            dataType: "json",
            success: function (response) {
                var data = "";
                $.each(response, function (key, value) {
                    data += '<tr>'
                    data += '<td>' + ++key + '</td>'
                    data += '<td>' + value.degree_code + '</td>'
                    data += '<td>' + value.degree_name + '</td>'
                    data += '<td>'
                        + '<button value=" ' + value.id + '" class="btn btn-primary mr-2 btn_modal_edit" data-toggle="modal" data-target="#exampleModalEdit"><i class="fa-regular fa-pen-to-square"></i></button>'
                        + '<button  value=" ' + value.id + '" class="btn btn-danger btn_delete"><i class="fa-solid fa-trash-can"></i></button>'
                    data += '</td>'
                    data += '</tr>'
                });
                $('tbody').html(data)
                $('#degreeTable').DataTable();

            }
        });
    }
    allData();

    $('.btn_add_data').on('click', function (e) {
        e.preventDefault();
        var degreeCode = $('#degreeCode').val();
        var degreeName = $('#degreeName').val();
        $.ajax({
            type: "POST",
            url: "degree/store",
            data: {
                degreeCode: degreeCode,
                degreeName: degreeName
            },
            dataType: "json",
            beforeSend: function () {
                $(document).find('span.error-text').text('');
            },
            success: function (response) {
                console.log(response);
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#exampleModalInsert').modal('hide');
                $('#degreeName').val('');
                allData();
            },
            error: function (error) {
                console.log(error);
                if (error.status == 403) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You must not perform this action!',
                    })
                    $('#exampleModalEdit').modal('hide');
                } else {
                    $('.degreeName_error').text(error.responseJSON.errors.degreeName);
                }
            }
        });
    });


    $(document).on('click', '.btn_modal_edit', function () {
        var id = $(this).val();
        $('.degreeName_error').text('');
        $.ajax({
            type: "post",
            url: "degree/edit",
            data: {
                id: id
            },
            dataType: "json",
            success: function (response) {
                $('.degreeCode_edit').val(response.degree_code)
                $('.degreeName_edit').val(response.degree_name)
                $('.btn_save_edit').val(id)
            },
            error: function (error) {
                if (error.status == 403) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You must not perform this action!',
                    })
                    $('#exampleModalEdit').modal('hide');
                }
            }
        });
    })

    $(document).on('click', '.btn_save_edit', function () {
        var id = $('.btn_save_edit').val()
        var degreeCode = $('.degreeCode_edit').val()
        var degreeName = $('.degreeName_edit').val()
        $.ajax({
            type: "post",
            url: "degree/update",
            data: {
                id: id,
                degreeCode: degreeCode,
                degreeName: degreeName
            },
            dataType: "json",
            success: function (response) {
                if (response) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#exampleModalEdit').modal('hide');
                    allData();
                }

            },
            error: function (error) {
                $('.degreeName_error').text(error.responseJSON.errors.degreeName);
            }
        });
    })

    $(document).on('click', '.btn_delete', function () {
        id = $(this).val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "degree/delete",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                        allData();
                    },
                    error: function (error) {
                        if (error.status == 403) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'You must not perform this action!',
                            })
                            $('#exampleModalEdit').modal('hide');
                        }
                    }
                });

            }
        })
    })
})