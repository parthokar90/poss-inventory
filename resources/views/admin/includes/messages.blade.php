<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Success Alert
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    // Error Alert
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            confirmButtonText: 'OK'
        });
    @endif

    // Warning Alert
    @if(session('warning'))
        Swal.fire({
            icon: 'warning',
            title: 'Warning!',
            text: "{{ session('warning') }}",
            confirmButtonText: 'OK'
        });
    @endif

    // Info Alert
    @if(session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Info!',
            text: "{{ session('info') }}",
            confirmButtonText: 'OK'
        });
    @endif
</script>