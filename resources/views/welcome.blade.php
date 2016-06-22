<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>I-Card</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
