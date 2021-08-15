<?php

namespace App\Repository;


use App\Models\Position;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Exception;

class PositionRepository  implements PositionRepositoryInterface
{   

    public function Get_Services_Position()
    {
        
        $Services = Service::with(['Positions'])->get();
        $list_Services = Service::all();
        return view('pages.Positions.Position',compact('Services','list_Services'));
    }

    public function Store_Positions($request)
    {
        
        try {

            $Positions = new Position();
      
            $Positions->Name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];
            $Positions->Description=['ar' => $request->Description_ar , 'en' => $request->Description_en];
            $Positions->Service_id = $request->Service_id;
            $Positions->save();
      
            toastr()->success(trans('messages.success'));
      
            return redirect()->route('Positions.index');
          }
      
          catch (\Exception $e){
              
              return redirect()->back()->withErrors(['error' => $e->getMessage()]);
          }



    }

    public function Update_Position($request)
    
    {
      
        try {

        $Positions = Position::findOrFail($request->id);

        $Positions->Name= ['ar' => $request->Name_ar, 'en' => $request->Name_en];
        $Positions->Description=['ar' => $request->Description_ar , 'en' => $request->Description_en];
        $Positions->Service_id = $request->Service_id;
        $Positions->save();

        toastr()->success(trans('messages.Update'));

        return redirect()->route('Positions.index');
         }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }  
    
    
    public function Delete_Position($request)
    {
         
        Position::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Positions.index');
        
    }

}
















?>
