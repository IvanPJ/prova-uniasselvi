@extends('navbar')

@section('content')
    <!-- Header -->
    <header class="jumbotron">
        <h1 class="display-4">Página de pedidos</h1>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCenter">
            Novo Pedido
        </button>
    </header>

    <!-- Table -->
    <body class="page">
    <table id="orders_table" class="table table-hover table-responsive-sm">
        <thead>
        <tr>
            <th>Ordem do Pedido</th>
            <th>Cliente</th>
            <th>CPF do cliente</th>
            <th>Email do cliente</th>
            <th>Data da ordem</th>
            <th>Código de barras</th>
            <th>Produto</th>
            <th>Preço Uni.</th>
            <th>Quantidade</th>
            <th>ID do Cliente</th>
            <th>ID do Produto</th>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Registro de Pedido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="productForm" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="orderId" id="orderId">
                            <label for="customerNameInput">Cliente</label>
                            <div class="input-group">
                                <select id="customer" name="customer" class="form-control"></select>
                                <div class="input-group-btn">
                                    <button title="Cadastro de Clientes" class="btn btn-default material-icons"
                                            onclick="window.location.href = '/customers'">
                                        person_add
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="productNameInput">Produto</label>
                            <div class="input-group">
                                <select id="product" name="product" class="form-control"></select>
                                <div class="input-group-btn">
                                    <button title="Cadastro de Produtos" class="btn btn-default material-icons"
                                            onclick="window.location.href = '/products'">
                                        inventory_2
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unitPriceInput">Quantidade</label>
                            <input type="number" class="form-control" id="amountInput" name="amountInput">
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar</button>
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
            $.ajax({
                url: "{{route('order.getData')}}",
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    custumersData = data.customers;
                    productsData = data.products;

                    custumersData.forEach(function (custumer) {
                        var newOption = new Option(custumer.name, custumer.id);
                        $('#customer').append(newOption);
                    });
                    productsData.forEach(function (product) {
                        var newOption = new Option(product.product_name, product.id);
                        $('#product').append(newOption);
                    });
                },
                error: function (data) {
                }
            });

            var table = $('#orders_table').DataTable({
                columnDefs: [
                    {'visible': false, 'targets': [9,10]}
                ],
                ajax: "{{route('order.getAll')}}",
                scrollX: true,
                columns: [
                    {data: 'order_number', width: '25vh'},
                    {data: 'customer_name', width: '15vh'},
                    {data: 'customer_cpf', width: '25vh'},
                    {data: 'customer_email', width: '25vh'},
                    {data: 'dt_order', width: '25vh'},
                    {data: 'bar_code', width: '25vh'},
                    {data: 'product_name', width: '25vh'},
                    {data: 'unit_price', width: '15vh'},
                    {data: 'amount', width: '15vh'},
                    {data: 'custumer_id'},
                    {data: 'product_id'},
                    {
                        "width": "15vh",
                        "orderable": false,
                        "data": null,
                        "defaultContent": "" +
                            "<a id='edit' style='color: white' class='material-icons btn btn-primary'>edit</a> " +
                            "<a id='delete' style='color: white' class='material-icons btn btn-danger'>delete</a>"
                    },
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/pt_br.json"
                }
            });

            $('#modalCenter').on('show.bs.modal', function () {
                console.log('abriu')
            });

            $('#productForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('order.create')}}",
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function (data) {
                        setTimeout(function () {
                            document.location.reload()
                        }, 1000);
                    },
                    error: function (data) {
                    }
                });
            });

            $('#orders_table tbody').on('click', '#edit', function () {
                const orderData = table.row($(this).parents('tr')).data();
                $('#modalCenter').modal({show: true});

                console.log(orderData);

                $('#orderId').val(orderData.order_number);
                $('#customer').val(orderData.custumer_id);
                $('#product').val(orderData.product_id);
                $('#amountInput').val(orderData.amount);
            });

            $('#orders_table tbody').on('click', '#delete', function () {
                const orderData = table.row($(this).parents('tr')).data();
                $.ajax({
                    url: "{{route('order.delete')}}",
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        order_number: orderData.order_number
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
                $('#orderId').val(null);
                $('#product').val(null);
                $('#customer').val(null);
                $('#amountInput').val(null);
            });
        });
    </script>
@endsection


