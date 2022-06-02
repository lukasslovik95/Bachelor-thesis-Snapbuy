<?php

session_start();

require 'database.php';

$conn = mysqli_connect("localhost", "root", "", "snapbuy");

$outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
$incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
$output = "";

$sql = "SELECT * FROM messages WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
        OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC";

$query = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($query);

$imgquery = mysqli_query($conn, "SELECT * FROM users where unique_id={$incoming_id}");
$imgrow = mysqli_fetch_assoc($imgquery);

if (mysqli_num_rows($query) > 0) {
    foreach($query as $row){
        if ($row['outgoing_msg_id'] === $outgoing_id) {
            $output .= '<div class="chat outgoing">
                            <div class="details">
                                <p>'. $row['msg'] .'</p>
                            </div>
                        </div>';
        } else {
            $output .= '<div class="chat incoming">
                            <img src="https://www.gravatar.com/avatar/' . md5($imgrow['email']) . '?d=mp" alt="">
                            <div class="details">
                                <p>'. $row['msg'] .'</p>
                            </div>
                        </div>';
        }
    }
    echo $output;
}

?>
