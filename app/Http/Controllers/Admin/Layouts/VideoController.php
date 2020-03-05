<?php

namespace App\Http\Controllers\Admin\Layouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVideoRequest;
use App\Model\Category;
use App\Model\Video;
use App\Model\Slide;
class VideoController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $products=Video::orderBy('id','desc')->get();
        return view("admin.pages.advertisement.index",compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Video::all();
        return view('admin.pages.advertisement.input-edit.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideoRequest $request)
    {
        $product=new Video();
    
        $product->title=$request['title'];
        $product->link=$request['link'];

      
        // $image=$request->file("file_name");
        //  if($image){
        //     $image_full_name=$image->getClientOriginalName();
        //      $upload_path="files/";
        //      $image_url=$upload_path.$image_full_name;
        //      $success=$image->move($upload_path,$image_full_name);
        //     if($success){
        //       $product->video=$image_url;
        //     }
        // }
        $product->save();
        
            // $file=$request->file('file_name');
            // $destination_path=public_path().'/files';
            // $files=$file->getClientOriginalName();
            // $file_name=$files;
            // $success=$file->move($destination_path,$file_name);
            return redirect()->back();
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
