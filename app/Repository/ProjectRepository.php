<?php

namespace App\Repository;

use App\Models\Image;
use App\Models\Logo;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


use Exception;

class ProjectRepository  implements ProjectRepositoryInterface
{

public function Get_Services_Projects()
{
  
  $Services = Service::with(['Projects'])->get();
  $list_Services = Service::all();
  
  return view('pages.Projects.Projects',compact('Services','list_Services'));

}

public function Show_Projects($id)
{
  $Projects = Project::findorfail($id);
  return view('pages.Projects.show',compact('Projects'));
}

public function Store_Projects($request)
  { 
    DB::beginTransaction();
    try {

      $Projects = new Project();
      $Projects->Name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];
      $Projects->Description=['ar' => $request->Description_ar , 'en' => $request->Description_en];
      $Projects->webLink = $request->webLink;
      $Projects->googleplayLink = $request->googleplayLink;
      $Projects->appstoreLink = $request->appstoreLink;
      $Projects->Service_id = $request->Service_id;
      $Projects->save();

        //insert logo
        if ($request->hasfile('logos')) {
          foreach ($request->file('logos') as $file) {
              $name =Str::slug($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
              $file->storeAs('attachments/'.Str::slug($Projects->getTranslation('Name','en')), $name, 'upload_attachments');

              // insert in image_table
              $logo = new Logo();
              $logo->filename = $name;
              $logo->logoable_id = $Projects->id;
              $logo->logoable_type = 'App\Models\Project';
              $logo->save();
          }
      }
      
      
        // if ($request->hasFile('logos')) {
         
        //   $Project_id = Project::latest()->first()->id;
        //   $image = $request->file('logos');
        //   $file_name = $image->getClientOriginalName();
   

        //   $attachments = new Logo();
        //   $attachments->filename = $file_name;
        //   $attachments->project_id = $Project_id;
        //   $attachments->save();

        //   // move pic
        //   $imageName = $request->pic->getClientOriginalName();
        //   $request->pic->move(public_path('attachments/'.Str::slug($Projects->getTranslation('Name','en')),'/'. $imageName));
     // }

          // insert img
          if ($request->hasfile('photos')) {
            foreach ($request->file('photos') as $file) {
                $name =Str::slug($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
                $file->storeAs('attachments/'.Str::slug($Projects->getTranslation('Name','en')), $name, 'upload_attachments');

                // insert in image_table
                $images = new Image();
                $images->filename = $name;
                $images->imageable_id = $Projects->id;
                $images->imageable_type = 'App\Models\Project';
                $images->save();
            }
        }

        DB::commit(); // insert data

      toastr()->success(trans('messages.success'));

      return redirect()->route('Projects.index');
    }

    catch (\Exception $e){
        DB::rollBack(); 
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }



  }

  public function Update_Projects($request)
  {
    
    try {

     
      $Projects = Project::findOrFail($request->id);

      $Projects->Name= ['ar' => $request->Name_ar, 'en' => $request->Name_en];
      $Projects->Description=['ar' => $request->Description_ar , 'en' => $request->Description_en];
      $Projects->webLink=$request->webLink;
      $Projects->googleplayLink=$request->googleplayLink;
      $Projects->appstoreLink=$request->appstoreLink;
      $Projects->Service_id = $request->Service_id;
      $Projects->save();

      toastr()->success(trans('messages.Update'));

      return redirect()->route('Projects.index');
     }
      catch (\Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

  }

  public function Delete_Projects($request)
  {
    Storage::disk('upload_attachments')->deleteDirectory('attachments/'.$request->project_name);
    Image::where('imageable_id',$request->id)->delete();
    Logo::where('logoable_id',$request->id)->delete();
    Project::findOrFail($request->id)->delete();
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('Projects.index');

  }
  
  public function Upload_attachment($request)
    {
        foreach($request->file('photos') as $file)
        {
            $name = Str::slug($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            $file->storeAs('attachments/'.$request->project_name, $name,'upload_attachments');

            // insert in image_table
            $images= new image();
            $images->filename=$name;
            $images->imageable_id = $request->project_id;
            $images->imageable_type = 'App\Models\Project';
            $images->save();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Projects.show',$request->project_id);
    }

  public function Download_attachment($projectsname, $filename)
    {
        return response()->download(public_path('attachments/'.$projectsname.'/'.$filename));
    }


  public function Delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/'.$request->project_name.'/'.$request->filename);

        // Delete in data
        image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Projects.show',$request->project_id);
    } 

}
