<?php

session_start();
require 'database.php';
$conn = mysqli_connect("localhost", "root", "", "snapbuy");
$sql = mysqli_query($conn, "SELECT * FROM users");
$row = mysqli_fetch_assoc($sql);
$output = "";

if (mysqli_num_rows($sql) == 1) {
    $output .= "Brak użytkowników online.";
} elseif (mysqli_num_rows($sql) > 0) {
    foreach($sql as $row) {
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        if (mysqli_num_rows($query2) > 0) {
            $result = $row2['msg'];
        } else {
            $result = "Brak wiadomości.";
        }

        (strlen($result) > 28) ? $msg = substr($result, 0, 28) : $msg = $result;

        $output .=  '<a href="chat.php?user_id='.$row['unique_id'].'">
                        <div class="content">
                        <img src="https://www.gravatar.com/avatar/' . md5($row['email']) . '?d=mp" alt="">
                        <div class="details">
                            <span>'. $row['name'] .'</span>
                            <p>'.$msg.'</p>
                        </div>
                        </div>
                        <div class="status-dot"><i class="fas fa-circle"></i></div>
                    </a>';
    }
}

echo $output;
?>
