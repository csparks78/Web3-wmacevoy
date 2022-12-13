<?php

require __DIR__ . "/credentials/db_credentials.php";
require_once "connect.php";
require_once 'loggedin.php';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="img\dogBath.png">
    <title>Amanda's Grooming</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Search</title>
</head>

<body id="search">

    <div class="container mt-5">
        <h1>Search</h1>
        <form method="post" action="search.php">
            <input type="text" name="search" placeholder="Search..." required>
            <button type="submit" value="Search">Search</button>
            <button id="home" type="submit" name="home" onclick="window.location.href='add_cust.php';return false;">Home</button>
            <button id="reset" type="reset" onclick="window.location.href='search.php';return false;">Start over</button>
        </form>
        <?php
        if (isset($_POST["search"])) {
            $stmt = $con->prepare("SELECT * FROM `names` WHERE `firstName` LIKE ? OR `lastName` LIKE ? OR `phone` LIKE ?");
            $stmt->execute(["%" . $_POST["search"] . "%", "%" . $_POST["search"] . "%", "%" . $_POST["search"] . "%"]);
            $results = $stmt->fetchAll();
            if (count($results) > 0) {
                foreach ($results as $r) {
                    printf("<div>%s %s <br>Email %s,<br> Phone: %s <br><br></div>", $r["firstName"], $r["lastName"], $r["email"], $r["phone"]);
                }
            } else {
                echo "No results found";
            }
        }
        ?>
        <div id="container">
            <h1>Customers</h1>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>

                    <!--<?php while ($row = $sth->fetch()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['lastName']) ?></td>
                            <td><?php echo htmlspecialchars($row['firstName']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                        </tr>
                    <?php endwhile; ?>-->
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>