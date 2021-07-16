<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Cause;
use App\Models\Contract;
use App\Models\Task;

// Helpers
use Brian2694\Toastr\Facades\Toastr;

class TaskController extends Controller
{
    protected $config = [
        "moduleName" => "Tareas",
        "moduleLabel" => "Registro de Tareas",
        "routeView" => "modules.tasks.",
        "routeLink" => "tasks",
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Index
     */
    public function index($id)
    {
        // Data tasks
            $array = Cause::with('tasks')->find($id);

        // Return view
            return view($this->config["routeView"] . "index")
                    ->with('causes', $array)
                    ->with("breadcrumAction", "")
                    ->with("config", $this->config);
    }

    /**
     * List tasks
     */
    public function listTasks($id)
    {
        // Search data
            $data = Task::whereCauseId($id)->get();

        // Return response
            return response()->json($data);
    }

    /**
     * Create
     */
    public function create($id)
    {
        return view($this->config["routeView"] . "register")
                    ->with('cause', $id)
                    ->with("breadcrumAction", "")
                    ->with("typeForm", "create")
                    ->with("config", $this->config);
    }
    /**
     * Store
     */
    public function store(Request $request)
    {
        $addTask = Task::create([
            'cause_id' => $request->input('cause_id'),
            'description' => $request->input('description'),
            'responsible' => $request->input('responsible'),
            'deadline' => $request->input('deadline'),
            'status' => 1,
        ]);

        if ($addTask) {
            Toastr::success("", "Tarea registrada!");
            return redirect('causes/'.$request->input('cause_id').'/tasks');
        }
    }
    /**
     * Edit
     */
    public function edit($id)
    {
        return view($this->config["routeView"] . "register")
                    ->with('row', Task::find($id))
                    ->with("breadcrumAction", "")
                    ->with("typeForm", "update")
                    ->with("config", $this->config);
    }
    /**
     * Update
     */
    public function update(Request $request)
    {
        $updateTask = Task::find($request->input('task_id'));
        $updateTask->description = $request->input('description');
        $updateTask->responsible = $request->input('responsible');
        $updateTask->deadline = $request->input('deadline');
        if ($updateTask->save()) {
            Toastr::success("", "Tarea Actualizada!");
            return redirect('causes/tasks/edit/'.$request->input('task_id'));
        }
    }
    /**
     * Complete
     */
    public function complete(Request $request)
    {
        $taskId = Task::find($request->input('task_id'));
        $taskId->date_realization = date("Y-m-d");
        $taskId->status = 2;
        if ($taskId->save()) {
            return response()->json(1);
        }
    }
}
