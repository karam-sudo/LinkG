<?php

namespace App\Repository;

interface ProjectRepositoryInterface{


   //  Get_Services and projects
   public function Get_Services_Projects();


    // show Projects Deatails 
   public function Show_Projects($id);


   //Store Projects
   public function Store_Projects($request);


   //Update Projects
  public function Update_Projects($request);


  //Delete_Project
  public function Delete_Projects($request );

  //upload attachment 
  public function Upload_attachment($request);


  //Download_attachment
  public function Download_attachment($projectsname,$filename);

   //Delete_attachment
   public function Delete_attachment($request);

}
























?>