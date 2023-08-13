<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Países</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="css/index.css" rel="stylesheet">
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
                    <a href="index.php" class="btn btn-secondary bg-danger mx-2">Cancelar</a>
                </div>
            </form>
        </div>
    </header>
    <div class="container py-5">
        <h1 id="text-principal">Lista de Países</h1>
        <div class="row col-12 justify-content-start">
            <?php
                class Database {
                    private $pdo;
                
                    public function __construct() {
                        $this->pdo = include('conexao.php');
                    }
                
                    public function query($sql, $params = []) {
                        $stmt = $this->pdo->prepare($sql);
                        $stmt->execute($params);
                        return $stmt->fetchAll();
                    }
                }
                
                abstract class Entity {
                    protected $data;
                
                    public function __construct(array $data = []) {
                        $this->data = $data;
                    }
                
                    public function __get($property) {
                        return $this->data[$property] ?? null;
                    }
                }
                
                //No projeto não há uma aplicação concreta de herança, usamos nessa classe apenas para atender os requisitos pedidos pelo professor na tarefa.
                class Country extends Entity {
                    public function imageUrl() {
                        return $this->UrlImagem;
                    }
                
                    public function name() {
                        return $this->Nome;
                    }

                    public function getData() {
                        return $this->data;
                    }
                }
                
                class CountryRepository {
                    private $db;
                
                    public function __construct(Database $db) {
                        $this->db = $db;
                    }
                
                    public function findAll($filter = '') {
                        $sql = 'SELECT * FROM paises';
                        $params = [];
                
                        if ($filter) {
                            $sql .= ' WHERE Nome LIKE ?';
                            $params[] = "%$filter%";
                        }
                
                        $sql .= ' ORDER BY Nome ASC';
                        $rows = $this->db->query($sql, $params);
                
                        return array_map(function($row) {
                            return new Country($row);
                        }, $rows);
                    }
                }
                
                class CountryDisplay {
                    public function render(array $countries) {
                        foreach ($countries as $country) {
                            echo "<div class='col-md-3 mb-4'>";
                            echo "<div class='card cards text-center'>";
                            echo "<img class='card-img-top' src='" . $country->imageUrl() . "' alt='Card image'>";
                            echo "<div class='card-body text-light'>";
                            echo "<h5 class='card-title'>" . $country->name() . "</h5>";
                            echo "<a href='show.php?" . http_build_query($country->getData()) . "' class='btn btn-primary'>Ver mais</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                }
                
                $db = new Database();
                $countryRepo = new CountryRepository($db);
                $display = new CountryDisplay();
                
                if (!isset($_GET['q'])) {
                    $countries = $countryRepo->findAll();
                } else {
                    $search = trim($_GET['q']);
                    if (empty($search)) {
                        echo "<p>Por favor, insira algo na barra de pesquisa.</p>";
                        $countries = [];
                    } else {
                        $countries = $countryRepo->findAll($search);
                        if (count($countries) === 0) {
                            echo "<p>Nenhum resultado encontrado</p>";
                        }
                    }
                }
                
                $display->render($countries);
            ?>
        </div>
    </div>
    
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