<?php

namespace App\Repository;

use Exception;
use App\Models\Image;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryRepository  implements GalleryRepositoryInterface
{

    public function Get_Gallery()
    {
        $Galleries=Gallery::all();
        return view('pages.Gallery.Gallery', compact('Galleries'));
    }

    public function Show_Gallery($id)
    {
        $Gallery = Gallery::findorfail($id);
        return view('pages.Gallery.show',compact('Gallery'));
    }


    public function Store_Gallery($request)
    {
      DB::beginTransaction();

      try {
          $Gallery_store = new Gallery();
          $Gallery_store->Description=['ar' => $request->Description_ar , 'en' => $request->Description_en];
          $Gallery_store->save();


          // insert img
          if ($request->hasfile('photos')) {
              foreach ($request->file('photos') as $file) {
                  $name = Str::slug($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
                  $file->storeAs('attachments/'. Str::slug($Gallery_store->getTranslation('Description','en')), $name, 'upload_attachments');

                  // insert in image_table
                  $images = new Image();
                  $images->filename = $name;
                  $images->imageable_id = $Gallery_store->id;
                  $images->imageable_type = 'App\Models\Gallery';
                  $images->save();
              }
          }

          DB::commit(); // insert data

          toastr()->success(trans('messages.success'));
          return redirect()->route('Gallery.index');


      } catch (\Exception $e) {
          DB::rollBack();
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

    }

    public function Update_Gallery($request)
    {
        try {


            $Gallery_store = Gallery::findOrFail($request->id);


            $Gallery_store->Description=['ar' => $request->Description_ar , 'en' => $request->Description_en];

            $Gallery_store->save();

            toastr()->success(trans('messages.Update'));

            return redirect()->route('Gallery.index');
           }
            catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
    }


    public function Delete_Gallery($request)
    {
        Storage::disk('upload_attachments')->deleteDirectory('attachments/'.$request->Gallery_desc);
        Image::where('imageable_id',$request->id)->delete();
        Gallery::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Gallery.index');

    }


    public function Upload_attachment($request)
    {
        foreach($request->file('photos') as $file)
        {
            $name = Str::slug($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension();
            $file->storeAs('attachments/'.$request->Gallery_desc, $name,'upload_attachments');

            // insert in image_table
            $images= new image();
            $images->filename=$name;
            $images->imageable_id = $request->Gallery_id;
            $images->imageable_type = 'App\Models\Gallery';
            $images->save();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Gallery.show',$request->Gallery_id);
    }

    public function Download_attachment($Galleriesdesc,$filename)
    {
        return response()->download(public_path('attachments/'.$Galleriesdesc.'/'.$filename));
    }

    public function Delete_attachment($request)
    {
          // Delete img in server disk
          Storage::disk('upload_attachments')->delete('attachments/'.$request->Gallery_desc.'/'.$request->filename);

          // Delete in data
          image::where('id',$request->id)->where('filename',$request->filename)->delete();
          toastr()->error(trans('messages.Delete'));
          return redirect()->route('Gallery.show',$request->Gallery_id);
    }

}
