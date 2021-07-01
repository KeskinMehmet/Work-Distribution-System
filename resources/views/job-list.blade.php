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
        Projenin Biteceği Toplam Süre
    </div>
    <div class="col-sm-12">
        <span>{{$general_data['totalProjectTime']}}</span>
    </div>
</div>
<hr>
<div class="row text-center alert-warning">
    <div class="col-sm">
        Ortalama Haftada Bitireceği İş Sayısı
    </div>
    @foreach($general_data['averageWeek'] as $key => $data)
        <div class="col-sm">
            <span>{{$data}} İş</span>
        </div>
    @endforeach
</div>
<hr>
<div class="row text-center alert-success">
    <div class="col-sm">
        Çalışacağı İş Adedi
    </div>
    @foreach($general_data['totalJob'] as $key => $data)
        <div class="col-sm">
            <span>{{$data}} Adet</span>
        </div>
    @endforeach
</div>
<hr>
<div class="row text-center alert-primary">
    <div class="col-sm">
        Çalışacağı Saat Sayısı
    </div>
    @foreach($general_data['time'] as $key => $data)
        <div class="col-sm">
            <span>{{$data}} Saat</span>
        </div>
    @endforeach
</div>
<hr>
<div class="row text-center alert-info">
    <div class="col-sm">
        Çalışacağı Hafta Sayısı
    </div>
    @foreach($general_data['week'] as $key => $data)
        <div class="col-sm">
            <span>{{$data}} Hafta Ortalama</span>
        </div>
    @endforeach
</div>
<hr>
<div class="row" style="font-size: 10px;">
    <!-- Start İş Listesi -->
    <div class="col-md-2">
        <div class="col-xs-12" align="center">
            <h5>GENEL İŞ LİSTESİ</h5>
        </div>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">İş</th>
                <th scope="col">Zorluk Seviyesi</th>
                <th scope="col">Tamamlanması Gereken Süre</th>
            </tr>
            </thead>
            <tbody>
            @foreach($jobList as $key => $job)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <th>{{$job['id']}}</th>
                    <td>{{$job['zorluk']}}</td>
                    <td>{{$job['sure']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- End İş Listesi -->

    <!-- Start Dev. 1 -->
    <div class="col-md-2">
        <div class="col-xs-12" align="center">
            <h5>Dev. 1 İş Listesi</h5>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">İş</th>
                <th scope="col">Seviye</th>
                <th scope="col">Tamamlanan Süre</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dev1 as $key => $job)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <th>{{$job['id']}}</th>
                    <td>{{$job['zorluk']}}</td>
                    <td>{{$job['sure']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- End Dev. 1 -->

    <!-- Start Dev. 2 -->
    <div class="col-md-2">
        <div class="col-xs-12" align="center">
            <h5>Dev. 2 İş Listesi</h5>
        </div>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">İş</th>
                <th scope="col">Seviye</th>
                <th scope="col">Tamamlanan Süre</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dev2 as $key => $job)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <th>{{$job['id']}}</th>
                    <td>{{$job['zorluk']}}</td>
                    <td>{{$job['sure']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- End Dev. 2 -->

    <!-- Start Dev. 3 -->
    <div class="col-md-2">
        <div class="col-xs-12" align="center">
            <h5>Dev. 3 İş Listesi</h5>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">İş</th>
                <th scope="col">Seviye</th>
                <th scope="col">Tamamlanan Süre</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dev3 as $key => $job)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <th>{{$job['id']}}</th>
                    <td>{{$job['zorluk']}}</td>
                    <td>{{$job['sure']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- End Dev. 3 -->

    <!-- Start Dev. 4 -->
    <div class="col-md-2">
        <div class="col-xs-12" align="center">
            <h5>Dev. 4 İş Listesi</h5>
        </div>
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">İş</th>
                <th scope="col">Seviye</th>
                <th scope="col">Tamamlanan Süre</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dev4 as $key => $job)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <th>{{$job['id']}}</th>
                    <td>{{$job['zorluk']}}</td>
                    <td>{{$job['sure']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- End Dev. 4 -->

    <!-- Start Dev. 5 -->
    <div class="col-md-2">
        <div class="col-xs-12" align="center">
            <h5>Dev. 5 İş Listesi</h5>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">İş</th>
                <th scope="col">Seviye</th>
                <th scope="col">Tamamlanan Süre</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dev5 as $key => $job)
                <tr>
                    <th scope="row">{{$key}}</th>
                    <th>{{$job['id']}}</th>
                    <td>{{$job['zorluk']}}</td>
                    <td>{{$job['sure']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- End Dev. 5 -->
</div>

</body>
</html>
