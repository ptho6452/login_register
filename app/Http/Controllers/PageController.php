<?php

namespace App\Http\Controllers;

use App\Models\bill_details;
use App\Models\comments;
use App\Models\products;
use App\Models\slide;
use App\Models\slides;
use App\Models\type_products;
use Illuminate\Http\Request;

class PageController extends Controller
{
  
    public function getIndex(){							
        $slide =slides::all();						
    	//return view('page.trangchu',['slide'=>$slide]);						
        $new_product = products::where('new',1)->paginate(8);
        $sanpham_khuyenmai = products::where('promotion_price','<>',0)->paginate(4);						
        //dd($new_product);							
    	return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));						
    }							
    						
    public function getDetail(Request $request){							
    	$sanpham = products:: where('id',$request->id)->first();
        $splienquan = products::where('id','<>',$sanpham->id,'and','id_type','=',$sanpham->id_type)->paginate(3);						
        $comments =	comments::where('id_product',$request->id)->get();					
    	return view('page.chitiet_sanpham',compact('sanpham','splienquan','comments'));						
    }	
    public function getLoaiSp($type){			
        	$type_product =type_products::all();//Show ra tên loại sản phẩm
            $sp_theoloai = products::where('id_type',$type)->get();
            $sp_khac =products::where('id_type','<>',$type)->paginate(3);
            return view('page.loai_sanpham',compact('sp_theoloai','type_product','sp_khac'));


 }	  
 public function getIndexAdmin(){
    $products=products::all();
    return view('pageadmin.admin')->with(['products'=> $products,
                                          'sumSold'=> count(bill_details::all())]);

 }
 public function getAdminAdd(){
    return view('pageadmin.admin-add-form');
}
    

public function postAdminAdd(Request $request) {
    $product = new products();
    
    if ($request->hasFile('inputImage')) {
        $file = $request->file('inputImage');
        $fileName = $file->getClientOriginalName('inputImage');
        $file->move('source/image/product', $fileName);
        $product->image = $fileName;
    }
    
    $product->name = $request->inputName;
    $product->description = $request->inputDescription; // Sửa đúng tên trường ở đây
    $product->unit_price = $request->inputunitPrice;
    $product->promotion_price = $request->inputPromotionPrice;
    $product->unit = $request->inputunit;
    $product->new = $request->inputNew;
    $product->id_type = $request->inputType;
    
    $product->save();
    
    return $this->getIndexAdmin();
}
public function getAdminEdit($id)	{
    $product =products::find($id);
    return view('pageadmin.admin-edit-form')->with('product',$product);
}										

public function postAdminEdit(Request $request)	{
    $id =$request ->editId;
    $product =products::find($id);
    if ($request->hasFile('editImage')) {
        $file = $request->file('editImage');
        $fileName = $file->getClientOriginalName('editImage');
        $file->move('source/image/product', $fileName);
        $product->image = $fileName;
    }
    
    $product->name = $request->editName;
    $product->description = $request->editDescription;
    $product->unit_price = $request->editunitPrice;
    $product->promotion_price = $request->editPromotionPrice;
    $product->unit = $request->inputeditunit;
    $product->new = $request->editNew;
    $product->id_type = $request->editType;
    
    $product->save();
    
    return $this->getIndexAdmin();
}		
public function  postAdminDelete($id)
{
    $product = products::find($id);
    $product->delete();
    return $this->getIndexAdmin();
}

}
