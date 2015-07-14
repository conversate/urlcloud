<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\File;
use App\Link;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }


    /**
    * Deliver a downloadable file
    * (Not for API use)
    *
    * @return Response
    */
    public function download(Request $request, $id) {
    
        // TODO: Proper validation
        $id = filter_var($id);

        // TODO: Optimize DB queries
        $link = Link::whereRaw('BINARY uri = ?', [$id])->first();
        $file = File::whereRaw('BINARY hash = ?', [$link->hash])->first();

        return view('file.show', [
            'file'      => $file,
            'link'      => $link,
            'request'   => $request,
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        // TODO: Proper Validation
        $id = filter_var($id);
  
        // TODO: Optimize DB queries
        $link = Link::whereRaw('BINARY uri = ?', [$id])->first();
        $file = File::whereRaw('BINARY hash = ?', [$link->hash])->first();

        // Acceptable image file previews
        $previews = [
        'image/png',
        'image/jpeg',
        'image/jpg',
        'image/gif',
        ];

        // Check if eligible for preview
        $preview = in_array($file->mime, $previews);

        // TODO: Replace w/ real glide caching
        $cache = ($preview) ? '/image.png' : null;

        return view('file.show', [
            'file'      => $file,
            'link'      => $link,
            'preview'   => $preview,
            'cached_url'=> $cache,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
