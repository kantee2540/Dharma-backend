<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            $query = DB::table('sounds')
            ->orderby('updated_at', 'desc')
            ->get();
        }
        echo json_encode($query);
    }

    public function show(Request $request){
        $id = $request->input('id');

        $query= DB::table('sounds_file')->where('package_id', '=', $id)->get();

        echo json_encode($query);
    }

    public function download($folder, $file){
        $path = public_path('sound_resource/'.$folder.'/'.$file);
        $headers = array(
            'Content-Type: application/mp3',
          );
        echo $path;
        return response()->download($path, $file, $headers);
    } 
}
