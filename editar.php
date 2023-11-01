<?php
try {
  $db = new SQLite3('database.db');
} catch (Exception $e) {
  die('Falha na conexão: ' . $e->getMessage());
}

if(isset($_POST['id'])){
  $id=$_POST['id'];
  $select = $db->query("SELECT COUNT(*) FROM produtos WHERE id = '$id';");
  $row = $select->fetchArray(SQLITE3_ASSOC);

  if ($row['COUNT(*)'] > 0) {
    try{
      $id = $_POST['id'];
      $nome = $_POST['nome'];
      $descricao = $_POST['descricao'];
      $preco = $_POST['preco'];

      $resultado = $db->query("UPDATE produtos SET nome = '$nome', descricao = '$descricao', preco = '$preco' WHERE id = '$id';" );

      $db->exec($resultado);
      echo "Produto atualizado com sucesso"."<br>";
    } catch(Exception $e){
      echo "Ocorreu o seguinte erro ao atualizar o produto '$nome': " . $e->getMessage();
    }
  } 
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Gerenciamento de Produtos</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <header>
    <h1>Editar Produto</h1>
  </header>

  <main>
    <br>
    <form action="editar.php" method="post">
      <input type="text" id="id" name="id" placeholder="ID do Produto" required><br>
      <input type="text" id="nome" name="nome" placeholder="Nome" required><br>
      <input type="text" id="descricao" name="descricao" placeholder="Descrição" required><br>
      <input type="number" min="0.01" step="0.01" id="preco" name="preco" placeholder="Preço" required><br>
      <input type="submit" value="Editar Produto">
    </form>
  </main>
  <br>
  <div class="link-container">
    <a href="listar.php">Ver Todos os Produtos Cadastrados</a> 
    <a href="index.html">Voltar para a Página Inicial</a>
  </div>
</body>

</html>