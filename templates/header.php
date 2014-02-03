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

            <div class="table" id="nav">
                <p>
                    <table>
                        <tr>
                            <td><a href="index.php">Home</a></td>
                            <td><a href="register.php">Register</a></td>
                            <td><a href="profile.php">Profile</a></td>
                            <td><a href="logout.php">Logout</a></td>
                        </tr>
                    </table>
                </p>
            </div>
            <div id="middle">

