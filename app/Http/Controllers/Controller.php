<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Subservice;
use App\Models\About;
use App\Models\Statistic;
use App\Models\Subscribe;
use App\Models\Setting;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Work;
use Session;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function index(){
        $sliders=Slider::all();
        $services=Service::all();
        $subservices=Subservice::all();
        $abouts=About::find(1);
        $statistics=Statistic::find(1);
        $articles=Article::all();
        $works=Work::all();
        $Setting=Setting::all();
        

        return view('welcome')->with('works',$works)->with('Setting',$Setting)->with('sliders',$sliders)->with('services',$services)->with("abouts",$abouts)->with('statistics',$statistics)->with('articles',$articles);
    }

    public function service($id){
        $services=Service::all();
        $servicedetail=Service::find($id);
        $subservices=Subservice::all();
        $statistics=Statistic::find(1);
        return view('service')->with('servicedetail',$servicedetail)->with('services',$services)->with('statistics',$statistics);
  
    }

    public function subservice($id){
        $services=Service::all();
        $subservicedetail=Subservice::find($id);
        $statistics=Statistic::find(1);
        return view('subservice')->with('subservicedetail',$subservicedetail)->with('services',$services)->with('statistics',$statistics);
  
    }
    public function article($id){
        $services=Service::all();
        $article=Article::find($id);
        $statistics=Statistic::find(1);
        return view('article')->with('article',$article)->with('services',$services)->with('statistics',$statistics);
  
    }
    public function work($id){
        $services=Service::all();
        $work=Work::find($id);
        $statistics=Statistic::find(1);
        return view('work')->with('work',$work)->with('services',$services)->with('statistics',$statistics);
  
    }
    public function articles(){
        $services=Service::all();
        $articles=Article::all();
        $statistics=Statistic::find(1);
        return view('articles')->with('articles',$articles)->with('services',$services)->with('statistics',$statistics);
  
    }
    
    public function contact(){
        $services=Service::all();
        $statistics=Statistic::find(1);
        return view('contact')->with('services',$services)->with('statistics',$statistics);
  
    }
    public function contactsend(){
   
      
        $contact=new Contact;
        $contact->name=request()->name;
        $contact->email=request()->email;
        $contact->phone=request()->phone;
        $contact->location=request()->location;
        $contact->message=request()->message;

        $contact->save();
        Session::flash('success',' تم ارسال طلبك بنجاح');
        return redirect()->back();
    }
    //subscribe
    public function subscribe(){
   
      
        $subscribe=new Subscribe;
        $subscribe->email=request()->email;
        $subscribe->save();
        Session::flash('success',' تم ارسال طلبك بنجاح');
        return redirect()->back();
    }
}
