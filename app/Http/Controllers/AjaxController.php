<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function Login()
    {
        return view('Admin.Login');
    }

    public function Index(Request $req)
    {
        $visitor = DB::table('visitor')->insert(['ip' => $req->getClientIp()]);
        $data = DB::table('blogs')->get();
        return view('Index', ["data" => $data]);
    }

    public function ContactCreate(Request $req)
    {

        $fields = ['email', 'message', 'number', 'name'];
        $data = array_filter($req->input(), function ($key) use ($fields) {
            return in_array($key, $fields);
        }, ARRAY_FILTER_USE_KEY);
        $validator = Validator::make($data, ['email' => 'required|email', 'message' => 'required|string', 'number' => 'string', 'name' => 'required|string']);

        if ($validator->fails()) {
            return response()->json(["success" => false, "message" => $validator->errors()->first()]);
        }
        $insert = DB::table('contacts')->insert($data);
        return response()->json(["success" => true, "message" => "Message Sent Successfully"]);
    }

    public function LoginUser(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'user_email' => 'required|email',
            'user_password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(["validate" => true, "message" => $validator->errors()->all()[0]]);
        }
        $user = DB::table('users')
            ->where(["user_email" => $req->input('user_email')])
            ->first();
        if (!$user) {
            return response()->json(["success" => false, "message" => "Invalid Credential"]);
        }
        session_start();
        if (Hash::check($req->input('user_password'), $user->user_password)) {
            $_SESSION["user_id"] = $user->user_id;
            $_SESSION["user_name"] = $user->user_name;
            return response()->json(["success" => true, "message" => "Login Successfull"]);
        } else {
            return response()->json(["success" => false, "message" => "Invalid Credential"]);
        }
    }

    public function Dashboard()
    {
        // $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        // $year = date('Y');
        // $result = DB::table('visitor')->select(DB::raw('YEAR(datetime) AS year, MONTH(datetime) AS month, COUNT(*) AS count'))->whereRaw('YEAR(datetime) = ?', [$year])->groupBy(DB::raw('YEAR(datetime), MONTH(datetime)'))->get();
        // for ($i = 1; $i <= count($result); $i++) {$data[$i - 1] = $result[$i - 1]->count;}
        return view('Admin.Dashboard');
    }

    public function Blog()
    {
        return view('Admin.Blog');
    }

    public function BlogInsert(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'blog_title' => 'required',
            'blog_short_desc' => 'required',
            'blog_long_desc' => 'required',
            'blog_image' => ($req->input('blog_id') != "") ? 'image' : 'required|image'
        ]);

        if ($validator->fails()) {
            return response()->json(["validate" => true, "message" => $validator->errors()->all()[0]]);
        }
        $data = $req->input();
        unset($data['blog_id']);

        try {
            if ($req->hasFile('blog_image')) {
                $image = $req->file('blog_image');
                $imagename = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $path = base_path('public/blog/' . $imagename);
                file_put_contents($path, file_get_contents($image));
                $data['blog_image'] = $imagename;
            }
            if ($req->input('blog_id') != "") {
                $old = DB::table('blogs')->where('blog_id', $req->input('blog_id'))->first();
                if (file_exists(base_path('public/blog/' . $old->blog_image))) {
                    unlink(base_path('public/blog/' . $old->blog_image));
                }
                $insert = DB::table('blogs')->where('blog_id', $req->input('blog_id'))->update($data);
            } else {
                $insert = DB::table('blogs')->insert($data);
            }
            return response()->json(["success" => true, "message" => "Blog created Successfully"]);
        } catch (\Throwable $err) {
            return response()->json(["success" => false, "message" => "An Error Occurred", "err" => $err]);
        }
    }

    public function BlogFetch(Request $req)
    {
        if ($req->input('id')) {
            $data = DB::table('blogs')->where("blog_id", $req->input('id'))->get();
        } else {
            $data = DB::table('blogs')->get();
        }
        return $data;
    }

    public function BlogDelete(Request $req)
    {
        $data = DB::table('blogs')->where('blog_id', $req->input('id'))->first();
        if (file_exists(base_path('public/blog/' . $data->blog_image))) {
            unlink(base_path('public/blog/' . $data->blog_image));
        }
        $delete = DB::table('blogs')->where('blog_id', $req->input('id'))->delete();
        return response()->json(["success" => true, "message" => "Blog deleted Successfully"]);
    }

    public function Gallery()
    {
        return view('Admin.Gallery');
    }

    public function GalleryInsert(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'gallery_image' => ($req->input('gallery_id') != "") ? 'image' : 'required|image'
        ]);

        if ($validator->fails()) {
            return response()->json(["validate" => true, "message" => $validator->errors()->all()[0]]);
        }
        $data = $req->input();
        unset($data['gallery_id']);

        try {
            if ($req->hasFile('gallery_image')) {
                $image = $req->file('gallery_image');
                $imagename = Str::random(20) . '.' . $image->getClientOriginalExtension();
                $path = base_path('public/gallery/' . $imagename);
                file_put_contents($path, file_get_contents($image));
                $data['gallery_image'] = $imagename;
            }
            if ($req->input('gallery_id') != "") {
                $old = DB::table('gallery')->where('gallery_id', $req->input('gallery_id'))->first();
                if (file_exists(base_path('public/gallery/' . $old->gallery_image))) {
                    unlink(base_path('public/gallery/' . $old->gallery_image));
                }
                $insert = DB::table('gallery')->where('gallery_id', $req->input('gallery_id'))->update($data);
            } else {
                $insert = DB::table('gallery')->insert($data);
            }
            return response()->json(["success" => true, "message" => "Gallery created Successfully"]);
        } catch (\Throwable $err) {
            return response()->json(["success" => false, "message" => "An Error Occurred", "err" => $err]);
        }
    }

    public function GalleryFetch(Request $req)
    {
        if ($req->input('id')) {
            $data = DB::table('gallery')->where("gallery_id", $req->input('id'))->get();
        } else {
            $data = DB::table('gallery')->get();
        }
        return $data;
    }

    public function GalleryDelete(Request $req)
    {
        $data = DB::table('gallery')->where('gallery_id', $req->input('id'))->first();
        if (file_exists(base_path('public/gallery/' . $data->gallery_image))) {
            unlink(base_path('public/gallery/' . $data->gallery_image));
        }
        $delete = DB::table('gallery')->where('gallery_id', $req->input('id'))->delete();
        return response()->json(["success" => true, "message" => "Gallery deleted Successfully"]);
    }

    public function Contacts()
    {
        return view('Admin.Contacts');
    }
    public function ContactsFetch(Request $req)
    {
        if ($req->input('id')) {
            $data = DB::table('contacts')->where("id", $req->input('id'))->get();
        } else {
            $data = DB::table('contacts')->get();
        }
        return $data;
    }
}
