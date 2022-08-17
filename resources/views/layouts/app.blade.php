<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

       

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>
  

        <style>
            body {
                font-family: 'Nunito', sans-serif;
                overflow: hidden;
                min-width: 1000px;
            }
            /* width */
            ::-webkit-scrollbar {
                width: 10px;
                height: 5px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
            background: #f1f1f1; 
            }
            
            /* Handle */
            ::-webkit-scrollbar-thumb {
            background: #888; 
            }
           
            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
            background: #555; 
            }
            @media screen and (max-width: 700px)
            {
                body {
                font-family: 'Nunito', sans-serif;
                resize: none;
                }
            }
        </style>
    </head>
    <body class="antialiased">
       
        <div id="root">
            @yield('content')
        </div>
    
    </body>
</html>
