@extends('app')

{{-- Do not reformat in PhpStorm otherwise labels in Ajax code at bottom breaks --}}

@section('content')
    <h3>Dashboard</h3>

    @if ( $overdueHighPriorityTasks->count() )
        <a name="most-recent-projects"></a>
        <h4>Most recently worked on projects</h4>

        @foreach( $mostRecentProjects as $project )
            <a href="{{ 'project/' . $project->slug }}">
                {{ $project->name }}
            </a> |
        @endforeach

    @endif

    <h4>Other Reports</h4>

    {{-- Only display hyperlinks if there are items --}}

    <a href="#tasks-completed-graph">Tasks Completed</a> |
    <a href="#tasks-updated-graph">Tasks Updated</a> |
    <a href="#tasks-created-graph">Tasks Created</a> |

    @if ($overdueHighPriorityTasks->count())
        <a href="#overdue-high-priority-tasks">Overdue High Priority Tasks ({{ $overdueHighPriorityTasks->count() }}
            )</a> |
    @endif

    @if ($overdueTasks->count())
        <a href="#overdue-tasks">Overdue Tasks ({{ $overdueTasks->count() }})</a> |
    @endif

    @if ( $user->hasRole('admin'))
        @if ($overdueHighPriorityTasksOther->count())
            <a href="#overdue-high-priority-tasks-other">Overdue High Priority Tasks Other
                ({{ $overdueHighPriorityTasksOther->count() }})</a> |
        @endif
        @if ($overdueTasksOther->count())
            <a href="#overdue-tasks-other">Overdue Tasks Other ({{ $overdueTasksOther->count() }})</a> |
        @endif
    @endif

    @if ($oldestTasks->count())
        <a href="#oldest-tasks">Oldest Tasks ({{ $oldestTasks->count() }})</a> |
    @endif

    <a href="#number-tasks-created-list">Number of Tasks Created</a>

    <hr>

    <a name="tasks-completed-graph"></a>
    <label for="tasks-completed-report">Tasks Completed<br/>
        <canvas id="tasks-completed-report" width="342" height="300"></canvas>
    </label>

    <a name="tasks-updated-graph"></a>
    <label for="daily-reports">Tasks Updated<br/>
        <canvas id="tasks-updated-report" width="342" height="300"></canvas>
    </label>

    <a name="tasks-created-graph"></a>
    <label for="daily-reports">Tasks Created<br/>
        <canvas id="daily-reports" width="342" height="300"></canvas>
    </label>

    <hr>

    @if ( $overdueHighPriorityTasks->count() )
        <a name="overdue-high-priority-tasks"></a>
        <h4>Overdue High Priority Tasks</h4>
        <div class="table-responsive">
            <table class="table table-hover table-condensed" id="table-clickable">
                <thead>
                <th>Task</th>
                <th>Due</th>
                <th>Updated</th>
                <th>Project/Task list</th>
                </thead>
                @foreach( $overdueHighPriorityTasks as $task )
                    <tr>
                        <td>
                            <a href="{{ route('project.tasklist.task.show', [$task->tasklist->project->slug, $task->tasklist->slug, $task->slug]) }}">
                                <font color="red">
                                    {{ $task->name }}</font>
                            </a>
                        </td>
                        <td><font color="red">{{ $task->due_at() }}</font></td>
                        <td>{{ $task->updated_at() }}</td>
                        <td>
                            <a href="{{ 'project/' . $task->tasklist->project->slug }}">
                                {{ $task->tasklist->project->name }}
                            </a>/<a href="{{ 'project/' . $task->tasklist->project->slug . '/tasklist/' . $task->tasklist->slug }}">
                                {{ $task->tasklist->name }}
                            </a>
                        </td>
                        <td>
                        </td>
                    </tr>

                @endforeach
            </table>
        </div>
    @endif

    @if ( $overdueTasks->count() )
        <a name="overdue-tasks"></a>
        <h4>Overdue Tasks</h4>
        <div class="table-responsive">
            <table class="table table-hover table-condensed" id="table-clickable">
                <thead>
                <th>Task</th>
                <th>Due</th>
                <th>Updated</th>
                <th>Project/Task list</th>
                </thead>
                @foreach( $overdueTasks as $task )
                    <tr>
                        <td>
                            <a href="{{ route('project.tasklist.task.show', [$task->tasklist->project->slug, $task->tasklist->slug, $task->slug]) }}">
                                {{ $task->name }}
                            </a>
                        </td>

                        <td>{{ $task->due_at() }}</td>

                        <td>{{ $task->updated_at() }}</td>
                        <td>
                            <a href="{{ 'project/' . $task->tasklist->project->slug }}">
                                {{ $task->tasklist->project->name }}
                            </a>/<a href="{{ 'project/' . $task->tasklist->project->slug . '/tasklist/' . $task->tasklist->slug }}">
                                {{ $task->tasklist->name }}
                            </a>
                        </td>
                        <td>
                        </td>
                    </tr>

                @endforeach
            </table>
        </div>
        <hr>
    @endif

    {{-- Only show tasks assigned to other if admin --}}
    @if ( $user->hasRole('admin'))

        @if ( $overdueHighPriorityTasksOther->count() )
            <a name="overdue-high-priority-tasks-other"></a>
            <h4>Overdue high priority tasks unassigned or assigned to other</h4>
            <div class="table-responsive">
                <table class="table table-hover table-condensed" id="table-clickable">
                    <thead>
                    <th>Task</th>
                    <th>Due</th>
                    <th>Assigned To</th>
                    <th>Project/Task list</th>
                    </thead>
                    @foreach( $overdueHighPriorityTasksOther as $task )
                        <tr>
                            <td>
                                <a href="{{ route('project.tasklist.task.show', [$task->tasklist->project->slug, $task->tasklist->slug, $task->slug]) }}">
                                    <font color="red">{{ $task->name }}</font>
                                </a>
                            </td>
                            <td><font color="red">{{ $task->due_at() }}</font></td>
                            <td>
                                <a href="{{ 'project/' . $task->tasklist->project->slug }}">
                                    {{ $task->tasklist->project->name }}
                                </a>/<a href="{{ 'project/' . $task->tasklist->project->slug . '/tasklist/' . $task->tasklist->slug }}">
                                    {{ $task->tasklist->name }}
                                </a>
                            </td>
                            <td>
                                @foreach( $task->users as $user )
                                    {{ $user->name }},
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ 'project/' . $task->tasklist->project->slug }}">
                                    {{ $task->tasklist->project->name }}
                                </a>/<a href="{{ 'project/' . $task->tasklist->project->slug . '/tasklist/' . $task->tasklist->slug }}">
                                    {{ $task->tasklist->name }}
                                </a>
                            </td>
                        </tr>

                    @endforeach
                </table>
            </div>
            <hr>
        @endif

        @if ( $overdueTasksOther->count() )
            <a name="overdue-tasks-other"></a>
            <h4>Overdue tasks unassigned or assigned to other</h4>
            <div class="table-responsive">
                <table class="table table-hover table-condensed" id="table-clickable">
                    <thead>
                    <th>Task</th>
                    <th>Due</th>
                    <th>Assigned To</th>
                    <th>Project/Task list</th>
                    </thead>
                    @foreach( $overdueTasksOther as $task )
                        <tr>
                            <td>
                                <a href="{{ route('project.tasklist.task.show', [$task->tasklist->project->slug, $task->tasklist->slug, $task->slug]) }}">
                                    {{ $task->name }}
                                </a>
                            </td>
                            <td>{{ $task->due_at() }}</td>
                            <td>
                                <a href="{{ 'project/' . $task->tasklist->project->slug }}">
                                    {{ $task->tasklist->project->name }}
                                </a>/<a href="{{ 'project/' . $task->tasklist->project->slug . '/tasklist/' . $task->tasklist->slug }}">
                                    {{ $task->tasklist->name }}
                                </a>
                            </td>
                            <td>
                                @foreach( $task->users as $user )
                                    {{ $user->name }},
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ 'project/' . $task->tasklist->project->slug }}">
                                    {{ $task->tasklist->project->name }}
                                </a>/<a href="{{ 'project/' . $task->tasklist->project->slug . '/tasklist/' . $task->tasklist->slug }}">
                                    {{ $task->tasklist->name }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <hr>
        @endif

    @endif

    <hr>

    @if ( $oldestTasks->count() )
        <a name="oldest-tasks"></a>
        <h4>Oldest Tasks</h4>
        <div class="table-responsive">
            <table class="table table-hover table-condensed" id="table-clickable">
                <thead>
                <th>Task</th>
                <th>Created</th>
                <th>Assigned To</th>
                <th>Last updated</th>
                <th>Project / List</th>
                </thead>
                @foreach( $oldestTasks as $task )
                    <tr>
                        <td>
                            <a href="{{ route('project.tasklist.task.show', [$task->tasklist->project->slug, $task->tasklist->slug, $task->slug]) }}">
                                @if ($task->priority) <font color="red"> @endif
                                {{ $task->name }}
                                    @if ($task->priority) </font> @endif
                            </a>
                        </td>
                        <td>{{ $task->created_at() }}</td>
                        <td>
                            @foreach( $task->users as $user )
                                {{ $user->name }},
                            @endforeach
                        </td>
                        <td>
                            {{ $task->updated_at() }}
                        </td>
                        <td>
                            <a href="{{ 'project/' . $task->tasklist->project->slug }}">
                                {{ $task->tasklist->project->name }}
                            </a>/<a href="{{ 'project/' . $task->tasklist->project->slug . '/tasklist/' . $task->tasklist->slug }}">
                                {{ $task->tasklist->name }}
                            </a>
                        </td>

                    </tr>
                @endforeach
            </table>
        </div>
        <hr>
    @endif

    <a name="number-tasks-created-list"></a>
    <h3>Number of Tasks Created</h3>
    @foreach ($totals as $index => $dailyAmounts)
        <li><strong>{{ $dates[$index] }}</strong> {{ $dailyAmounts}}</li>
    @endforeach

    <script src="/js/vendor/chart.js"></script>
    <script>
        (function () {
            var ctx = document.getElementById('tasks-completed-report').getContext('2d');
            var chart = {
                labels: {!!json_encode($completedDates)!!},
                datasets
        :
        [{
            data: {{ json_encode($completedTasks) }},
            fillColor: "#00ff00",
            strokeColor: "#006600",
            pointColor: "#000000"
        }]
        }
        ;
        new Chart(ctx).Bar(chart, {bezierCurve: false});
        })
        ();

        (function () {
            var ctx = document.getElementById('tasks-updated-report').getContext('2d');
            var chart = {
                labels: {!!json_encode($updatedDates)!!},
                datasets
        :
        [{
            data: {{ json_encode($updatedTasks) }},
            fillColor: "#3366FF",
            strokeColor: "#000099",
            pointColor: "#000000"
        }]
        }
        ;
        new Chart(ctx).Bar(chart, {bezierCurve: false});
        })
        ();

        (function () {
            var ctx = document.getElementById('daily-reports').getContext('2d');
            var chart = {
                labels: {!!json_encode($dates)!!},
                datasets
        :
        [{
            data: {{ json_encode($totals) }},
            fillColor: "#CC00FF",
            strokeColor: "#CC0099",
            pointColor: "#bb574e"
        }]
        }
        ;
        new Chart(ctx).Bar(chart, {bezierCurve: false});
        })
        ();
    </script>
@stop