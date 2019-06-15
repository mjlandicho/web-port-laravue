<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Portfolio;

class PortfolioController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->authorize('isAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Portfolio::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $portfolio = new Portfolio;

        $this->validate($request, [
            'title' => 'required|string|max:191',
            'f_image' => 'string',
            'description' => 'required|string',
            'project_info' => 'required|string',
            'client' => 'required|string',
            'website' => 'required|string',
            'completed' => 'required|string',
        ]);

        $currentPhoto = $portfolio->f_image;

        if($request->f_image != $currentPhoto){
            $name = time().'.' . explode('/', explode(':', substr($request->f_image, 0, strpos($request->f_image, ';')))[1])[1];
            // using intervention image
            \Image::make($request->f_image)->save(public_path('img/featured_image/').$name);

            $request->merge(['f_image' => $name]);

            $featuredImage = public_path('img/featured_image/').$currentPhoto;
            if(file_exists($featuredImage)){
                @unlink($featuredImage);
            }


        }

        $portfolio->create($request->all());

        // $portfolio = new Portfolio;
        // $portfolio->create([
        //     'title' => $request['title'],
        //     'f_image' => $request['f_image'],
        //     'description' => $request['description'],
        //     'project_info' => $request['project_info'],
        //     'client' => $request['client'],
        //     'website' => $request['website'],
        //     'completed' => $request['completed'],
        // ]);

        return $portfolio;

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
