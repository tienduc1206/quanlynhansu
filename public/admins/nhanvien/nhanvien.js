$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $('.btn_insert_employee').on('click', function () {
        var date = new Date();
        var employeeCode = 'MNV' + date.getTime();
        $('.degreeName_error').text('');
        $('input[name = "employeeCode"]').val(employeeCode);
    });

    function allData(pagePresent = 1) {
        var data = '';
        let pagination = ''
        // lastPage = $('.page-item.last-page').val();

        $('.page-item').removeClass('active');
        let search = $('.search-employee').val();

        $.ajax({
            type: "GET",
            url: "nhanvien/all?page=" + pagePresent,
            data: {
                search: search
            },
            dataType: "JSON",
            success: function (response) {
                let totalRecords = response.total
                let per_page = response.per_page
                let maxPage = Math.ceil(totalRecords / per_page);
                classDisabled = pagePresent == 1 ? 'disabled' : ''
                pagination += '<li class="page-prev ' + classDisabled + ' page-item">'
                pagination += '<a class="page-link" href="#" tabindex="-1">Previous</a>'
                pagination += '</li>'
                for (let index = 1; index <= maxPage; index++) {
                    classActive = pagePresent == index ? 'active' : '';
                    classLastPage = maxPage == index ? ' last-page' : '';

                    pagination += ' <li class="page-item ' + classActive + classLastPage + '" value = "' + index + '" > <a class="page-link" href="">' + index + '</a></li >'
                }
                classDisabled = pagePresent == maxPage ? 'disabled' : ''
                pagination += '<li class="page-next ' + classDisabled + ' page-item"><a class="page-link" href="">Next</a></li >'
                $('.pagination').html(pagination)

                $.each(response.data, function (index, value) {
                    data += '<tr>'
                    data += '<td>' + ++index + '</td>'
                    data += '<td>' + value['ma_nv'] + '</td>'
                    data += '<td>' + value['ten_nv'] + '</td>'
                    data += '<td>' + value['gioi_tinh'] + '</td>'
                    data += '<td>' + value['ngay_sinh'] + '</td>'
                    data += '<td>' + value['noi_sinh'] + '</td>'
                    data += '<td>' + value['bangcap_id'] + '</td>'
                    data += '<td>' + value['phongban_id'] + '</td>'
                    data += '<td>'
                    data += '<img class="image_nhanvien" src="' + value['image_path'] + '" alt="">'
                    data += '</td>'
                    data += '<td>'
                        + '<button value=" ' + value.id + '" class="btn btn-sm btn-primary mr-2 btn_modal_edit" data-toggle="modal" data-target="#exampleModalEdit"><i class="fa-regular fa-pen-to-square"></i></button>'
                        + '<button  value=" ' + value.id + '" class="btn btn-sm btn-danger btn_delete"><i class="fa-solid fa-trash-can"></i></button>'
                    data += '</td>'
                    data += '</tr>'
                });
                $('tbody').html(data)
            }
        })
    }
    allData();

    $(document).on('click', '.page-item', function (e) {
        e.preventDefault();
        let pagePresent = $(this).val();
        if (pagePresent > 0) {
            allData(pagePresent);
        }
    })

    $(document).on('click', '.page-prev', function (e) {
        e.preventDefault();
        pagePresent = $('.page-item.active').val();
        if (pagePresent > 1) {
            allData(pagePresent - 1);
        }
    })

    $(document).on('click', '.page-next', function (e) {
        e.preventDefault();
        pagePresent = $('.page-item.active').val();
        lastPage = $('.page-item.last-page').val();
        console.log(lastPage);

        if (pagePresent < lastPage) {
            allData(pagePresent + 1);
        }
    })


    $('.search-employee').on('keyup', function (e) {
        e.preventDefault();
        let search = $('.search-employee').val();

        $.ajax({
            type: "get",
            url: "nhanvien/all",
            data: {
                search: search
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                allData();
            }
        });
    });

    //CREATE EMPLOYEE
    $('#formInsert').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "nhanvien/store",
            data: formData,
            dataType: "JSON",
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('span.error-text').text('')
            },
            success: function (response) {
                console.log(response)

                if (response) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Successfully added new employees!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    allData();
                    $('#exampleModalInsert').modal('hide');
                    $('#formInsert').trigger('reset');
                }
            },
            error: function (error) {
                console.log(error)
                if (error.status == 403) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You must not perform this action!',
                    })
                    $('#exampleModalInsert').modal('hide');
                } else {
                    $('.employeeName_error').text(error.responseJSON.errors.employeeName);
                    $('.gender_error').text(error.responseJSON.errors.gender);
                    $('.address_error').text(error.responseJSON.errors.address);
                    $('.birthday_error').text(error.responseJSON.errors.birthday);
                    $('.phongban_error').text(error.responseJSON.errors.phongban_id);
                    $('.bangcap_error').text(error.responseJSON.errors.bangcap_id);
                    $('.imageEmployee_error').text(error.responseJSON.errors.imageEmployee);
                }
            }
        });
    });

    $(document).on('click', '.btn_modal_edit', function () {
        var id = $(this).val();
        $('.idUpdate').val(id);
        $('.btn_save_data').val(id);
        $.ajax({
            type: "post",
            url: "nhanvien/edit",
            data: {
                id: id,
            },
            dataType: "json",
            beforeSend: function () {
                $('span.error-text').text('')
            },
            success: function (response) {
                $('input[name = "employeeNameEdit"]').val(response.ten_nv);
                $('input[name = "employeeCodeEdit"]').val(response.ma_nv);
                $('select[name = "genderEdit"]').val(response.gioi_tinh);
                $('input[name = "addressEdit"]').val(response.noi_sinh);
                $('input[name = "birthdayEdit"]').val(response.ngay_sinh);
                $('select[name = "phongban_idEdit"]').val(response.phongban_id);
                $('select[name = "bangcap_idEdit"]').val(response.bangcap_id);
                $('img.imageEmployeeEdit').attr('src', response.image_path);
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

    $('#formEdit').on('submit', function (e) {
        e.preventDefault();
        var id = $('.btn_save_edit').val()
        let formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "nhanvien/update",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Edit successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#exampleModalEdit').modal('hide');
                    allData();
                }
            },
            error: function (error) {

            }
        });
    })

    // DELETE EMPLOYEE
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
                    type: "post",
                    url: "nhanvien/delete",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            Swal.fire(
                                'Deleted!',
                                'Delete employee successfully.',
                                'success'
                            )
                        }
                        allData();
                    },
                    error: function (error) {
                        if (error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'You must not perform this action!',
                            })
                        }

                    }
                });

            }
        })
    })

});