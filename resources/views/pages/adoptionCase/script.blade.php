<script>
    var route = $('#myForm').attr("action");
    var isSubmitting = false;

    function performSearch() {
        if (isSubmitting) {
            return;
        }
        isSubmitting = true;
        // get value input and select
        var nameValue = $('input[name=name]').val();
        var typeValue = $('#selectInputType').val();
        var breedValue = $('#selectInputBreed').val();
        var genderValues = [];
        var agesValues = [];
        $('input[name="genders[]"]:checked').each(function() {
            genderValues.push($(this).val());
        });

        $('input[name="ages[]"]:checked').each(function() {
            agesValues.push($(this).val());
        });

        // create URL search
        let url = route + '?name=' + nameValue + '&type=' + typeValue + '&breed=' + breedValue;
        if (genderValues.length) {
            url = url + '&genders%5B%5D=' + genderValues.join('&genders%5B%5D=');
        }
        if (agesValues.length) {
            url = url + '&ages%5B%5D=' + agesValues.join('&ages%5B%5D=');
        }
        // send AJAX request
        $.ajax({
            url: url,
            method: 'get',
            success: function(result) {
                $('.antialiased').html(result);
                isSubmitting = false;
            },
            error: function(error) {
                console.log(error);
                isSubmitting = false;
            }
        });
    }
    $('input[name="name"], #selectInputType, #selectInputBreed, #checkboxInputGender, #checkboxInputAge').on('change',function() {
        performSearch();
    });
</script>