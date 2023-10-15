<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#ImdID').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $(document).ready(function () {
        const khoaSelect = $('#khoa_select');
        const lopSelect = $('#lop_select');
        
        khoaSelect.on('change', function () {
            const selectedKhoaId = khoaSelect.find('option:selected').data('khoa-id');
            
            $.ajax({
                url: '{{ route("get-lops-by-khoa", ":khoaId") }}'.replace(':khoaId', selectedKhoaId),
                method: 'GET',
                success: function (data) {
                    lopSelect.find('option').remove();
                    
                    data.lops.forEach(function (lop) {
                        lopSelect.append($('<option>', {
                            value: lop.id,
                            'data-khoa-id': lop.khoa_id,
                            text: lop.name
                        }));
                    });
                    console.log(data)
                }
            });
        });
    });



    $(document).ready(function () {
    const khoaSelect = $('#khoa_select');
    const lopSelect = $('#lop_select');
    
    khoaSelect.on('change', function () {
        const selectedKhoaId = khoaSelect.find('option:selected').val();

        // Đoạn mã gửi yêu cầu Ajax để lấy danh sách lớp tương tự
        $.ajax({
            url: '{{ route("get-lops-by-khoa", ":khoaId") }}'.replace(':khoaId', selectedKhoaId),
            method: 'GET',
            success: function (data) {
                lopSelect.empty();

                lopSelect.append($('<option>', {
                    value: '',
                    text: 'Chọn lớp',
                }));

                data.lops.forEach(function (lop) {
                    lopSelect.append($('<option>', {
                        value: lop.id,
                        'data-khoa-id': lop.khoa_id,
                        text: lop.name
                    }));
                });
                console.log(data)
            }
        });
    });
});


</script>