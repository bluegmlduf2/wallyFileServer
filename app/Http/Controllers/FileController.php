<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('created_at','desc')->get(); //File::all()
        $user = auth()->user();
        return view('file.index',compact('files','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('file.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        $inputs=$request->validate([
            'filename'=>'required|max:255',
            'file'=>'required|max:1024',
        ]);

        $file = new File();
        $file->user_id = auth()->user()->id;
        // TODO 파일패스부분 수정 예정
        $file->file_path = 'testPath1';
        
        // 파일저장 및 파일정보저장
        if (request('file')) {
            $paramFile=request()->file('file');
            
            // DB 전송값 설정
            $file->file_name = date('Ymd_His').'_'.$paramFile->getClientOriginalName();
            $file->file_size = $paramFile->getSize();
            $file->file_type = $paramFile->extension();
            
            // 파일 저장
            $paramFile->move('storage/files',$file->file_name);
        }
        
        $file->save();
        
        return redirect()->route('file.create')->with('message','파일등록하였습니다');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        return view('file.show',compact('file'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFileRequest  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
