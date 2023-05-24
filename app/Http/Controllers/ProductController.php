<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function index(){
        $products=Product::all();
        return view('product.index',compact('products'));
    }//end method


    //store product
    public function store(Request $request){
        $request->validate([
            'product_name'=>'required|unique:products',
            'photos'=>'required',
        ],[
           'product_name.required'=>'Product name can not be empty',
           'photos.required'=>'Images field can not be empty',
        ]);

        $product=new Product([
            'product_name'=>$request->product_name,
            'product_description'=>$request->product_description,
        ]);

        $product->save();



        if($request->file('photos')){
            $images=$request->file('photos');
            foreach($images as $image){

                $imageName=rand().$image->getClientOriginalName();

                $image->move('product_images/',$imageName);

                $imageUrl='product_images/'.$imageName;

              Photo::create([
                    'product_id'=> $product->id,
                    'image'=> $imageUrl,
                ]);
            }
        }




        return redirect()->back()->with('message','Product added successfully');
    }//end method


    //delete product image
    public function deleteImage($id){
       $photo=Photo::find($id);

       if(File::exists($photo->image)){
        File::delete($photo->image);
       }

       $photo->delete();

       return redirect()->back();
    }//



    //edit product
    public function editProduct($id){
        $product=Product::find($id);
        return view('product.edit',compact('product'));
    }//end method


    //update product
    public function updateProduct(Request $request){
        $product=Product::find($request->id);

        $product->update([
            'product_name'=>$request->product_name,
            'product_description'=>$request->product_description,
        ]);


        if($request->file('photos')){
            $images=$request->file('photos');
            foreach($images as $image){

                $imageName=rand().$image->getClientOriginalName();

                $image->move('product_images/',$imageName);

                $imageUrl='product_images/'.$imageName;

              Photo::create([
                    'product_id'=> $product->id,
                    'image'=> $imageUrl,
                ]);
            }
        }

        return redirect('/')->with('info','Product updated successfully');

    }//end method


    //delete product
    public function deleteProduct($id){
        $product=Product::find($id);

        if($product->productImages){
            foreach($product->productImages as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
                $imageDelete=Photo::find($image->id)->delete();
            }
        }

        $product->delete();
        return redirect('/')->with('info','Product deleted successfully');
    }//end method
}
