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

$(document).on('click', '#showButton', function() {
        var dataId = $(this).data('id');
        var modal = $('#showModal');
        let url = "{{ route('show.adoption-application', ['id' => 'id']) }}".replace('id', dataId);
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                console.log(response);
                var adoptionApplication = response.adoptionApplication
                modal.find('.result-username').val(adoptionApplication.username);
                modal.find('.result-fullname').val(adoptionApplication.first_name + ' ' + adoptionApplication.last_name);
                modal.find('.result-email').val(adoptionApplication.email);
                modal.find('.result-phone').val(adoptionApplication.phone_number);
                modal.find('.result-address').val(adoptionApplication.address);
                modal.find('.result-link-social').val(adoptionApplication.link_social);
                modal.find('.front-id-card').attr('src', '{{ asset('storage') }}/' + adoptionApplication.front_side_ID_card);
                modal.find('.back-id-card').attr('src', '{{ asset('storage') }}/' + adoptionApplication.back_side_ID_card);
            
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>