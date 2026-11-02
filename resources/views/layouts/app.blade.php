<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>

    <h1>Laravel Student Management</h1>

    @if(session('status'))
        <p style="color: green;">
            {{ session('status') }}
        </p>
    @endif

    <hr>

    @yield('content')

</body>
</html>
