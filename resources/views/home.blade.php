@extends('components/main')

@section('title', 'Home')

@section('style-container')
  @vite('resources/home/css/main.css')
  @vite('resources/home/js/create-task.js')
  @vite('resources/home/js/finish-task.js')
@endsection


@section('main-content')
  <div class="main-container">

    <div class="create-and-hashtags">

      <div class="create-task-container">
        <form class="was-validated" id="createTaskForm" method="POST" action="{{ route('task.create') }}">

          @csrf

          <div class="form-check mb-3">
            <label for="task_content" class="form-label">Task Title</label>
            <input name="task_title" type="text" class="form-control" aria-label="Task Title" placeholder="Task Title" required>
            <div class="invalid-feedback">Enter a task title</div>
          </div>

          <div class="form-check mb-3">
            <label for="taskContent" class="form-label">Task Content</label>
            <textarea name="task_content" class="form-control" id="taskContent" placeholder="Task Content" required></textarea>
            <div class="invalid-feedback">
              Please enter a task content
            </div>
          </div>

          <div class="form-check mb-3">
            <input name="hashtag" type="text" id="hashtag" class="form-control" aria-label="Hashtag" placeholder="e.g. #sports" required>
            <div class="invalid-feedback">Enter a hashtag</div>
          </div>

          <div class="form-check mb-3">
            <input name="deadline_date" type="date" id="deadlineDate" class="form-control" aria-label="Deadline Date" required>
            <div class="invalid-feedback">Enter a deadline date</div>
          </div>


          <div style="display: flex; flex-direction: row;" class="form-check mb-3">
            <button id="submit-btn" class="btn btn-primary" type="submit">Create Task</button>

            <div style="margin-left: 10px" class="form-check mb-3">
              <input name="finished" type="checkbox" class="form-check-input" id="validationFormCheck1">
              <label class="form-check-label" for="validationFormCheck1">Finished</label>
            </div>

          </div>

        </form>
        @if($errors->any())
            @foreach($errors->all() as $single_error)
                <div id="create-task-error-feedback" class="alert alert-danger" role="alert">
                    <span style="width: 95%; display: inline-block"> {{ $single_error }} </span>
                    <button style="float: right" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif
      </div>

      <div class="hashtags-list">

        <!-- for the unfinished tasks -->
        <div class="list-group">
          <span class="list-group-item"
                style="background-color: black; border: none; border-radius: 0px; border-bottom: 3px solid white; color: white">
                Unfinishehd Tasks
          </span>

          @if(count($unfinished_tasks) > 0)
              @foreach($unfinished_tasks as $single_unfinished_tasks)
                <a href="#" class="list-group-item list-group-item-action">
                  <span class="badge text-bg-warning"> {{ $single_unfinished_tasks->hashtag }} </span>
                </a>
              @endforeach
          @else
          <div class="alert alert-danger" role="alert">
            <span> No Unfinished Tasks Yet! </span>
          </div>
          @endif
        </div>

        <!-- for the finished tasks -->
        <div class="list-group">
            <span class="list-group-item"
                  style="background-color: black; border: none; border-radius: 0px; border-bottom: 3px solid white; color: white">
                  Finishehd Tasks
            </span>
            @if (count($finished_tasks) > 0)
              @foreach($finished_tasks as $single_finished_task)
                <li> <a href="#" class="list-group-item list-group-item-action">{{ $single_finished_task->hashtag }}</a> </li>
              @endforeach
            @elseif (count($finished_tasks) == 0)
              <div class="alert alert-danger" role="alert">
                <span> No Unfinished Tasks Yet! </span>
              </div>
            @endif
        </div>

      </div>

    </div>


    <div class="task-list-container">
      <div class="unfinished-tasks">
        @if (count($unfinished_tasks) > 0)

            @foreach($unfinished_tasks as $single_unfinished_task)
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <span> {{ $single_unfinished_task->task_title }} </span> -
                      <span class="badge text-bg-warning"> {{ $single_unfinished_task->hashtag }} </span> -
                      <span class="badge text-bg-danger"> Status : Unfinished </span>
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div style="display: flex; flex-direction: row" class="accordion-body">
                      <div style="width: 100%">
                        {{ $single_unfinished_task->task_content }}
                      </div>

                      <div style="display: flex; flex-direction: row;">
                        <span id="task-id" style="display: none;"> {{ $single_unfinished_task->id }} </span>

                        <button id="mark-as-finished" type="button" class="btn btn-success">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-square-fill" viewBox="0 0 16 16">
                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"></path>
                          </svg>
                        </button>

                        <form style="margin-left: 10px;" method="POST" action="{{ route('task.delete', $single_unfinished_task->id) }}">
                          @csrf
                          <button type="submit" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path>
                              <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path>
                            </svg>
                          </button>
                        </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach

        @else
          <div class="alert alert-danger" role="alert">
            <span> No Unfinished Tasks Yet! </span>
          </div>
        @endif

      </div>

      <div class="finished-tasks">
        @if(count($finished_tasks) > 0)

          @foreach($finished_tasks as $single_finished_task)
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <span> {{ $single_finished_task->task_title }} </span> -
                    <span class="badge text-bg-warning"> {{ $single_finished_task->hashtag }} </span> -
                    <span class="badge text-bg-success"> Status : Finished </span>
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                  <div style="display: flex; flex-direction: row" class="accordion-body">
                    <div style="width: 100%">
                      {{ $single_finished_task->task_content }}
                    </div>
                    <div>
                      <span id="task-id" style="display: none;"> {{ $single_finished_task->id }} </span>
                      <form style="margin-left: 10px;" method="POST" action="{{ route('task.delete', $single_finished_task->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path>
                          </svg>
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

        @else
          <div class="alert alert-danger" role="alert">
            <span> No Finished Tasks Yet! </span>
          </div>
        @endif
      </div>
    </div>



  <button style="display: none" id="modal-activation" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Finish Task</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Do You want to confirm task accomplishment for task <span class="badge text-bg-success" id="task-title-container"> </span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a id="finish-task-url" class="btn btn-primary" href="#"> Mark As Finished </a>
        </div>
      </div>
    </div>
  </div>
@endsection
