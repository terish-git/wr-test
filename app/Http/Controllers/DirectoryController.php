<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Directory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DirectoryController extends Controller
{

    protected $uploadPath = 'directory/';

    public function index()
    {
        $page_title = 'Directory';
        $directorys    = Directory::select('id', 'name')->orderBy('id')->paginate(2);
        return view('directory.index', compact('page_title', 'directorys'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['status'] = 1;

        
        $slug = Str::slug($data['name']);
        $path = 'public/' . $this->uploadPath . $slug;
        Storage::makeDirectory($path);


        $dirObj = Directory::create($data);
        $dirObj->path = $dirObj->slug;
        $dirObj->save();

        return redirect('directory')->with('message', 'Directory created successfully');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $directory_data = Directory::findOrFail($id);
        return $directory_data;
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $lims_directory_data = Directory::find($data['directory_id']);

        if($request->has('status'))
            $data['status'] = 1;
        else
            $data['status'] = 0;

        $lims_directory_data->update($data);
        return redirect('directory')->with('message', 'Directory updated successfully');
    }


    public function destroy($id)
    {
        $directory_data = Directory::find($id);
            Storage::delete('public/'.$this->uploadPath.'/'.$directory_data->path);
        $directory_data->delete();
        return redirect('directory')->with('not_permitted', 'Directory deleted successfully');
    }
}
