<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $post = Post::create($request->all());
        // return $post;

        $post = new Post;

        $this->validate($request, [
            'title' => 'required|string|max:191',
            'image' => 'string',
            'body' => 'required|string',
        ]);

        $currentPhoto = $post->image;

        if($request->image != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            // using intervention image
            \Image::make($request->image)->save(public_path('img/featured_image/blog/').$name);

            $request->merge(['image' => $name]);

            $featuredImage = public_path('img/featured_image/blog/').$currentPhoto;
            if(file_exists($featuredImage)){
                @unlink($featuredImage);
            }


        }

        $post->create($request->all());














    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::findOrFail($id);
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
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return '';
    }
}
