<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        
        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>RDXA</title>
        <?php endif ?>

    </head>

    <body>

        <div class="container-fluid">

            <div id="nav" class="navigator">
                <p>
                    <table>
                        <tr>
                            <td><a href="index.php">Home</a></td>
                            <td><a href="logout.php">Logout</a></td>
                            <td><a href="management.php">Management</a></td>
                        </tr>
                    </table>
                </p>
            </div>
            <div id="middle">

