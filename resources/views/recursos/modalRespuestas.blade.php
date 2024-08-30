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

        $(document).ready(function() {
            $('.open-modal').click(function() {
                var id = $(this).attr('id');
                var codigo = $(this).attr('codigo');
                var name = $(this).attr('name');
                var detalle = $(this).attr('detalle');
                $('#editarAgencia').find('input[name="id"]').val(id);
                $('#editarAgencia').find('input[name="name"]').val(name);
                $('#editarAgencia').find('input[name="codigo"]').val(codigo);
                $('#editarAgencia').find('textarea[name="detalle"]').val(detalle);
            });
        });

    </script>

@endsection
