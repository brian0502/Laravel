<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laravel Test</title>
        @include('vendor.css')
        @include('vendor.javascript')
    </head>
    <body>
        {{PubLib::test()}}
        @foreach (Alert::get() as $alert)
            <script>
                alert('{{ $alert->message }}');
            </script>
        @endforeach
        <!-- wrapper start -->
        <div id="wrapper" class="wrapper">
            @include('public.header')
            <main>
                <div class="container">
                    <section>
                        <h1 style="text-align:center;">{{ !empty($title)? $title:'Default Title' }}</h1>
                        <div id="github-icons"></div>
                        @yield('content')
                    </section>
                </div>
            </main>
        </div>
        <!-- /wrapper -->
        @include('public.sidebar')
    </body>
</html>
@include('public.js')
@yield('script')