@if (session('success'))
        <script>
            Swal.fire({
                title: 'Sucesso!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Erro!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'Entendido'
            });
        </script>
    @endif
