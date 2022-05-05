$(document).ready(function () {




    $('.btn_insert_phongban').on('click', function () {
        var date = new Date();
        var ma_phong_ban = 'MPB' + date.getTime();
        $('.ma_phong_ban').val(ma_phong_ban);
    });

    function allData() {
        $.ajax({
            type: "get",
            url: "phongban/all",
            dataType: "json",
            success: function (response) {
                console.log(response);
                var data = "";
                $.each(response, function (key, value) {
                    data += '<tr>'
                    data += '<td>' + ++key + '</td>'
                    data += '<td>' + value.ma_phong_ban + '</td>'
                    data += '<td>' + value.ten_phong_ban + '</td>'
                    data += '<td>'
                        + '<button value=" ' + value.id + '" class="btn btn-primary mr-2 btn_modal_edit" data-toggle="modal" data-target="#exampleModalEdit"><i class="fa-regular fa-pen-to-square"></i></button>'
                        + '<button  value=" ' + value.id + '" class="btn btn-danger btn_delete"><i class="fa-solid fa-trash-can"></button>'
                    data += '</td>'
                    data += '</tr>'
                    $('tbody').html(data);
                });
                $('#departmentTable').DataTable();
            }
        });
    }
    allData();


    $('.btn_add_data').on('click', function (e) {

        var maPhongBan = $('#ma_phong_ban_add').val();
        var tenPhongBan = $('#ten_phong_ban_add').val();
        $.ajax({
            type: "POST",
            url: "phongban/store",
            data: {
                maPhongBan: maPhongBan,
                tenPhongBan: tenPhongBan
            },
            dataType: "json",
            success: function (response) {
                console.log(response.error);
                if (response.status == 0) {
                    $.each(response.error, function (key, val) {
                        $('span.' + key + '_error').text(val[0]);
                    });
                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#ten_phong_ban_add').val('');
                    $('#exampleModalInsert').modal('hide');
                    $(document).find('p.success-text').text('');
                    allData();
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $(document).on('click', '.btn_modal_edit', function () {
        var id = $(this).val();

        $.ajax({
            type: "post",
            url: "phongban/edit",
            data: {
                id: id
            },
            dataType: "json",
            success: function (response) {
                $('.ma_phong_ban_edit').val(response.ma_phong_ban)
                $('.ten_phong_ban_edit').val(response.ten_phong_ban)
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
        var maPhongBan = $('.ma_phong_ban_edit').val()
        var tenPhongBan = $('.ten_phong_ban_edit').val()
        $.ajax({
            type: "post",
            url: "phongban/update",
            data: {
                id: id,
                maPhongBan: maPhongBan,
                tenPhongBan: tenPhongBan
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
                console.log(error.responseJSON.errors.tenPhongBan)
                $('.tenPhongBan_error_edit').text(error.responseJSON.errors.tenPhongBan)
            }
        });
    })

    $(document).on('click', '.btn_delete', function () {
        var id = $(this).val();
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
                    url: "phongban/delete",
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





});