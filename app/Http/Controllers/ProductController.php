<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Models\product;
use App\Models\supplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::with('supplier');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%');
            });
        }


        // Jika tidak ada parameter ‘search’, langsung ambil produk dengan paginasi
        $products = $query->paginate(2);


      return view("master-data.product-master.index-product", compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = supplier::all();
        return view("master-data.product-master.create-product",compact('suppliers')) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi_data = $request->validate([
            'product_name'=>'required|string|max:255',
            'unit'=>'required|string|max:50',
            'type'=>'required|string|max:50',
            'information'=>'nullable|string',
            'qty'=>'required|integer',
            'producer'=>'required|string|max:255',
            'supplier_id'=> 'required|exists:suppliers,id',
        ]);

        product::create($validasi_data);

        return redirect()->back()->with('success', 'Product created succesfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $suppliers = supplier::all();
        return view("master-data.product-master.detail-product", compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $suppliers = Supplier::all(); 
    $product = Product::findOrFail($id); 

    // Kirimkan $suppliers dan $product ke view
    return view('master-data.product-master.edit-product', compact('product', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'information' => 'nullable|string',
            'qty' => 'required|integer|min:1',
            'producer' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product->update ([
            'product_name' => $request -> product_name,
            'unit' => $request->unit,
            'type' => $request->type,
            'information' => $request->information,
            'qty' => $request->qty,
            'producer' => $request->producer,
        ]);

        return redirect()->back()->with('succes', 'product update succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route('product')->with ('success', 'product berhasil dihapus.');
        }
        return redirect()->route('product')->with('error','Product tidak ditemukan.');
    }
    public function exportExcel (){
        return Excel::download(new ProductsExport,'product.xlsx');
    }
}

