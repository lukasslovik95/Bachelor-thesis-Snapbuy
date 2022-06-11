<?php
session_start();
?>

<?php include ( '_header.php' ); ?>

<?php

require 'database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}
}

?>

  <main>

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
                <input type="text" placeholder="Wprowadź login" name="name">
             <input type="password" placeholder="Hasło" name="password">
             <input type="password" placeholder="Potwierdź hasło" name="confirm_password">
                <input type="text" name="unique_id" value=<?php echo htmlspecialchars($uuid); ?> readonly style="position:absolute;opacity:0;left:-100000;"/>
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

    <section class="category-section container">
        <a href="kup-teraz.php" class="i-category">
            <div class="d-flex justify-content-center align-items-center">
                <span>
                <h2 class="h1 color-light t-center m-20 mt-15">KUP TERAZ</h2>
                </span>
            </div>
        </a>
        <a href="ShowAuctions.php" class="i-category">
            <div class="d-flex justify-content-center align-items-center">
                <span>
                <h2 class="h1 color-light t-center m-20 mt-15">AUKCJA</h2>
                </span>
            </div>
        </a>
    </section>

  </main>

<?php include ( '_footer.php' ); ?>
