<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Países</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body class="bg-dark text-light">
    <header>
        <form action="">
            <input  name="q" type="text" id="q" placeholder="Pesquisar país">
            <input type="submit" class="btn" name='pesquisar' value="Pesquisar">
            <input type="submit" class="btn" name='reset' value="Cancelar">
        </form>
    </header>
    <div>
        <h1>Lista de Países</h1>
        <?php
            class Exibir
            {
                private $db;
            
                public function __construct()
                {
                    $this->db = include('conexao.php');
                }
            
                public function listarPaises($filtro = '')
                {
                    try {
                        $sql = 'SELECT * FROM paises';
                        if (!empty($filtro)) {
                            $filtro = $this->db->quote("%$filtro%");
                            $sql .= " WHERE Nome LIKE $filtro";
                        }
                        $sql .= ' ORDER BY Nome ASC';
            
                        $consulta = $this->db->query($sql);
                        $paises = $consulta->fetchAll();
            
                        return $paises;
                    } catch (\Throwable $th) {
                        echo $th;
                    }
            
                    return [];
                }
            
                public function exibirPaises($paises)
                {
                    foreach ($paises as $pais) {
                        echo "<div class='m-4 d-flex flex-column align-items-start'>";
                            echo "<img class='w-25' src='" . $pais["UrlImagem"] . "' >";
                            echo "<a class='btn' href='show.php?" . http_build_query($pais) . "'>" . $pais["Nome"] . "</a>";
                        echo "</div>";
                    }
                }
            }
            
            $exibir = new Exibir();
            
            if (!isset($_GET['q']) || isset($_GET['reset'])) {
                $paises = $exibir->listarPaises();
            } else {
                $pesquisa = trim($_GET['q']);
                if ($pesquisa === '') {
                    echo "Digite algo na barra de pesquisa";
                    $paises = [];
                } else {
                    $paises = $exibir->listarPaises($pesquisa);
                    if (count($paises) === 0) {
                        echo "<p>Nenhum resultado encontrado</p>";
                    }
                }
            }
            
            $exibir->exibirPaises($paises);
        ?>
    </div>
</body>
</html>