<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>I-Card</title>

    {{ Html::style('assets/bootstrap/bootstrap.min.css') }}
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    {{ Html::style('assets/datepicker/css/datepicker.css') }}
    <style type="text/css">
        .img-circle {
            border-radius: 50%;
            width: 100px;
            height: 100px; 
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Kartu-Imunisasi</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
                @include('Pages.nav')
            </div>
        </div>
    </nav>

    @yield('content')

    
<script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDFSdY_4-2pUQcmlooi3VhJbj9-G7kwXsM",
    authDomain: "kartu-imunisasi-f624d.firebaseapp.com",
    databaseURL: "https://kartu-imunisasi-f624d.firebaseio.com",
    storageBucket: "kartu-imunisasi-f624d.appspot.com",
  };
  firebase.initializeApp(config);
</script>
    
    <!-- Scripts -->
    {{ Html::script('assets/jquery/jquery.min.js') }}
    {{ Html::script('assets/bootsrap/bootstrap.min.js') }}
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrwoVeaGTxS78GCVIdc8g98u0PpfeyjNs&libraries=places"></script> -->
    
    {{ Html::script('assets/datepicker/js/bootstrap-datepicker.js') }}
    <script type="text/javascript">
        $('.dp1').datepicker();
    </script>
</body>
</html>
