<?php

namespace App\Http\Controllers\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\GalleryRepositoryInterface;

class GalleryController extends Controller
{
    protected $Gallery;

    public function __construct(GalleryRepositoryInterface $Gallery)
    {
        $this->Gallery=$Gallery;
        $this->middleware('permission:Gallery', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->Gallery->Get_Gallery();
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
        return $this->Gallery->Store_Gallery($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->Gallery->Show_Gallery($id);
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
    public function update(Request $request)
    {
       return $this->Gallery->Update_Gallery($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->Gallery->Delete_Gallery($request);
    }

    public function Upload_attachment(Request $request)
    {
        return $this->Gallery->Upload_attachment($request);
    }


    public function Download_attachment($Galleriesdesc,$filename)
    {
        return $this->Gallery->Download_attachment($Galleriesdesc,$filename);
    }

    public function Delete_attachment(Request $request)
    {
        return $this->Gallery->Delete_attachment($request);

    }
}
