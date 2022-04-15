<html>

<head>
    <style>
    .hars {
        background-color: black;
        color: white;
        height: 2rem;
        padding-top: 1rem;
    }

    .btnn {
        margin-left: 13rem;
        margin-top: -1.2rem;

    }

    .navn {
        margin-left: 30rem;
    }
    </style>

    <script src="https://kit.fontawesome.com/2b29b6dab6.js" crossorigin="anonymous"></script>
</head>

<body>
    @extends('layouts.app')

    @section('content')

    <div style="text-align: center" class="panel-body">
        <form action="{{ route('store-task') }}" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-sm-6" style="width:300px; margin-left:420px">
                    <input type=" text" name="description" id="task-name" class="form-control">
                </div>
                <div class="form">
                    <button type="submit" class="btnn">
                        <i class="fa fa-btn fa-plus"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>


    @if (count($tasks) > 0)
    <div style="text-align: center" class="panel panel-default">

        <div class="panel-body">
            <table class="navn">

                <div>
                    <thead>
                        <th>&nbsp;</th>
                    </thead>
                </div>


                <tbody class="navn">
                    @foreach ($tasks as $task)
                    <tr>
                        <td><a href="<?php echo env('app_url'); ?>/edit/task/{{$task->id}}">{{ $task->description }}</a>
                        </td>

                        <td>
                            <form action="{{ url('task/'.$task->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button style="margin-left: 3.5rem" type="submit" id="delete-task-{{ $task->id }}"
                                    class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    @endsection
</body>

</html>