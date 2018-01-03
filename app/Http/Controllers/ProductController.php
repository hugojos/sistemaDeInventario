<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function searchGet($buscador){
        $post=Product::select('categories.title','name','products.id','price')->leftJoin('categories','category_id','=','categories.id')->where('name','LIKE',$buscador.'%')->get();
       if (count($post)== 0) {
         $post=Product::select('categories.title','name','products.id','price')->leftJoin('categories','category_id','=','categories.id')->where('name','LIKE','%'.$buscador.'%')->get();
       }
       return $post;
     }

    public function index()
    {
        return view('welcome',['products'=>Product::select('id','name','price','category_id')
                                          ->orderBy('name', 'ASC')
                                          ->get(),'category'=>Category::all()]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          'price'=>'required',
          'name'=>'required|string',
          'category_id'=>'required|integer'
        ]);
        Product::create([
          'name'=> $request->input('name'),
          'price'=>$request->input('price'),
          'category_id'=>$request->input('category_id')
        ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
