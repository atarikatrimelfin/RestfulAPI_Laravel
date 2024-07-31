<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ToDoController extends Controller
{
    public function index()
    {
        $todo = ToDo::all();
        return response()->json($todo);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
            'priority' => 'required|in:Low,Medium,High',
            'due_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Created Data Failed',
                'data' => $validator->errors()
            ], 422);
        }

        $todo = ToDo::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Created Data Success',
            'data' => $todo
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'status' => 'required|in:Pending,In Progress,Completed',
            'priority' => 'required|in:Low,Medium,High',
        ];

        if ($request->has('title')) {
            $rules['title'] = 'string|max:255|unique:todo,title,' . $id;
        }

        if ($request->has('due_date')) {
            $rules['due_date'] = 'date';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Updated Data Failed',
                'data' => $validator->errors()
            ], 422);
        }

        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json([
                'success' => false,
                'message' => 'Todo not found',
                'data' => null
            ], 404);
        }

        if ($request->has('title')) {
            $todo->title = $request->title;
        }
        if ($request->has('description')) {
            $todo->description = $request->description;
        }
        if ($request->has('status')) {
            $todo->status = $request->status;
        }
        if ($request->has('priority')) {
            $todo->priority = $request->priority;
        }
        if ($request->has('due_date')) {
            $todo->due_date = $request->due_date;
        }

        $todo->save();

        return response()->json([
            'success' => true,
            'message' => 'Updated Data Success',
            'data' => $todo
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $todo = ToDo::find($id);

            if (!$todo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Todo Not Found',
                    'data' => null
                ], 404);
            }

            $todo->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data Deleted Successfully',
                'data' => null
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the data',
                'data' => $th->getMessage(),
            ], 500);
        }
    }
}
