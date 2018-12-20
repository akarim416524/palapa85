<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Cloud;
use Auth;
use Storage;
use App\User;
use App\Peminjaman;
use File;

class CloudController extends Controller
{
    public function index()
    {
      $data['items'] = Cloud::where('user_id', Auth::user()->id )->get();
      $data['users'] = User::where('id', '!=', Auth::user()->id)->get();
      return view('pages/cloud/index', $data);
    }

    public function init(Request $request)
    {
      $file = Cloud::find($request['id']);
      return $file;
    }

    public function share(Request $request)
    {
      Cloud::create([
        'user_id' => $request['user_id'],
        'item_name' => $request['item_name'],
        'item' => $request['item'],
      ]);
      return redirect()->back()->with('OK', 'Berhasil Membagi file.');
    }
    

    public function upload(Request $request)
    {

      // $this->validate($request,[
      //   'gambar_barang' => 'mimes:jpeg,jpg,png|max:500',
      // ]);

      if ($request->hasFile('item')) {
        $path = $request->file('item')->store('/public/Cloud-Storage'); // with /public on path
        $filename = $request->file('item')->hashName(); // remove the /public on path
        $validPath = '/storage/Cloud-Storage/' . $filename;
      }else {
        $validPath = null;
      }

      Cloud::create([
        'user_id' => $request['user_id'],
        'item_name' => $request['item_name'],
        'item' => $validPath,
      ]);
      return redirect()->back()->with('OK', 'Berhasil Mengupload data.');
    }

    public function destroy(Request $request)
    {
      $file = Cloud::find($request['id']);
      $file->delete();
      return redirect()->back()->with('OK', 'Berhasil menghapus File.');
    }

}
