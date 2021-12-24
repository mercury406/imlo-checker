<!doctype html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Translate</title>
    <link rel="stylesheet" href="css/bootstrap5.min.css">
</head>
<body>
<div class="container mt-3">
    @if(session('success'))<div class="row my-2 alert alert-success">{{session('success')}}</div>@endif
    <div class="row">
        <div class="col-12">
            <form action="{{route('enter')}}" method="post">
                @csrf
                <label for="first">Добавление слов</label>
                <textarea spellcheck="false" class="w-100 my-3 p-1" rows="15" name="addText"></textarea>
                <button class="btn btn-info m-2" id="checkBtn">Добавить</button>
            </form>
        </div>
    </div>
</div>
<script src="js/bootstrap5.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>
</body>
</html>
