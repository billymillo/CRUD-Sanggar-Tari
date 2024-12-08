<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Costume;
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
        return view('order.struk');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $costumes = Costume::all();
        return view('order.create', compact('costumes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validasi input quantity
        $request->validate([
          'name_customer' => 'required',
          'costumes' => 'required',
        ]);

       $hitungjumlah = array_count_values($request->costumes);
       $arrayFormat = [];

       foreach ($hitungjumlah as $key => $value) {
           $dataCostume = Costume::find($key);

           if (!$dataCostume) {
            return redirect()->back()->withInput()->with('failed', 'Obat dengan ID ' . $key . ' tidak ditemukan.');
        }

        if ($dataCostume->stock < $value) {
            $valueBefore = [
                "name_customer" => $request->name_customer,
                "costumes" => $request->costumes
            ];
           if($dataCostume['stock'] < $value){
            $msg = 'Tidak dapat memesan baju ' . $dataCostume['name'] . '
            sisa stock : '.  $dataCostume['stock'];
            return redirect()->back()->withInput()->with('failed', $msg);
           } else {
            // $dataCostume->stock -= $value;
            $dataCostume->save();
        }
        }
           $formatCostume = [
            "id" => $key,
            "name_costume" => $dataCostume['name'],
            "price" => $dataCostume['price'],
            "quantity" => $value,
            "sub_price" => ($dataCostume['price'] * $value),
            "pajak" =>  ($dataCostume['price'] * $value) * 0.1,
           ];

           array_push($arrayFormat, $formatCostume);
       }

       $totalHarga = 0 ;
       foreach ($arrayFormat as $key => $value) {
           $totalHarga += $value['sub_price'];
       }


        // Buat order baru
        $tambahOrder = Order::create([
            'user_id' => auth()->user()->id,
            'name_customer' => $request->name_customer,
            'total_price' => $totalHarga,
            'costumes' => ($arrayFormat),
        ]);

        if ($tambahOrder) {
          foreach ($arrayFormat as $key => $value) {
              $costumeBefore = Costume::find($value['id']);
              Costume::where('id', $value['id'])->update([
                  'stock' => $costumeBefore['stock'] - $value['quantity']
              ]);
          }
          return redirect()->route('order.chartadd',['id' => $tambahOrder->id])->with('success', 'Costume berhasil ditambahkan ke keranjang.');
        }


        // Redirect setelah order berhasil

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $order = Order::all();
        return view('order.chartStruk', compact('order'));
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
