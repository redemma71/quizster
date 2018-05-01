<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quizster Jobs</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" 
        crossorigin="anonymous">
    <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{mix('css/scrivener.css')}}" rel="stylesheet" type="text/css">
    <link href="{{mix('css/hamburger.css')}}" rel="stylesheet" type="text/css">

</head>
<body>
    <div id="outer-container">
        <div id="header"></div>
        <main id="page-wrap">
            <div class="container">
                <div class="row">
                    <div id="jobs"></div>
                </div>
            </div>
        </main>
    </div>
    <script src={{mix('js/jobs.js')}}></script>
</body>
</html>