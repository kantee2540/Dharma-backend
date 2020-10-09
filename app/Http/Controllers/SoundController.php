<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use File;

class SoundController extends Controller{

    public function index(){
        $query = DB::table('sounds')->get();
        return view('sound', compact('query'));
    }

    public function show($id){
        $query = DB::table('sounds')->where('id', '=', $id)->first();
        $files = DB::table('sounds_file')->where('package_id', '=', $id)->get();
        return view('edit-sound', compact('query', 'files'));
    }

    public function addPackage(Request $request){
        try{
            $name = $request->input('name');
            $dateFolder = date('Y-m-d_H-i-s');

            $query = DB::table('sounds')->insert(['sound_package_name' => $name,
            'sound_package_folder' => $dateFolder,
            'created_at' => now(),
            'updated_at' => now()]);

            $file = public_path('sound_resource/'.$dateFolder); 
            $result = File::makeDirectory($file);
            return redirect('/admin/sound');

        }catch(QueryExceptions $e)
        {
           echo $e->getMessage();
        }
    }

    public function updateName(Request $request){
        $newName = $request->input('name');
        $id = $request->input('id');

        DB::table('sounds')->where('id', '=', $id)
        ->update(['sound_package_name' => $newName,
        'updated_at' => now()]);

        return redirect('/admin/sound/'.$id);
    }

    public function updateCoverImage(Request $request){
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png',
        ]);
        $id = $request->input('id');
        $folder = $request->input('folder');
        $imageFile = $request->file->getClientOriginalName();

        DB::table('sounds')->where('id', '=', $id)
        ->update(['package_image' => $imageFile]);

        $destinationPath = public_path('sound_resource/'.$folder);
        $uploadFile = $request->file->move($destinationPath, $imageFile);

        if ($uploadFile){
            return redirect('/admin/sound/'.$id);
        }
    }

    public function uploadFile(Request $request){
        $request->validate([
            'file' => 'required|file',
        ]);
        $id = $request->input('id');
        $folder = $request->input('folder');
        $soundFileName = date('Y-m-d_H-i-s').'_'.$request->file->getClientOriginalName();

        DB::table('sounds_file')->insert(["sound_file" => $soundFileName,
        'package_id' => $id,
        'created_at' => now(),
        'updated_at' => now()]);

        $destinationPath = public_path('sound_resource/'.$folder);
        $request->file->move($destinationPath, $soundFileName);
        return redirect('/admin/sound/'.$id);
    }

    public function deleteSoundFile(Request $request){
        $soundId = $request->input('sound_id');
        $packId = $request->input('package_id');
        $folder = $request->input('folder');
        $file = $request->input('file');

        DB::table('sounds_file')->where('sound_id', '=', $soundId)->delete();

        $target = public_path('sound_resource/'.$folder.'/'.$file);
        $fileDel = File::delete($target);

        if ($fileDel){
            return redirect('/admin/sound/'.$packId);
        }
    }

    public function deletePackage(Request $request){
        $id = $request->input('id');
        $folder = $request->input('folder');

        DB::table('sounds')->where('id', '=', $id)->delete();

        $target = public_path('sound_resource/'.$folder);
        File::deleteDirectory($target);

        return redirect('/admin/sound');
    }
}
