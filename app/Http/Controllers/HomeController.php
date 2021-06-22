<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
    
    public function index() {
        $link = Link::all();
        $data = [
            'data' => $link,
            'i' => 1
        ];
        
        return view('home', $data);
    }

    public function create(Request $request) {
        $input = $request->validate(
            //rules
            [
                'link' => 'required'
            ],

            //error message
            [
                'required' => 'Link tidak boleh kosong'
            ]
        );
        $input['short'] = Str::random(5);

        Link::create($input);
        session()->flash('success', 'Link berhasil dibuat');

        // return redirect()->to('/edit'); 
        return back();
        
    }

    public function go_to($short) {
        $link = DB::table('links')->where('short', $short)->first();
        $to = $link->link;
        
        return redirect()->away($to);
    }

}
