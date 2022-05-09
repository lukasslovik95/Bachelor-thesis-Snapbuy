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





    <!-- BANNER SECTION -->
	<section>
		<div class="about-us-banner">
			<div><h1 class="color-white mt-50">O nas</h1></div>
		</div>
    </section>

    <!-- CONTENT SECTION -->
    <div class="container-small mt-50 mb-50 mt-md-70 mb-md-70">
        <p class="t-justify mb-20">Projekt SnapBuy jest sklepem internetowym. Wykonany on został na potrzeby pracy dyplomowej. Nie jest to prawdziwy, działający sklep. Nie posiada on również autentycznych płatności, ani prawdziwych urządzeń wystawionych jako oferty. Nie zmienia to faktu, że projekt SnapBuy został wykonany zgodnie z dobrymi praktykami programowania i mógłby być prawdziwym, działającym sklepem.</p>
        <p class="t-justify">Autorami serwisu to studenci Uniwersytetu Gdańskiego, są to Piotr Rychert oraz Łukasz Słowik. Projekt wykonaliśmy dzięki umiejętnościom nabytym podczas studiowania oraz doświadczenia pozyskanego w pracy.</p>
    </div>

    <section class="container-fluid mt-lg-40 mt-20">
        <div class="row">
            <div class="col-12 col-sm-6 p-lg-100 p-md-30 p-20 d-flex align-items-center justify-content-end order-sm-0 order-1">
                <div class="ml-auto" style="max-width: 500px;">
                    <h2 class="h3">Autorzy strony</h3>
                    <p class="t-justify mb-20"><strong>Piotr Rychert:</strong> viverra lorem scelerisque magna venenatis cursus. Suspendisse pharetra rutrum tellus, sit amet tempus magna laoreet euismod. Pellentesque nisl sem, dapibus ac orci molestie, maximus bibendum est. Donec luctus semper pellentesque.</p>
                    <p class="t-justify"><strong>Łukasz Słowik</strong>: vehicula suscipit consectetur. In vel dapibus turpis, eu porta velit. Nam quis tellus nec lorem pharetra fringilla. Praesent maximus ligula quis enim malesuada faucibus a vel ante. Quisque luctus metus id purus dapibus laoreet. Sed eget aliquet quam. Curabitur vestibulum nibh metus, eu dignissim nulla rhoncus eu.</p>
                </div>
            </div>
        <div class="col-sm-6 p-0 order-sm-1 order-0"><img src="img/o-nas-section-1.jpg" class="full obj-fit-cover"></div>
        </div>
        <div class="row">
            <div class="col-sm-6 p-0"><img src="img/o-nas-section-2.jpg" class="full obj-fit-cover"></div>
            <div class="col-12 col-sm-6 p-lg-100 p-md-30 p-20 d-flex align-items-center">
                <div class="mr-auto" style="max-width: 500px;">
                    <h2 class="h3">Sklep godny polecenia</h3>
                    <p class="t-justify mb-20">Zaufaj nam tak samo jak wiele innych studentów, którzy potrzebowali pomocy w rozwiązaniu problemów ze swoim kodem.</p>
                    <p class="t-justify">Dlaczego jesteśmy niekwestionowanym liderem? Z naszym sklepem współpracują liderzy tacy jak Przykład, Example lub chociażby Dummy. Nasz bezawaryjny sklep internetowy pozwoli Ci zaopatrzyć się w laptopa do pracy nad wymagającymi projektami, gier z podkręconą grafiką lub oglądania filmów w najwyższej jakości.</p>
                </div>
            </div>
        </div>
    </section>

  </main>

<?php include ( '_footer.php' ); ?>
