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
                'link' => 'required|unique:links,link|url'
            ],

            //error message
            [
                'required' => 'Link tidak boleh kosong',
                'unique' => 'Link sudah digunakan',
                'url' => 'Link tidak valid'
            ]
        );
        $random = Str::random(5);
        $input['short'] = $random;

        Link::create($input);
        session()->flash('success', 'Link berhasil dibuat');

        return redirect()->to("/edit/$random"); 
    }

    public function go_to(Link $link) {
        $to = $link->link;
        if (!$to) {
            return abort(404);
        }

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
                'link' => 'required|unique:links,link,'.$link->id.'|url',
                'short' => 'required|unique:links,short,'.$link->id.'|alpha_dash',
            ],

            //error message
            [
                'required' => 'Link tidak boleh kosong',
                'unique' => 'Link sudah digunakan',
                'alpha_dash' => 'Link dipisahkan dengan "-" atau "_" , dan tidak boleh selain huruf, angka',
                'url' => 'Link tidak valid'
            ]
        );

        $link->update($input);
        session()->flash('diedit', 'Link berhasil diedit');
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
