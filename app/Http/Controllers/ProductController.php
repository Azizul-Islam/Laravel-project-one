<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
Use Image;
Use App\Category;

class ProductController extends Controller
{
    function addproductview(){
        $products = Product::paginate(5);
        $deleted_products = Product::onlyTrashed()->get();
        $categories =   Category::all();
        return view('product/view',compact('products','deleted_products','categories'));
    }
    function addproductinsert(Request $request){

       $request->validate([
        'product_name' =>'required',
        'category_id' =>'required',
        'product_description' =>'required',
        'product_price' =>'required|numeric',
        'product_quantity' =>'required|numeric',
        'alert_quantity' =>'required|numeric',
      ]);
    $last_insert_id = Product::insertGetId([
      'product_name' => $request->product_name,
      'category_id' => $request->category_id,
      'product_description' => $request->product_description,
      'product_price' => $request->product_price,
      'product_quantity' => $request->product_quantity,
      'alert_quantity' => $request->alert_quantity,
    ]);
    if($request->hasFile('product_image')){
      $photo_to_upload = $request->product_image;
      $file_name = $last_insert_id.".".$photo_to_upload->getClientOriginalExtension();
      Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$file_name));
      Product::find($last_insert_id)->update([
        'product_image' => $file_name
      ]);
    }
     return back()->with('status', 'Product Added Successfully');
    }
    function deleteproduct($product_id){
      Product::where('id', $product_id)->delete();
      return back()->with('deletestatus', 'Product deleted Successfully');
    }
    function editproduct($product_id){
      $single_product_id = Product::findOrFail($product_id);
     return view('product/edit',compact('single_product_id'));
    }
    function editproductinsert (Request $request){
      if($request->hasFile('product_image')){
        if(Product::find($request->product_id)->product_image == 'defaultproductphoto.jpg'){
          $photo_to_upload = $request->product_image;
          $file_name = $request->product_id.".".$photo_to_upload->getClientOriginalExtension();
          Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$file_name));
          Product::find($request->product_id)->update([
            'product_image' => $file_name
          ]);
        }
        else {
          $delete_this_file = Product::find($request->product_id)->product_image;
          unlink(base_path('public/uploads/product_photos/'.$delete_this_file));

          $photo_to_upload = $request->product_image;
          $file_name = $request->product_id.".".$photo_to_upload->getClientOriginalExtension();
          Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$file_name));
          Product::find($request->product_id)->update([
            'product_image' => $file_name
          ]);
        }
      }
      Product::find($request->product_id)->update([
        'product_name' => $request->product_name,
        'product_description' => $request->product_description,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'alert_quantity' => $request->alert_quantity,
      ]);
      return back()->with('status', 'Product Edited Successfully');
    }
    function restoreproduct ($product_id){
      Product::onlyTrashed()->where('id',$product_id)->restore();
      return back()->with('restorestatus', 'Product Restore Successfully');
    }
    function parmanentdeleteproduct($product_id){
      $delete_this_file =   Product::onlyTrashed()->find($product_id)->product_image;
      unlink(base_path('public/uploads/product_photos/'.$delete_this_file));

      Product::onlyTrashed()->find($product_id)->forceDelete();
      return back();
    }
}
