<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SoundApiController extends Controller
{
    public function index(Request $request){
        $id = $request->input('id');
        $limit = $request->input('limit');

        if ($id){
            $query = DB::table('sounds')
            ->where('id', '=', $id)
            ->get();
        }
        else if($limit){
            $query = DB::table('sounds')
            ->limit($limit)
            ->orderby('updated_at', 'desc')
            ->get();
        
        }else{
            $query = DB::table('sounds')->get();
        }
        echo json_encode($query);
    }

    public function show(Request $request){
        $id = $request->input('id');

        $query= DB::table('sounds_file')->where('package_id', '=', $id)->get();

        echo json_encode($query);
    }
}
