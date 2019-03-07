<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Interview Project</title>
        <base href="/" target="_self">


        <!-- Styles -->
        <link href="{{asset('css/app.css')}}" media="all" rel="stylesheet" type="text/css" />
    </head>
    <body>
      <div id="app">
        <div class="display-4 text-center mt-4">
          Loading...
        </div>
      </div>
     <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    </body>
</html>
