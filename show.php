<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title><?php echo $_GET['Nome'] ?></title>
</head>
<body class="bg-dark text-light">
    <?php
        function filterInput($input) {
            return htmlspecialchars(strip_tags(trim($input)));
        }

        $urlImagem = filterInput($_GET['UrlImagem']);
        $nome = filterInput($_GET['Nome']);
        $capital = filterInput($_GET['Capital']);
        $lingua = filterInput($_GET['Lingua']);
        $moeda = filterInput($_GET['Moeda']);
        $populacao = filterInput($_GET['Populacao']);
        $continente = filterInput($_GET['Continente']);
        $idh = filterInput($_GET['Idh']);

        echo "<div class='m-4 d-flex flex-column align-items-start'>";
            echo "<img class='w-25' src='{$urlImagem}' >";
            echo "<p>{$nome}</p>";
            echo "<p>{$capital}</p>";
            echo "<p>{$lingua}</p>";
            echo "<p>{$moeda}</p>";
            echo "<p>{$populacao}</p>";
            echo "<p>{$continente}</p>";
            echo "<p>{$idh}</p>";
        echo "</div>";
    ?>
    <a class="btn" href="index.php">Retornar</a>
</body>
</html>