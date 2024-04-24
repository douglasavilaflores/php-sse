<?php

use Source\Models\Message;

require dirname(__DIR__, 2) . "/vendor/autoload.php";

$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
if ($message) {
    $new_message = (new Message);
    $new_message->message = $message ?? null;
    $new_message->save();
    if ($new_message->fail()) {
        dump($new_message->fail()->getMessage());
    } else {
        Header("Location: .");
    }
}

?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP | SSE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form action="" class="mt-5" method="post">
            <div class="mb-3">
                <label for="message" class="form-label">Mensagem</label>
                <input type="text" class="form-control" name="message" aria-describedby="messageHelp" required>
                <div id="messageHelp" class="form-text">Mensagem com no máximo 299 caracteres</div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>