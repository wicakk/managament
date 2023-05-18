<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{
 
    public function index(): View
    {
        $projects = Project::all();
        return view ('projects.project')->with('projects', $projects);
    }
 
    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Project::create($input);
        return redirect('projects')->with('flash_message', 'Project Addedd!');
    }
 
    public function show(string $id): View
    {
        $Project = Project::find($id);
        return view('projects.show')->with('projects', $Project);
    }
 
    public function edit(string $id): View
    {
        $Project = Project::find($id);
        return view('projects.edit')->with('projects', $Project);
    }
 
    public function update(Request $request, string $id): RedirectResponse
    {
        $Project = Project::find($id);
        $input = $request->all();
        $Project->update($input);
        return redirect('projects')->with('flash_message', 'Project Updated!');  
    }
 
    
    public function destroy(string $id): RedirectResponse
    {
        Project::destroy($id);
        return redirect('projects')->with('flash_message', 'Project deleted!');
    }
}