<?php

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "arthub";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getUsers() {
        $query = "SELECT * FROM Users";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategories() {
        $query = "SELECT * FROM Categories";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPosts() {
        $query = "SELECT * FROM Posts";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFollowers() {
        $query = "SELECT * FROM Followers";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getComments() {
        $query = "SELECT * FROM Comments";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChatMessages() {
        $query = "SELECT * FROM ChatMessages";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNotifications() {
        $query = "SELECT * FROM Notifications";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get user by username
    public function getUserByUsername($username) {
        $query = "SELECT * FROM Users WHERE Username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get user by email
    public function getUserByEmail($email) {
        $query = "SELECT * FROM Users WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insert user
    public function insertUser($username, $password, $email, $bio) {
        $query = "INSERT INTO Users (Username, Password, Email, Bio) VALUES (:username, :password, :email, :bio)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        return $stmt->execute();

    }

    // Insert post
    public function insertPost($userID, $mediaURL, $caption, $categoryID) {
        $query = "INSERT INTO Posts (UserID, MediaURL, Caption, CategoryID) VALUES (:userID, :mediaURL, :caption, :categoryID)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':mediaURL', $mediaURL, PDO::PARAM_STR);
        $stmt->bindParam(':caption', $caption, PDO::PARAM_STR);
        $stmt->bindParam(':categoryID', $categoryID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Insert comment
    public function insertComment($postID, $userID, $commentText) {
        $query = "INSERT INTO Comments (PostID, UserID, CommentText) VALUES (:postID, :userID, :commentText)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':postID', $postID, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':commentText', $commentText, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Insert notification
    public function insertNotification($userID, $notificationText) {
        $query = "INSERT INTO Notifications (UserID, NotificationText) VALUES (:userID, :notificationText)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':notificationText', $notificationText, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Insert follower
    public function insertFollower($followerUserID, $followingUserID) {
        $query = "INSERT INTO Followers (FollowerUserID, FollowingUserID) VALUES (:followerUserID, :followingUserID)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':followerUserID', $followerUserID, PDO::PARAM_INT);
        $stmt->bindParam(':followingUserID', $followingUserID, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Insert message
    public function insertMessage($senderID, $receiverID, $messageText) {
        $query = "INSERT INTO ChatMessages (SenderID, ReceiverID, MessageText) VALUES (:senderID, :receiverID, :messageText)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':senderID', $senderID, PDO::PARAM_INT);
        $stmt->bindParam(':receiverID', $receiverID, PDO::PARAM_INT);
        $stmt->bindParam(':messageText', $messageText, PDO::PARAM_STR);
        return $stmt->execute();
    }
}


?>
