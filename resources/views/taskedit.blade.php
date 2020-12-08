@extends ('layouts.layout')

@section ('content')

<h1>Edit task</h1>


<div class="container mt-4">
 
 
  @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
  @endif
  
  @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
  @enderror

  <div class="card">
    <div class="card-body">
      <form name="add-task" id="add-task" method="post" action="{{url('tasks')}}/{{$task->id}}">
       @csrf
        <div class="form-group">
          <label >Task Name</label>
          <input type="text" id="name" value="{{$task->name}}" name="name" class="form-control" required>
        </div>
        <div class="form-group">
          <label >Task Priority</label>
          <input type="number" value="{{$task->priority}}" id="priority" name="priority" class="form-control" required>
        </div>
        <div class="form-group">
            <select value="1" name="project_id" class="custom-select" required>
                <option value=''>Select project</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <input name="_method" type="hidden" value="PUT">
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>    

@endsection