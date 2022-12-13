<?php
//Check logged in status
require __DIR__ . '/loggedin.php';
//Connection to the database
require __DIR__ . '/credentials/db_credentials.php';

require_once 'connect.php';

try {
    $sql = 'SELECT lastName,
                    firstName,
                    phone,
                    email
               FROM names
              ORDER BY lastName';

$sth = $con->query($sql);
    $sth->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP MySQL Query Data Demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css\add_customers.css" rel="stylesheet">
    </head>
    <body>
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
                    <?php while ($row = $sth->fetch()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['lastName']) ?></td>
                            <td><?php echo htmlspecialchars($row['firstName']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </body>
</div>
</html>