<?php

namespace App\Repository;

use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class ServiceRepository  implements ServiceRepositoryInterface
{


    public function Get_Services()
    {
        $Services=Service::all();
        
        return view('pages.Services.Service',compact('Services'));

    }

    public function Show_Services($id)
    {
       
    $Services=Service::findorfail($id);
    return view('pages.Services.show',compact('Services'));

    }


    public function Store_Services($request)
    {
      DB::beginTransaction();
        try {

            $Service=new Service();
    
            $Service->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
        
            $Service->Description=['ar' => $request->Description_ar , 'en' => $request->Description_en];
        
            $Service->save();

         // insert img
         if ($request->hasfile('photos')) {
          foreach ($request->file('photos') as $file) {
              $name = Str::slug($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
             // $FileDestinationPath ='/attachments/Services/'.$Service->Name .'/'. $name;
              $file->storeAs('attachments/'.Str::slug($Service->getTranslation('Name','en')), $name, 'upload_attachments');

              // insert in image_table
              $images = new Image();
              $images->filename = $name;
              $images->imageable_id = $Service->id;
              $images->imageable_type = 'App\Models\Service';
              $images->save();
          }
      }

          DB::commit(); // insert data
            toastr()->success(trans('messages.success'));
        
             return redirect()->route('Services.index');
        
            }
         
              catch (\Exception $e) {
                DB::rollBack(); 
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        
            }

    }

    public function Update_Services($request)
    {
        
    try {
  
        $Service= Service::findOrFail($request->id);
  
         $Service->update([
           $Service->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
           $Service->Description= ['en' => $request->Description_en, 'ar' => $request->Description_ar],
         ]);
    
        toastr()->success(trans('messages.success'));
    
         return redirect()->route('Services.index');
    
        }
    
          catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    
        }
    }


    public function Delete_Services($request)
    {
      $My_Project_id = Project::where('Service_id',$request->id)->pluck('Service_id');
      $My_TeamMember_id =TeamMember::where('service_id',$request->id)->pluck('service_id');

      if($My_Project_id->count() == 0 && $My_TeamMember_id->count()==0){

        Storage::disk('upload_attachments')->deleteDirectory('attachments/'.$request->Service_name);
        image::where('imageable_id',$request->id)->delete();
        Service::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Services.index');
      }
      else {
          
        toastr()->error(trans('services_trans.delete_service_Error'));
        return redirect()->route('Services.index');

      }

    }


    public function Upload_attachment($request)
    {
      foreach($request->file('photos') as $file)
        {
            $name = Str::slug($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            $file->storeAs('attachments/'.$request->Service_name, $name,'upload_attachments');

            // insert in image_table
            $images= new image();
            $images->filename=$name;
            $images->imageable_id = $request->Service_id;
            $images->imageable_type = 'App\Models\Service';
            $images->save();
        }   
        toastr()->success(trans('messages.success'));
        return redirect()->route('Services.show',$request->Service_id);
    }


    public function Download_attachment($Serviceename, $filename)
    {
      return response()->download(public_path('attachments/'.$Serviceename.'/'.$filename));

    }

    public function Delete_attachment($request)
    {
      //Delete img in server disk

      Storage::disk('upload_attachments')->delete('attachments/'.$request->Service_name.'/'.$request->filename);

      // Delete in data
      image::where('id',$request->id)->where('filename',$request->filename)->delete();

      toastr()->error(trans('messages.Delete'));
      return redirect()->route('Services.show', $request->Service_id);
    }


}








?>