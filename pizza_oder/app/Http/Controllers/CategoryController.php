<?php

namespace App\Http\Controllers;



use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category list page
    public function list(){
        $categorie = Category::when(request('search'),function($query) {
                                $query->where('category_name','like','%'. request('search').'%');
                                })
                                ->orderBy('id','desc')
                                ->paginate(4);
        $categorie->appends(request()->all());
        return view('admin.category.list',compact('categorie'));
    }
    public function createpage() {
        return view('admin.category.create');
    }
    public function create(Request $request) {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);

        Category::create($data);
        return redirect()->route('listpage')->with(['createSuccess'=>'categoory Create.....']);
    }

    public function delete($id) {
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'delete Success...']);
    }

    public function edit($id) {
        $Category = Category::where ('id',$id)->first();
        return view('admin.category.edit',compact('Category'));
    }

    //update
    public function update(Request $request) {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        category::where('id',$request->id)->update($data);
        return redirect()->route('listpage');
        // dd($id,$request->all());
    }

    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName'=>'required| unique:categories,category_name,'.$request->categoryId
        ])->validate();
    }
    //request category data
    private function requestCategoryData($request) {
        return[
            'category_name'=>$request->categoryName
        ];
    }
}
