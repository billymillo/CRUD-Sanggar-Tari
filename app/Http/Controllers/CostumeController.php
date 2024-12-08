<?php

namespace App\Http\Controllers;
// use PDF;
use App\Models\Costume;
use Illuminate\Http\Request;

class CostumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $costume = Costume::where('name', 'LIKE', '%' . $request->search_costume . '%')
        ->simplepaginate(5)
        ->appends($request->all());

        return view('costume.index', compact('costume'));
    }

    // public function download()
    // {
    //     // Tentukan data yang akan dimunculkan di PDF file
    //     // Harus bertipedata array
    //     $costume = Costume::all();
    //     // Buat nama variable yang akan digunakan di pdf
    //     view()->share('costume', $costume);
    //     // Panggil file blade yang akan diubah menjadi pdf file
    //     $pdf = PDF::loadView('costume.pdf');
    //     // Proses download dan nama file
    //     return $pdf->download('pdf.pdf');
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('costume.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required|max:255',
        ]);

        $costume = new Costume();
        $costume->name = $request->name;
        $costume->price = $request->price;
        $costume->stock = $request->stock;
        $costume->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $costume->image = $filename;
        }
        $costume->save();
        return redirect()->route('costume.gallery')->with('success', 'Costume created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Costume  $costume
     * @return \Illuminate\Http\Response
     */
    public function show(Costume $costume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Costume  $costume
     * @return \Illuminate\Http\Response
     */
    public function edit(String $id)
    {
        $costumeId = Costume::where('id', $id)->first();
        return view('costume.edit', compact('costumeId'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required',
        ]);

        $costume = Costume::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $costume->image = $filename;
        }

        $costume->name = $request->name;
        $costume->price = $request->price;
        $costume->stock = $request->stock;
        $costume->description = $request->description;
        $costume->save();

        return redirect()->route('costume.gallery')->with('success', 'Costume updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Costume  $costume
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteCostume = Costume::where('id', $id)->delete();
        if($deleteCostume){
            return redirect()->back()->with('success', 'Berhasil Menghapus Data Kostum');
        }else {
            return redirect()->back()->with('error', 'Gagal Menghapus Data Kostum');
        }
    }
}
