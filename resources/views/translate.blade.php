<!doctype html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Translate</title>
    <link rel="stylesheet" href="css/bootstrap5.min.css">
    <style>
        .editable_div {
            min-height: 300px;
            border: 2px solid black;
            border-radius: 5px
        }

        .editable_div:focus {
            min-height: 300px;
            border: 2px solid blue;
            border-radius: 5px
        }

        .custom-danger-alert{
            border-radius: 5px;
            padding: 1px;
            border: 1px solid #ff6a51;
            background: #ff8375;
            margin-right: 4px;
        }
        #tekst{
            line-height: 150%;
        }
    </style>
</head>
<body>

<div class="container mt-3">
    <div class="row">
        <div>Bazada
            <strong>
                {{\App\Models\Words::count()}}
            </strong> so'z
        </div>
        <div class="col-12">
            <p>Aniqlash uchun tekstni kiriting</p>
{{--            <div contenteditable="true" spellcheck="false" id="first" class="w-100 p-1 editable_div"></div>--}}
            <textarea id="first" cols="30" rows="10" class="form-control" name="text" spellcheck="false"></textarea>
            <button class="btn btn-info m-2" id="checkBtn">Aniqlash</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mt-2">
            Tekshirilgan tekst
            <div id="tekst" class="p-3"></div>
        </div>
    </div>
</div>

<script src="js/bootstrap5.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>
<script>
    const checkBtn = $("#checkBtn");
    const finalText = $("#tekst");
    checkBtn.click((event) => {
        event.preventDefault()
        const text = $("#first").val()
        checkBtn.attr("disabled", true)
        $.post(
            "{{route('checking')}}",
            {
                "_token": "{{csrf_token()}}",
                "text": text
            },
            (data) => {
                finalText.html("")
                finalText.html(data.text);
            }
        )
        checkBtn.attr("disabled", false)
    })
</script>
</body>
</html>
