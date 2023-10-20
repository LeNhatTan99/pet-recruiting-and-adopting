@if (session('success') || session('error'))
    <script type="text/javascript">
        @if (session('success'))
            Command: toastr["success"]("{{ session('success') }}")
        @elseif(session('error'))
            Command: toastr["error"]("{{ session('error') }}")
        @elseif(session('warning'))
            Command: toastr["warning"]("{{ session('warning') }}")
        @elseif(session('info'))
            Command: toastr["info"]("{{ session('info') }}")
        @else
        @endif
    </script>
@endif