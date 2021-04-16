@extends('navbar')

@section('content')

    <!-- Header -->
    <header class="jumbotron">
        <h1 class="display-4">Cadastro de clientes</h1>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCenter">
            Novo Cliente
        </button>
    </header>

    <!-- Table -->
    <body class="page">
    <table id="customers_table" class="table table-hover table-responsive-sm" style="width:100%">
        <thead>
        <tr>
            <th>CPF</th>
            <th>Nome do cliente</th>
            <th>Email</th>
            <th></th>
        </tr>
        </thead>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadastro de Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="customerForm" action="" method="post" enctype="multipart/form-data">
                        <input class="form-control" type="hidden" name="customerIdInput" id="customerIdInput">
                        <div class="form-group">
                            <label for="customerNameInput">Nome do cliente</label>
                            <input type="text" class="form-control" id="customerNameInput" name="customerNameInput">
                        </div>
                        <div class="form-group">
                            <label for="cpfInput">CPF</label>
                            <input type="number" class="form-control" id="cpfInput" name="cpfInput">
                        </div>
                        <div class="form-group">
                            <label for="emailInput">Email</label>
                            <input type="email" class="form-control" id="emailInput" name="emailInput">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
@endsection
@section('scripts')
    <script>
        $(document).ready(() => {
            var table = $('#customers_table').DataTable({
                ajax: "{{route('customers.getAll')}}",
                columns: [
                    {data: 'cpf'},
                    {data: 'name'},
                    {data: 'email'},
                    {
                        "orderable": false,
                        "data": null,
                        "defaultContent": "" +
                            "<a id='edit' style='color: white' class='material-icons btn btn-primary'>edit</a> " +
                            "<a id='delete' style='color: white' class='material-icons btn btn-danger'>delete</a>"
                    },
                ],
                "language": {
                    "decimal": ",",
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/pt_br.json"
                }
            });

            $('#customers_table tbody').on('click', '#edit', function () {
                const customerData = table.row($(this).parents('tr')).data();
                $('#modalCenter').modal({show: true});

                $('#customerIdInput').val(customerData.id);
                $('#customerNameInput').val(customerData.name);
                $('#cpfInput').val(customerData.cpf);
                $('#emailInput').val(customerData.email);
            });

            $('#customers_table tbody').on('click', '#delete', function () {
                const customerData = table.row($(this).parents('tr')).data();

                $.ajax({
                    url: "{{route('customers.delete')}}",
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        id: customerData.id
                    },
                    success: (data) => {
                        setTimeout(() => {
                            document.location.reload()
                        }, 500);
                    },
                    error: (data) => {
                        toastr.error('Erro ao incluir um produto!');
                    }
                });
            });

            $('#modalCenter').on('hidden.bs.modal', function () {
                $('#customerIdInput').val(null);
                $('#customerNameInput').val(null);
                $('#cpfInput').val(null);
                $('#emailInput').val(null);
            });

            $('#customerForm').submit(function () {
                e.preventDefault();
                $.ajax({
                    url: "{{route('customers.create')}}",
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function () {
                        setTimeout(function () {
                            document.location.reload()
                        }, 2500);
                    },
                    error: function () {
                        toastr.error('Erro ao incluir um produto!');
                    }
                });
            });
        });
    </script>
@endsection
