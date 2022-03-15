<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function getDataKelas()
    {
        $ambildata = DB::table('kelas')->get();

        if($ambildata){
            return response()->json([
                "Result" => ["ResultCode" => 1,
                "ResultMessage" => "Success take a data!",
                "WaktuAkses" => today()],
                "Data" => $ambildata
            ],200);

            // return response()->json($ambildata,200);
        }else{
            return response()->json(["Result" => ["ResultCode" => 0,
                "ResultMessage" => "Failed!"]],
                401
            );
        }
    }
    public function getDataKelasById($idkelas)
    {
        $ambildata = DB::table('kelas')->where('id_kelas',$idkelas)->get();

        if($ambildata){
            // return response()->json([
            //     "Result" => ["ResultCode" => 1,
            //     "ResultMessage" => "Success take a data!"],
            //     "Data" => $ambildata
            // ],200);

            return response()->json($ambildata,200);
        }else{
            return response()->json(["Result" => ["ResultCode" => 0,
                "ResultMessage" => "Failed!"]],
                401
            );
        }
    }


}
