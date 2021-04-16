<?php

namespace App\Http\Controllers;

use App\Models\CustomersModel;
use App\Models\OrdersModel;
use App\Models\ProductsModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function index()
    {
        return view('registrations/orders');
    }

    public function getAll()
    {
        $data = DB::table('product_orders')
            ->join('customers', 'product_orders.customer_cpf', '=', 'customers.cpf')
            ->join('products', 'product_orders.bar_code', '=', 'products.bar_code')
            ->select('product_orders.*', 'customers.id as custumer_id', 'products.id as product_id')
            ->get();
        return response()->json(['success' => false, 'data' => $data]);
    }

    public function getData()
    {
        $data = [
            'customers' => $customersData = CustomersModel::all(),
            'products' => $productsData = ProductsModel::all()
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $customerData = CustomersModel::find($request->post('customer'));
        $productData = ProductsModel::find($request->post('product'));
        $date = date("Y-m-d H:i:s");

        $orderData = OrdersModel::updateOrCreate(
            ['order_number' => $request->post('orderIdInput')],
            [
                'customer_name' => $customerData->name,
                'customer_cpf' => $customerData->cpf,
                'customer_email' => $customerData->email,
                'dt_order' => $date,
                'bar_code' => $productData->bar_code,
                'product_name' => $productData->product_name,
                'unit_price' => $productData->unit_price,
                'amount' => $request->post('amountInput'),
            ]
        );

        return response()->json($orderData);
    }

    public function delete(Request $request)
    {
        $dataBase = OrdersModel::where([['order_number', $request->all('order_number')]])->delete();
        return response()->json(['success' => false, 'data' => $dataBase]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
