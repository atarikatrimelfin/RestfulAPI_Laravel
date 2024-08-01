<?php

namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;

class WebToDoController extends Controller
{
    public function index()
    {
        $todo = ToDo::orderBy('due_date', 'desc')->get();
        return view('todo.index', compact('todo'));
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => '',
            'status' => 'required',
            'priority' => 'required',
            'due_date' => 'required',
        ]);

        ToDo::create($request->all());

        return redirect('/todo')->with('success', 'ToDo Added Successfuly');
    }


    public function edit($id)
    {
        $todo = ToDo::find($id);
        return view('todo.update', compact('todo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => '',
            'status' => 'required',
            'priority' => 'required',
            'due_date' => 'required',
        ]);

        $todo = ToDo::find($id);

        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->status = $request->status;
        $todo->priority = $request->priority;
        $todo->due_date = $request->due_date;

        $todo->save();

        return redirect('/todo')->with('success', 'ToDo Updated Succcessfuly.');
    }

    public function destroy($id)
    {
        ToDo::find($id)->delete();
        return redirect('/todo')->with('success', 'ToDo Deleted Successfuly');
    }
}
