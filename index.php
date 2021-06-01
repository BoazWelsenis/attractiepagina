<?php
session_start();
require_once 'admin/backend/config.php';
?>

<!doctype html>
<html lang="nl">

<head>
    <title>Attractiepagina</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@400;600;700&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/main.css">
    <link rel="icon" href="<?php echo $base_url; ?>/favicon.ico" type="image/x-icon" />
</head>

<body>

    <?php require_once 'header.php'; ?>
    <div class="container content">
        <aside>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia modi dolore magnam! Iste libero voluptatum autem, sapiente ullam earum nostrum sed magnam vel laboriosam quibusdam, officia, esse vitae dignissimos nulla?
        </aside>
        <main>
            <!-- hier zou de query kunnen komen -->
            <?php
                require_once './admin/backend/conn.php';
                $query = "SELECT * FROM rides";
                $statement = $conn->prepare($query);
                $statement->execute();
                $rides = $statement->fetchAll(PDO::FETCH_ASSOC);
            ?>
            
            <!-- hier komen de attractiekaartjes -->
            <div class="attracties">
                <!-- hier komt de foreach -->
                <?php foreach($rides as $ride): ?>
                <div class="attractie">
                    <img src="img/attracties/<?php echo $ride['img_file']; ?>" alt="attractie">

                    <div class="txt-wrapper">
                        <div class="thema"><?php echo strtoupper($ride['themeland']); ?></div> <!-- https://www.php.net/manual/en/function.strtoupper.php -->
                        <h2><?php echo $ride['title']; ?></h2>
                        <p><?php echo $ride['description']; ?></p>
                        <div class="lengte"><p><b><?php echo $ride['min_length']; ?>cm</b> minimale lengte</p></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>

</body>

</html>
