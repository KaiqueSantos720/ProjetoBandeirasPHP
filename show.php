<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="css/index.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Dados do País</title>
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
                    <a href="index.php" class="btn btn-secondary bg-danger mx-2">Voltar</a>
                </div>
            </form>
        </div>
    </header>

    <!-- Como o código não foi testado com uma API real pode haver pequenos erros -->
    <?php
        class Country {
            protected $data;
            
            public function __construct(array $data = []) {
                $this->data = $data;
            }
        
            public function __get($property) {
                return $this->data[$property] ?? null;
            }
        }
        
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die("O ID do país não foi fornecido corretamente.");
        }
        
        $countryId = intval($_GET['id']);
        
        $url = 'api' . $countryId; # substituir pelo link real da API para exibir dados do país

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            die("Erro ao buscar informações. Tente novamente mais tarde.");
        }

        $countryData = json_decode($response);

        if (!$countryData) {
            die("País não encontrado.");
        }
        
        $country = new Country((array) $countryData);
    ?>

    <div class="container mt-5 mb-5">
        <div class="card bg-dark text-light d-flex justify-content-center align-items-center border-0">
            <div class="row no-gutters d-flex flex-column align-items-center p-3 border border-white rounded-3">
                <div class="col-md-4 d-flex align-items-center p-2 gap-3 flex-column">
                    <img src="<?php echo $country->UrlImagem; ?>" class="card-img" alt="<?php echo $country->Nome; ?>">
                    <h5 class="card-title"><?php echo $country->Nome; ?></h5>
                </div>
                <div class="col-md-8 d-flex">
                    <div class="card-body">
                        <p class="card-text"><strong>Capital:</strong> <?php echo $country->Capital; ?></p>
                        <p class="card-text"><strong>Lingua:</strong> <?php echo $country->Lingua; ?></p>
                        <p class="card-text"><strong>Moeda:</strong> <?php echo $country->Moeda; ?></p>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><strong>População:</strong> <?php echo $country->Populacao; ?></p>
                        <p class="card-text"><strong>Continente:</strong> <?php echo $country->Continente; ?></p>
                        <p class="card-text"><strong>IDH:</strong> <?php echo $country->Idh; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div onclick="topFunction()" id="myBtn" class="container text-center" title="Go to top" style="cursor: pointer;">
        <i class="fas fa-arrow-up"></i>
    </div>

    <footer class="shadow-top text-light text-center bg-dark ">
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
