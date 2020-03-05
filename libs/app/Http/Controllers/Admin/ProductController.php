<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\AddProductRequest;
use DB;

class ProductController extends Controller
{
    //
    public function getPro() {
        $data['prolist'] = DB::table('products')->join('categories', 'products.pro_cate', '=', 'categories.cate_id')->orderBy('pro_id', 'desc')->get();
        return view('backend.product', $data);
    }

    public function getAddPro() {
        $data['catelist'] = Category::all();
        return view('backend.addproduct', $data);
    }

    public function postAddPro(AddProductRequest $request) {
        $filename = $request->img->getClientOriginalName();
        $product = new Product;
        $product->pro_name = $request->name;
        $product->pro_slug = str_slug($request->name);
        $product->pro_price = $request->price;
        $product->pro_img = $filename;
        $product->pro_accessories = $request->accessories;
        $product->pro_warranty = $request->warranty;
        $product->pro_promotion = $request->promotion;
        $product->pro_condition = $request->condition;
        $product->pro_status = $request->status;
        $product->pro_description = $request->description;
        $product->pro_cate = $request->cate;
        $product->pro_featured = $request->featured;
        $product->save();
        $request->img->storeAs('avatar', $filename);
        return back();
    }

    public function getEditPro($id) {
        $data['proitem'] = Product::find($id);
        $data['catelist'] = Category::all();
        return view('backend.editproduct', $data);
    }

    public function postEditPro(Request $request, $id) {
        $product = new Product;
        $arr['pro_name'] = $request->name;
        $arr['pro_slug'] = str_slug($request->name);
        $arr['pro_price'] = $request->price;
        $arr['pro_accessories'] = $request->accessories;
        $arr['pro_warranty'] = $request->warranty;
        $arr['pro_promotion'] = $request->promotion;
        $arr['pro_condition'] = $request->condition;
        $arr['pro_status'] = $request->status;
        $arr['pro_description'] = $request->description;
        $arr['pro_cate'] = $request->cate;
        $arr['pro_featured'] = $request->featured;
        if ($request->hasFile('img')) {
            $img = $request->img->getClientOriginalName();
            $arr['pro_img']= $img;
            $request->img->storeAs('avatar', $img);
        }
        $product::where('pro_id', $id)->update($arr);
        return redirect('admin/product');
    }

    public function getDeletePro($id) {
        Product::destroy($id);
        return back();
    }
}
