<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class ContinueController extends Controller
{
    public function continue ()
    {
        $user = Auth::user();
        $now = Carbon::now();
        $nowLondon = Carbon::now('Europe/London');
        $diff = $user->updated_at->diffInDays(Carbon::now());

        // dd($nowLondon);

        return view('continue',[
            'now' => $now
        ]);
    }
}
