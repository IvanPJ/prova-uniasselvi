<?php

namespace App\Http\Controllers;

use App\Models\ProductsModel;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getAll()
    {
        $data = ProductsModel::get();
        if ($data) {
            return response()->json(['success' => true, 'data' => $data]);
        }
        return response()->json(['success' => false, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $postDatabase = ProductsModel::updateOrCreate(
            ['id' => $request->post('productIdInput')],
            [
                'product_name' => $request->post('productNameInput'),
                'bar_code' => $request->post('barCodeInput'),
                'unit_price' => $request->post('unitPriceInput')
            ]
        );
        if ($postDatabase)
            return response()->json(['success' => true, 'data' => $postDatabase, 'message' => 'Sucesso ao adicionar um produto!']);
        return response()->json(['success' => false, 'data' => $postDatabase]);
    }

    public function delete(Request $request)
    {
        $dataBase = ProductsModel::where([['id', $request->all('id')]])->delete();
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
