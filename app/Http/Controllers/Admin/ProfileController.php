<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでProfile Modelが扱えるようになるはず
use App\Profile;
use App\Phistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {

        return view('admin.profile.create');
    }

      public function create(Request $request)
  {
            // 以下を追記 課題16-1
            
      // Varidationを行う
      $this->validate($request, Profile::$rules);

      $profile = new Profile;
      $form = $request->all();
      // フォームから送信されてきた_tokenを削除する
  
      unset($form['_token']);
          dd($form);

      // データベースに保存する
     // $profile->fill($form);
      
      $profile->fill(["name"=>"hashi", "gender"=>"男", "hobby"=>"映画鑑賞", "introduction"=>"よろしく"]);
      
      $profile->save();
        return redirect('admin/profile/create');
    }
    
      public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Profile::where('name', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }


    //public function edit()
    //{
    //    return view('admin.profile.edit');
    //}
    
    public function edit(Request $request)
  {
      // Profile Modelからデータを取得する
      $profile = Profile::find($request->id);
      if (empty($profile)) {
        abort(404);    
      }
      return view('admin.profile.edit', ['profile_form' => $profile,'hoge' => "hello"]);
  }

    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = Profile::find($request->id);
        $profile_form = $request->all();
        
//        if ($request->remove == 'true') {
//            $news_form['image_path'] = null;
//        } elseif ($request->file('image')) {
//            $path = $request->file('image')->store('public/image');
//            $news_form['image_path'] = basename($path);
//        } else {
//            $news_form['image_path'] = $news->image_path;
//        }

        unset($profile_form['_token']);
        $profile->fill($profile_form)->save();

        // 以下を追記
        $phistory = new Phistory();
        $phistory->profile_id = $profile->id;
        $phistory->edited_at = Carbon::now();
        $phistory->save();
        
        return redirect('admin/profile');
    }
}

