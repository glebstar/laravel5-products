<?php

namespace GlebStarProducts\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use GlebStarProducts\Models\Product;

class ProductController extends BaseController
{
    public function __construct()
    {
        $this->middleware('product');
    }

    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('products::index', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products::create');
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->_validate($request);

        Product::create([
            'name' => $request->name,
            'art'  => $request->art,
        ]);

        return redirect(route('products.index'));
    }

    /**
     * Show the form for editing the product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('products::edit', ['product' => Product::find($id)]);
    }

    /**
     * Update the product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->_validate($request, $id);

        Product::find($id)->update([
            'name' => $request->name,
            'art'  => $request->art,
        ]);

        return redirect(route('products.index'));
    }

    /**
     * Remove the product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect(route('products.index'));
    }

    protected function _validate($request, $id = null)
    {
        if ($id) {
            $artRule = 'required|regex:/^[a-z0-9]+$/|unique:products,art,' . $id;
        } else {
            $artRule = 'required|regex:/^[a-z0-9]+$/|unique:products,art';
        }

        $this->validate($request, [
            'name' => 'required|min:10',
            'art'  => $artRule,
        ]);
    }
}