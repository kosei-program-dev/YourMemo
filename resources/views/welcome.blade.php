{{-- <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Example</title>
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

    <div id="app">
        <div id="nav">
          <router-link to="/">Home</router-link>
          <router-link to="/about">About</router-link>
        </div>

        <router-view/>
        </div>
    </div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="api-token" content="{{ session()->get('api_token') ?? '' }}">
        <title>Laravel</title>
    </head>
    <body>
      <div id="app">
        <app/>
      </div>
      <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
