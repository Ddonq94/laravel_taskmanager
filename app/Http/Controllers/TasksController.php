<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        //
        $tasks = Task::orderBy('priority', 'asc')->get();
        // return $tasks;
        return view('taskindex')->with('tasks',$tasks);
    
    }
    
    
    public function getByProject($project)
    {
        //
        $tasks = Task::all()->where('project_id', $project);
        // dd($tasks);
        // return $tasks;
        return view('taskindex')->with('tasks',$tasks);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('taskcreate');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request,[
            'name'=> 'required',
            'priority'=> 'required',
            'project_id'=> 'required',
        ]);


        // $task = new Task;
        $task = Task::create($request->all());

        return redirect('/tasks')->with('success', 'Task Saved Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::find($id);
        // return $task;
        return view('taskedit')->with('task',$task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $this->validate($request,[
            'name'=> 'required',
            'priority'=> 'required',
            'project_id'=> 'required',
        ]);

        Task::find($id)->update($request->all());

        return redirect('/tasks')->with('success', 'Task Updated Successfully');

    }
    
    public function updateByDrag(Request $request, $id)
    {
        //

        // return true;
        $this->validate($request,[
            'priority'=> 'required',
        ]);

        Task::find($id)->update($request->all());

        return response()->json(true, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Task::find($id)->delete();

        return redirect('/tasks')->with('success', 'Task Deleted Successfully');
    }
}
