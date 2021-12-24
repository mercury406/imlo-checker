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
        <div class="col-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Введите слово для проверки" id="input-word">
                <button class="btn btn-success" id="checkBtn">Проверить</button>
            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-5">
        <div class="col-12">
            <ul class="list-group" id="wordList">
                {{--                    <li class="list-group-item"></li>--}}
            </ul>
        </div>
    </div>
</div>

<script src="js/jquery.min.js"></script>
<script>
    const wordList = $("#wordList");
    var words = [];
    $("#checkBtn").click(() => {
        wordList.html("");
        let input = $("#input-word").val();
        $.post("{{route('word-list')}}", {
            "_token": "{{csrf_token()}}",
            "word": input
        })
        .done((data) => {
            wordList.append(`Найдено слов: ${data.words.length}`);
            words = data.words;
            words.forEach(word => {wordList.append(`<li class="list-group-item">${word.value} <span class="btn btn-danger " onclick="delbtn('${word.value}')">delete</span></li>`)});
        });
    });

    function delbtn(word) {
        $.post("{{route('del_word')}}", {
            "_token": "{{csrf_token()}}",
            "del_word": word,
            "_method": "delete"
        })
        .done(
            (data) => {
                console.log(data);
                words = words.filter(function (value, index, arr) {return value !== word});
                wordList.html("");
                words.forEach(word => {wordList.append(`<li class="list-group-item">${word.value} <span class="btn btn-danger " onclick="delbtn('${word.value}')">delete</span></li>`);});
            }
        )
    }
</script>
</body>
</html>
