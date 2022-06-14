<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function getDataGuruKelas()
    {
        $ambildataGuru = DB::table('guru')->get();
        $ambildataGuruKelas = DB::table('guru')
            ->join('jadwal_guru', 'guru.id_guru', '=', 'jadwal_guru.id_guru')
            ->join('kelas', 'jadwal_guru.id_kelas', '=', 'kelas.id_kelas')
            ->select(
                'guru.id_guru',
                'jadwal_guru.hari',
                'jadwal_guru.jam_mulai',
                'kelas.kelas',
                'kelas.jurusan',
                'kelas.sub'
            )
            ->get();
        $arr_result = json_decode($ambildataGuru, true);

        foreach ($arr_result as $keyguru => $valueguru) {
            foreach ($ambildataGuruKelas as $key => $value) {
                if ($valueguru['id_guru'] == $value->id_guru) {
                    $arr_jadwal = [
                        'hari' => $value->hari,
                        'kelas' =>
                            $value->kelas .
                            ' ' .
                            $value->jurusan .
                            ' ' .
                            $value->sub,
                        'jam_mulai' => $value->jam_mulai,
                        'id_guru' => $value->id_guru,
                    ];
                    $arr_result[$keyguru]['jadwal_guru'][] = $arr_jadwal;
                }
            }
        }
        if ($arr_result) {
            return response()->json(
                [
                    'user' => 'Dimas',
                    'waktukelas' => today(),
                    'result' => 1,
                    'DataKelasGuru' => $arr_result,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'Result' => [
                        'ResultCode' => 0,
                        'ResultMessage' => 'Data Tidak Ditemukan',
                    ],
                ],
                401
            );
        }
    }
    // public function getDataKelasById($idkelas)
    // {
    //     $ambildata = DB::table('kelas')->where('id_kelas',$idkelas)->get();

    //     if($ambildata){
    //         // return response()->json([
    //         //     "Result" => ["ResultCode" => 1,
    //         //     "ResultMessage" => "Success take a data!"],
    //         //     "Data" => $ambildata
    //         // ],200);

    //         return response()->json($ambildata,200);
    //     }else{
    //         return response()->json(["Result" => ["ResultCode" => 0,
    //             "ResultMessage" => "Failed!"]],
    //             401
    //         );
    //     }
    // }

    public function getDataGuru()
    {
        $ambildata = DB::table('guru')->get();

        if ($ambildata) {
            return response()->json(
                [
                    'Result' => [
                        'ResultCode' => 1,
                        'ResultMessage' => 'Success take a data!',
                        'WaktuAkses' => today(),
                    ],
                    'Data' => $ambildata,
                ],
                200
            );

            // return response()->json($ambildata,200);
        } else {
            return response()->json(
                ['Result' => ['ResultCode' => 0, 'ResultMessage' => 'Failed!']],
                401
            );
        }
    }

    public function insertDataGuru(Request $request)
    {
        DB::table('guru')->insert([
            'rfid' => $request->input('rfid'),
            'nip' => $request->input('nip'),
            'nama_guru' => $request->input('nama_guru'),
            'alamat' => $request->input('alamat'),
            'status_guru' => 1,
        ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Masuk Ke Database',
                ],
            ],
            200
        );
    }

    public function updateDataGuru(Request $request)
    {
        DB::table('guru')
            ->where('id_guru', $request->input('id_guru'))
            ->update([
                'rfid' => $request->input('rfid'),
                'nip' => $request->input('nip'),
                'nama_guru' => $request->input('nama_guru'),
                'alamat' => $request->input('alamat'),
                'status_guru' => $request->input('status_guru'),
            ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di ubah',
                ],
            ],
            200
        );
    }
    public function deleteDataGuru(Request $request)
    {
        DB::table('guru')
            ->where('id_guru', $request->input('id_guru'))
            ->delete();

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di dihapus',
                ],
            ],
            200
        );
    }
    public function getDataKelas()
    {
        $ambildata = DB::table('kelas')->get();

        if ($ambildata) {
            return response()->json(
                [
                    'Result' => [
                        'ResultCode' => 1,
                        'ResultMessage' => 'Success take a data!',
                        'WaktuAkses' => today(),
                    ],
                    'Data' => $ambildata,
                ],
                200
            );

            // return response()->json($ambildata,200);
        } else {
            return response()->json(
                ['Result' => ['ResultCode' => 0, 'ResultMessage' => 'Failed!']],
                401
            );
        }
    }
    public function insertDataKelas(Request $request)
    {
        DB::table('kelas')->insert([
            'kelas' => $request->input('kelas'),
            'jurusan' => $request->input('jurusan'),
            'sub' => $request->input('sub'),
        ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Masuk Ke Database',
                ],
            ],
            200
        );
    }

    public function updateDataKelas(Request $request)
    {
        DB::table('kelas')
            ->where('id_kelas', $request->input('id_kelas'))
            ->update([
                'kelas' => $request->input('kelas'),
                'jurusan' => $request->input('jurusan'),
                'sub' => $request->input('sub'),
            ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di ubah',
                ],
            ],
            200
        );
    }
    public function deleteDataKelas(Request $request)
    {
        DB::table('kelas')
            ->where('id_kelas', $request->input('id_kelas'))
            ->delete();

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di dihapus',
                ],
            ],
            200
        );
    }
    public function getDataMapel()
    {
        $ambildata = DB::table('mapel')->get();

        if ($ambildata) {
            return response()->json(
                [
                    'Result' => [
                        'ResultCode' => 1,
                        'ResultMessage' => 'Success take a data!',
                        'WaktuAkses' => today(),
                    ],
                    'Data' => $ambildata,
                ],
                200
            );

            // return response()->json($ambildata,200);
        } else {
            return response()->json(
                ['Result' => ['ResultCode' => 0, 'ResultMessage' => 'Failed!']],
                401
            );
        }
    }
    public function insertDataMapel(Request $request)
    {
        DB::table('mapel')->insert([
            'nama_mapel' => $request->input('nama_mapel'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Masuk Ke Database',
                ],
            ],
            200
        );
    }

    public function updateDataMapel(Request $request)
    {
        DB::table('mapel')
            ->where('id_mapel', $request->input('id_mapel'))
            ->update([
                'nama_mapel' => $request->input('nama_mapel'),
                'deskripsi' => $request->input('deskripsi'),
            ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di ubah',
                ],
            ],
            200
        );
    }
    public function deleteDataMapel(Request $request)
    {
        DB::table('mapel')
            ->where('id_mapel', $request->input('id_mapel'))
            ->delete();

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di dihapus',
                ],
            ],
            200
        );
    }
    public function getDataPresensiMengajar()
    {
        $ambildata = DB::table('presensi_mengajar')->get();

        if ($ambildata) {
            return response()->json(
                [
                    'Result' => [
                        'ResultCode' => 1,
                        'ResultMessage' => 'Success take a data!',
                        'WaktuAkses' => today(),
                    ],
                    'Data' => $ambildata,
                ],
                200
            );

            // return response()->json($ambildata,200);
        } else {
            return response()->json(
                ['Result' => ['ResultCode' => 0, 'ResultMessage' => 'Failed!']],
                401
            );
        }
    }
    public function insertDataPresensiMengajar(Request $request)
    {
        DB::table('presensi_mengajar')->insert([
            'id_jadwal_guru' => $request->input('id_jadwal_guru'),
            'tanggal' => $request->input('tanggal'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
            'metode' => $request->input('metode'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Masuk Ke Database',
                ],
            ],
            200
        );
    }

    public function updateDataPresensiMengajar(Request $request)
    {
        DB::table('presensi_mengajar')
            ->where('id_presensi_mengajar', $request->input('id_presensi_mengajar'))
            ->update([
                'id_jadwal_guru' => $request->input('id_jadwal_guru'),
                'tanggal' => $request->input('tanggal'),
                'jam_mulai' => $request->input('jam_mulai'),
                'jam_selesai' => $request->input('jam_selesai'),
                'metode' => $request->input('metode'),
                'keterangan' => $request->input('keterangan'),
            ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di ubah',
                ],
            ],
            200
        );
    }
    public function deleteDataPresensiMengajar(Request $request)
    {
        DB::table('presensi_mengajar')
            ->where('id_presensi_mengajar', $request->input('id_presensi_mengajar'))
            ->delete();

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di dihapus',
                ],
            ],
            200
        );
    }
    public function getDataPresensiHarian()
    {
        $ambildata = DB::table('presensi_harian')->get();

        if ($ambildata) {
            return response()->json(
                [
                    'Result' => [
                        'ResultCode' => 1,
                        'ResultMessage' => 'Success take a data!',
                        'WaktuAkses' => today(),
                    ],
                    'Data' => $ambildata,
                ],
                200
            );

            // return response()->json($ambildata,200);
        } else {
            return response()->json(
                ['Result' => ['ResultCode' => 0, 'ResultMessage' => 'Failed!']],
                401
            );
        }
    }
    public function insertDataPresensiHarian(Request $request)
    {
        DB::table('presensi_harian')->insert([
            'tahun_akademik' => $request->input('tahun_akademik'),
            'semester' => $request->input('semester'),
            'tanggal' => $request->input('tanggal'),
            'hari' => $request->input('hari'),
            'id_guru' => $request->input('id_guru'),
            'jam_masuk' => $request->input('jam_masuk'),
            'jam_pulang' => $request->input('jam_pulang'),
            'metode' => $request->input('metode'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Masuk Ke Database',
                ],
            ],
            200
        );
    }

    public function updateDataPresensiHarian(Request $request)
    {
        DB::table('presensi_harian')
            ->where('id_presensi_harian', $request->input('id_presensi_harian'))
            ->update([
                'tahun_akademik' => $request->input('tahun_akademik'),
                'semester' => $request->input('semester'),
                'tanggal' => $request->input('tanggal'),
                'hari' => $request->input('hari'),
                'id_guru' => $request->input('id_guru'),
                'jam_masuk' => $request->input('jam_masuk'),
                'jam_pulang' => $request->input('jam_pulang'),
                'metode' => $request->input('metode'),
                'keterangan' => $request->input('keterangan'),
            ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di ubah',
                ],
            ],
            200
        );
    }
    public function deleteDataPresensiHarian(Request $request)
    {
        DB::table('presensi_harian')
            ->where('id_presensi_harian', $request->input('id_presensi_harian'))
            ->delete();

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di dihapus',
                ],
            ],
            200
        );
    }
    public function getDataJadwalGuru()
    {
        $ambildata = DB::table('jadwal_guru')->get();

        if ($ambildata) {
            return response()->json(
                [
                    'Result' => [
                        'ResultCode' => 1,
                        'ResultMessage' => 'Success take a data!',
                        'WaktuAkses' => today(),
                    ],
                    'Data' => $ambildata,
                ],
                200
            );

            // return response()->json($ambildata,200);
        } else {
            return response()->json(
                ['Result' => ['ResultCode' => 0, 'ResultMessage' => 'Failed!']],
                401
            );
        }
    }
    public function insertDataJadwalGuru(Request $request)
    {
        DB::table('jadwal_guru')->insert([
            'tahun_akademik' => $request->input('tahun_akademik'),
            'semester' => $request->input('semester'),
            'id_guru' => $request->input('id_guru'),
            'hari' => $request->input('hari'),
            'id_kelas' => $request->input('id_kelas'),
            'id_mapel' => $request->input('id_mapel'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
        ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Masuk Ke Database',
                ],
            ],
            200
        );
    }

    public function updateDataJadwalGuru(Request $request)
    {
        DB::table('jadwal_guru')
            ->where('id_jadwal_guru', $request->input('id_jadwal_guru'))
            ->update([
                'tahun_akademik' => $request->input('tahun_akademik'),
                'semester' => $request->input('semester'),
                'id_guru' => $request->input('id_guru'),
                'hari' => $request->input('hari'),
                'id_kelas' => $request->input('id_kelas'),
                'id_mapel' => $request->input('id_mapel'),
                'jam_mulai' => $request->input('jam_mulai'),
                'jam_selesai' => $request->input('jam_selesai'),
            ]);

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di ubah',
                ],
            ],
            200
        );
    }
    public function deleteDataJadwalGuru(Request $request)
    {
        DB::table('jadwal_guru')
            ->where('id_jadwal_guru', $request->input('id_jadwal_guru'))
            ->delete();

        return response()->json(
            [
                'Result' => [
                    'ResultCode' => 0,
                    'ResultMessage' => 'Success Data Berhasil di dihapus',
                ],
            ],
            200
        );
    }
}
