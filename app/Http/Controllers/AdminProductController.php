<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();

        return view('backend.product.index', [
            'title' => 'Product',
            'products' => $product,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create', [
            'title' => 'Create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'product_name' => 'required',
            'product_code' => 'required|min:6|max:6|unique:products',
            'price' => 'required',
            'quantity' => 'required|min:1',
            'image' => 'required|file|image|max:1024',
        ];

        $validatedData = $request->validate($rules);

        //simpan foto di storage
        $validatedData['image'] = $request->file('image')->store('image_product', 'public');

        Product::create($validatedData);

        return redirect('/admin/product')->with('success', 'Product berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('backend.product.edit', [
            'title' => 'Edit',
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $rules = [
            'product_name' => 'required',
            'price' => 'required',
            'quantity' => 'required|min:1',

        ];

        if ($request->image) {
            $rules['product_code'] = 'required|file|image|max:1024';
        }

        if ($request->product_code != $product->product_code) {
            $rules['product_code'] = 'required|min:6|max:6|unique:products';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::disk('public')->delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('image_product', 'public');
        }

        Product::where('id', $product->id)->update($validatedData);

        return redirect('/admin/product')->with('success', 'Product berhasil Diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // hapus user berdasarkan id
        Product::destroy($product->id);

        return redirect('/admin/product')->with('success', 'Product behasil dihapus !');
    }
}
