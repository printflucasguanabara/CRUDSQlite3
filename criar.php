<?php

try {
  $database = new SQLite3('database.db');
} catch (Exception $e) {
  die('Erro de conexão: ' . $e->getMessage());
}

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $resultado = $database->query("SELECT COUNT(*) FROM produtos WHERE id = $id");
  $linha = $resultado->fetchArray(SQLITE3_ASSOC);

  if ($linha['COUNT(*)'] > 0) {
    echo "Este produto já está cadastrado.";
  } else {
    try {
      $id = $_POST['id'];
      $nome = $_POST['nome'];
      $descricao = $_POST['descricao'];
      $preco = $_POST['preco'];
      $database->exec("INSERT INTO produtos (id, nome, descricao, preco) VALUES ('$id', '$nome', '$descricao', '$preco')");

      echo "Produto cadastrado com sucesso." . "<br>";
      header('Location: listar.php');
    } catch (Exception $e) {
      echo "Ocorreu o seguinte problema: " . $e->getMessage();
    }
  }
}
$database->close();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Cadastro de Produtos</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <header>
    <h1>Cadastro de Novo Produto</h1>
  </header>
  <main>
    <br>
    <form action="criar.php" method="post">
      <div class="row">
        <div class="col-md-6">
          <label for="id"></label>
          <input type="text" id="id" name="id" placeholder="ID do Produto" required>
        </div>
        <div class="col-md-6">
          <label for="nome"></label>
          <input type="text" id="nome" name="nome" placeholder="Nome" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label for="descricao"></label>
          <input type="text" id="descricao" name="descricao" placeholder="Descrição" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="preco"></label>
          <input type="number" min="0" id="preco" name="preco" placeholder="Preço" required pattern="^\d+(\.\d{1,2})?$">
        </div>
      </div>
      <br>
      <input type="submit" value="Criar Produto">
    </form>
  </main>
  <br>
  <a href="listar.php">Ver Todos os Produtos Cadastrados</a> <br>
</body>

</html>