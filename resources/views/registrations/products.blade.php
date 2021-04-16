@extends('navbar')

@section('content')
    <!-- Header -->
    <header class="jumbotron">
        <h1 class="display-4">Cadastro de produtos</h1>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCenter">
            Novo Produto
        </button>
    </header>

    <!-- Table -->
    <body class="page">
    <table id="customers_table" class="table table-hover table-responsive-sm" style="width:100%">
        <thead>
        <tr>
            <th>Nome do produto</th>
            <th>Código de barras</th>
            <th>Preço unitário</th>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadastro de Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="productForm" action="" method="post" enctype="multipart/form-data">
                        <input class="form-control" type="hidden" name="productIdInput" id="productIdInput">
                        <div class="form-group">
                            <label for="productNameInput">Nome do produto</label>
                            <input type="text" class="form-control" id="productNameInput" name="productNameInput">
                        </div>
                        <div class="form-group">
                            <label for="barCodeInput">Código de barras</label>
                            <input type="number" class="form-control" id="barCodeInput" name="barCodeInput">
                        </div>
                        <div class="form-group">
                            <label for="unitPriceInput">Preço unitário</label>
                            <input type="number" class="form-control" id="unitPriceInput" name="unitPriceInput">
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
        $(document).ready(function () {
            var table = $('#customers_table').DataTable({
                ajax: "{{route('products.getAll')}}",
                columns: [
                    {data: 'product_name'},
                    {data: 'bar_code'},
                    {data: 'unit_price'},
                    {
                        "orderable": false,
                        "data": null,
                        "defaultContent": "" +
                            "<a id='edit' style='color: white' class='material-icons btn btn-primary'>edit</a> " +
                            "<a id='delete' style='color: white' class='material-icons btn btn-danger'>delete</a>"
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/pt_br.json"
                }
            });

            $('#customers_table tbody').on('click', '#edit', function () {
                const productData = table.row($(this).parents('tr')).data();
                $('#modalCenter').modal({show: true});

                $('#productIdInput').val(productData.id);
                $('#productNameInput').val(productData.product_name);
                $('#barCodeInput').val(productData.bar_code);
                $('#unitPriceInput').val(productData.unit_price);
            });

            $('#customers_table tbody').on('click', '#delete', function () {
                const customerData = table.row($(this).parents('tr')).data();

                $.ajax({
                    url: "{{route('products.delete')}}",
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

            $('#productForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('products.create')}}",
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function (data) {
                        setTimeout(function () {
                            document.location.reload()
                        }, 2500);
                    },
                    error: function (data) {
                        toastr.error('Erro ao incluir um produto!');
                    }
                });
            });
        });
    </script>
@endsection


