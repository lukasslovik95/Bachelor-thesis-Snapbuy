<?php

require 'database.php';
$conn = mysqli_connect("localhost", "root", "", "snapbuy");
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
$output = "";

$sql = mysqli_query($conn, "SELECT * FROM users WHERE name LIKE '%{$searchTerm}%'");
$row = mysqli_fetch_assoc($sql);

if (mysqli_num_rows($sql) > 0) {
    foreach($sql as $row) {
        $output .=  '<a href="chat.php?user_id='.$row['unique_id'].'">
                        <div class="content">
                        <img src="https://www.gravatar.com/avatar/' . md5($row['email']) . '?d=mp" alt="">
                        <div class="details">
                            <span>'. $row['name'] .'</span>
                            <p>przykładowa wiadomość</p>
                        </div>
                        </div>
                        <div class="status-dot"><i class="fas fa-circle"></i></div>
                    </a>';
    }
} else {
    $output .= "Nie znaleziono użytkownika o podanej nazwie.";
}
echo $output;

?>
