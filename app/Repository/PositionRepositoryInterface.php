<?php

namespace App\Repository;

interface PositionRepositoryInterface{

   //get services and positions
   public function Get_Services_Position();


   //store positions
   public function Store_Positions($request);

   //update position
   public function Update_Position($request);

   //delete position
   public function Delete_Position($request);
   
}
























?>