<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Exception;

class SiswaController extends Controller
{
    public function tes()
    {
        return "Hello";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Siswa::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Siswa::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        return Siswa::find($siswa);
    }

    public function cari($tahun, $katakunci)
    {
        return Siswa::where('tahun', $tahun)->
            where(function ($query) use ($katakunci) {
                $query->where('nama', 'like', '%' . $katakunci . '%')
                ->orWhere('nis', 'like', '%' . $katakunci . '%')->get();
            })
            ->get();
            // where('nama', 'like', '%' . $katakunci . '%')->orWhere('nis', 'like', '%' . $katakunci . '%')->get();
    }

    public function tahun() {
        return Siswa::select('tahun')->distinct()->orderBy('tahun', 'desc')->get();
    }

    public function semuaKelas() {
        return Siswa::select('kelas')->distinct()->orderBy('kelas', 'desc')->get();
    }

    public function semuaTingkat() {
        return Siswa::select('tingkat')->distinct()->orderBy('tingkat', 'desc')->get();
    }

    public function ambilSiswa($tahun, $nis)
    {
        return Siswa::where('tahun', $tahun)->where('nis', $nis)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $s = Siswa::find($siswa);
        $s->update($request->all());
        return $s;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        Siswa::destroy($siswa);
    }

    public function uploadCsv(Request $request)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);

        $file = $request->file('file');
        $filename = 'uploads/' . Carbon::now()->format('Y-M-d-h-m-s') . '.csv';
        $file->move('uploads', $filename);

        try {
            $filep = fopen($filename, 'r');
            $jumlahSiswa = 0;
            $errors = [];
            while (($data = fgetcsv($filep, 1000, ";")) !== FALSE) {
                try {

                    $createdSiswa = Siswa::create([
                        'nis' => $data[0],
                        'nama' => $data[1],
                        'kelas' => $data[2],
                        'tingkat' => $data[3],
                        'tahun' => $data[4]
                    ]);

                    $uploadDate = now('Asia/Jakarta');
                    Pembayaran::create([
                        'tanggal' => $uploadDate,
                        'id_siswa' => $createdSiswa->id,
                        'periode_lunas' => $data[5],
                    ]);

                    $jumlahSiswa++;
                } catch (Exception $err) {
                    array_push($errors, $err);
                }
            }
        } finally {
            fclose($filep);
        }
        return response()->json([
            'result' => [
                'tersimpan' => $jumlahSiswa,
                'errors' => $errors
            ]
        ]);
    }
}
