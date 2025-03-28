<html>
<head>
    <title>Add Room</title>
</head>
<body>
    <a href="index.php">Go to Home</a>
    <br /><br />

    <form action="add.php" method="post">
        <table width="25%" border="0">
            <tr>
                <td>Room Name</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="text" name="price"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>

    <?php
    if (isset($_POST['Submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];

        include_once("config.php");

        $result = mysqli_query($mysqli, "INSERT INTO rooms(name, price) VALUES('$name', '$price')");

        echo "Room added successfully. <a href='index.php'>View Rooms</a>";
    }
    ?>
</body>
</html>
