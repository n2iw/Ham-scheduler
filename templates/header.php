<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        
        <link href="css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Website designed by N2IW</title>
        <?php endif ?>

    </head>

    <body>

        <div class="container-fluid">

            <div id="nav" class="navigator">
                <p>
                    <table>
                        <tr>
                            <td><a href="index.php">Home</a></td>
                            <?php if (!isset($_SESSION["id"])): ?>
                                <td><a href="login.php">Login</a></td>
                            <?php else :?>
                                <td><a href="profile.php">Profile</a></td>
                                <td><a href="logout.php">Logout</a></td>
                                <?php if ($_SESSION["privilege"] > 1): ?>
                                    <td><a href="management.php">Management</a></td>
                                <?php endif ?>
                            <?php endif ?>
                        </tr>
                    </table>
                </p>
            </div>
            <div id="middle">

