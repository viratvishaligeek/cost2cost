 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>{{ $pageName ?? '' }} | {{ 'site_name' }}</title>
     <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('backend') }}/img/favicons/apple-touch-icon.png">
     <link rel="icon" type="image/png" sizes="32x32"
         href="{{ URL::asset('backend') }}/img/favicons/favicon-32x32.png">
     <link rel="icon" type="image/png" sizes="16x16"
         href="{{ URL::asset('backend') }}/img/favicons/favicon-16x16.png">
     <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('backend') }}/img/favicons/favicon.ico">
     <link rel="manifest" href="{{ URL::asset('backend') }}/img/favicons/manifest.json">
     <meta name="msapplication-TileImage" content="{{ URL::asset('backend') }}/img/favicons/mstile-150x150.png">
     <meta name="theme-color" content="#ffffff">
     <script src="{{ URL::asset('backend') }}/simplebar/simplebar.min.js"></script>
     <script src="{{ URL::asset('backend') }}/js/config.js"></script>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
     <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
         rel="stylesheet">
     <link href="{{ URL::asset('backend') }}/simplebar/simplebar.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://unGlobalSettingicons.iconscout.com/release/v4.0.8/css/line.css">
     <link href="{{ URL::asset('backend') }}/css/theme.min.css" type="text/css" rel="stylesheet" id="style-default">
     <link href="{{ URL::asset('backend') }}/css/user.min.css" type="text/css" rel="stylesheet"
         id="user-style-default">
     <link href="{{ URL::asset('backend') }}/leaflet/leaflet.css" rel="stylesheet">
     <link href="{{ URL::asset('backend') }}/leaflet.markercluster/MarkerCluster.css" rel="stylesheet">
     <link href="{{ URL::asset('backend') }}/leaflet.markercluster/MarkerCluster.Default.css" rel="stylesheet">
 </head>
