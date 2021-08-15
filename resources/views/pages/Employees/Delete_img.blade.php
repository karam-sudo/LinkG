<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_img{{$attachment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('projects_trans.Delete_attachment')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('Delete_Employee_attachment')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$attachment->id}}">

                    <input type="hidden" name="Employee_name" value="{{Str::slug($attachment->imageable->getTranslation('Name','en'))}}">
                    <input type="hidden" name="Employee_id" value="{{$attachment->imageable->id}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('projects_trans.Delete_attachment_tilte')}}</h5>
                    <input type="text" name="filename" readonly value="{{$attachment->filename}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('projects_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('projects_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>