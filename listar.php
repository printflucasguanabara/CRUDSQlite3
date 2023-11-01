<!DOCTYPE html>
<html>

<head>
    <title>Lista de Produtos</title>
    <style>
        * {
            box-sizing: border-box;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f7f7;
        }

        header {
            background-color: #3b6978;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
            color: #ffffff;
            margin-bottom: 30px;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 40px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 15px;
        }

        th {
            background-color: #3b6978;
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            background-color: #3b6978;
            padding: 10px 20px;
            text-decoration: none;
            color: #ffffff;
            border-radius: 5px;
            margin: 5px;
            transition: background-color 0.4s, color 0.4s;
        }

        a:hover {
            background-color: #264653;
        }

        .button-container {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Lista de Itens</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Produto</th>
                    <th>Descrição</th>
                    <th>Preço (R$)</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $db = new SQLite3('database.db');
                } catch (Exception $e) {
                    die('Erro de conexão: ' . $e->getMessage());
                }

                $result = $db->query('SELECT * FROM produtos');

                while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['nome'] . '</td>';
                    echo '<td>' . $row['descricao'] . '</td>';
                    echo '<td>' . $row['preco'] . '</td>';
                    echo '<td>';
                    echo '<a href="editar.php?id=' . $row['id'] . '">Editar</a>';
                    echo ' | ';
                    echo '<a href="excluir.php?id=' . $row['id'] . '">Excluir</a>';
                    echo '</td>';
                    echo '</tr>';
                }

                $db->close();
                ?>
            </tbody>
        </table>

        <div class="button-container">
            <a href="index.html">Voltar para a Página Inicial</a>
        </div>
    </main>
</body>

</html>
