<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
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

    public function getOrders()
    {
        $orders = Order::get(['orders.id_order','orders.applicant','orders.date_order','orders.date_delivery']);
        $count = $orders->count();
        if($count == 0){
            $orders = ['message'=>'No se Encontraron Ordenes'];
            return response() -> json($orders,200);
        }else{
            return response() -> json($orders,200);
        }
    }

    public function getOrdersDate(Request $request)
    {
        $date_consult = $request->date;
        if(!empty($date_consult)){
            $orders = Order::where('orders.date_delivery','=',$date_consult)
                        ->get(['orders.id_order','orders.applicant','orders.date_order','orders.date_delivery']);

            $count = $orders->count();
            if($count == 0){
                $orders = ['message'=>'No se Encontraron Ordenes'];
                return response() -> json($orders,200);
            }else{
                return response() -> json($orders,200);
            }
        }else{
            $orders = ['message'=>'Debe Insertar Una Fecha de Consulta'];
            return response() -> json($orders,200);
        }

    }

    public function getOrdersId(Request $request)
    {
        $id_consult = $request->id_order;
        if(!empty($id_consult)){
            $orders = Order::where('orders.id_order','=',$id_consult)->join('orders_products', 'orders.id_order', '=', 'orders_products.id_order')
                        ->join('products', 'products.id_product', '=', 'orders_products.id_product')
                        ->join('inventorys', 'inventorys.id_product', '=', 'products.id_product')
                        ->join('vendors', 'vendors.id_vendor', '=', 'products.id_vendor')
                        ->selectRaw("orders.id_order,orders.applicant,orders.date_order,orders.date_delivery,products.name_product,vendors.name_vendor,inventorys.quantity ,CASE inventorys.quantity WHEN 0 THEN 'Debe ser Abastecido' ELSE 'Producto Disponible' END AS quantity_label")
                        ->get();

            $count = $orders->count();
            if($count == 0){
                $orders = ['message'=>'No se Encontraron Ordenes'];
                return response() -> json($orders,200);
            }else{
                return response() -> json($orders,200);
            }
        }else{
            $orders = ['message'=>'Debe Insertar Un Id Consulta'];
            return response() -> json($orders,200);
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
