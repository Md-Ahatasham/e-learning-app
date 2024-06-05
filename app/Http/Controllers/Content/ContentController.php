<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Services\Content\ContentService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    protected $service;

    public function __construct(ContentService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function prepareContentByCourseId($courseId)
    {
        $data['courseId'] = $courseId;
        $data['breadcrumb'] = $this->getBreadcrumb("Content", "Upload Content");
        return view('backend.contents.create', with(['data' => $data]));
    }
    /**
     * Store a newly created permission to role.
     * @date: 02-03-2022
     * @param Request $request
     * @return RedirectResponse
     */

    public function store(Request $request): RedirectResponse
    {
        try {
            $this->service->storeContent($request);
        } catch (Exception $ex) {
            return redirect()->route('courses.index')->with('toast_warning', 'Failed, Content not added!');
        }
        return redirect()->route('courses.index')->with('toast_success', 'Content added successfully !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        //
    }

    public function getContentById($id)
    {
        $data['contentList'] = $this->service->getContent($id);
        $data['breadcrumb'] = $this->getBreadcrumb("Content", "Content List");
        return view('backend.contents.index', with(['data' => $data]));
    }
}
