<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'RoleCheck:admin']);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("master-data.supplier-master.create-supplier-master");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi_data = $request->validate([
            'supplier_name'=>'required|string|max:255',
            'supplier_address'=>'required|string|max:255',
            'phone'=>'required|string|max:15',
            'comment'=>'nullable|string|max:255',
        ]);

        supplier::create($validasi_data);

        return redirect()->back()->with('success', 'Supplier added succesfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
