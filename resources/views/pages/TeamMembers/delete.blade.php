<!-- Deleted inFormation Student -->
<div class="modal fade" id="Delete_TeamMember{{$list_TeamMembers->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('TeamMembers_trans.Deleted_member')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('TeamMembers.destroy','test')}}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="id" value="{{$list_TeamMembers->id}}">
                    <input type="hidden" name="member_name" value="{{$list_TeamMembers->Name}}">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('TeamMembers_trans.Deleted_member_tilte')}}</h5>
                    <input type="text" readonly value="{{$list_TeamMembers->Name}}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('TeamMembers_trans.Close')}}</button>
                        <button  class="btn btn-danger">{{trans('TeamMembers_trans.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>