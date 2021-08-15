<?php

namespace App\Repository;



interface EmployeeRepositoryInterface{

  public function Get_Employee();

  public function Get_positions($id);

  public function Store_Employee($request);

  public function Update_Employee($request);

  public function Delete_Employee($request);

  public function Show_Employee($id);

  public function Upload_attachment($request);

  public function Download_attachment($Employeename , $filename);

  public function Delete_attachment($request);

}
























?>