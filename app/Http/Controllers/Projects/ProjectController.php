<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\ProjectRepositoryInterface;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    protected $Project;

    public function __construct(ProjectRepositoryInterface $Project)
    {
        $this->Project=$Project;

        $this->middleware('permission:Project', ['only' => ['index']]);
        $this->middleware('permission:Add Project', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Project', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Project', ['only' => ['destroy']]);
        $this->middleware('permission:Show Project Attachment', ['only' => ['show']]);
    }


    public function index()
    {
       return $this->Project->Get_Services_Projects();
    }


    public function create()
    {
        //
    }

  
    public function store(ProjectRequest $request)
    {
        return $this->Project->Store_Projects($request);
    }

   
    public function show($id)
    {
        return $this->Project->Show_Projects($id);
    }

 
    public function edit($id)
    {
        //
    }

    
    public function update(ProjectRequest $request)
    {
        return $this->Project->Update_Projects($request);
    }

 
    public function destroy(Request $request )
    {
        return $this->Project->Delete_Projects($request );
    }

    public function Upload_attachment(Request $request)
    {
        return $this->Project->Upload_attachment($request);
    }

    public function Download_attachment($projectsname,$filename)
    {
        return $this->Project->Download_attachment($projectsname,$filename);
    }

    
    public function Delete_attachment(Request $request)
    {
        return $this->Project->Delete_attachment($request);

    }

}
