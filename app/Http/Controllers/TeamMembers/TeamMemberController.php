<?php

namespace App\Http\Controllers\TeamMembers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;
use App\Repository\TeamMemberRepositoryInterface;

class TeamMemberController extends Controller
{
    protected $Team;

    public function __construct(TeamMemberRepositoryInterface $Team)
    {
        $this->Team=$Team;
    }


    public function index()
    {
        return $this->Team->Get_Service_TeamMembers();
    }

    
    public function create()
    {
        return $this->Team->Create_Member();
    }

    
    public function store(TeamRequest $request)
    {
        return $this->Team->Store_Member($request);
        
    }

   
    public function show($id)
    {
        return $this->Team->Show_Member($id);
    }

    
    public function edit($id)
    {
        return $this->Team->Edit_TeamMember($id);
    }

   
    public function update(TeamRequest $request)
    {
        return $this->Team->Update_TeamMember($request);
    }

   
    public function destroy(Request $request)
    {
        return $this->Team->Delete_Memeber($request);
    }

    public function Get_Positions($id)
    {
        return $this->Team->Get_Positions($id);
    }

    public function Upload_attachment(Request $request)
    {
        return $this->Team->Upload_attachment($request);
    }


    public function Download_attachment($membername,$filename)
    {
        return $this->Team->Download_attachment($membername,$filename);
    }


    public function Delete_attachment(Request $request)
    {
        return $this->Team->Delete_attachment($request);

    }


}
