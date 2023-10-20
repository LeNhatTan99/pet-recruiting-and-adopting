<script>
$(document).ready(function () {
    $('select[name="status"]').on('change',function() {
    // get value input and select
        var statusValue = $(this).val();
        var id = $(this).data('value-id');
        let url = "{{ route('update.adoption-application', ['id' => 'id']) }}".replace('id', id);
        // send AJAX request
        $.ajax({
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            data: {
                status: statusValue
            },
            success: function(result) {
                if(result.success && result.message) {
                    toastr.success(result.message);
                } else {
                    toastr.error(result.message);
                }
            },
            error: function(error) {
                console.log(url);
                console.log(error);
            }
        });
    });
}); 
</script>