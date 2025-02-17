<?php
require('inc/koneksi_db_izzy.php');

// Proses update jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_settings'])) {
    $title_izzy = $_POST['title_izzy'] ?? '';
    $about_izzy = $_POST['about_izzy'] ?? '';

    if (!empty($title_izzy) && !empty($about_izzy)) {
        $stmt = $con->prepare("UPDATE setting_izzy SET title_izzy = ?, about_izzy = ? WHERE id_izzy = 1");

        if ($stmt) {
            $stmt->bind_param("ss", $title_izzy, $about_izzy);
            if ($stmt->execute()) {
                $message = "Settings updated successfully!";
            } else {
                $message = "Error updating settings: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "Database error: " . $con->error;
        }
    } else {
        $message = "Both fields are required!";
    }

    // Refresh halaman setelah update
    header("Location: setting_izzy.php");
    exit;
}

// Ambil data dari database untuk ditampilkan di halaman
$query = "SELECT title_izzy, about_izzy FROM setting_izzy WHERE id_izzy = 1";
$result = $con->query($query);
$settings = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php require('inc/links_izzy.php'); ?>
</head>

<body class="bg-light">

    <?php require('inc/header_admin_izzy.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">SETTINGS</h3>

                <?php if (!empty($message)): ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
                <?php endif; ?>

                <!-- General Settings Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#generalSettingsModal">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card-text"><?php echo htmlspecialchars($settings['title_izzy']); ?></p>
                        <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
                        <p class="card-text"><?php echo htmlspecialchars($settings['about_izzy']); ?></p>
                    </div>
                </div>

                <!-- Modal for Editing Settings -->
                <div class="modal fade" id="generalSettingsModal" data-bs-backdrop="static" data-bs-keyboard="true"
                    tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Settings</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Site Title</label>
                                        <input type="text" name="title_izzy"
                                            value="<?php echo htmlspecialchars($settings['title_izzy']); ?>"
                                            class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">About Us</label>
                                        <textarea name="about_izzy" class="form-control shadow-none" rows="6"
                                            required><?php echo htmlspecialchars($settings['about_izzy']); ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary shadow-none"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" name="update_settings"
                                        class="btn btn-primary shadow-none">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Shutdown -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <div class="form-check form-switch">
                                <form action="">

                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                </form>
                            </div>
                        </div>
                        <p class="card-text">
                            No Customers will be allowed to book hotel room, when shutdown mode is turned on.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/script_izzy.php'); ?>

</body>

</html>