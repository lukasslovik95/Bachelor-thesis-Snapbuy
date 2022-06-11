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





    <!-- BANNER SECTION -->
	<section class="contact-banner">
		<div>
			<div class="container">
                <h1 class="color-white mt-20 t-center t-lg-left">Kontakt</h1>
            </div>
		</div>
    </section>

		<div class="container">
			<div class="row">
                <div class="col-12 offset-sm-1 col-sm-10 offset-md-2 col-md-8 offset-lg-0 col-lg-6 col-xl-5">
                    <div class="mb-60 mt-20 mt-lg-50 mb-lg-50 mr-10 mr-xl-0">
                        <h2>DANE DO KONTAKTU</h2>
                        <p class="mb-20">Zachęcamy do dzielenia się Państwa opiniami na temat naszego sklepu. Będziemy wdzięczni za propozycje zmian, które jeszcze bardziej usprawnią obsługę i dostosują sklep do Państwa oczekiwań. Z góry bardzo dziękujemy!</p>
                        <p class="mb-20">Kontaktując się za pośrednictwem poczty elektronicznej otrzymacie Państwo szybką i fachową pomoc.
    Dodatkowo pod numerem telefonu mogą się Państwo skontaktować z naszym konsultantem.</p>
                        <p class="mb-5"><strong>Infolinia</strong> w godz. 8:00 - 15:00</p>
                        <p class="mb-5"><i class="far fa-mobile mr-10 color-purple"></i>Telefon komórkowy: <a class="color-purple fw-500" href="tel:997998999">997 998 999</a></p>
                        <p class="mb-5"><i class="far fa-phone mr-5 color-purple"></i>Telefon stacjonarny: <a class="color-purple fw-500" href="tel:123456789">123 456 789</a></p>
                        <p class="mb-20"><i class="far fa-envelope mr-5 color-purple"></i>E-mail: <a class="color-purple fw-500" href="mailto: snapbuy@gmail.com">snapbuy@gmail.com</a></p>
                        <p class="mb-5">Dane firmy:</p>
                        <p class="mb-5"><i class="far fa-building mr-10 color-purple"></i><strong>SnapBuy Sp. z o.o.</strong></p>
                        <p class="mb-5"><i class="far fa-map-marker-alt mr-10 color-purple"></i>ul. Wita Stwosza 57, 80-308 Gdańsk</p>
                        <p class="mb-5"><i class="fas fa-globe-europe mr-8 color-purple"></i>woj. pomorskie, Polska</p>
                        <p class="mb-5"><i class="far fa-paperclip mr-5 color-purple"></i>NIP: 101-102-01-02</p>
                        <p><i class="far fa-pencil mr-5 color-purple"></i>REGON: 987654321</p>
                    </div>
                </div>
                <div class="col-12 offset-sm-1 col-sm-10 offset-md-2 col-md-8 offset-lg-0 col-lg-6 offset-xl-2 col-xl-5">
                    <div class="contact-form-section">
                      <a class="anchor" id="formularz"></a>
                      <form name="contactForm" action="" novalidate="novalidate" method="post">
                        <h3 class="fw-400 t-center mb-sm-50">NAPISZ DO NAS</h3>
                        <div class="form-field">
                          <label for="imie">Imię</label>
                          <input type="text" name="imie" id="imie" class="required" required>
                        </div>
                        <div class="form-field">
                          <label for="nazwisko">Nazwisko</label>
                          <input type="text" name="nazwisko" id="nazwisko" class="required" required>
                        </div>
                        <div class="form-field">
                          <label for="email">E-mail</label>
                          <input type="email" name="email" id="email" class="required" required>
                        </div>
                        <div class="form-field">
                          <label for="wiadomosc">Wiadomość</label>
                          <textarea name="wiadomosc" id="wiadomosc" class="required" required></textarea>
                        </div>
                        <div class="form-field checkbox">
                          <input type="checkbox" id="horns" name="horns" class="required">
                          <label for="horns">Przeczytałem i akceptuje <a class="color-purple fw-500" href="#">Regulamin</a></label>
                        </div>
                        <button type="submit" form="contactForm" class="btn full">Wyślij</button>
                      </form>
                      <script>
                        $(document).ready(function () {
                          /* VALIDATE */
                          $("#contactForm").validate({
                            ignore: ":disabled, :hidden"
                          });
                        });
                      </script>
                    </div>
                </div>
            </div>
		</div>

    </section>

    <!-- COUNTING SECTION -->
    <section class="full counting-section">
        <div class="container">
            <h2 class="t-center color-light mb-40 mb-lg-100">Zaufaj nam!</h2>
        <div class="row">
            <div class="col-12 col-md-4 d-flex">
                <article class="mb-60 mb-md-0">
                  <?php
                    $countuser = $conn->prepare('SELECT COUNT(id) FROM users');
                    $countuser->execute();
                    $count = $countuser->fetch(PDO::FETCH_COLUMN);
                      echo'
                            <div class="i-icon"><i class="far fa-users"></i></div>
                          <span class="fs-lg-18 t-center pb-20 pb-lg-30">Jest już z nami</span>
                          <span class="fs-30 fw-700 pb-20 pb-lg-30">'.$count.'</span>
                          <span class="fs-16 fs-lg-20 t-center fw-600">użytkowników</span>
                      ';
                  ?>
                </article>
            </div>
            <div class="col-12 col-md-4 d-flex">
                <article class="mb-60 mb-md-0">
                  <?php
                      $countproducts = $conn->prepare('SELECT COUNT(ID) FROM buynow WHERE End is NULL');
                      $countproducts->execute();
                      $countp = $countproducts->fetch(PDO::FETCH_COLUMN);
                      echo'
                            <div class="i-icon"><i class="far fa-laptop"></i></div>
                          <span class="fs-lg-18 t-center pb-20 pb-lg-30">Na naszej stronie kupisz</span>
                          <span class="fs-30 fw-700 pb-20 pb-lg-30">'.$countp.'</span>
                          <span class="fs-16 fs-lg-20 t-center fw-600">urządzeń od ręki</span>
                      ';
                  ?>
                </article>
            </div>
            <div class="col-12 col-md-4 d-flex">
                <article>
                  <?php
                    $GetQuantity = $conn->prepare('SELECT value FROM statistics where name="orders"');
                    $GetQuantity->execute();
                    $value = $GetQuantity->fetch(PDO::FETCH_COLUMN);
                      echo'
                            <div class="i-icon"><i class="far fa-shopping-cart"></i></div>
                          <span class="fs-lg-18 t-center pb-20 pb-lg-30">Użytkownicy kupili</span>
                          <span class="fs-30 fw-700 pb-20 pb-lg-30">'.$value.'</span>
                          <span class="fs-16 fs-lg-20 t-center fw-600">urządzeń</span>
                      ';
                  ?>
                </article>
            </div>
        </div>
        </div>
    </section>

  </main>

<?php include ( '_footer.php' ); ?>
