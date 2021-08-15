<?php

namespace App\Http\Controllers\Spatie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash as FacadesHash;

class UserController extends Controller
{
  
    
    function __construct()
    {

        $this->middleware('permission:Users', ['only' => ['index']]);
        $this->middleware('permission:Add User', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit User', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete User', ['only' => ['destroy']]);

    }

    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('pages.users.show_users', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


  
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('pages.users.Add_user', compact('roles'));
    }
  
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles_name' => 'required'
        ]);

        $input = $request->all();


        $input['password'] = FacadesHash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles_name'));
        return redirect()->route('users.index')
            ->with('success', 'تم اضافة المستخدم بنجاح');
    }

 
    public function show($id)
    {
        $user = User::find($id);
        return view('pages.users.show', compact('user'));
    }
 
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('pages.users.edit', compact('user', 'roles', 'userRole'));
    }
  
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = FacadesHash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }
        $user = User::findOrFail($id);
        $user->roles_name=$request->roles;
        $user->update($input);
        
        FacadesDB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'تم تحديث معلومات المستخدم بنجاح');
    }


    public function destroy(Request $request)
    {
        User::find($request->user_id)->delete();
        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
}
