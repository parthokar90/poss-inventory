<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\category\Category;
use App\Http\Requests\CategoryValidationRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->search!=''){
            $count=Category::where('category_name','LIKE',"%{$request->search}%")->count();
            if($count==0){
            session()->flash("error","Category not found");
            return redirect(route('category.index'));
            }
            $list=Category::where('category_name', 'LIKE', "%{$request->search}%")->orderBy('id','DESC')->simplePaginate(10);
            return view('category.index',compact('list'));
        }
        $list=Category::orderBy('id','DESC')->simplePaginate(10);
        return view('category.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list=Category::orderBy('id','DESC')->where('status',1)->get();
        return view('category.create',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryValidationRequest $request)
    {
       if($request->parent_id==''){
          $parent=0;
       }else{
           $parent=$request->parent_id;
       }
        $image_name=null;
        if($request->hasFile('image')){
             $image_name = time().'.'.$request->image->getClientOriginalExtension();
             $request->image->move(('category_logo/'), $image_name);
        }
        $store=new Category;
        $store->category_name=$request->category_name;
        $store->parent_id=$parent;
        $store->image=$image_name;
        $store->slug=lcfirst($request->category_name);;
        $store->description=$request->description;
        $store->save();
        session()->flash("success","Information saved Successfully");
        return redirect(route('category.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list=Category::orderBy('id','DESC')->where('status',1)->get();
        $edit=Category::find($id);
        return view('category.edit',compact('edit','list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryValidationRequest $request, $id)
    {
        if($request->image==''){
           $image_name=$request->d_logo;
        }else{
          $image_name = time().'.'.$request->image->getClientOriginalExtension();
          $request->image->move(('category_logo/'), $image_name);
        }
        Category::where('id',$id)->update([
            'category_name'=>$request->category_name,
            'parent_id'=>$request->parent_id,
            'category_name'=>$request->category_name,
            'image'=>$image_name,
            'slug'=>lcfirst($request->category_name),
            'description'=>$request->description,
            'status'=>$request->status,
        ]);
        session()->flash("success","Information update Successfully");
        return redirect(route('category.index'));
    }

    //subcategory show
    public function subCategory($id){
      $sub_category=Category::where('parent_id',$id)->get(); 
      return response()->json($sub_category);
    }

}
