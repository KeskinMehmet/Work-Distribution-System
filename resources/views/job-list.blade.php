<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <title>Work Distribution System</title>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="row text-center alert-secondary">
    <div class="col-sm-12">
        Estimated Total Time to Finish the Project
    </div>
    <div class="col-sm-12">
        <span>{{$general_data['project_estimation']}}</span>
    </div>
</div>
<hr>
<div class="container-full px-2">
    <div class="row px-3" style="display: flex;flex-wrap: nowrap;overflow: scroll;">
        @foreach($general_data['developers'] as $key => $dev)
            <div class="col-3 p-0 border border-primary mr-2">
                <div class="">
                    <ul class="list-group">
                        <li class="list-group-item active">Developer {{$key + 1}}</li>
                        <li class="list-group-item"> Average Number of Jobs per Week : {{$dev['averageOfWeekJob']}}</li>
                        <li class="list-group-item">Total Jobs : {{$dev['jobsCount']}} </li>
                        <li class="list-group-item">Total Hours : {{$dev['total_time']}} </li>
                        <li class="list-group-item">Total Week : {{$dev['week_total_jobs_count']}} </li>
                    </ul>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th style="font-size:12px" scope="col">Job ID</th>
                        <th style="font-size:12px" scope="col">Job</th>
                        <th style="font-size:12px" scope="col">Level</th>
                        <th style="font-size:12px" scope="col">Estimated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dev['jobs'] as $jobs)
                        <tr>
                            <td style="font-size:12px"> {{$jobs['id']}}</td>
                            <td style="font-size:12px">{{$jobs['job']}}</td>
                            <td style="font-size:12px">{{$jobs['level']}}</td>
                            <td style="font-size:12px">{{$jobs['estimated_duration']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>


</body>
</html>
