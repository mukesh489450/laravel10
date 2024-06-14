<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $module;
    protected $title;
    protected $view_folder;
    protected $mTable;
   
    public function __construct()
    {
        $this->module = 'products';
        $this->title = 'Products';
        $this->view_folder = 'products';
        $this->mTable = 'App\Models\Product';
    } 
    public function index(){
        //dd(@Auth::guard('web')->user());
        $title = $this->title;
        $module = $this->module;
        $breadcum = [$this->title=>route($this->module.'.index'),'Listing'=>''];
        $data = $this->mTable::get();
        return view($this->view_folder.'.index',compact('breadcum','module','title','data'));
    }

    public function create(){
        $module = $this->module;
        $title = $this->title;
        $breadcum = [$this->title=>route($this->module.'.index'),'Add'=>''];
        $categories = Category::whereStatus('1')->pluck('name','id');
        return view($this->view_folder.'.create',compact('breadcum','module','title','categories'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        try
        {
            
            $validator = Validator::make($request->all(),$this->mTable::rules($request->all()));
            if ($validator->fails()) 
            {
                return redirect()->back()->withInput()->withErrors($validator->errors());
            }
            else
            {
                $row = new $this->mTable;
                $row->name = $request->name;
                $row->save();
                DB::commit();
                Session::flash('success', 'Record added successfully');
                return redirect()->route($this->module.'.index'); 
            }
            
        }
        catch(\Exception $e)
        {
            DB::rollback();
           $msg = $e->getMessage();
           Session::flash('warning', $msg);
           return redirect()->back()->withInput();
        }
    }

    public function edit($slug){
        // dd($id);
        $module = $this->module;
        $title = $this->title;
        $breadcum = [$this->title=>route($this->module.'.index'),'Edit'=>''];
        $row = $this->mTable::whereSlug($slug)->first();
        if($row){
            return view($this->view_folder.'.edit',compact('breadcum','module','title','row'));
        }else{
            Session::flash('warning', 'Record not found!');
           return redirect()->back();
        }
        
    }


    public function update(Request $request, Category $category){
        DB::beginTransaction();
        try
        {
            
            $validator = Validator::make($request->all(),$this->mTable::rules($request->all(),$category));
            if ($validator->fails()) 
            {
                return redirect()->back()->withInput()->withErrors($validator->errors());
            }
            else
            {
            
                $category->update(['name'=>$request->name]);
                DB::commit();
                Session::flash('success', 'Record updated successfully');
                return redirect()->route($this->module.'.index'); 
            }

        }
        catch(\Exception $e)
        {
            DB::rollback();
           $msg = $e->getMessage();
           Session::flash('warning', $msg);
           return redirect()->back()->withInput();
        }
    }


    public function changeStatus($slug){
        DB::beginTransaction();
        try
        {
            
            $row = $this->mTable::whereSlug($slug)->first();
            if ($row) 
            {
                $row->status = $row->status=='1'?'0':'1';
                $row->save();

                DB::commit();
                Session::flash('success', 'Status updated successfully');
                return redirect()->back(); 
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

    public function destroy($slug){
        DB::beginTransaction();
        try
        {
            $row = $this->mTable::whereSlug($slug)->first();
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
