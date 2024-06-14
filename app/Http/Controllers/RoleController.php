<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    protected $module;
    protected $title;
    protected $view_folder;

    public function __construct()
    {
        $this->module = 'roles';
        $this->title = 'Roles';
        $this->view_folder = 'role-permission.role';
    } 
    public function index(){
        $title = $this->title;
        $module = $this->module;
        $breadcum = [$this->title=>route($this->module.'.index'),'Listing'=>''];
        $data = Role::get();
        return view($this->view_folder.'.index',compact('breadcum','module','title','data'));
    }

    public function create(){
        $module = $this->module;
        $title = $this->title;
        $breadcum = [$this->title=>route($this->module.'.index'),'Add'=>''];
        return view($this->view_folder.'.create',compact('breadcum','module','title'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        try
        {
            
            $request->validate(['name'=>['required','string','unique:permissions,name']]);
            
                Role::create(['name'=>$request->name]);
                DB::commit();
                Session::flash('success', 'Record added successfully');
                return redirect()->route($this->module.'.index'); 
            
        }
        catch(\Exception $e)
        {
            DB::rollback();
           $msg = $e->getMessage();
           Session::flash('warning', $msg);
           return redirect()->back()->withInput();
        }
    }

    public function edit($id){
        $module = $this->module;
        $title = $this->title;
        $breadcum = [$this->title=>route($this->module.'.index'),'Edit'=>''];
        $row = Role::findById($id);
        if($row){
            return view($this->view_folder.'.edit',compact('breadcum','module','title','row'));
        }else{
            Session::flash('warning', 'Record not found!');
           return redirect()->back();
        }
        
    }

    public function update(Request $request, Role $role){
        DB::beginTransaction();
        try
        {
            
            $request->validate(['name'=>['required','string','unique:permissions,name,'.$role->id]]);
            
                $role->update(['name'=>$request->name]);
                DB::commit();
                Session::flash('success', 'Record updated successfully');
                return redirect()->route($this->module.'.index'); 
            
        }
        catch(\Exception $e)
        {
            DB::rollback();
           $msg = $e->getMessage();
           Session::flash('warning', $msg);
           return redirect()->back()->withInput();
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try
        {
            $row = Role::find($id);
            if($row){
                $row->delete();
                DB::commit();
                Session::flash('success', 'Record deleted successfully');
                return redirect()->route($this->module.'.index'); 
            }
            else
            {
                Session::flash('warning', 'Invalid request!');
                return redirect()->back();
                
            }
        }
        catch(\Exception $e)
        {
            DB::rollback();
           $msg = $e->getMessage();
           Session::flash('warning', $msg);
           return redirect()->back();
        }
    }

    public function addPermissionToRole($roleId)
    {
        try
        {
            $module = $this->module;
            $title = $this->title;
            $permissions = Permission::get();
            $role = Role::findOrFail($roleId);
            $rolePermissions = DB::table('role_has_permissions')
                                    ->where('role_has_permissions.role_id', $role->id)
                                    ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                    ->all();

            return view($this->view_folder.'.add-permissions', compact('role','permissions','rolePermissions','module','title'));
        }
        catch(\Exception $e)
        {
            DB::rollback();
            $msg = $e->getMessage();
            Session::flash('warning', $msg);
            return redirect()->back();
        }
    }

    public function updatePermissionToRole(Request $request, $roleId)
    {
        DB::beginTransaction();
        try
        {
            $request->validate([
                'permission' => 'required'
            ]);

            $role = Role::findOrFail($roleId);
            $role->syncPermissions($request->permission);
            DB::commit();
            Session::flash('success', 'Permisson updated successfully');
            return redirect()->route($this->module.'.index'); 
            
        }
        catch(\Exception $e)
        {
            DB::rollback();
           $msg = $e->getMessage();
           Session::flash('warning', $msg);
           return redirect()->back()->withInput();
        }
        
    }
}
