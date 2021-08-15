<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{
    
    protected $Employee;

    public function __construct(EmployeeRepositoryInterface $Employee)
    {
        $this->Employee=$Employee;

        $this->middleware('permission:Employees', ['only' => ['index']]);
        $this->middleware('permission:Add Employee', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Employee', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Employee', ['only' => ['destroy']]);
        $this->middleware('permission:Show Employee Attachment', ['only' => ['show']]);
    }


    public function index()
    {
        return $this->Employee->Get_Employee();
    }

  
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
       return $this->Employee->Store_Employee($request);
    }


    public function show($id)
    {
        return $this->Employee->Show_Employee($id);
    }

    
    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        return $this->Employee->Update_Employee($request);
    }




    public function destroy(Request $request)
    {
        return $this->Employee->Delete_Employee($request);
    }



    public function Get_Positions($id){

        return $this->Employee->Get_Positions($id);
    }


    public function Upload_attachment(Request $request)
    {
        return $this->Employee->Upload_attachment($request);
    }

    public function Download_attachment($Employeename , $filename)
    {
        return $this->Employee->Download_attachment($Employeename,$filename);

    }

    public function Delete_attachment(Request $request)
    {
        return $this->Employee->Delete_attachment($request);
    }
}
