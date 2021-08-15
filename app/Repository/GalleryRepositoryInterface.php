<?php

namespace App\Repository;


interface GalleryRepositoryInterface{

    public function Get_Gallery();

    public function Store_Gallery($request);

    public function Show_Gallery($id);

    public function Update_Gallery($request);

    public function Delete_Gallery($request );

    public function Upload_attachment($request);

    public function Download_attachment($Galleriesdesc,$filename);

    public function Delete_attachment($request);

}
























?>
