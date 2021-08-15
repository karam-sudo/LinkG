<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use App\Repository\ServiceRepositoryInterface;

class ServiceController extends Controller
{

    protected $Service;

    public function __construct(ServiceRepositoryInterface $Service)
    {
        $this->Service=$Service;
        $this->middleware('permission:services', ['only' => ['index']]);
        $this->middleware('permission:Add Services', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Service', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Service', ['only' => ['destroy']]);
        $this->middleware('permission:Show Service Attachment', ['only' => ['show']]);
    }




    public function index()
    {
       return $this->Service->Get_Services();
    }

  
    public function create()
    {
        //
    }

   
    public function store(ServiceRequest $request)
    {
        return $this->Service->Store_Services($request);
    }

  
    public function show($id)
    {
        return $this->Service->Show_Services($id);
    }


    public function edit($id)
    {
        //
    }

  
    public function update(ServiceRequest $request)
    {
        return $this->Service->Update_Services($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->Service->Delete_Services($request);
    }


    public function Upload_attachment(Request $request)
    {
        return $this->Service->Upload_attachment($request);
    }

    public function  Download_attachment($Serviceename, $filename)
    {
        return $this->Service->Download_attachment($Serviceename ,$filename);
    }

    public function Delete_attachment(Request $request)
    {
        return $this->Service->Delete_attachment($request);
    }
}
