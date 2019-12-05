<!doctype html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>

<div class="wrapper">

    @include('includes.sidebar')

    <div class="main">

        @include('includes.header')

        <main class="content">

            @yield('content')

        </main>

        @include('includes.footer')

    </div>

</div>

@include('includes.foot')

</body>
</html>
