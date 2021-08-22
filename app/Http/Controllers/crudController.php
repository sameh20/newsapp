<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use App\Models\category;
use DB;
use Session;
class crudController extends Controller
{
    
    public function insertData(Request $req){
      $this->request = $req;
      $data=Request::except('_token');

        $tbl = decrypt($data['tbl']);
        unset($data['tbl']);
        $data['created_at']=date('Y-m-d H:i:s');

        if(Request::has('social')){
          $data['social']=implode(',',$data['social']);
        }
        if(Request::has('image')){
          $data['image']=$this->uploadimage($tbl,$data['image']); 
        }
        if(Request::has('category_id')){
          $data['category_id'] = implode(',',$data['category_id']);
        }
          DB::table($tbl)->insert($data);
          if($tbl =='messages'){
        session::flash('message','Your Message was sent successfully Thanks for messaging us');

          }else{
        session::flash('message','Data was inserted successfully');
    }
    return redirect()->back();

  }
    public function updatetData(Request $req){

      $this->request = $req;
      $data = Request::except('_token');
       
        $tbl = decrypt($data['tbl']);
        unset($data['tbl']);
        $data['updated_at']=date('Y-m-d H:i:s');
        
        if(Request::has('social')){
         $data['social']=implode(',',$data['social']);
       };
        if(Request::has('image')){
          $data['image']=$this->uploadimage($tbl,$data['image']);
         
        }
        if(Request::has('category_id')){
          $data['category_id'] = implode(',',$data['category_id']);
        }
         DB::table($tbl)->where (key($data),reset($data))->update($data);
        session::flash('message','Data is updated successfully');
        return redirect()->back();
           }
           
           public function uploadimage($location,$imageName){
              $name= $imageName->getClientOriginalName();
              $imageName->move(public_path().'/'.$location,date('ymdgis').$name);
              return date('ymdgis').$name;
              
           }
};
