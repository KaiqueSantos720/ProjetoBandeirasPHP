<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="css/index.css" rel="stylesheet">
    <title><?php echo $_GET['Nome'] ?></title>
</head>
<body class="bg-dark text-light">
    <header class="bg-dark shadow">
            <div class="container d-flex justify-content-between align-items-center py-2">
                <a href="index.php" class="me-3">
                    <img src="https://via.placeholder.com/75x75?text=Logo" alt="Logo" class="logo">
                </a>
                <form action="index.php" class="form-inline my-2 my-lg-0">
                    <div class="input-group mx-auto">
                        <input name="q" type="text" id="q" placeholder="Pesquisar país" class="form-control mx-2">
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                        <button type="reset" class="btn btn-secondary bg-danger mx-2">Cancelar</button>
                    </div>
                </form>
            </div>
        </header>
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

    <div onclick="topFunction()" id="myBtn" class="container bg-danger" title="Go to top">
        <i class="bi bi-arrow-up-circle-fill"></i>
    </div> 

    <footer class="shadow-top text-light text-center bg-dark py-2">
        <div class="content container d-flex justify-content-between align-items-center">
            <div class="py-2 me-3">
                &copy;2023 Bandeiras - Todos os direitos reservados
            </div>
            <div>
                <a href="index.php" class="me-3">
                    <img src="https://via.placeholder.com/75x75?text=Logo" class="img-fluid logo" alt="Logo">
                </a>
            </div>
        </div>
    </footer>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>