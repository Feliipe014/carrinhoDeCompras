<?php
session_start();
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de compras PHP</title>

    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2.title {
            background-color: #069;
            width: 100%;
            padding: 20px;
            text-align: center;
            color: white;
        }

        .carrinho-container {
            display: flex;
            margin-top: 10px;
        }

        .produto {
            width: 33.3%;
            padding: 0 30px;
            border: 1px solid #ccc;

        }

        .produto img {
            max-width: 100%;
            width: 300px;
            aspect-ratio: 10/10;

        }

        .produto a {
            display: block;
            width: 100%;
            padding: 10px;
            color: white;
            background-color: #5fb382;
            text-align: center;
            text-decoration: none;
            border: 1px solid #ccc;
        }

        .carrinho-item {
            max-width: 1200px;
            margin: 10px auto;
            padding-bottom: 10px;
            border-bottom: 2px dotted #ccc;
        }

        .carrinho-item p {
            font-size: 19px;
            color: black;
        }
    </style>
</head>

<body>

    <h2 class="title">Carrinho com PHP</h2>
    <div class="carrinho-container">

        <?php

        $items = array(
            ['nome' => 'produto 1', 'imagem' => 'img/item1.png', 'preco' => '12000'],
            ['nome' => 'produto 2', 'imagem' => 'img/item2.png', 'preco' => '4500'],
            ['nome' => 'produto 3', 'imagem' => 'img/item3.png', 'preco' => '1250']
        );

        foreach ($items as $key => $value) {
        ?>
            <div class="produto">
                <img src="<?php echo $value['imagem'] ?>" alt="" />
                <a href="?adicionar=<?php echo $key ?>">Adicionar ao carrinho</a>
            </div>

        <?php
        }
        ?>
    </div>

    <?php
    if (isset($_GET['adicionar'])) {
        $idProduto = (int) $_GET['adicionar'];
        if (isset($items[$idProduto])) {
            if (isset($_SESSION['carrinho'][$idProduto])) {
                $_SESSION['carrinho'][$idProduto]['quantidade']++;
            } else {
                $_SESSION['carrinho'][$idProduto] = array('quantidade' => 1, 'nome' => $items[$idProduto]['nome'], 'preco' => $items[$idProduto]['preco']);
            }
            echo '<script>alert("O item foi adicionado ao carrinho.");</script>';
        } else {
            die('Você não pode adicionar um item que não existe.');
        }
    }
    ?>

    <h2 class="title">Carrinho</h2>

    <?php

    foreach ($_SESSION['carrinho'] as $key => $value) {
        echo '<div class="carrinho-item">';
        echo '<p>Nome: ' . $value['nome'] . ' | Quantidade: ' . $value['quantidade'] .
            ' | Preço: R$' . ($value['quantidade'] * $value['preco']) . ',00</p>';
        echo '</div>';
    }

    ?>

    <?php
    if (isset($_GET['limpar'])) {
        unset($_SESSION['carrinho']);
    }
    ?>
    <a href="?limpar">Limpar carrinho</a>


</body>

</html>