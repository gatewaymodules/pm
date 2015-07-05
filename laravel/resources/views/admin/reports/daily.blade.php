@extends('app')

@section('content')
    <h3>Dashboard</h3>

    @if ( $highPriorityTasks->count() )
        Overdue high priority tasks:
        <div class="table-responsive">
        <table class="table table-hover table-condensed" id="table-clickable" >
        <thead>
            <th>Task</th><th>Assigned To</th><th>Due</th>
        </thead>
        @foreach( $highPriorityTasks as $task )
            <tr>
                <td>
                    <a href="{{ $task->url }}"><font color="red">
                    {{ $task->name }}</font>
                    </a>
                </td>
                <td>
                    @foreach( $task->users as $user )
                        {{ $user->name }},
                    @endforeach
                </td>
                <td>{{ $task->due_at() }}</td>
            </tr>
        @endforeach
    </table>
            </div>
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

    <label for = "tasks-completed-report">Tasks Completed<br />
        <canvas id="tasks-completed-report" width="342" height="300"></canvas>
    </label>

    <label for = "daily-reports">Tasks Created<br />
        <canvas id="daily-reports" width="342" height="300"></canvas>
    </label>

    <label for = "daily-reports">Tasks Updated<br />
        <canvas id="tasks-updated-report" width="342" height="300"></canvas>
    </label>

    <h3>Amount of Tasks Created</h3>
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
                    fillColor : "#f8b1aa",
                    strokeColor : "#bb574e",
                    pointColor : "#bb574e"
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
            fillColor : "#f8b1aa",
            strokeColor : "#bb574e",
            pointColor : "#bb574e"
        }]
        };
        new Chart(ctx).Bar(chart, { bezierCurve: false });
        })();
    </script>
@stop