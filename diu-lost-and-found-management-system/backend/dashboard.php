<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}

$items = $conn->query("SELECT * FROM items WHERE status='Pending' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DIU LOST & FOUND</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js" defer></script>
</head>
<body>

<div class="sidebar">
    <h2>DIU</h2>
    <a href="#" onclick="showSection('dashboard');return false;">Dashboard</a>
    <a href="#" onclick="showSection('lost');return false;">Lost & Found</a>
    <a href="#" onclick="showSection('add');return false;">Add Item</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">

    <div class="topbar">
        <div class="topbar-left">
            <h3>Dashboard</h3>
            <p style="font-size: 12px; color: #777;">Student Portal</p>
        </div>
        <div class="topbar-right text-right">
            <span style="font-weight: bold; text-transform: uppercase;">PROMIT KARMAKAR</span><br>
            <span style="font-size: 12px; color: #777;">232-35-417</span>
        </div>
    </div>

    <div class="content">

        <div id="dashboard-section">
            
            <div class="cards">
                <div class="card">
                    <p>Total Payable</p>
                    <h2>563,550.00</h2>
                </div>
                <div class="card">
                    <p>Total Paid</p>
                    <h2>526,511.00</h2>
                </div>
                <div class="card">
                    <p>Total Due</p>
                    <h2>37,039.00</h2>
                </div>
                <div class="card">
                    <p>Total Other</p>
                    <h2>400.00</h2>
                </div>
            </div>

            <div class="section-container">
                <h4>📅 Today's Routine - Sunday</h4>
                <div class="routine-box">
                    <p>No routine available for today.</p>
                </div>
            </div>

            <div class="section-container">
                <h4>Semester Wise Result</h4>
                <div class="chart-container">
                    <canvas id="cgpaChart"></canvas>
                </div>
            </div>

        </div>

        <div id="lost-section" style="display:none;">
            <h2>Unclaimed Lost & Found Items</h2>
            <div class="grid">
                <?php while($row=$items->fetch_assoc()){ ?>
                <div class="item">
                    <img src="uploads/<?php echo $row['image']; ?>">
                    <h3><?php echo $row['item_name']; ?></h3>
                    <p><?php echo $row['description']; ?></p>
                    <a href="update_status.php?id=<?php echo $row['id']; ?>&s=Claimed" class="btn">Got It</a>
                </div>
                <?php } ?>
            </div>
        </div>

        <div id="add-section" style="display:none;">
            <h2>Add Item</h2>
            <form action="add_item.php" method="POST" enctype="multipart/form-data">
                <input name="item_name" placeholder="Item Name" required><br><br>
                <select name="type">
                    <option>Lost</option>
                    <option>Found</option>
                </select><br><br>
                <textarea name="description" placeholder="Description"></textarea><br><br>
                <input type="file" name="image" required><br><br>
                <button name="add" class="submit-btn">Submit</button>
            </form>
        </div>

    </div> <div class="footer">
        <p>2026 © - Developed by <strong>Daffodil International University</strong></p>
    </div>
</div>

<script>
    // CGPA Graph Initialization
    const ctx = document.getElementById('cgpaChart').getContext('2d');
    const cgpaChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Fall 2023', 'Spring 2024', 'Fall 2024', 'Spring 2025', 'Summer 2025', 'Fall 2025'],
            datasets: [{
                label: 'CGPA',
                data: [3.72, 3.36, 3.32, 3.84, 3.85, 3.61],
                backgroundColor: [
                    '#e5d1b8', // Fall 2023
                    '#949fb1', // Spring 2024
                    '#d68a8a', // Fall 2024
                    '#d891ef', // Spring 2025
                    '#a38d8d', // Summer 2025
                    '#c7f1e1'  // Fall 2025
                ],
                borderRadius: 5,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 4.0,
                    grid: { color: '#eee' }
                },
                x: {
                    grid: { display: false }
                }
            },
            plugins: {
                legend: { display: true, position: 'top' }
            }
        }
    });

    // Navigation function (existing but updated for the new IDs)
    function showSection(sectionId) {
        document.getElementById('dashboard-section').style.display = 'none';
        document.getElementById('lost-section').style.display = 'none';
        document.getElementById('add-section').style.display = 'none';
        
        document.getElementById(sectionId + '-section').style.display = 'block';
    }
</script>

</body>
</html>