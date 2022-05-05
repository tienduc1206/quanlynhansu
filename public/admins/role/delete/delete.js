$(function () {
    $('.action_delete').on('click', function (e) {
        e.preventDefault();
        let url = $(this).data('url')
        that = $(this);
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
                    type: "Get",
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
});