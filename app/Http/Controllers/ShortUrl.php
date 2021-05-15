<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl_model;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Redirect;

class ShortUrl extends Controller
{
    public function Search(Request $request)
    {
        if (Auth::check()) {

            $data_shorten = ShortUrl_model::where('original_link', 'like', '%' . $request->kata . '%')->simplePaginate(4);
            $no = 4 * ($data_shorten->currentPage() - 1);
            return view('adminMenu.search', compact('data_shorten', 'no'));
            //return dd($data_shorten);
        } else {
            return redirect('/login');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::check()) {
            $data_shorten = ShortUrl_model::orderBy('id', 'desc')->simplePaginate(4);
            $no = 4 * ($data_shorten->currentPage() - 1);
            return view('adminMenu.index', compact('data_shorten', 'no'));
        } else {
            return redirect('/login');
        }
    }

    public function GetUrl($id)
    {

        $data_url = DB::table('tbl_short')->where('short_link', URL::to('/') . '/' . $id);
        if ($data_url->exists()) {
            return redirect($data_url->pluck('original_link')[0]);
        } else {
            return redirect('/')->with('Pesan', 'Url anda tidak ditemukan');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ShortUrl_model = new ShortUrl_model();
        $this->validate($request, [
            'Url_short' => 'required|url',
        ],
            [
                'Url_short.required' => 'Masukan Url Anda',

            ]
        );

        // Jika User Memiliki Custom Link
        if ($request->has('short_link')) {
            $random_short_link = $request->short_link;
        }

        // Jika User tidak mempunyai Custom Link
        if (!empty($request->input('short_link'))) {

            // Jika Custom Link Duplicate
            if ($ShortUrl_model->GetSameUrl($request->short_link) === true) {
                return Redirect::back()->with('Pesan', 'Custom ShortUrl Sudah Digunakan');
            }
        } else {
            // Generate Custom Link
            $random_short_link = Str::random(rand(3, 8));
        }

        $data_url = new ShortUrl_model;
        $data_url->original_link = $request->Url_short;
        $data_url->short_link = URL::to('/') . '/' . $random_short_link;
        $data_url->save();

        return Redirect::back()->with('Pesan', URL::to('/') . '/' . $random_short_link);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (Auth::check()) {

            $data_shorten = ShortUrl_model::find($id);
            return view('adminMenu.show', compact('data_shorten'));
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data_shorten = ShortUrl_model::find($id);
        return view('adminMenu.edit', compact('data_shorten'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $ShortUrl_model = new ShortUrl_model();
        $this->validate($request, [
            'Url_short' => 'required|url',
        ],
            [
                'Url_short.required' => 'Masukan Url Anda',

            ]
        );

        // Jika User Memiliki Custom Link
        if ($request->has('short_link')) {
            $random_short_link = $request->short_link;
        }

        // Jika User tidak mempunyai Custom Link
        if (!empty($request->input('short_link'))) {

            // Jika Custom Link Duplicate
            if ($ShortUrl_model->GetSameUrl($request->short_link) === true) {
                return Redirect::back()->with('Pesan', 'Custom ShortUrl Sudah Digunakan Sebelumnya');
            }
        } else {
            // Generate Custom Link
            $random_short_link = Str::random(rand(3, 8));
        }

        $data_shorten = ShortUrl_model::find($id);
        $data_shorten->original_link = $request->Url_short;
        $data_shorten->short_link = URL::to('/') . '/' . $random_short_link;
        $data_shorten->update();

        return Redirect::back()->with('Pesan', 'Sukses Edit ShortUrl');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $data_shorten = ShortUrl_model::find($id);
        $data_shorten->delete();
        return Redirect::back()->with('Pesan', 'Berhasil Delete');
    }

}
