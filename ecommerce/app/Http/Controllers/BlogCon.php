<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Carbon;

class BlogCon extends Controller
{
    // Blog index page
    public function index(){
        $blogs = DB::table('blogs')->orderBy('id', 'DESC')->get();
        return view('cms.blog.all_blog', compact('blogs'));
    }

    // Add Blog Function
    public function Add_new_blog(Request $request){

        $request->validate([
            'title' => 'required|unique:blogs',
            'url' => 'required|unique:blogs',
            'image' => 'required',            
        ]);
      
        $blog_image = $request->file('image');
        $name_gen = hexdec(uniqid()).".".$blog_image->getClientOriginalExtension();
        Image::make($blog_image)->resize(345, 205)->save('images/'.$name_gen);
        $last_img = 'images/'.$name_gen;


        $data = array();
        $data['title'] = $request->title;
        $data['url'] = $request->url;
        $data['image'] = $last_img;
        $data['alt'] = $request->alt;
        $data['description'] = $request->editor1;
        $data['meta_title'] = $request->meta_title;
        $data['meta_description'] = $request->editor2;
        $data['author'] = $request->author;
        $data['date'] = $request->date;
        $data['created_at'] = Carbon::now();

        DB::table('blogs')->insert($data);
        return Redirect()->route('all_blog')->with('status', 'New Blog Added Successfully');

    }


    // Edit Blog Function
    public function EditBlog($id){
        $blog = DB::table('blogs')-> where('id', $id) ->first();
        return view('cms.blog.edit_blog', compact('blog'));
    }

    // Update Blog Function
    public function Update_Blog(Request $request, $id){

        $old_image = $request->old_image;
        $data = array();

        $blog_image = $request->file('image');

        if($blog_image){
            $name_gen = hexdec(uniqid()).".".$blog_image->getClientOriginalExtension();
            Image::make($blog_image)->resize(345, 205)->save('images/'.$name_gen);
            $last_img = 'images/'.$name_gen;
            
            if($old_image){
                unlink($old_image);
            }
            $data['image'] = $last_img;
        }

        $data['title'] = $request->title;
        $data['url'] = $request->url;
        $data['alt'] = $request->alt;
        $data['description'] = $request->editor1;
        $data['meta_title'] = $request->meta_title;
        $data['meta_description'] = $request->editor2;
        $data['author'] = $request->author;
        $data['date'] = $request->date;
        $data['created_at'] = Carbon::now();

        DB::table('blogs')->where('id', $id)->update($data);
        return Redirect()->route('all_blog')->with('status', 'Blog Update Successfully');
    }


    // Begin:: USer Blog 
    public function UserBlogIndex() {
        $blogs = DB::table('blogs')->orderBy('id', 'DESC')->limit(6)->get();
        return view('user.pages.blog.all_blog', compact('blogs'));
    }
    // End:: USer Blog 

    // Begin:: USer Blog Load More button
    public function BlogLoad_more_ajax() {
        $lastID = $_GET['lastID'];
        $updatedlastID = 0;
        $output = '';

        $blogs = DB::table('blogs')
                    ->where('id', '<', $lastID)
                    ->orderBy('id', 'desc')
                    ->limit(6)
                    ->get();

        if(!$blogs->isEmpty()) {
            $noMorePSts = 'yes';
            
            foreach($blogs as $blog) {
                $output .= '<div class="col-md-4 mt-4">
                            <div class="card">
                                <a href="/blog/'.$blog->id.'/'.$blog->url.'"><img class="card-img-top img-fluid" src="'.asset($blog->image).'" alt="'.optional($blog)->alt.'"></a>
                                <div class="card-body">
                                    <h5 style="text-align: justify;" class="card-title"><a href="/blog/'.$blog->id.'/'.$blog->url.'">'.$blog->title.'</a></h5>
                                    <p style="color: #FF6000;">Date:  '.date('d M, Y', strtotime($blog->date)).' | Posted By: '.$blog->author.'</p><br>
                                    <p style="text-align: justify;" class="card-text">'.substr(strip_tags($blog->description), 0, 120).'....</p>
                                </div>
                            </div>
                        </div>';
                            $updatedlastID = $blog->id;
                        }
                    }
                    else {
                        $noMorePSts = 'no';
                        $output .= '<div id="load_more">
                                        <div class="text-center"><h2><b>Sorry, No Data Found</b></h2></div>
                                    </div>';
                    }

                    $res = [
                        'output' => $output,
                        'upLastID' => $updatedlastID,
                        'noMorePSts' => $noMorePSts,
                    ];
                    return response()->json($res);

    }
    // End:: USer Blog Load More button

    //Begin:: User Blog Details
    public function UserBlogDetails($id) {
        $blog = DB::table('blogs')->where('id', $id)->first();
        return view('user.pages.blog.blog_details', compact('blog'));
    }
    //Begin:: User Blog Details


}
