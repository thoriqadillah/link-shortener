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
                'link' => 'required|unique:links,link'
            ],

            //error message
            [
                'required' => 'Link tidak boleh kosong',
                'unique' => 'Link sudah digunakan'
            ]
        );
        $random = Str::random(5);
        $input['short'] = $random;

        Link::create($input);
        session()->flash('success', 'Link berhasil dibuat');

        return redirect()->to("/edit/$random"); 
        // return back();
        
    }

    public function go_to($short) {
        $link = DB::table('links')->where('short', $short)->first();
        $to = $link->link;
        
        return redirect()->away($to);
    }

    public function edit(Link $link) {
        $links = Link::all();
        $data = [
            'data' => $links,
            'latest' => $link,
            'i' => 1
        ];
        
        return view('edit', $data);
    }

    public function update(Link $link) {
        $input = request()->validate(
            //rules
            [
                'link' => 'required|unique:links,link,'.$link->id,
                'short' => 'required|unique:links,short,'.$link->id,
            ],

            //error message
            [
                'required' => 'Link tidak boleh kosong',
                'unique' => 'Link sudah digunakan'
            ]
        );

        $link->update($input);
        return redirect()->to('/');
    }

    public function destroy(Link $link) {
        $data = $link->delete();

        if(!$data) {
            return abort(404);
        }
        session()->flash('deleted', 'Link berhasil dihapus');
        return back();
    }

}
