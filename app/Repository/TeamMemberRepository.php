<?php

namespace App\Repository;

use App\models\Currency;
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
use Exception;

class TeamMemberRepository  implements TeamMemberRepositoryInterface
{

    public function Get_Service_TeamMembers()
    {
        $Services = Service::with(['TeamMembers'])->get();
        $list_Services = Service::all();
        return view('pages.TeamMembers.TeamMembers',compact('Services','list_Services'));
    }


    public function Edit_TeamMember($id)
    {
        $data['my_positions']=Service::all();
        $data['genders']=Gender::all();
        $data['jobtimes']=JobTime::all();
        $data['jobtypes']=JobType::all();
        $data['currencies']=Currency::all();
        $TeamMembers =  TeamMember::findOrFail($id);
        return view('pages.TeamMembers.edit',$data ,compact('TeamMembers'));
    }

    public function Create_Member()
    {
        $data['my_positions']=Service::all();
        $data['genders']=Gender::all();
        $data['jobtimes']=JobTime::all();
        $data['jobtypes']=JobType::all();
        $data['currencies']=Currency::all();
        return view('pages.TeamMembers.add',$data);
    }

    public function Show_Member($id)
    {
        $TeamMembers = TeamMember::findorfail($id);
        return view('pages.TeamMembers.show',compact('TeamMembers'));
    }

    public function Get_Positions($id)
    {
        $list_positions = Position::where("Service_id", $id)->pluck("Name", "id");
        return $list_positions;
    }


    public function Store_Member($request)
    {
        DB::beginTransaction();

        try {
            $TeamMembers = new TeamMember();
            $TeamMembers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $TeamMembers->Email = $request->Email;
            $TeamMembers->Phone = $request->Phone;
            $TeamMembers->Address = ['en' => $request->Address_en, 'ar' => $request->Address_ar];
            $TeamMembers->gender_id = $request->gender_id;
            $TeamMembers->jobtime_id = $request->jobtime_id;
            $TeamMembers->jobtype_id = $request->jobtype_id;
            $TeamMembers->Date_Birth = $request->Date_Birth;
            $TeamMembers->salary = $request->salary;
            $TeamMembers->currency_id = $request->currency_id;
            $TeamMembers->service_id = $request->service_id;
            $TeamMembers->position_id = $request->position_id;
            $TeamMembers->save();


            // insert img
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/Members/' . $TeamMembers->Name, $file->getClientOriginalName(), 'upload_attachments');

                    // insert in image_table
                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_id = $TeamMembers->id;
                    $images->imageable_type = 'App\Models\TeamMember';
                    $images->save();
                }
            }

            DB::commit(); // insert data

            toastr()->success(trans('messages.success'));
            return redirect()->route('TeamMembers.create');


        } catch (\Exception $e) {
            DB::rollBack(); 
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

       
    }

    public function Update_TeamMember($request)
    {

        try {
            $TeamMembers= TeamMember::findOrFail($request->id);
            $TeamMembers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $TeamMembers->Email = $request->Email;
            $TeamMembers->Phone = $request->Phone;
            $TeamMembers->Address = ['en' => $request->Address_en, 'ar' => $request->Address_ar];
            $TeamMembers->gender_id = $request->gender_id;
            $TeamMembers->jobtime_id = $request->jobtime_id;
            $TeamMembers->jobtype_id = $request->jobtype_id;
            $TeamMembers->Date_Birth = $request->Date_Birth;
            $TeamMembers->salary = $request->salary;
            $TeamMembers->currency_id = $request->currency_id;
            $TeamMembers->service_id = $request->service_id;
            $TeamMembers->position_id = $request->position_id;
            $TeamMembers->save();


            toastr()->success(trans('messages.success'));
            return redirect()->route('TeamMembers.index');


        } catch (\Exception $e) {
          
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function Delete_Memeber($request)
    {

        Storage::disk('upload_attachments')->deleteDirectory('attachments/Members/'.$request->member_name);
        TeamMember::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('TeamMembers.index');
    }

    public function Upload_attachment($request)
    {
        foreach($request->file('photos') as $file)
        {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/Members/'.$request->member_name, $file->getClientOriginalName(),'upload_attachments');

            // insert in image_table
            $images= new image();
            $images->filename=$name;
            $images->imageable_id = $request->member_id;
            $images->imageable_type = 'App\Models\TeamMember';
            $images->save();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('TeamMembers.show',$request->member_id);

    }


    public function Download_attachment($membername, $filename)
    {
        return response()->download(public_path('attachments/Members/'.$membername.'/'.$filename));
    }

    public function Delete_attachment($request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/Members/'.$request->member_name.'/'.$request->filename);

        // Delete in data
        image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('TeamMembers.show',$request->member_id);
    } 
















   
}








?>