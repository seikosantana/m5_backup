<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Pembayaran::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show($id_siswa)
    {
        $result = Pembayaran::where('id_siswa', '=', $id_siswa);
        return $result->get();
    }

    public function terakhir($id_siswa)
    {
        $result = Pembayaran::where('id_siswa', $id_siswa)->max('periode_lunas');
        if ($result == FALSE) {
            return response()->json(['message' => 'Siswa tidak ditemukan'], 404);
        } else {
            return $result;
        }
    }

    public function nunggak($tahun, $periode)
    {
        $query = DB::table('siswas')
            ->join('pembayarans', 'siswas.id', '=', 'pembayarans.id_siswa')
            ->select(['id_siswa', 'nis', 'nama', 'kelas', 'tingkat', DB::raw('MAX(periode_lunas) as lunas')])
            ->where('tahun', $tahun)
            ->groupBy('id_siswa')
            ->having('lunas', "<", $periode);
        $result = $query->get();
        return $result;
    }

    public function nunggakKelas($tahun, $periode, $kelas)
    {
        $query = DB::table('siswas')
            ->join('pembayarans', 'siswas.id', '=', 'pembayarans.id_siswa')
            ->select(['id_siswa', 'nis', 'nama', 'kelas', 'tingkat', DB::raw('MAX(periode_lunas) as lunas')])
            ->where('tahun', $tahun)
            ->where('kelas', $kelas)
            ->groupBy('id_siswa')
            ->having('lunas', "<", $periode);
        $result = $query->get();
        $count = DB::table('siswas')
            ->where('tahun', $tahun)
            ->where('kelas', $kelas)
            ->count('id');
        return response()->json(
            [
                'maksimal' => $count,
                'siswa' => $result
            ]
        );
    }

    public function nunggakTingkat($tahun, $periode, $tingkat)
    {
        $query = DB::table('siswas')
            ->join('pembayarans', 'siswas.id', '=', 'pembayarans.id_siswa')
            ->select(['id_siswa', 'nis', 'nama', 'kelas', 'tingkat', DB::raw('MAX(periode_lunas) as lunas')])
            ->where('tahun', $tahun)
            ->where('tingkat', $tingkat)
            ->groupBy('id_siswa')
            ->having('lunas', "<", $periode);
        $result = $query->get();
        $count = DB::table('siswas')
            ->where('tahun', $tahun)
            ->where('tingkat', $tingkat)
            ->count('id');

        return response()->json(
            [
                'maksimal' => $count,
                'siswa' => $result
            ]
        );
    }

    public function lunasKelas($tahun, $periode, $kelas) {
        $query = DB::table('siswas')
            ->join('pembayarans', 'siswas.id', '=', 'pembayarans.id_siswa')
            ->select(['id_siswa', 'nis', 'nama', 'kelas', 'tingkat', DB::raw('MAX(periode_lunas) as lunas')])
            ->where('tahun', $tahun)
            ->where('kelas', $kelas)
            ->groupBy('id_siswa')
            ->having('lunas', ">=", $periode);
        $result = $query->get();
        $count = DB::table('siswas')
            ->where('tahun', $tahun)
            ->where('kelas', $kelas)
            ->count('id');
        return response()->json(
            [
                'maksimal' => $count,
                'siswa' => $result
            ]
        );
    }

    public function lunasTingkat($tahun, $periode, $tingkat) {
        $query = DB::table('siswas')
            ->join('pembayarans', 'siswas.id', '=', 'pembayarans.id_siswa')
            ->select(['id_siswa', 'nis', 'nama', 'kelas', 'tingkat', DB::raw('MAX(periode_lunas) as lunas')])
            ->where('tahun', $tahun)
            ->where('tingkat', $tingkat)
            ->groupBy('id_siswa')
            ->having('lunas', ">=", $periode);
        $result = $query->get();
        $count = DB::table('siswas')
            ->where('tahun', $tahun)
            ->where('tingkat', $tingkat)
            ->count('id');

        return response()->json(
            [
                'maksimal' => $count,
                'siswa' => $result
            ]
        );
    }

    public function export() {
        $query = DB::table('siswas')
            ->join('pembayarans', 'siswas.id', '=', 'pembayarans.id_siswa')
            ->select(['id_siswa', 'nis', 'nama', 'kelas', 'tingkat', DB::raw('MAX(periode_lunas) as lunas'), 'tahun'])
            ->groupBy('id_siswa')
            ->orderBy('tahun')
            ->orderBy('tingkat')
            ->orderBy('nama');
        $result = $query->get();

        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }

    public function laporanKelas($tahun, $kelas, $periode)
    {
        $querySiswa = Siswa::select('siswas.id', 'nis')->where('tahun', '=', $tahun)->where('kelas', '=', $kelas);
        $jumlahSiswa = $querySiswa->count();
        $queryLunas = DB::table('siswas')
            ->join('pembayarans', 'siswas.id', '=', 'pembayarans.id_siswa')
            ->select('nis')
            ->where('tahun', '=', $tahun)
            ->where('kelas', '=', $kelas)
            ->where("periode_lunas", ">=", $periode)
            ->distinct()
            // ->groupBy('nis')
            ->count('nis');
        // ->get();
        // $res = DB::select("select id_siswa, nis, nama, tahun, periode_lunas, kelas from siswas inner join pembayarans on siswas.id = pembayarans.id_siswa where periode_lunas > 8 group by nis;");

        return response()->json([
            'jumlah_siswa' => $jumlahSiswa,
            'tahun' => intval($tahun),
            'kelas' => $kelas,
            'periode' => intval($periode),
            'jumlah_lunas' => $queryLunas,
            // 'jumlah_lunas_sql' => $queryLunas->toSql(),
        ]);
        // return $jumlahSiswaLunasPeriodeIni;
    }

    public function laporanTingkat($tahun, $tingkat, $periode)
    {
        $querySiswa = Siswa::select('siswas.id', 'nis')->where('tahun', '=', $tahun)->where('tingkat', '=', $tingkat);
        $jumlahSiswa = $querySiswa->count();
        $queryLunas = DB::table('siswas')
            ->join('pembayarans', 'siswas.id', '=', 'pembayarans.id_siswa')
            ->select('nis')
            ->where('tahun', '=', $tahun)
            ->where('tingkat', '=', $tingkat)
            ->where("periode_lunas", ">=", $periode)
            ->distinct()
            // ->groupBy('nis')
            ->count('nis');
        // ->get();
        // $res = DB::select("select id_siswa, nis, nama, tahun, periode_lunas, kelas from siswas inner join pembayarans on siswas.id = pembayarans.id_siswa where periode_lunas > 8 group by nis;");

        return response()->json([
            'jumlah_siswa' => $jumlahSiswa,
            'tahun' => $tahun,
            'tingkat' => $tingkat,
            'periode' => $periode,
            'jumlah_lunas' => $queryLunas,
            // 'jumlah_lunas_sql' => $queryLunas->toSql(),
        ]);
    }
}
