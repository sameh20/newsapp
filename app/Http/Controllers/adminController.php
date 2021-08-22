<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use DB;
use Session;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view ('backend.index');
    }
    public function viewcategory(){
        $data = DB::table('categories')->get();
        return view ('backend.categories.category',['data'=>$data]);
    }
    public function editcategory($id){
        $singledata = DB::table('categories')->where('cid',$id)->first();
         if($singledata == NULL){
            return redirect('viewcategory');
         }
        $data = DB::table('categories')->get();

        return view ('backend.categories.editcategory',['data'=>$data,'singledata'=>$singledata]);

    }
    public function multipleDelete(Request $req){
        $data= $req->input();
        $data=$req->except('_token');
        if($data['bulk-action']==0){
        session::flash('message','Please choose the action you want to perform');
        return redirect()->back();
    }
        $tbl = decrypt($data['tbl']);
        $tblid = decrypt($data['tblid']);
 if(empty($data['select-data'])){
    session::flash('message','Please choose the data you want to delete');
    return redirect()->back();
 }
$ids = $data['select-data'];
 foreach($ids as $id){
  DB::table($tbl)->where($tblid,$id)->delete();
}

session::flash('message',' Data deleted successfully');
return redirect()->back();
}
public function settings(){
    $data = DB::table('settings')->first();
    if($data){
        $data->social = explode(',',$data->social); 
    }
    return view('backend.settings',['data' => $data]);

}
   public function addPost(){
    $categories = DB::table('categories')->get();
    return view('backend.post.add-post',['categories'=>$categories]);
  }
   public function allPosts(){
    $posts = DB::table('posts')->orderby('pid','DESC')->paginate(20);
    foreach($posts as $post){
        $categories = explode(',',$post->category_id);
        foreach($categories as $cat){
            $postcat = DB::table('categories')->where('cid',$cat)->value('title');
            $postcategories[]= $postcat;
            $postcat = implode(', ', $postcategories);
        }
        $post->category_id = $postcat;
        $postcategories = [];
    }
    $published = DB::table('posts')->where('status','publish')->count();
    $allposts = DB::table('posts')->count();
    return view ('backend.post.all-posts',['posts'=>$posts,'published'=>$published,'allposts'=>$allposts]);
}
    public function editPost($id){
    $data = DB::table('posts')->where('pid',$id)->first();
    $postcat = explode(',', $data->category_id);
    $categories = DB::table('categories')->get();

    return view('backend.post.editpost',['data'=>$data,'categories'=>$categories,'postcat'=>$postcat]);

}

public function addPage(){
    return view('backend.pages.add-page');
  }
   public function allPages(){
    $pages = DB::table('pages')->get();
    
    $published = DB::table('pages')->where('status','publish')->count();
    $allpages = DB::table('pages')->count();
    return view ('backend.pages.all-pages',['pages'=>$pages,'published'=>$published,'allpages'=>$allpages]);
}
public function editPage($pageid){
    $data = DB::table('pages')->where('pageid',$pageid)->first();
    return view('backend.pages.editpage',['data'=>$data]);

}
  public function messages(){
      $data = DB::table('messages')->orderby('mid','DESC')->paginate(20);
      return view('backend.messages',['data'=>$data]);
  }
  public function addAdv(){
    return view('backend.advertisment.add-adv');
  }
  public function allAdv(){
   $data = DB::table('advertisments')->orderby('aid','DESC')->GET();
    return view('backend.advertisment.all-adv',['data'=>$data]);
  }
  public function editAdv($id){
    $data = DB::table('advertisments')->where('aid',$id)->first();
     return view('backend.advertisment.edit-adv',['data'=>$data]);
   }
 
}
