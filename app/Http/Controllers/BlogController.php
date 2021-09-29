<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::user()->id;
        $blogs = Blog::where('id',$id)->orderby('id','desc')->paginate(5);

        return view('blogs.index', compact('blogs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id=Auth::user()->id;
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg']
        ]);

         if($image=$request->image){
            $uploadImage=$image->getClientOriginalName();
            $blogImage=date('ymdHis').".".$image->getClientOriginalExtension();
            $image->move(public_path('/uploads'),  $blogImage);
        }

        Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image'=>$blogImage,
            'user_id'=>$id,
            'is_active'=> true
        ]);

        return redirect()->route('blog.index')
            ->with('success', 'blog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
      
         if($request->image!=''){
            $image=$request->image;
            $blogImage=date('ymdHis').".".$image->getClientOriginalExtension();
            $image->move(public_path('/uploads'),  $blogImage);

             Blog::update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image'=>$blogImage,
            'is_active'=> $request->end_date
           ]);

        }else{
           Blog::update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active'=> $request->end_date
           ]);

        }

       

        return redirect()->route('blog.index')
            ->with('success', 'blog updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(blog $blog)
    {
        $blog->delete();

        return redirect()->route('blog.index')
            ->with('success', 'blog deleted successfully');
    }
}
