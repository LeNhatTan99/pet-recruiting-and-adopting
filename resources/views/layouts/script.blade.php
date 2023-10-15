<script src="{{ asset('base/js/jquery-2.2.4.js') }}"></script>
<script>
    $(document).ready(function() {
        $(".btn-nav-action").click(function(event) {
            event.stopPropagation();
            $(".nav-action-box").toggle();
        });
    
        $(document).click(function() {
            $(".nav-action-box").hide();
        });
    });
</script>