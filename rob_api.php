<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use Str;
use App\Models\Ummuser;
use Hash;
use Carbon\Carbon;
use Session;

class ROBApiController extends Controller
{
   public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
        $this->middleware('guest')->except('logout');
    }
    public function homeSliderList($location=''){
        $path='http://20.219.125.221/rob/';
        if($location){

            $output=''; $robdata=array();
                $output = DB::table('rob_forms as rh')->select('rh.video','rh.video_caption','rh.video2','rh.video2_caption','rh.video3','rh.video3_caption', 'rd.document_name as image','rd.caption_name')
                ->leftjoin('rob_documents as rd','rh.Pk_id','=','rd.rob_form_id')
                ->where('rh.office','ROB-'.$location)
                ->where('rd.show_website',1)->get();
                //dd($output);
                if(!empty($output)){
                  $image=[];
                  $temp = [];
                     foreach($output as $key=>$val){
                      $temp['video']          = $path.$val->video;
                      $temp['video_caption']  = $val->video_caption;
                      $temp['video2']         = $path.$val->video2;
                      $temp['video2_caption'] = $val->video2_caption;
                      $temp['video3']         = $path.$val->video3;
                      $temp['video3_caption'] = $val->video3_caption;
                      $response['video_Data'] = $temp;
                      $temp2['image']= $path.$val->image;
                      $temp2['image_caption_name']= $val->caption_name;
                      $response['image_data'][] = $temp2;

                    }
                }
               
            return response(['data'=>$response,'status'=>200]);
        }else {
            return response(['msg' => ' Data  not Found.!','status'=>400]);
        }   

    }
    /* get preactivated form data  */
    public function preActivatedROBList($location=''){
        $path='http://20.219.125.221/rob/';
        if($location){
          $response=[];
          $response = DB::table('rob_forms as rh')->select('rh.*')
                // ->leftjoin('rob_documents as rd','rh.Pk_id','=','rd.rob_form_id')
                ->where('rh.rob_name','ROB-'.$location)
                //->where('rd.show_website',1)
                // ->where('rh.user_type',2)
                ->where('rh.form_type',0)
                ->where('rh.active',1)
                ->where('rh.approve',1)
                ->get();
            return response(['data'=>$response,'status'=>200]);
        }else {
            $response=[];
            $response = DB::table('rob_forms as rh')->select('rh.*')
                    // ->leftjoin('rob_documents as rd','rh.Pk_id','=','rd.rob_form_id')
                    //->where('rd.show_website',1)
                    // ->where('rh.user_type',2)
                    ->where('rh.form_type',0)
                    ->where('rh.active',1)
                    ->where('rh.approve',1)
                    ->get();
                return response(['data'=>$response,'status'=>200]);

            // return response(['msg' => ' Data  not Found.!','status'=>400]);
        }
    }
     /* get post activated form data  */
    public function postActivatedROBList($location=''){
        $path='http://20.219.125.221/rob/';
        if($location){
          $response=[];
          $response = DB::table('rob_forms as rh')->select('rh.*','rd.*')
                ->leftjoin('rob_documents as rd','rh.Pk_id','=','rd.rob_form_id')
                ->where('rh.office','ROB-'.$location)
                //->where('rd.show_website',1)
                ->where('rh.user_type',2)
                ->where('rh.form_type',1)
                ->where('rh.active',1)
                ->get();
            return response(['data'=>$response,'status'=>200]);
        }else {
            return response(['msg' => ' Data  not Found.!','status'=>400]);
        }
    }

    //rob contact us api
    public function ROBcontactus($location=''){
        if($location){
          $response=[];
          $response = DB::table('rob_contactus')
                      ->select('Headquarters','fullname','designation','contact_no','email','state_name','rob_fob_address','owner_name','rob_name','active')
                      ->where("rob_name",$location)
                      ->where("active",1)
                      ->get();
               if(count($response) > 0){
                 return response(['data'=>$response,'status'=>200]);
               }else{
                return response(['msg' => 'Data  not Found.!','status'=>400]);
               }       
           
        }else {
            return response(['msg' => ' Data  not Found.!','status'=>400]);
        }
    }

    //rob contact us api all get data
    public function ROBallcontactus(){
          $response=[];
          $response = DB::table('rob_contactus')
                      ->select('Headquarters','fullname','designation','contact_no','email','state_name','rob_fob_address','owner_name','rob_name','active')
                      ->where("active",1)
                      ->get();
               if(count($response) > 0){
                 return response(['data'=>$response,'status'=>200]);
               }else{
                return response(['msg' => 'Data  not Found.!','status'=>400]);
               }       
           
        
    }

   public function ROBbanner($location=''){
        $path='http://20.219.125.221/rob/';
        if($location){

            $output=''; $robdata=array();
                $output = DB::table('rob_banner')->select('banner_name','owner_name')
                ->where("owner_name",$location)
                ->where("active",1)
                ->get();  
            if(count($output) > 0)
            {
              $banner=[];
              foreach($output as $key=>$value){
                $banner['banner'] =$path.$value->banner_name;
                $banner['image'] = $value->owner_name;
                $response['temp_banner'][] = $banner;
              }
              return response(['data'=>$response,'status'=>200]);
            }
            else
            {
              return response(['msg' => ' Data  not Found.!','status'=>400]);
            }
        }
        else 
        {
            return response(['msg' => ' Data  not Found.!','status'=>400]);
        }   

    }


    public function ROBwhatsnew($location=''){
        $path='http://20.219.125.221/rob/';
        if($location){

            $output=''; $robdata=array();
                $output = DB::table('rob_whats_new')->select('description','post_date','conatct_person','conatct_number','filename','owner_name','rob_name')
                ->where("owner_name",$location)
                ->where("active",1)
                ->orderBy('id','desc')
                ->get();  
            if(count($output) > 0)
            {
              $ary=[];
              foreach($output as $key=>$value){
                $ary['description'] =$value->description;
                $ary['post_date'] =$value->post_date;
                $ary['conatct_person'] =$value->conatct_person;
                $ary['conatct_number'] =$value->conatct_number;
                $ary['owner_name'] =$value->owner_name;
                $ary['rob_name'] =$value->rob_name;
                $ary['filename'] = $path.$value->filename;
                $response['temp_data'][] = $ary;
              }
              return response(['data'=>$response,'status'=>200]);
            }
            else
            {
              return response(['msg' => ' Data  not Found.!','status'=>400]);
            }
        }
        else 
        {
            return response(['msg' => ' Data  not Found.!','status'=>400]);
        }   

    }

    //image and video find by id
    public function mediaById($id=''){
        $path='http://20.219.125.221:8787/rob/';
        if($id){
            $output=''; $robdata=array();
                $output = DB::table('rob_forms as rh')->select('rh.pre_photo as pre_photos','rh.sop_theme as theme','rh.event_description as description','rd.document_name as image','rd.caption_name','rd.image_type as file_type')
                ->leftjoin('rob_documents as rd','rh.Pk_id','=','rd.rob_form_id')
                ->where('rh.Pk_id',$id)
                // ->where('rd.show_website',1)
                ->get();
                // $output=DB::table('rob_forms')->select('*')->get();
                
                if(!empty($output)){
                  $image=[];
                  $temp = [];
                     foreach($output as $key=>$val)
                     {
                      //   $temp['pre_image']=$path.$val->pre_photos;
                      $temp2['image']= $path.$val->image;
                      $temp2['image_caption_name']= $val->caption_name;
                      $temp2['file_type']= $val->file_type;
                      $temp2['theme']= $val->theme;
                      $temp2['description']= $val->description;
                      $response['image_data'][] = $temp2;
                    }

                    if($val->pre_photos == '')
                    {
                        $response['pre_image'] = $response['image_data'][1]['image'];
                        $response['theme'] = $response['image_data'][1]['theme'];
                        $response['description'] = $response['image_data'][1]['description'];
                    }
                    else{
                        $response['pre_image'] = $path.$val->pre_photos;
                        $response['theme'] = $val->theme;
                        $response['description'] = $val->description;
                    }
                    
                }
               
            return response(['data'=>$response,'status'=>200]);
        }else {
            return response(['msg' => ' Data  not Found.!','status'=>400]);
        }   

    }
}
