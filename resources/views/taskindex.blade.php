@extends ('layouts.layout')

@section ('content')

<div class="container mt-4">

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif

</div>

<h1>Hii, see your tasks below</h1>

<h6 class='text-danger'>Drag to reorder <small>(Reorders are save automatically)</small></h6>

<a href="/tasks/create" class="btn btn-primary  mb-4"> Add New</a>


<!-- can be done dynamically with a project model but i chose to hardcode for the sake of time -->
<div class="dropdown float-right" style="display:inline-block;">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Select Project
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="/taskfilter/1">One</a>
    <a class="dropdown-item" href="/taskfilter/2">Two</a>
    <a class="dropdown-item" href="/taskfilter/3">Three</a>
  </div>
</div>


<ul id='uls' class="list-group">
@foreach($tasks as $task)

  <li class="list-group-item" data-id="{{$task->id}}" id="{{$task->priority}}">  <p> <span class="ui-icon ui-icon-arrowthick-2-n-s"></span> {{ ucfirst($task->name) }}   </p>
  <form  method="post" action="{{url('tasks')}}/{{$task->id}}">
       @csrf
    <input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="btn btn-sm btn-danger float-right ml-2">Delete</button>
  </form>
  
  <a class="btn btn-sm btn-secondary float-right" href="/tasks/{{$task->id}}/edit">Edit</a> 



   </li>

@endforeach

@if($tasks->count() < 1)
<div class="card">
    <div class="card-body text-danger">
        Maybe add some Tasks first? 
    </div>
</div>
@endif


</ul>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" /> -->

<script type="text/javascript" defer>
    
    setTimeout( ()=> {
        $( "ul" ).sortable();
        // $( "ul" ).disableSelection();

        $( "ul" ).on( "sortupdate", ( event, ui )=> {

                console.log(event, ui);
                // $('li').each((i)=>
                // {
                //     // console.log(); // This is your rel value
                //     console.log($(this));
                // });
                save();

        } );


    }, 3000);
    

    function save(){
       let lis = Array.from(document.getElementById("uls").getElementsByTagName("li"));

       console.log(lis);

    //    for (let item of lis) {

        lis.forEach((item, ind)=>{

            console.log(item.id,item.dataset.id,ind);

           let formData = {
                priority: ind,
            };

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/taskdrag/'+item.dataset.id,
                type: 'PUT',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    // alert('Load was performed.');
                    console.log(data);
                }
            });




        })
        // }

        console.log('done');
        location.reload();

    } 
    


    </script>


@endsection