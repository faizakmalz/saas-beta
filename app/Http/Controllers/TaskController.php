<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class TaskController extends Controller
{   
    protected string $projectName;
    protected int $projectId;
    protected string $tableName;

    public function __construct($projectName = null, $projectId = null) {
        if ($projectName && $projectId) {
            $this->projectName = $projectName;
            $this->projectId = $projectId;
            $this->tableName = 'project_' . $projectId . '_' . str_replace(' ', '_', strtolower($projectName));
        }
    }

    public function index($projectName, $projectId) {
        $this->setProjectDetails($projectName, $projectId);
        $tasks = DB::table($this->tableName)->get();
        return view('pages.tasks.index', compact('tasks', 'projectName', 'projectId'));
    }

    public function create($projectName, $projectId) {
        $this->setProjectDetails($projectName, $projectId);
        return view('pages.tasks.create', compact('projectName', 'projectId'));
    }

    public function edit($projectName, $projectId, $taskId) {
        $this->setProjectDetails($projectName, $projectId);
        $task = DB::table($this->tableName)->where('id', $taskId)->first();

        return view('pages.tasks.edit', compact('task', 'projectName', 'projectId'));
    }

    public function update(Request $request, $projectName, $projectId, $taskId) {
        $this->setProjectDetails($projectName, $projectId);

        $taskData = [
            'task_name' => $request->task_name,
            'task_description' => $request->task_description,
            'due_date' => $request->due_date,
        ];

        DB::table($this->tableName)->where('id', $taskId)->update($taskData);

        return redirect()->route('tasks.index', [
            'projectName' => $this->projectName,
            'projectId' => $this->projectId,
        ]);
    }


    public function store(Request $request, $projectName, $projectId) {
        $this->setProjectDetails($projectName, $projectId);

        $task = [
            'project_id' => $this->projectId,
            'task_name' => $request->task_name,
            'task_description' => $request->task_description,
            'due_date' => $request->due_date,
        ];

        DB::table($this->tableName)->insert($task);

        return redirect()->route('tasks.index', [
            'projectName' => $this->projectName,
            'projectId' => $this->projectId,
        ]);
    }

    protected function setProjectDetails($projectName, $projectId) {
        $this->projectName = $projectName;
        $this->projectId = $projectId;
        $this->tableName = 'project_' . $projectId . '_' . str_replace(' ', '_', strtolower($projectName));
    }

    public function destroy(    Request $request, $projectName, $projectId, $taskId) {
        $this->setProjectDetails($projectName, $projectId);
        DB::table($this->tableName)->where('id', $taskId)->delete();
        return redirect()->route('tasks.index', [
            'projectName' => $this->projectName,
            'projectId' => $this->projectId,
        ]);
    }
}
