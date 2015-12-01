<?php

namespace PS\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PS\Entities\Project;
use PS\Http\Requests;
use PS\Http\Controllers\Controller;
use PS\Services\ProjectService;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectService
     */
    private $service;

    /**
     * ProjectFileController constructor.
     * @param ProjectService $service
     */
    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $data['file'] =$file;
        $data['extension'] = $file->getClientOriginalExtension();
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $this->service->createFile($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id,$file_id)
    {
        return $this->service->destroyImage($file_id);
    }
}
