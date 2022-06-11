<?php session_start(); ?>

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


	<?php
		$conn = mysqli_connect("localhost", "root", "", "snapbuy");

		if($conn === false){
			die("ERROR: Could not connect. "
			. mysqli_connect_error());
		}

		$ID = $_REQUEST['ID'];
		$ShowBuyNow = mysqli_query($conn, "SELECT * FROM buynow WHERE ID='$ID'");
		$row = mysqli_fetch_array($ShowBuyNow);

	?>

    <!-- A'LA HERO DIV -->

	<section class="container single-item-hero">
		<div class="row">
            <div class="col-12 offset-sm-1 col-sm-10 offset-md-2 col-md-8 offset-lg-0 col-lg-6 col-xl-5 single-item-gallery-section order-1">
          <div class="slider-for mb-20">
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image1'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image2'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image3'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image4'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image5'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image6'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image7'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image8'] ).'" class="order-1"/>'; ?>
            </div>
          </div>
          <div class="slider-nav">
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image1'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image2'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image3'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image4'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image5'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image6'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image7'] ).'" class="order-1"/>'; ?>
            </div>
            <div>
              <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row['Image8'] ).'" class="order-1"/>'; ?>
            </div>
          </div>
          <script>
          $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
            });
            $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
               {
                 breakpoint: 475,
                 settings: {
                   slidesToShow: 2,
                 }
               },
               {
                 breakpoint: 400,
                 settings: {
                   slidesToShow: 1,
                 }
               },
               {
                 breakpoint: 275,
                 settings: {
                   dots: false,
                 }
               }

             ]
            });
		  </script>
        </div>
            <div class="col-12 offset-md-1 col-md-10 offset-lg-0 col-lg-6 offset-xl-1 order-0 order-lg-2 d-flex flex-column justify-content-between">
                <div>
                    <h1 class="mb-40 t-center t-lg-left"><?php echo $row['Producer']; ?></h1>
                    <p class="mb-40"><?php echo $row['Description']; ?></p>
                    <hr>
                    <div class="i-text">
                        <i class="fad fa-square fs-30"></i><p class="h6 i-header">CPU</p>
                        <p class="mt-10 mt-sm-0"><span class="d-none d-sm-inline">&nbsp;-&nbsp;</span><?php echo $row['Cpu']; ?></p>
                    </div>
                    <hr>
                    <div class="i-text">
                        <i class="fad fa-hdd fs-30"></i><p class="h6 i-header">HDD</p>
                        <p class="mt-10 mt-sm-0"><span class="d-none d-sm-inline">&nbsp;-&nbsp;</span><?php echo $row['HDD']; ?></p>
                    </div>
                    <hr>
                    <div class="i-text">
                        <i class="fad fa-tv-retro fs-30"></i><p class="h6 i-header">WYSWIETLACZ</p>
                        <p class="mt-10 mt-sm-0"><span class="d-none d-sm-inline">&nbsp;-&nbsp;</span>Matowy, <?php echo $row['MatrixType']; ?>, <?php echo $row['Resolution']; ?></p>
                    </div>
                    <hr>
                    <div class="i-text">
                        <i class="fad fa-memory fs-30"></i><p class="h6 i-header">RAM</p>
                        <p class="mt-10 mt-sm-0"><span class="d-none d-sm-inline">&nbsp;-&nbsp;</span><?php echo $row['RAM']; ?></p>
                    </div>
                    <hr>
                    <div class="i-text">
                        <i class="fad fa-router fs-30"></i><p class="h6 i-header">KARTA SIECIOWA</p>
                        <p class="mt-10 mt-sm-0"><span class="d-none d-sm-inline">&nbsp;-&nbsp;</span><?php echo $row['NetworkCard']; ?>Mb/s</p>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center mb-40">
                        <p class="mr-20">Przewiń do pełnej specyfikacji</p>
                        <a class="btn btn-secondary btn-round"><i class="fas fa-chevron-double-down"></i></a>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="order-1 mb-20 mb-sm-0">
                        <a href="#" class="btn btn-secondary mr-20">POWRÓT</a>
						<?php
							if (!empty($user)):
							echo
							'<form method="POST" action="BuyProduct.php">
								<input type="hidden" name="ID" value='.$row['ID'].'>
								<input type="hidden" name="User" value='.$user['email'].'>
								<input type="submit" name="add" value="KUP TERAZ" class="btn"/>
							</form>';
							else:

							echo '<h3>Zaloguj się aby zakupić przedmiot</h3>';

							endif;
						?>
                    </div>
                    <p class="h4 mb-0 order-0 order-sm-2 mb-20 mb-sm-0"><?php echo $row['Price']; ?>,00zł</p>
                </div>
            </div>
        </div>
    </section>

    <hr class="mt-md-50 mb-md-50 mb-20 mt-20">

    <!-- OPIS -->

    <section class="container-small">
        <div class="row">
            <div class="col-12">
				<?php
					$CPU = $row['Cpu'];
					$PRODUCER = $row['Producer'];
					$MATRIX = $row['MatrixType'];

					$ShowCpu = mysqli_query($conn, "SELECT * FROM cpu WHERE Name = '$CPU'");
					$ShowProducer = mysqli_query($conn, "SELECT * FROM producer WHERE Name = '$PRODUCER'");
					$ShowMatrix = mysqli_query($conn, "SELECT * FROM matrix WHERE Name = '$MATRIX'");

					$row2 = mysqli_fetch_array($ShowCpu);
					$row3 = mysqli_fetch_array($ShowProducer);
					$row4 = mysqli_fetch_array($ShowMatrix);
				?>
                <h2 class="t-center mb-20 mb-md-40">OPIS</h2>
                <h3><?php echo $row3['Name'];?></h3>
                <p class="t-justify"><?php echo $row3['Description'];?></p>
                <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row3['Img'] ).'" class="br-5 mt-20 mb-30 mb-md-40"/>'; ?>
                <h3><?php echo $row2['Name'];?></h3>
                <p class="t-justify"><?php echo $row2['Description'];?></p>
				<?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row2['Img'] ).'" class="br-5 mt-20 mb-30 mb-md-40"/>'; ?>
                <h3><?php echo $row4['Name'];?></h3>
                <p class="t-justify"><?php echo $row4['Description'];?></p>
                <?php echo'<img src="data:image/jpeg;base64,'.base64_encode( $row4['Img'] ).'" class="br-5 mt-20 mb-30 mb-md-40"/>'; ?>
            </div>
        </div>
    </section>

    <!-- FILMIK DLACZEGO MY -->

    <section class="single-item-video-section">
        <div>
            <div class="container">
                <h2 class="color-light mb-50">DLACZEGO MY</h2>
                <div>
                    <iframe class="i-video" src="https://www.youtube.com/embed/NpEaa2P7qZI" title="Dlaczego warto nam zaufać?" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- SPECYFIKACJA -->

    <section class="container">
        <h2 class="t-center mt-20 mt-md-50 mb-md-50">PEŁNA SEPCYFIKACJA</h2>
        <table class="table table-specification">
            <tbody>
                <tr><th class="t-center" colspan="2">Informacje podstawowe</th><th class="p-0"></th></tr>
                <tr>
                    <td class="t-right">Producent</td>
                    <td><?php echo $row['Producer']; ?></td>
                </tr>
                <tr>
                    <td class="t-right">Zastosowanie</td>
                    <td><?php echo $row['Application']; ?></td>
                </tr>
                <tr>
                    <td class="t-right">Kolor</td>
                    <td><?php echo $row['Color']; ?></td>
                </tr>
                <tr><th class="t-center" colspan="2">Procesor</th><th class="p-0"></th></tr>
                <tr>
                    <td class="t-right">Model procesora</td>
                    <td><?php echo $row['Cpu']; ?></td>
                </tr>
                <tr><th class="t-center" colspan="2">DYSK</th><th class="p-0"></th></tr>
                <tr>
                    <td class="t-right">Pojemność dysku SSD</td>
                    <td><?php echo $row['SSD']; ?> </td>
                </tr>
                <tr>
                    <td class="t-right">Pojemność dysku HDD</td>
                    <td><?php echo $row['HDD']; ?> </td>
                </tr>
                <tr><th class="t-center" colspan="2">Wyświetlacz</th><th class="p-0"></th></tr>
                <tr>
                    <td class="t-right">Przekątna ekranu</td>
                    <td><?php echo $row['ScreenDiagonal']; ?>"</td>
                </tr>
                <tr>
                    <td class="t-right">Rozdzielczość</td>
                    <td><?php echo $row['Resolution']; ?></td>
                </tr>
                <tr>
                    <td class="t-right">Typ matrycy</td>
                    <td><?php echo $row['MatrixType']; ?></td>
                </tr>
                <tr>
                    <td class="t-right">Częstotliwość odświeżania</td>
                    <td><?php echo $row['ScreenFrequency']; ?></td>
                </tr>
                <tr><th class="t-center" colspan="2">Pamięć RAM</th><th class="p-0"></th></tr>
                <tr>
                    <td class="t-right">Wielkość pamięci RAM</td>
                    <td><?php echo $row['RAM']; ?> </td>
                </tr>
                <tr>
                    <td class="t-right">Typ pamięci RAM</td>
                    <td><?php echo $row['RamType']; ?></td>
                </tr>
                <tr><th class="t-center" colspan="2">Łączność</th><th class="p-0"></th></tr>
                <tr>
                    <td class="t-right">Karta sieciowa</td>
                    <td><?php echo $row['NetworkCard']; ?> Mb/s</td>
                </tr>
                <tr>
                    <td class="t-right">Bluetooth</td>
                    <td><?php echo $row['Bluetooth']; ?></td>
                </tr>
                <tr><th class="t-center" colspan="2">Wymiary</th><th class="p-0"></th></tr>
                <tr>
                    <td class="t-right">Wysokość [cm]</td>
                    <td><?php echo $row['Height']; ?></td>
                </tr>
                <tr>
                    <td class="t-right">Szerokość [cm]</td>
                    <td><?php echo $row['Width']; ?></td>
                </tr>
                <tr>
                    <td class="t-right">Głębokość [cm]</td>
                    <td><?php echo $row['Depth']; ?></td>
                </tr>
                <tr>
                    <td class="t-right">Waga [kg]</td>
                    <td><?php echo $row['Weight']; ?></td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- POLECANE PRODUKTY -->

    <section class="container recommended-section">
        <h2 class="t-center">POLECANE PRODUKTY</h2>
        <div id="slickRecommended">
          <a title="" href="#" target="_blank" class="ol-none">
            <img src="_media/laptoppng.png" class="pb-30 m-0">
            <p class="pb-30">Huawei MateBook D 15 i3-10110U/8GB/256/Win10 srebrny</p>
            <p>1 899,00 zł</p>
          </a>
          <a title="" href="#" target="_blank" class="ol-none">
            <img src="_media/laptop-3.png" class="pb-30 m-0">
            <p class="pb-30">Dell Inspiron G3 i5-10300H/16GB/1TB/W10 GTX1650Ti 144Hz</p>
            <p>4 099,00 zł</p>
          </a>
          <a title="" href="#" target="_blank" class="ol-none">
            <img src="_media/laptop-1.png" class="pb-30 m-0">
            <p class="pb-30">ASUS VivoBook R R564JA i3-1005G1/8GB/240/W10 Touch</p>
            <p>1 999,00 zł</p>
          </a>
          <a title="" href="#" target="_blank" class="ol-none">
            <img src="_media/laptop-2.png" class="pb-30 m-0">
            <p class="pb-30">ASUS VivoBook S15 M513IA R5-4500U/16GB/512/W10</p>
            <p>3 049,00 zł</p>
          </a>
          <a title="" href="#" target="_blank" class="ol-none">
            <img src="_media/laptop-1.png" class="pb-30 m-0">
            <p class="pb-30">Acer Nitro 5 i5-10300H/16GB/512 GTX1650Ti 144Hz</p>
            <p>3 549,00 zł</p>
          </a>
          <a title="" href="#" target="_blank" class="ol-none">
            <img src="_media/laptop-2.png" class="pb-30 m-0">
            <p class="pb-30">Lenovo ThinkBook 15 i5-1135G7/16GB/512/Win10P</p>
            <p>3 549,00 zł</p>
          </a>
          <a title="" href="#" target="_blank" class="ol-none">
            <img src="_media/laptop-3.png" class="pb-30 m-0">
            <p class="pb-30">Dell Vostro 3500 i5-1135G7/16GB/512/Win10P</p>
            <p>3 699,00 zł</p>
          </a>
        </div>
        <script>
        $('#slickRecommended').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
               {
                 breakpoint: 1275,
                 settings: {
                   slidesToShow: 3,
                 }
               },
               {
                 breakpoint: 750,
                 settings: {
                   slidesToShow: 2,
                 }
               },
               {
                 breakpoint: 550,
                 settings: {
                   slidesToShow: 1,
                 }
               }

             ]
        });
        </script>
    </section>

    <hr class="mt-0 hr">

  </main>

<?php include ( '_footer.php' ); ?>
