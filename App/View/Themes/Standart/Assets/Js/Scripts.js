$(document).ready(function() {
    $('.delete_client').on('click', function(e) {
        e.preventDefault();

        $id = $(this).data('id');

        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: '/clients/delete',
                method: 'post',
                dataType: 'json',
                data: {id: $id},
                success: function(data) {
                    console.log(data);
                    location.reload();
                }
            })
        }
    })
});