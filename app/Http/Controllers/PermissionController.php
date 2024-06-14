<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Auth;

class PermissionController extends Controller
{
    protected $module;
    protected $title;
    protected $view_folder;
   
    public function __construct()
    {
        $this->module = 'permissions';
        $this->title = 'Permissions';
        $this->view_folder = 'role-permission.permission';
    } 
    public function index(){
        //dd(@Auth::guard('web')->user());
        $title = $this->title;
        $module = $this->module;
        $breadcum = [$this->title=>route($this->module.'.index'),'Listing'=>''];
        $data = Permission::get();
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
            
                Permission::create(['name'=>$request->name]);
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
        $row = Permission::findById($id);
        if($row){
            return view($this->view_folder.'.edit',compact('breadcum','module','title','row'));
        }else{
            Session::flash('warning', 'Record not found!');
           return redirect()->back();
        }
        
    }


    public function update(Request $request, Permission $permission){
        DB::beginTransaction();
        try
        {
            
            $request->validate(['name'=>['required','string','unique:permissions,name,'.$permission->id]]);
            
                $permission->update(['name'=>$request->name]);
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
            $row = Permission::find($id);
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
}
