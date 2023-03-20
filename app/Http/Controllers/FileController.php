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
            'file'=>'required|max:10240', // 용량 10MB까지
        ]);

        // 화면에서 받아온 파일이 존재하는지 확인
        if (request('file')) {
            // 초기화
            $file = new File();
            $paramFile=request()->file('file');
            
            // DB 저장값 설정
            $file->user_id = auth()->user()->id;
            $file->file_name = $request->filename;
            $file->file_url = date('Ymd_His').'_'.$paramFile->getClientOriginalName();
            $file->file_size = formatBytes($paramFile->getSize());
            $file->file_type = $paramFile->extension();
            
            // 파일 저장
            $paramFile->move('storage/files',$file->file_url);

            // DB 저장
            $file->save();
        }
        
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
        return view('file.edit',compact('file'));
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
        $inputs=$request->validate([
            'filename'=>'required|max:255',
            'file'=>'max:10240', // 용량 10MB까지
        ]);

        $file->user_id = auth()->user()->id;
        $file->file_name = $request->filename;

        // 화면에서 받아온 파일이 존재하는 경우 파일 저장을 실행
        if (request()->file('file') !== null) {
            // 초기화
            $paramFile=request()->file('file');
            
            // DB 저장값 설정
            $file->file_url = date('Ymd_His').'_'.$paramFile->getClientOriginalName();
            $file->file_size = formatBytes($paramFile->getSize());
            $file->file_type = $paramFile->extension();
            
            // 파일 저장
            $paramFile->move('storage/files',$file->file_url);
        }
        
        // DB 저장
        $file->save();

        return redirect()->route('file.show',$file)->with('message','파일편집하였습니다');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        // DB의 파일정보삭제
        $isDeleted = $file->delete();
        $deleteFilePath = 'storage/files/'.$file->file_url;
        // 물리적으로 파일삭제
        if(is_file($deleteFilePath)){
            // TODO filesystems.php의 루트경로를 취득하는 함수로 변경필요
            unlink(storage_path('app/public/files/'.$file->file_url));
        }
        return redirect()->route('file.index')->with('message','파일삭제하였습니다');
    }
}
