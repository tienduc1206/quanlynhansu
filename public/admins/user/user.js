$(function () {

    $('#example').DataTable();


    //Delete User
    $(document).on('click', '.action_delete', function (e) {
        e.preventDefault();
        let url = $(this).data('url');
        let that = $(this);
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
                    type: "GET",
                    url: url,
                    success: function (response) {
                        if (response.code == 200) {
                            that.parent().parent().remove();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    }
                });

            }
        })
    })


    //Pagination
    $('.pagination a').on('click', function (e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getMoreUsers(page);
    })

    function getMoreUsers(page) {
        $.ajax({
            type: "GET",
            url: "users/get-more-users/" + "?page=" + page,
            dataType: "JSON",
            success: function (response) {
                console.log(response.data);
                data = "";
                $('tbody').html(response.data);
            }
        });
    }
});