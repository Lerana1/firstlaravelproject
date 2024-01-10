<?php

namespace App\Http\Controllers;


use App\Models\Contact;
use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product
    public function list() {
        $pizza = product::select('products.*','category_name')
                ->when(request('search'),function($query) {
                $query->where('products.name','like','%'. request('search').'%');
            })
            ->leftjoin('categories','products.category_id','categories.id')
            ->orderBy('products.created_at','desc')
            ->paginate(5);
        $pizza->appends(request()->all());
        return view('products.pizza',compact('pizza'));
    }
    //create
    public function create() {
        $categories = Category::select('id','category_name')->get();
        return view('products.create',compact('categories'));
    }

     //delete pizza
     public function deletepage($id) {
        product::where('id',$id)->delete();
        return redirect()->route('list#page')->with (['deleteSuccess'=>'product delete Success...']);
    }

    //view pizza
    public function viewpage($id) {
        $pizza = product::select('products.*','category_name')
                ->leftjoin('categories','products.category_id','categories.id')
                ->where('products.id',$id)->first();
        return view('products.view',compact('pizza'));
    }

    //update
    public function updatepage($id) {
        $pizza = product::where('id',$id)->first();
        $category = Category::get();
        return view('products.update',compact('pizza','category'));
    }


   public function createpage(Request $request) {
    $this ->productValidationCheck($request,"create");
    $data =$this ->requestProductInfo($request);
    if($request-> hasFile('image')){
        $filename = uniqid().$request->file('image')->getClientoriginalName();
        $request->file('image')->storeAs('public',$filename);
        $data['image'] = $filename;
    }
    product::create($data);
    return redirect()->route('list#page');
    }

     //update
     public function update(Request $request){
        $this->productValidationCheck($request,"update");
        $data = $this->requestProductInfo($request);

        if($request-> hasFile('image')) {
            $oldimage = product::where('id',$request->id)->first();
            $oldimage = $oldimage->image;
            if($oldimage != null) {
                Storage::delete('public/'.$oldimage);
            }
            $filename = uniqid().$request->file('image')->getClientoriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;
        }
        product::where('id',$request->id)->update($data);
        return redirect()->route('list#page');

    }

    //contact
    public function contactadmin() {
            $contect = Contact::get();
        return view('admin.order.contactuser',compact('contect'));
    }

   private function requestProductInfo($request){
    return[
        'category_id'=>$request->category,
        'name'=>$request->pizzaName,
        'description'=>$request->description,
        'price'=>$request->price,

    ];
   }
   private function productValidationCheck($request,$action) {
    $validationRules= [
        'pizzaName'=>'required|min:5|unique:products,name,'.$request->id,
        'category'=>'required',
        'description'=>'required',
        'price'=>'required',
    ];

   $validationRules ['image'] = $action == "create" ? 'required|mimes:jpg,jpeg,png,jfif' : "mimes:jpg,jpeg,png,jfif";
    Validator::make($request->all(),$validationRules)->validate();
   }
}
