<?php
include_once("config.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $result = mysqli_query($mysqli, "UPDATE rooms SET name='$name', price='$price' WHERE id=$id");

    header("Location: index.php");
}
?>

<?php
$id = $_GET['id'];
$result = mysqli_query($mysqli, "SELECT * FROM rooms WHERE id=$id");

while ($room_data = mysqli_fetch_array($result)) {
    $name = $room_data['name'];
    $price = $room_data['price'];
}
?>
<html>
<head>
    <title>Edit Room</title>
</head>
<body>
    <a href="index.php">Home</a>
    <br /><br />

    <form name="update_room" method="post" action="edit.php">
        <table border="0">
            <tr>
                <td>Room Name</td>
                <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="text" name="price" value="<?php echo $price; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>
