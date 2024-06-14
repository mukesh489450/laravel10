<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth');
   }
      
   public function dashboard()
   { 
      try
      {
         if(FacadesAuth::guard('web')->user())
         {
            return view('dashboard');
         }else{
            return view('auth.login');
         }
      }catch(\Exception $e){
         $msg = $e->getMessage();
         Session::flash('warning', $msg);
         return redirect()->back();
      }
   }
}