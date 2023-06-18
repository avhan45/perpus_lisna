<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Carbon\Carbon;
// use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Alert;


class BukuController extends Controller
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

        $datas = Buku::get();
        return view('buku.index', compact('datas'));
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

        return view('buku.create');
    }

    // public function format()
    // {
    //     $data = [['judul' => null, 'isbn' => null, 'pengarang' => null, 'penerbit' => null, 'tahun_terbit' => null, 'jumlah_buku' => null, 'deskripsi' => null, 'lokasi' => 'rak1/rak2/rak3']];
    //         $fileName = 'format-buku';
            

    //     $export = Excel::create($fileName.date('Y-m-d_H-i-s'), function($excel) use($data){
    //         $excel->sheet('buku', function($sheet) use($data) {
    //             $sheet->fromArray($data);
    //         });
    //     });

    //     return $export->download('xlsx');
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:255',
            'isbn' => 'required|string'
        ]);

        if($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/buku", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        Buku::create([
                'judul' => $request->get('judul'),
                'isbn' => $request->get('isbn'),
                'pengarang' => $request->get('pengarang'),
                'penerbit' => $request->get('penerbit'),
                'tahun_terbit' => $request->get('tahun_terbit'),
                'jumlah_buku' => $request->get('jumlah_buku'),
                'deskripsi' => $request->get('deskripsi'),
                'lokasi' => $request->get('lokasi'),
                'cover' => $cover
            ]);

        alert()->success('Berhasil.','Data telah ditambahkan!');

        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
    }

    $data = Buku::findOrFail($id);

    return view('buku.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(Auth::user()->level == 'user') {
            Alert::info('Oopss..', 'Anda dilarang masuk ke area ini.');
            return redirect()->to('/');
            }

    $data = Buku::findOrFail($id);
    return view('buku.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->file('cover')) {
            $file = $request->file('cover');
            $dt = Carbon::now();
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.$dt->format('Y-m-d-H-i-s').'.'.$acak; 
            $request->file('cover')->move("images/buku", $fileName);
            $cover = $fileName;
        } else {
            $cover = NULL;
        }

        Buku::find($id)->update([
             'judul' => $request->get('judul'),
                'isbn' => $request->get('isbn'),
                'pengarang' => $request->get('pengarang'),
                'penerbit' => $request->get('penerbit'),
                'tahun_terbit' => $request->get('tahun_terbit'),
                'jumlah_buku' => $request->get('jumlah_buku'),
                'deskripsi' => $request->get('deskripsi'),
                'lokasi' => $request->get('lokasi'),
                'cover' => $cover
                ]);

        alert()->success('Berhasil.','Data telah diubah!');
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Buku::find($id)->delete();
        alert()->success('Berhasil.','Data telah dihapus!');
        return redirect()->route('buku.index');
    }
}
