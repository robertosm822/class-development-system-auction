<!DOCTYPE html>
<html>
<head>
    <title>{{ $params['title'] ?? 'E-mail' }}</title>
</head>
<body>
    <h1>{{ $params['title'] ?? 'Olá' }}</h1>
    <p>{{ $params['message'] ?? 'Mensagem padrão do e-mail.' }}</p>
    <p>Atenciosamente, <br> Equipe</p>
</body>
</html>
