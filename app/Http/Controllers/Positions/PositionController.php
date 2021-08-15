<?php

namespace App\Http\Controllers\Positions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\PositionRepositoryInterface;
use App\Http\Requests\PositionRequest;

class PositionController extends Controller
{
    
    protected $Position;

    public function __construct(PositionRepositoryInterface $Position)
    {
        $this->Position=$Position;
        $this->middleware('permission:Positions', ['only' => ['index']]);
        $this->middleware('permission:Add Position', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Position', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Position', ['only' => ['destroy']]);
    }


    public function index()
    {
        return $this->Position->Get_Services_Position();
    }

   
    public function create()
    {
        //
    }

    
    public function store(PositionRequest $request)
    {
        return $this->Position->Store_Positions($request);
    }

  
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

 
    public function update(PositionRequest $request)
    {
        return $this->Position->Update_Position($request);
    }

 
    public function destroy(Request $request)
    {
        return $this->Position->Delete_Position($request);
    }
}
