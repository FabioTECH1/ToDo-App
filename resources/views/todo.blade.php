<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>

</head>

<body class="bg-light">
    <h2 class="my-4 text-center">ToDo App</h2>
    <div class="container-fluid my-3 bg-white p-4" style="width: 40%;">
        <form action="{{ route('add.task') }}" method="post" class="row gx-3 gy-2 align-items-center">
            @csrf
            <input type="text" name="task" class="form-control my-2 shadow-none" id="">
            <button type="submit" class="btn btn-primary shadow-none">Add</button>
        </form>
        @error('task')
            <p class="text-info text-center my-2">{{ $message }}</p>
        @enderror
    </div>
    @if ($tasks->count() < 1)
        <h4 class="text-center text-info">No Tasks</h4>
    @else
        <h4 class="text-center text-info">You have {{ $tasks->count() }} tasks in total
            @if ($task2do->count() > 0 && $taskdone->count() > 0)
                <span class="text-black-50">({{ $taskdone->count() }} completed, {{ $task2do->count() }} to
                    go)</span>
            @elseif ($taskdone->count() < 1) <span class="text-warning text-small">(No task done yet)</span>
                @else
                    <span class="text-success text-small">(Tasks Completed)</span>
            @endif
        </h4>
    @endif
    @if ($tasks->count() > 0)
        <div class="container-fluid my-4" style="width: 40%;">
            <table class="table table-hover  table-info table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Tasks</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($tasks as $task)
                    <tbody>
                        <tr>
                            <td>{{ $task->task }}</td>
                            @if ($task->status == 0)
                                <td>Task On Queue</td>
                            @else
                                <td>Task Done</td>
                            @endif
                            <td>
                                <div class="custom-control custom-checkbox d-inline">
                                    <form action="{{ route('done.task', $task->id) }}" method="post"
                                        id="check{{ $task->id }}" class="d-inline">
                                        <input type="checkbox"
                                            onchange="document.getElementById('check{{ $task->id }}').submit()"
                                            class="custom-control-input" @if ($task->status == 1) checked @endif>
                                        @csrf
                                    </form>
                                    <form action="{{ route('remove.task', $task->id) }}" method="post"
                                        class="d-inline p-4">
                                        @csrf
                                        @method('delete')
                                        <button class="btn-sm btn-close shadow-none"></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @endforeach

            </table>
            <form action="{{ route('remove.task.all') }}" method="post" style="text-align: center">
                @csrf
                @method('delete')
                <button type="button" class="btn btn-primary shadow-none"
                    onclick="document.getElementById('confirmation').style.display='block';">Delete All</button>
                <div class="my-2" id='confirmation' style="display: none">
                    <button type="submit" class="btn-sm btn-outline-danger shadow-none">Yes</button>
                    <button type="button" class="btn-sm btn-outline-success shadow-none"
                        onclick="document.getElementById('confirmation').style.display='none';">No</button>
                </div>
            </form>
        </div>

    @endif
</body>

</html>
