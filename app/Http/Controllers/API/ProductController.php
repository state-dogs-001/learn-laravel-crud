<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// include products model
use App\Models\Products;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all product
        return Products::all();
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
            'product_name' => 'required',
            'product_price' => 'required',
            'product_img' => 'required',
            'product_description' => 'required',
        ]);
        // Create product
        $response = Products::create($request->all());
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find product by id
        $response = Products::find($id);
        return $response;
    }

    public function showSome()
    {
        // Get some products
        return Products::all()->take(6);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_img' => 'required',
            'product_description' => 'required',
        ]);
        // Update product
        $isProduct = Products::where('id', '=', $id)->get();
        if (count($isProduct) == 0) {
            // Not has product
            $response = response()->json([
                'status' => 'error',
                'message' => 'Not has this product.'
            ]);
            return $response;
        } else {
            // Update product
            Products::where('id', '=', $id)->update($request->all());
            $response = response()->json([
                'status' => 'ok',
                'message' => 'Update product successfully.'
            ]);
            return $response;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDelete = Products::where('id', '=', $id)->delete();
        if ($isDelete) {
            $response = response()->json([
                'status' => 'ok',
                'message' => 'Delete product successfully.'
            ]);
            return $response;
        } else {
            $response = response()->json([
                'status' => 'error',
                'message' => 'Delete product failed!!'
            ]);
            return $response;
        }
    }

    public function search($name)
    {
        $response = Products::where([
            ['product_name', 'like', '%' . $name . '%']
        ])->get();
        return $response;
    }
}
