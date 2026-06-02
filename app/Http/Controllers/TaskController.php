<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class TaskController extends Controller
{

    public function AddCategoryToTask($task_id, Request $request)
    {
        try {
            $tsak = Task::findOrFail($task_id);
            $tsak->categories()->attach($request->category_id);
            return response()->json('atattched successfully', 200);
        } catch (Exception $e) {
            return response()->json([
                "erorr" => "this ctegory is alredy atattched"
                ,
                "detales" => $e->getMessage()
            ], 404);
        }

    }
    public function getTasksOrdered()
    {
        $task = Auth::user()
            ->tasks()
            ->orderByRaw("FIELD(priority,'high','medium','low')")
            ->get();

        return response()->json($task, 200);
    }
    //------------------------------------CRUD--------------------------------------

    public function store(StorTaskRequest $request)
    {

        $user_id = Auth::user()->id;
        $validatedData = $request->validated();
        $validatedData['user_id'] = $user_id;
        $task = Task::create($validatedData);

        return response()->json($task, 201);
    }

    public function index()
    {
        $task = Auth::user()->tasks;

        return response()->json($task, 200);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task, 200);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $user_id = Auth::user()->id;

        if ($task->user_id != $user_id)
            return response()->json(['massege' => 'you have not this task'], 403);


        $task->update($request->only('title', 'describion', 'priority'));
        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return response()->json('deleted succesfully', 200);
        } catch (Exception $e) {
            return response()->json([
                'erorr' => 'not found',
                'detales' => $e->getMessage()
            ], 403);
        }

    }

    //------------------------------------------------------------------------

    public function getUser($id)
    {
        $user = Task::find($id)->user;
        return response()->json($user);
    }



}

