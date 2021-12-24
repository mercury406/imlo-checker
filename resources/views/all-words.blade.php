<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Слово</title>
    <link rel="stylesheet" href="css/bootstrap5.min.css">
</head>
<body>
<div class="container">
    <div class="row mt-5">
        {{$words->links("pagination::bootstrap-4")}}
    </div>
    <hr>
    <div class="row mt-5">
        <div class="col-12">
            <ul class="list-group" id="wordList">
                @foreach($words as $w)
                    <li class="list-group-item">{{$w->value}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script src="js/jquery.min.js"></script>
</body>
</html>
