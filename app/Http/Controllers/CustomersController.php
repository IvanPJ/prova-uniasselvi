<?php

namespace App\Http\Controllers;

use App\Models\CustomersModel;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
    }

    public function getAll()
    {
        $data = CustomersModel::get();
        if ($data) {
            return response()->json(['success' => true, 'data' => $data]);
        }
        return response()->json(['success' => false, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $dataBase = CustomersModel::updateOrCreate(
            ['id' => $request->post('customerIdInput')],
            [
                'name' => $request->post('customerNameInput'),
                'cpf' => $request->post('cpfInput'),
                'email' => $request->post('emailInput')
            ]
        );
        if ($dataBase)
            return response()->json(['success' => true, 'data' => $dataBase, 'message' => 'Sucesso ao adicionar um cliente!']);
        return response()->json(['success' => false, 'data' => $dataBase]);
    }

    public function delete(Request $request)
    {
        $dataBase = CustomersModel::where([['id', $request->all('id')]])->delete();
        return response()->json(['success' => false, 'data' => $dataBase]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
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
     * @param Request $request
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
