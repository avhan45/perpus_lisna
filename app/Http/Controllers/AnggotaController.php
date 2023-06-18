<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      if(Auth::user()->level == 'user') {
        Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
        return redirect()->to('/');
        }

    $datas = Anggota::get();
    return view('anggota.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }

        $users = User::WhereNotExists(function($query) {
                        $query->select(DB::raw(1))
                        ->from('anggota')
                        ->whereRaw('anggota.user_id = users.id');
                     })->get();
        return view('anggota.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count = Anggota::where('nim',$request->input('nim'))->count();

        if($count>0){
            // Session::flash('message', 'Already exist!');
            // Session::flash('message_type', 'danger');
            return redirect()->to('anggota');
        }

        $this->validate($request, [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:anggota'
        ]);

        Anggota::create($request->all());

        alert()->success('Berhasil.','Data telah ditambahkan!');
        return redirect()->route('anggota.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
        }
        $data = Anggota::findOrFail($id);

        return view('anggota.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if((Auth::user()->level == 'user') && (Auth::user()->id != $id)) {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
            }

            $data = Anggota::findOrFail($id);
            $users = User::get();
            return view('anggota.edit', compact('data', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Anggota::find($id)->update($request->all());

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->to('anggota');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Anggota::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('anggota.index');
    }
}
