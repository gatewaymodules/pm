@extends('app')

@section('content')
    <h3>Dashboard</h3>

        <a href="#overdue-and-high-priority">Overdue and High Priority Owned</a> |
        <a href="#overdue-and-high-priority-unassigned">Overdue and High Priority Unassigned</a> |
        <a href="#tasks-completed-graph">Tasks Completed</a> |
        <a href="#tasks-created-graph">Tasks Created</a> |
        <a href="#tasks-updated-graph">Tasks Updated</a> |
        <a href="#number-tasks-created-list">Number of Tasks Created</a>

    @if ( $highPriorityTasks->count() )
        <a name="overdue-and-high-priority"></a>
        <h4>Overdue and high priority owned tasks</h4>
        <div class="table-responsive">
        <table class="table table-hover table-condensed" id="table-clickable" >
        <thead>
            <th>Task</th>
            <th>Due</th>
            <th>Task list</th>
            <th>Project</th>
            <th>Assigned To</th>
        </thead>
        @foreach( $highPriorityTasks as $task )
            <tr>
                <td>
                    <a href="{{ $task->url }}"><font color="red">
                    {{ $task->name }}</font>
                    </a>
                </td>
                <td><font color="red">{{ $task->due_at() }}</font></td>
                <td>
                    {{ $task->tasklist->name }}
                </td>
                <td>
                    {{ $task->tasklist->project->name }}
                </td>
                <td>
                    @foreach( $task->users as $user )
                        {{ $user->name }},
                    @endforeach
                </td>
            </tr>
        @endforeach
    </table>
            </div>
        <hr>
    @endif

    @if ( $user->hasRole('admin'))

    @if ( $highPriorityTasksUnassigned->count() )
        <a name="overdue-and-high-priority-unassigned"></a>
        <h4>Overdue and high priority tasks unassigned</h4>
        <div class="table-responsive">
            <table class="table table-hover table-condensed" id="table-clickable" >
                <thead>
                <th>Task</th>
                <th>Due</th>
                {{--
                <th>Task list</th>
                <th>Project</th> --}}
                <th>Assigned To</th>
                </thead>
                @foreach( $highPriorityTasksUnassigned as $task )
                    <tr>
                        <td>
                            <a href="{{ $task->url }}"><font color="red">
                                    {{ $task->name }}</font>
                            </a>
                        </td>
                        <td><font color="red">{{ $task->due_at() }}</font></td>
                        {{--
                        <td>
                            {{ $task->tasklist()->get() }}
                        </td>
                        <td>
                         {{ $task->tasklist()->project()->name }}
                        </td>
                        --}}
                        <td>
                            @foreach( $task->users as $user )
                                {{ $user->name }},
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <hr>
    @endif

    @endif

    {{--
    @if ($normalPriorityTasks)
        The following tasks are overdue:
    @endif

    @if ($todaysTasks)
        Today's due tasks:
    @endif

    @if ($futureTasks)
        Upcoming tasks:
    @endif
    --}}

    <a name="tasks-completed-graph"></a>
    <label for = "tasks-completed-report">Tasks Completed<br />
        <canvas id="tasks-completed-report" width="342" height="300"></canvas>
    </label>

    <a name="tasks-updated-graph"></a>
    <label for = "daily-reports">Tasks Updated<br />
        <canvas id="tasks-updated-report" width="342" height="300"></canvas>
    </label>

    <a name="tasks-created-graph"></a>
    <label for = "daily-reports">Tasks Created<br />
        <canvas id="daily-reports" width="342" height="300"></canvas>
    </label>

    <hr>

    <a name="number-tasks-created-list"></a>
    <h3>Number of Tasks Created</h3>
    @foreach ($totals as $index => $dailyAmounts)
        <li><strong>{{ $dates[$index] }}</strong> {{ $dailyAmounts}}</li>
    @endforeach

    <script src="/js/vendor/chart.js"></script>
    <script>
        (function() {
            var ctx = document.getElementById('tasks-completed-report').getContext('2d');
            var chart = {
                labels: {!! json_encode($completedDates)  !!},
                datasets: [{
            data: {{ json_encode($completedTasks) }},
            fillColor : "#00ff00",
            strokeColor : "#006600",
            pointColor : "#000000"
        }]
        };
        new Chart(ctx).Bar(chart, { bezierCurve: false });
        })();

        (function() {
            var ctx = document.getElementById('tasks-updated-report').getContext('2d');
            var chart = {
                labels: {!! json_encode($updatedDates)  !!},
                datasets: [{
                    data: {{ json_encode($updatedTasks) }},
                    fillColor : "#3366FF",
                    strokeColor : "#000099",
                    pointColor : "#000000"
                }]
            };
            new Chart(ctx).Bar(chart, { bezierCurve: false });
        })();

        (function() {
            var ctx = document.getElementById('daily-reports').getContext('2d');
            var chart = {
                labels: {!! json_encode($dates)  !!},
                datasets: [{
            data: {{ json_encode($totals) }},
            fillColor : "#CC00FF",
            strokeColor : "#CC0099",
            pointColor : "#bb574e"
        }]
        };
        new Chart(ctx).Bar(chart, { bezierCurve: false });
        })();
    </script>
@stop