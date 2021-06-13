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
            <h3>Filters</h3>

            <form action="" action="GET">
                <select name="type">
                    <option value="">- kies een themgebied - </option>
                </select>

                <input type="submit" value="Filters">
            </form>

            <!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia modi dolore magnam! Iste libero voluptatum autem, sapiente ullam earum nostrum sed magnam vel laboriosam quibusdam, officia, esse vitae dignissimos nulla? -->
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
                <div class="attractie <?php if($ride['fast_pass']) echo "large"?>">
                    <img class="attractie-img" src="img/attracties/<?php echo $ride['img_file']; ?>" alt="<?php echo $ride['title']; ?>">

                    <div class="attractie-bottom">
                        <div class="txt-wrapper <?php if($ride['fast_pass']) echo "w50"?>">
                            <div class="thema"><?php echo strtoupper($ride['themeland']); ?></div> <!-- https://www.php.net/manual/en/function.strtoupper.php -->
                            <h2><?php echo $ride['title']; ?></h2>
                            <p><?php echo $ride['description']; ?></p>
                            <div class="lengte">
                                <p><b><?php echo $ride['min_length'] ? $ride['min_length'] . " " . "cm" : "Geen"?></b> minimale lengte</p>
                            </div>
                        </div>

                        <!-- Informatie bj fast-pass -->
                        <?php if($ride['fast_pass']): ?>
                            <div class="txt-fastpass">
                                <p>Deze attractie is alleen te <br> bezoeken met een fastpass</p>

                                <p>Boek nu en sla de wachtrij over:</p>
                                
                                <button>
                                    <img src="./img/Ticket.png" alt="ticket icon">
                                    FAST PASS
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</body>
</html>
