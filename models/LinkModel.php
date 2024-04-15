<?php
 

class LinkModel {
    protected $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getUserLinks($userId) {
        $stmt = $this->db->prepare("SELECT id, original_url FROM links WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function createShortLink($url) {
        $shortCode = $this->generateShortCode();
        // Check if the shortcode already exists
        if ($this->checkShortCodeExists($shortCode)) {
            return $this->createShortLink($url); // Recursion if shortcode exists
        }
        
        $stmt = $this->db->prepare("INSERT INTO links (original_url, short_code, id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $url, $shortCode, $_SESSION['id']);
        $stmt->execute();
        return $shortCode;
    }

    protected function generateShortCode() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }

     function checkShortCodeExists($shortCode) {
        $stmt = $this->db->prepare("SELECT * FROM links WHERE short_code = ?");
        $stmt->bind_param("s", $shortCode);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}

?>
