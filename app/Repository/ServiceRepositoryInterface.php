<?php

namespace App\Repository;

interface ServiceRepositoryInterface{


    //  Get_Services
    public function Get_Services();

    public function Show_Services($id);

    //Store_Services
    public function Store_Services($request);

    //Update_Services
    public function Update_Services($request);

    //Delete_Services
    public function Delete_Services($request);

    public function Upload_attachment($request);

    public function Download_attachment($Serviceename, $filename);

    public function Delete_attachment($request);


}
























?>