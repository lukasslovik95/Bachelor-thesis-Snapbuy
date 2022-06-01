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
    <section class="slider-section full">
      <div class="container">
        <div id="slickAdBanner">
          <a title="" href="#" target="_blank" class="ol-none">
            <img src="_media/banner1.jpg" class="m-0">
          </a>
          <a title="" href="#" target="_blank" class="ol-none">
            <img src="_media/banner2.jpg" class="m-0">
          </a>
          <a title="" href="#" target="_blank" class="ol-none">
            <img src="_media/banner3.jpg" class="m-0">
          </a>
          <a title="" href="business-laptop.php" target="_blank" class="ol-none">
            <img src="_media/banner4.jpg" class="m-0">
          </a>
        </div>
        <script>
          $('#slickAdBanner').slick({
            lazyLoad: 'ondemand',
            dots: true,
            arrows:true,
            autoplay: true,
            autoplaySpeed: 5000,
            infinite: true,

            fade: true,
            slidesToScroll: 1,
            pauseOnHover: true,
            swipeToSlide:true,
            centerMode: false,
            touchThreshold: 15,
            variableWidth: false,
            variableHeight: false,
            responsive: [
              {
                breakpoint: 1350,
                settings: {
                  slidesToShow: 3
                }
              },
              {
                breakpoint: 991,
                settings: {
                  slidesToShow: 2
                }
              },
              {
                breakpoint: 690,
                settings: {
                  slidesToShow: 1
                }
              }
            ]
          });
        </script>
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

    <!-- PRODUCTS SECTION -->
      <div class="container bx-rel">
          <h2 class="mt-40 mb-40">Galeria zdjęć naszych produktów</h2>
          <div class="row">
              <div class="col-6 col-md-4 p-10 p-sm-20 p-lg-30">
                  <a data-fancybox="gallery" rel="group-1" href="_media/1.jpg" class="full">
                      <img src="_media/1.jpg" alt="" class="full">
                      <div class="mt-20 color-normal t-center">
                          <p class=""><strong>Laptop HP Model ABC</strong></p>
                          <p class="">2499 zł</p>
                          <p class="">Sprawdź ofertę ></p>
                      </div>
                  </a>
              </div>
              <div class="col-6 col-md-4 p-10 p-sm-20 p-lg-30">
                  <a data-fancybox="gallery" rel="group-1" href="_media/2.jpg" class="full">
                      <img src="_media/2.jpg" alt="" class="full">
                      <div class="mt-20 color-normal t-center">
                          <p class=""><strong>Laptop Lenovo Model Fiesta</strong></p>
                          <p class="">2999 zł</p>
                          <p class="">Sprawdź ofertę ></p>
                      </div>
                  </a>
              </div>
              <div class="col-6 col-md-4 p-10 p-sm-20 p-lg-30">
                  <a data-fancybox="gallery" rel="group-1" href="_media/3.jpg" class="full">
                      <img src="_media/3.jpg" alt="" class="full">
                      <div class="mt-20 color-normal t-center">
                          <p class=""><strong>Laptop HP Model XYZ</strong></p>
                          <p class="">2299 zł</p>
                          <p class="">Sprawdź ofertę ></p>
                      </div>
                  </a>
              </div>
              <div class="col-6 col-md-4 p-10 p-sm-20 p-lg-30">
                  <a data-fancybox="gallery" rel="group-1" href="_media/1.jpg" class="full">
                      <img src="_media/1.jpg" alt="" class="full">
                  </a>
                  <div class="mt-20 color-normal t-center">
                      <p class=""><strong>Laptop HP Model ABC</strong></p>
                      <p class="">2499 zł</p>
                      <p class="">Sprawdź ofertę ></p>
                  </div>
              </div>
              <div class="col-6 col-md-4 p-10 p-sm-20 p-lg-30">
                  <a data-fancybox="gallery" rel="group-1" href="_media/2.jpg" class="full">
                      <img src="_media/2.jpg" alt="" class="full">
                  </a>
                  <div class="mt-20 color-normal t-center">
                      <p class=""><strong>Laptop Lenovo Model Fiesta</strong></p>
                      <p class="">2999 zł</p>
                      <p class="">Sprawdź ofertę ></p>
                  </div>
              </div>
              <div class="col-6 col-md-4 p-10 p-sm-20 p-lg-30">
                  <a data-fancybox="gallery" rel="group-1" href="_media/3.jpg" class="full">
                      <img src="_media/3.jpg" alt="" class="full">
                  </a>
                  <div class="mt-20 color-normal t-center">
                      <p class=""><strong>Laptop HP Model XYZ</strong></p>
                      <p class="">2299 zł</p>
                      <p class="">Sprawdź ofertę ></p>
                  </div>
              </div>
          </div>
      </div>

  </main>

<?php include ( '_footer.php' ); ?>
