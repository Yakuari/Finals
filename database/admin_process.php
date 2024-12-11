<?php
require_once __DIR__ . '/dbh.php'; // Adjust the path to your Dbh class file

class AdminActions extends Dbh {
    // Check if user is already processed
    private function isUserProcessed($userId) {
        $sql = "SELECT status FROM users WHERE id = :user_id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $user = $stmt->fetch();

        if (!$user) {
            throw new Exception("User not found.");
        }

        return in_array($user['status'], ['accepted', 'rejected']);
    }

    public function acceptUser($userId) {
        if ($this->isUserProcessed($userId)) {
            header("Location: admin-dashboard-class.php?error=already_processed");
            exit();
        }

        // Fetch the user's month value
        $sql = "SELECT user_month FROM users WHERE id = :user_id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $user = $stmt->fetch();

        if ($user) {
            $userMonth = (int)$user['user_month'];
            $daysToAdd = $userMonth * 30; // Each month corresponds to 30 days
            $expireAt = date('Y-m-d H:i:s', strtotime("+$daysToAdd days")); // Calculate expiration date

            // Update the user's expiration date and status
            $updateSql = "UPDATE users SET expire_at = :expire_at, status = 'accepted' WHERE id = :user_id";
            $updateStmt = $this->connect()->prepare($updateSql);
            $updateStmt->execute(['expire_at' => $expireAt, 'user_id' => $userId]);

            // Log the action
            $logSql = "INSERT INTO user_logs (user_id, action) VALUES (:user_id, 'accepted')";
            $logStmt = $this->connect()->prepare($logSql);
            $logStmt->execute(['user_id' => $userId]);
        } else {
            throw new Exception("User not found.");
        }
    }

    public function rejectUser($userId) {
        if ($this->isUserProcessed($userId)) {
            header("Location: admin-dashboard-class.php?error=already_processed");
            exit();
        }

        try {
            // Log the rejection action before updating the user
            $logSql = "INSERT INTO user_logs (user_id, action) VALUES (:user_id, 'rejected')";
            $logStmt = $this->connect()->prepare($logSql);
            $logStmt->execute(['user_id' => $userId]);

            // Update the user's status
            $sql = "UPDATE users SET status = 'rejected' WHERE id = :user_id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['user_id' => $userId]);
        } catch (PDOException $e) {
            throw new Exception("Database Error: " . $e->getMessage());
        }
    }
}

// Main logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'] ?? null;
    $action = $_POST['action'] ?? null;

    // Validate input
    if (!$userId || !$action) {
        header("Location: admin-dashboard-class.php?error=missing_data");
        exit();
    }

    $adminActions = new AdminActions();

    try {
        if ($action === 'accept') {
            $adminActions->acceptUser($userId);
        } elseif ($action === 'reject') {
            $adminActions->rejectUser($userId);
        } else {
            header("Location: admin-dashboard-class.php?error=invalid_action");
            exit();
        }

        // Redirect to admin-dashboard.php with a success message
        header("Location: admin-dashboard-class.php?message=success");
        exit();
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        header("Location: admin-dashboard-class.php?error=db_error");
        exit();
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        header("Location: admin-dashboard-class.php?error=general_error");
        exit();
    }
}
