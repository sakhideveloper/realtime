<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MojoQuizzy | By MojoSolo</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">

    <style type="text/css">
      body {
        padding-top: 56px;
        background-color: #284FA6;
        color:white;
        font-family: 'Nunito', sans-serif;
      }

      section {
        padding-top: 5rem;
        padding-bottom: 5rem;
      }
    </style>
  </head>
  <body>
    <!-- navbar-->
  
    <!-- Hero Section-->
    <section>
      <div class="container"> 
        <div class="row">

          <div class="col-lg-6 order-2 order-lg-1 text-center" style="padding-top:6%;">
            <div class="pull-right">
              <h1 style="font-size: 84px!important;">Join at</h1>
              <h2 style="font-size: 64px!important;" class="lead">MojoQuizzy.com</h2>
              <p style="font-size: 24px!important;">#{{$hashId}}</p>
            </div>
          </div>

          <div class="col-lg-6 order-1 order-lg-2">
            <div class="visible-print text-center">
                {!! QrCode::size(200)->size(300)->gradient(255, 0, 0,21,55,87,'vertical')->generate(route('quiz.take',$hashId)); !!}
                {{-- <p>Scan me to return to the original page.</p> --}}
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- Services-->

  </body>
</html>