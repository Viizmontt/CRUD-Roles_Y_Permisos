@section('js')
    @if (Session::has('C'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: "success",
                    title: "¡Creado!",
                    text: "{{ Session::get('C') }}",
                });
            });
        </script>
        {{ Session::forget('C') }}
    @endif

    @if (Session::has('A'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: "success",
                    title: "¡Actualizado!",
                    text: "{{ Session::get('A') }}",
                });
            });
        </script>
        {{ Session::forget('A') }} 
    @endif

    @if (Session::has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: "success",
                    title: "¡Hecho!",
                    text: "{{ Session::get('success') }}",
                });
            });
        </script>
        {{ Session::forget('success') }} 
    @endif

    @if (Session::has('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: "{{ Session::get('error') }}",
                });
            });
        </script>
        {{ Session::forget('error') }} 
    @endif

    <script>
        $(document).ready(function() {
            $('.formEliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "¿Estas seguro?",
                    text: "¡Se va ha eliminar un registro!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "¡No, cancelar!",
                    confirmButtonText: "¡Si, hacerlo!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            })
        })
    </script>

@endsection
