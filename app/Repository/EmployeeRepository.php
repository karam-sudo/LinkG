<?php

namespace App\Repository;

use App\models\Currency;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\Image;
use App\Models\JobTime;
use App\Models\JobType;
use App\Models\Position;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Exception;

class EmployeeRepository  implements EmployeeRepositoryInterface
{

    public function Get_Employee()
    {
        $Employees=Employee::all();
        $list_Services=Service::all();
        return view('pages.Employees.Employee',compact('Employees','list_Services'));
    }

  public function Show_Employee($id)
  {
    
    $Employees=Employee::findorfail($id);
    return view('pages.Employees.show',compact('Employees'));

  }



  public function Get_positions($id)
  {
    $list_positions = Position::where("Service_id", $id)->pluck("Name", "id");
    return $list_positions;
  }

  public function Store_Employee($request)
  {
    DB::beginTransaction();

    try {
        $Employee_store = new Employee();
        $Employee_store->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        $Employee_store->About = ['en' => $request->About_en, 'ar' => $request->About_ar];
       
        $Employee_store->service_id = $request->service_id;
        $Employee_store->position_id = $request->position_id;
        $Employee_store->save();


        // insert img
        if ($request->hasfile('photos')) {
            foreach ($request->file('photos') as $file) {
                $name = Str::slug($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
                $file->storeAs('attachments/'. Str::slug($Employee_store->getTranslation('Name','en')), $name, 'upload_attachments');

                // insert in image_table
                $images = new Image();
                $images->filename = $name;
                $images->imageable_id = $Employee_store->id;
                $images->imageable_type = 'App\Models\Employee';
                $images->save();
            }
        }

        DB::commit(); // insert data

        toastr()->success(trans('messages.success'));
        return redirect()->route('Employees.index');


    } catch (\Exception $e) {
        DB::rollBack(); 
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

  }
  
  public function Update_Employee($request)
  {
    try {
        $Employee_store= Employee::findOrFail($request->id);
        $Employee_store->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        $Employee_store->About = ['en' => $request->About_en, 'ar' => $request->About_ar];
       
        $Employee_store->service_id = $request->service_id;
        $Employee_store->position_id = $request->position_id;
        
        $Employee_store->save();


        toastr()->success(trans('messages.success'));
        return redirect()->route('Employees.index');


    } catch (\Exception $e) {
      
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

  }


  public function Delete_Employee($request)
    {
      Storage::disk('upload_attachments')->deleteDirectory('attachments/'.$request->Employee_name);
      Image::where('imageable_id',$request->id)->delete();
      Employee::findOrFail($request->id)->delete();
      toastr()->error(trans('messages.Delete'));
      return redirect()->route('Employees.index');
    }


    public function Upload_attachment($request)
    {
      foreach($request->file('photos') as $file)
        {
            $name = Str::slug($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            $file->storeAs('attachments/'.$request->Employee_name, $name,'upload_attachments');

            // insert in image_table
            $images= new image();
            $images->filename=$name;
            $images->imageable_id = $request->Employee_id;
            $images->imageable_type = 'App\Models\Employee';
            $images->save();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Employees.show',$request->Employee_id);
    }


    public function Download_attachment($Employeename, $filename)
    {
      return response()->download(public_path('attachments/'.$Employeename.'/'.$filename));
    }


    public function Delete_attachment($request)
    {
      // Delete img in server disk
      Storage::disk('upload_attachments')->delete('attachments/'.$request->Employee_name.'/'.$request->filename);

      // Delete in data
      image::where('id',$request->id)->where('filename',$request->filename)->delete();
      toastr()->error(trans('messages.Delete'));
      return redirect()->route('Employees.show',$request->Employee_id);
    }















   
}
