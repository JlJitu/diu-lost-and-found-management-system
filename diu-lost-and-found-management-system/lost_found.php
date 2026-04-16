<?php
session_start();
include 'db.php';
// ডাটাবেস থেকে সকল লস্ট আইটেম আনা হচ্ছে
$lost = $conn->query("SELECT * FROM lost_items ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found Portal</title>
    <style>
        /* মূল কন্টেইনার এবং গ্রিড স্টাইল */
        .lost-found-wrapper { font-family: 'Segoe UI', Arial, sans-serif; padding: 20px; }
        .lost-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); 
            gap: 25px; 
        }

        /* আইটেম কার্ড ডিজাইন */
        .lost-card { 
            background: #ffffff; 
            border-radius: 12px; 
            padding: 15px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.1); 
            transition: transform 0.3s ease; 
            display: flex;
            flex-direction: column;
            text-align: center;
        }
        .lost-card:hover { transform: translateY(-5px); }
        .lost-card img { 
            width: 100%; 
            height: 180px; 
            object-fit: cover; 
            border-radius: 8px; 
            margin-bottom: 12px;
        }

        /* টেক্সট এবং বাটন স্টাইল */
        .item-name { 
            color: #2e3192; 
            font-size: 18px; 
            margin-bottom: 8px; 
            cursor: pointer; 
            font-weight: bold;
        }
        .item-name:hover { text-decoration: underline; }
        .view-btn { 
            background: #2e3192; 
            color: white; 
            border: none; 
            padding: 10px; 
            border-radius: 6px; 
            cursor: pointer; 
            font-weight: 600;
            width: 100%;
            margin-top: auto;
        }

        /* পপআপ/মডাল ডিজাইন (পুরো স্ক্রিন জুড়ে আসবে) */
        .modal-overlay {
            display: none; /* ডিফল্টভাবে লুকানো */
            position: fixed; 
            top: 0; left: 0; 
            width: 100%; height: 100%; 
            background: rgba(0, 0, 0, 0.85); 
            justify-content: center; 
            align-items: center; 
            z-index: 99999; /* সবকিছুর উপরে থাকার জন্য */
            backdrop-filter: blur(4px);
        }
        .modal-container {
            background: #fff; 
            padding: 25px; 
            border-radius: 15px; 
            max-width: 480px; 
            width: 90%; 
            position: relative; 
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
        
        .modal-container img { 
            width: 100%; 
            max-height: 250px; 
            object-fit: contain; 
            border-radius: 8px; 
            margin-bottom: 15px; 
        }
        .close-x { 
            position: absolute; top: 12px; right: 18px; 
            font-size: 28px; cursor: pointer; color: #666; 
        }
        .close-x:hover { color: #000; }
    </style>
</head>
<body>

<div class="lost-found-wrapper">
    <h2 style="margin-bottom: 25px;">Unclaimed Lost & Found Items</h2>

    <div class="lost-grid">
        <?php while($row = $lost->fetch_assoc()){ 
            // ছবির পাথ এবং ডাটা ভেরিয়েবল
            $img_path = "uploads/" . $row['image'];
            $title = addslashes($row['item_name']);
            $desc = addslashes($row['description']);
        ?>
        <div class="lost-card">
            <img src="<?php echo $img_path; ?>" onerror="this.src='https://via.placeholder.com/300x180?text=No+Image'">
            
            <h4 class="item-name" onclick="openItemDetails('<?php echo $title; ?>', '<?php echo $desc; ?>', '<?php echo $img_path; ?>')">
                <?php echo $row['item_name']; ?>
            </h4>
            
            <p style="color: #666; font-size: 14px; margin-bottom: 15px;">
                <?php echo substr($row['description'], 0, 40); ?>...
            </p>

            <button class="view-btn" onclick="openItemDetails('<?php echo $title; ?>', '<?php echo $desc; ?>', '<?php echo $img_path; ?>')">
                View Details
            </button>
        </div>
        <?php } ?>
    </div>
</div>

<div id="itemModalOverlay" class="modal-overlay" onclick="closeItemDetails()">
    <div class="modal-container" onclick="event.stopPropagation()">
        <span class="close-x" onclick="closeItemDetails()">&times;</span>
        
        <img id="popImage" src="" alt="Product">
        <h2 id="popTitle" style="color: #2e3192; margin-bottom: 10px;"></h2>
        <p id="popDesc" style="color: #444; font-size: 15px; line-height: 1.6; text-align: justify;"></p>
        
        <button class="view-btn" style="margin-top: 20px;" onclick="closeItemDetails()">Close</button>
    </div>
</div>

<script>
    // পপআপ ওপেন করার ফাংশন
    function openItemDetails(name, description, image) {
        document.getElementById('popTitle').innerText = name;
        document.getElementById('popDesc').innerText = description;
        document.getElementById('popImage').src = image;
        
        // ডিসপ্লে ফ্লেক্স করে মডালটি দেখানো হচ্ছে
        document.getElementById('itemModalOverlay').style.display = 'flex';
    }

    // পপআপ বন্ধ করার ফাংশন
    function closeItemDetails() {
        document.getElementById('itemModalOverlay').style.display = 'none';
    }
</script>

</body>
</html>