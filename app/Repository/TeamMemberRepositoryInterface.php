<?php

namespace App\Repository;

interface TeamMemberRepositoryInterface{

    //get TeamMembers by Services
   public function Get_Service_TeamMembers(); 
    //create member
   public function Create_Member();

   //show member details 
   public function Show_Member($id);

   //Edit TeamMember
   public function Edit_TeamMember($id);

   //get positions by services
   public function Get_Positions($id);

   //Store Member
   public function Store_Member($request);

    //update member
   public function Update_TeamMember($request);
   
    //Delete member
   public function Delete_Memeber($request);

    //upload attachment 
  public function Upload_attachment($request);

  //Download_attachment
  public function Download_attachment($membername,$filename);


  //Delete_attachment
  public function Delete_attachment($request);



}
























?>