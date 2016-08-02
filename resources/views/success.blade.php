<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="_token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700' rel='stylesheet' type='text/css'>
  <title>Boka banan | Högelids Tennisklubb</title>

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/timedropper.css" type="text/css">
  <link rel="stylesheet" href="css/datedropper.css" type="text/css">

  <script src="https://use.fontawesome.com/5cafce8111.js"></script>
</head>
<body>
  <div class="bildbox">
    <img src="img/htk-logo.svg" alt="" class="logotype">
  </div>

  <p class="intro-text">Välkommen till Högelids Tennisklubb! Här kan du som är medlem boka speltid på vår grusbana och se andra medlemmars bokade tider.</p>

  <div class="bokade-tider">
    <h4>Bra jobbat!</h4>
    <h1><i class="fa fa-thumbs-up"></i></h1>
    Bokad av: {{ $createdReservation->name }}
    <br>
    Bokad från: {{ $createdReservation->start->format('Y-m-d H:i') }}
    <br>
    Bokad till: {{ $createdReservation->stop->format('Y-m-d H:i') }}
    <br>
    Bokades: {{ $createdReservation->created_at->diffForHumans() }}
    <br>
  </div>
</body>
</html>