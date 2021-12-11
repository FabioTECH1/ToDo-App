<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- <link rel="manifest" href="{{ asset('manifest/app.webmanifest') }}"> --}}
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function(reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>


</head>

<body class="bg-light">
    <section class="vh-100 gradient-custom">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <h2 class="mb-4 text-center">ToDo App</h2>
                <div class="col col-xl-10">
                    <div class="card">
                        <div class="card-body p-5">

                            <form action="{{ route('add.task', $user_id) }}" id="add_task" method="POST"
                                class="d-flex justify-content-center align-items-center mb-4">
                                <div class="form-outline flex-fill">
                                    <input type="text" id="task" placeholder='New task...'
                                        class="form-control shadow-none" name="task" required />
                                </div>
                                @csrf
                                <button type="submit" class="btn btn-info ms-2 shadow-none">Add</button>
                            </form>


                            <!-- Tabs content -->
                            <div class="tab-content" id="ex1-content">

                                <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel"
                                    aria-labelledby="ex1-tab-1">
                                    <ul class="list-group mb-0" id="all_tasks">
                                        @foreach ($tasks as $task)
                                            <li class="status_form list-group-item d-flex align-items-center border-0 mb-2 rounded"
                                                style="background-color: #f4f6f7;">
                                                <form action="{{ route('done.task', [$user_id, $task->id]) }}"
                                                    method="post" id="check{{ $task->id }}" class="d-inline">
                                                    <input type="checkbox"
                                                        class="custom-control-input form-check-input me-2 task_status"
                                                        @if ($task->status == 1) checked @endif>
                                                    <span class="task_text text-uppercase">
                                                        @if ($task->status == 0)
                                                            {{ $task->task }}
                                                        @else
                                                            <s>{{ $task->task }}</s>
                                                        @endif
                                                    </span>
                                                    @csrf
                                                </form>
                                                <div>
                                                    <form action="{{ route('remove.task', [$user_id, $task->id]) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        {{-- <input type="submit" class="btn-sm btn-close shadow-none"
                                                            value=""> --}}
                                                        <button class="btn-sm btn-close shadow-none delete_task"
                                                            style="margin-left:13em"></button>
                                                    </form>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- Tabs content -->
                        </div>
                    </div>

                </div>
                @if ($tasks->count() <= 0)

                @else
                    <form action="{{ route('remove.task.all', $user_id) }}" method="post" style="text-align: center"
                        class="mt-3" id='delete_all'>
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-primary shadow-none"
                            onclick="document.getElementById('confirmation').style.display='block'">Delete All</button>
                        <div class=" my-2" id='confirmation' style="display: none">
                            <button type="submit" class="btn-sm btn-outline-danger shadow-none">Yes</button>
                            <button type="button" class="btn-sm btn-outline-success shadow-none"
                                onclick="document.getElementById('confirmation').style.display='none';">No</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

    </section>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
