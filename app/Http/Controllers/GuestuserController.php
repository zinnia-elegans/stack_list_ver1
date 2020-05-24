<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guestuser;

class GuestuserController extends Controller
{
    public function getSignup()
    {
        return View('guest.signup');
    }

    public function postSignup(Request $request)
    {
        // バリデーション
        $this->validate($request,[
          'name' => 'required',
          'email' => 'email|required|unique:users',
          'password' => 'required|min:4',
        ]);
       
        // DBインサート
        $user = new Guestuser([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'password' => bcrypt($request->input('password')),
        ]);
       
        // 保存
        $user->save();
       
        // リダイレクト
        return redirect()->route('admin');
      }

      public function getProfile()
      {
        return view('guest/register');
      }

}
