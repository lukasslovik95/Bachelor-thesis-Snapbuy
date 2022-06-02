<?php
session_start();
?>

<?php include ( '_header.php' ); ?>

<?php
require 'database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,name,unique_id,password,status FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}
}

$conn = mysqli_connect("localhost", "root", "", "snapbuy");

$ownsql = mysqli_query($conn, "SELECT * FROM users WHERE id = {$_SESSION['user_id']}");
$ownrow = mysqli_fetch_assoc($ownsql);

$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
$row = mysqli_fetch_assoc($sql);
// $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
// $row = mysqli_fetch_assoc($sql);

// if( isset($_SESSION['user_id']) ){
//
// 	$records = $conn->prepare('SELECT id,email,name,unique_id,password,status FROM users WHERE id = :id');
// 	$records->bindParam(':id', $_SESSION['user_id']);
// 	$records->execute();
// 	$results = $records->fetch(PDO::FETCH_ASSOC);
//
// 	$user = NULL;
//
// 	if( count($results) > 0){
// 		$user = $results;
// 	}
// }

?>

<main class="main-chat d-flex justify-content-center">

    <!-- REGISTER MODAL -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalTitleTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalTitle">Rejestracja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <form action="register.php" method="POST">
                        <input type="text" placeholder="Wprowadź email" name="email">
                        <input type="password" placeholder="Hasło" name="password">
                        <input type="password" placeholder="Potwierdź hasło" name="confirm_password">
                        <button type="submit" class="btn btn-primary">Zatwierdź</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- LOGIN MODAL -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalTitle">Logowanie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <form action="login.php" method="POST">
                        <input type="text" placeholder="Wprowadź email" name="email">
                        <input type="password" placeholder="Hasło" name="password">
                        <button type="submit" class="btn btn-primary">Zatwierdź</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- CHAT WINDOW -->
    <?php if( !empty($user) ): ?>
        <div class="wrapper">
            <section class="chat-area">
                <header>
                    <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <img <?php echo "src=\"https://www.gravatar.com/avatar/" . md5($row['email']) . "?d=mp\""; ?> />
                    <div class="details">
                        <span><?php echo $row['name']; ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                </header>
                <div class="chat-box">

                </div>
                <form action="#" class="typing-area" autocomplete="off">
                    <input type="text" name="outgoing_id" value="<?php echo $ownrow['unique_id']; ?>" hidden>
                    <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                    <input type="text" name="message" class="input-field" placeholder="Napisz wiadomość...">
                    <button><i class="fab fa-telegram-plane"></i></button>
                </form>
            </section>
        </div>
    <?php else: ?>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <p class="fs-20 mb-20"><a class="menu-scroll fw-900 color-violet" type="button" data-toggle="modal" data-target="#loginModal">Zaloguj się</a>, aby móc korespondować z innymi użytkownikami.</p>
            <p class="fs-20">Nie masz konta? <a class="menu-scroll fw-900 color-violet" type="button" data-toggle="modal" data-target="#registerModal">Zarejestruj się</a>.</p>
        </div>
    <?php endif; ?>

</main>

<script src="js/chat.js"></script>

<?php include ( '_footer.php' ); ?>
