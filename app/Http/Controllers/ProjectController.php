<?php

namespace App\Http\Controllers;

use App\Jobs\ProjectCreateJob;
use App\Models\ProjectModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Schema;

class ProjectController extends Controller
{
    //
    public function index(){
        $projects = ProjectModel::all();
        return view("pages.projects.index", compact("projects"));
    }
    public function create() {
        return view("pages.projects.create");
    }

    public function store(Request $request) {
        $project = ProjectModel::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'end_date' => $request->end_date,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
        
        ProjectCreateJob::dispatch($project->id, $project->name);
    
        return redirect(route('projects.index'));
    }

    public function edit($id) {
        $project = ProjectModel::find($id);
        return view('pages.projects.settings', compact('project'));
    }

    public function update(Request $request, $id) {
        $project = ProjectModel::find($id);
    
        $oldTableName = 'project_' . $project->id . '_' . str_replace(' ', '_', strtolower($project->name));
    
        $projectData = [
            'name' => $request->name,
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'end_date' => $request->end_date,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ];
    
        $project->update($projectData);
    
        $newTableName = 'project_' . $project->id . '_' . str_replace(' ', '_', strtolower($request->name));
    
        if (Schema::hasTable($oldTableName) && $oldTableName !== $newTableName) {
            Schema::rename($oldTableName, $newTableName);
        }
    
        return redirect(route('projects.index'));
    }
    

    public function destroy($id) {
        $project = ProjectModel::find($id);
        $tableName = 'project_' . $id . '_' . str_replace(' ', '_', strtolower($project->name));
        Schema::dropIfExists($tableName);
        $project->delete();

        return redirect(route('projects.index'));
    }
}
