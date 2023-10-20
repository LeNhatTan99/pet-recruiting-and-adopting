<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.querySelectorAll('.delete-button').forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const deleteUrl = this.getAttribute('href');
            const rowElement = this.closest('.item-row');
            Swal.fire({
                title: 'You definitely want to delete?',
                text: 'This action cannot be undone!',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: deleteUrl,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'post',
                        success: function(result) {
                            if(result.message) {
                                $(rowElement).hide();
                                toastr.success(result.message);
                            }   
                        },
                        error: function(error) {
                            console.log(url);
                            console.log(error);
                        }
                    });      
                }
            });
        });
    });
</script>