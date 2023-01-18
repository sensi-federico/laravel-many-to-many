<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->get();
        //dd
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $types = Type::All();
        $technologies = Technology::all();
        // dd($types);
        return view('admin.projects.create', compact('types', 'project', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        // dd($request->all());
        $val_data = $this->validation($request->all());

        $project_slug = Str::slug($val_data['title']);
        $val_data['slug'] = $project_slug;

        $cover = Storage::disk('public')->put('placeholders', $request->cover);
        // dd($cover);
        $val_data['cover'] = $cover;

        $project = Project::create($val_data);

        // attach the selected technologies
        if ($request->has('technologies')) {
            $project->technologies()->attach($val_data['technologies']);
        }

        // dd($request->all());

        return to_route('admin.projects.index')->with('message', "$project->title added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        // dd($project->type_id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $this->validation($request->all());
        $project_slug = Str::slug($val_data['title']);
        $val_data['slug'] = $project_slug;


        $project->update($val_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($val_data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }


        // dd($request->all());

        return to_route('admin.projects.index')->with('message', "$project->title added successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::delete($project->image);
        }
        $project->delete();

        return to_route('admin.projects.index')->with('message', "$project->title deleted successfully");
    }



    private function validation($data)
    {
        // Validator::make($data, $rules, $message)
        $validator = Validator::make($data, [
            'title' => 'required|min:5|max:100',
            'overview' => 'nullable',
            'cover' => 'nullable|image|max:500',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ])->validate();

        return $validator;
    }
}
