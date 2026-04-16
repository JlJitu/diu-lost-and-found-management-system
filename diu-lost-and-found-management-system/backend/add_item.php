<?php 
include 'db.php';

if(isset($_POST['add'])){
    $name = $_POST['item_name'];
    $type = $_POST['type'];
    $desc = $_POST['description'];
    $date = $_POST['event_date'];
    $place = $_POST['place'];
    $time = $_POST['event_time'];

    $img = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$img);

    $conn->query("INSERT INTO items(item_name, type, description, image, event_date, place, event_time, status) 
    VALUES('$name', '$type', '$desc', '$img', '$date', '$place', '$time', 'Pending')");

    header("Location: dashboard.php");
}
?>

<div id="add-section" class="add-item-container" style="display:none;">
    <h2>Add New Lost or Found Item</h2>

    <form method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label>Item Name</label>
            <input type="text" name="item_name" required>
        </div>

        <div class="form-group">
            <label>Type</label>
            <select name="type">
                <option value="Lost">Lost</option>
                <option value="Found">Found</option>
            </select>
        </div>

        <div class="form-group">
            <label>Location</label>
            <input type="text" name="place" required>
        </div>

        <div class="row">
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="event_date" required>
            </div>

            <div class="form-group">
                <label>Time</label>
                <input type="time" name="event_time">
            </div>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description"></textarea>
        </div>

        <div class="form-group">
            <label>Upload Image</label>
            <input type="file" name="image">
        </div>

        <button type="submit" name="add" class="submit-btn">Submit Report</button>

    </form>
</div>