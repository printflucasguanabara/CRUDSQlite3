<?php
try {
  $db = new SQLite3('database.db');
} catch (Exception $e) {
  die('Falaha na conexão: ' . $e->getMessage());
}

if(isset($_POST['id'])){
$id=$_POST['id'];
$select = $db->query("SELECT COUNT(*) FROM produtos WHERE id = '$id';");
$row = $select->fetchArray(SQLITE3_ASSOC);

  if ($row['COUNT(*)'] > 0) {
    try{
      $id = $_POST['id'];
      $db->exec("DELETE FROM produtos WHERE id = '$id';");
    }catch (Exception $e) {
      echo "Houve o seguinte erro ao excluir o produto '$id': " . $e->getMessage();
    }
  }
}
?>

<html>
<head>
   <title>CRUDSQlite</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
  <body>
    <h1>Excluir Produto</h1>
  <main>
    <form action="excluir.php" method="post">
    <input type="text" id="id" name="id" placeholder="Digite o ID do produto" required><br>
      <input type="submit" value="Excluir">
    </form>
    <br>
    <a href="listar.php">Verificar todos os produtos cadastrados</a> 
    <a href="index.html">Voltar para a página inicial</a>
  </main>
  </body>
</html>