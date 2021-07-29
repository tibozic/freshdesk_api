<!DOCTYPE html>
<html>
<head>
    <title>Freshdesk API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="menu">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="tickets">Freshdesk Tickets</a></li>
            <li class="nav-item"><a class="nav-link" href="database">Database Tickets</a></li>
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>
<div>
</body>

</html>
