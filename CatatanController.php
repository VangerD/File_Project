<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatatanController extends Controller
{
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_tempat' => 'required',
            'alamat' => 'required',
            'tanggal_perjalanan' => 'required',
            'jam_perjalanan' => 'required',
            'suhu_tubuh' => 'required',
        ]);
        
        $validatedData['user_id'] = auth()->user()->id;
        
        if(Catatan::create($validatedData)){
            return redirect(route('catatan'))->with('create-success', 'Catatan Perjalanan Berhasil Ditambahkan!');
        } else {    
            return redirect(route('catatan'))->with('create-error', 'Catatan Perjalanan Gagal Ditambahkan!');
        }
    }
    
    
    public function catatan(Request $request){
        $id = Auth::id();
        $catatan = Catatan::whereUserId(Auth::id());

        return view('catatan', [
            "title" => 'catatan-isi',
            "catatan" => $catatan->order($order = request(['filter', 'order']))->search($search = request(['search']))->get()
        ]);
    }

    public function destroy(Catatan $catatan)
    {
        if(Catatan::destroy($catatan->id)){
            return redirect('/catatan')->with('delete-success', 'Catatan Berhasil Dihapus!');            
        } else {    
            return redirect('/catatan')->with('delete-error', 'Catatan Gagal Dihapus!');
        }
    }
}
