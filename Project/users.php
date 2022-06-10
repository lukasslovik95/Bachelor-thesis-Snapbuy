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
                    <form action="register.php" method="POST">a
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

    <?php if( !empty($user) ): ?>
        <div class="wrapper">

            <section class="users">
                <header>
                    <div class="content">
                        <img <?php echo "src=\"https://www.gravatar.com/avatar/" . md5($user['email']) . "?d=mp\""; ?> />
                        <div class="details">
                            <span><?php echo $user['name']; ?></span>
                            <p><?php echo $user['status']; ?></p>
                        </div>
                    </div>
                </header>
                <div class="search">
                    <span class="text">Znajdź użytkownika</span>
                    <input type="text" placeholder="Wyszukaj...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list">

                </div>
            </section>
        </div>
    <?php else: ?>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <p class="fs-20 mb-20"><a class="menu-scroll fw-900 color-violet" type="button" data-toggle="modal" data-target="#loginModal">Zaloguj się</a>, aby móc korespondować z innymi użytkownikami.</p>
            <p class="fs-20">Nie masz konta? <a class="menu-scroll fw-900 color-violet" type="button" data-toggle="modal" data-target="#registerModal">Zarejestruj się</a>.</p>
        </div>
    <?php endif; ?>

</main>

<script src="js/users.js"></script>

<?php include ( '_footer.php' ); ?>
