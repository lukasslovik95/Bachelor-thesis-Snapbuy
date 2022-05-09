<?php
session_start();
?>

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

<?php if( !empty($user) ): ?>

<?php include ( '_header.php' ); ?>



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
		<div class="kup-teraz-banner">
			<div><h1 class="color-white mt-50">Dodaj aukcje</h1></div>
		</div>
    </section>

	<div class="container mt-20 mt-md-40 mt-lg-60" style="max-width: 400px;">		

			<form action="InsertAuction.php" method="post" enctype="multipart/form-data">
                <div class="form-field">
					<label for="producer">Producent:</label>
					<?php
						$conn = mysqli_connect("localhost", "root", "", "snapbuy");
		
						if($conn === false){
							die("ERROR: Could not connect. " 
							. mysqli_connect_error());
						}
						
						$list = mysqli_query($conn, "SELECT Name from producer");
						$row = mysqli_fetch_array($list);
						
						echo '<select name="Producer" id="producer" class="required" required>';
						foreach($list as $row){
							echo'						
								<option value="'.$row['Name'].'">'.$row['Name'].'</option>								
							';
						}
						echo '</select>';
					
					?>														
				</div>
                <div class="form-field">
					<label for="application">Zastosowanie:</label>
					<select name="Application" id="application" class="required" required>
						<option value="Biznesowy">Biznesowy</option>
						<option value="Gamingowy">Gamingowy</option>
						<option value="Domowy">Domowy</option>
					</select>
				</div>
                <div class="form-field">
					<label for="color">Kolor:</label>
					<input type="text" name="Color" id="color" class="required" required>
				</div>
                <div class="form-field">
					<label for="cpu">Procesor:</label>
					
					<?php											
						$list2 = mysqli_query($conn, "SELECT Name from cpu");
						$row2 = mysqli_fetch_array($list2);
						
						echo '<select name="Cpu" id="cpu" class="required" required>';
						foreach($list2 as $row2){
							echo'						
								<option value="'.$row2['Name'].'">'.$row2['Name'].'</option>								
							';
						}
						echo '</select>';
					
					?>
					
                </div>
                <div class="form-field">
					<label for="hdd">Pojemnośc dysku HDD:</label>
                    <select name="HDD" id="hdd" class="required" required>
                        <option value="Brak">Brak</option>
						<option value="250 GB">250 GB</option>
						<option value="500 GB">500 GB</option>
                        <option value="750 GB">750 GB</option>
                        <option value="1 TB">1 TB</option>
                        <option value="1,5 TB">1,5 TB</option>
                        <option value="2 TB">2 TB</option>
					</select>
				</div>
                <div class="form-field">
					<label for="ssd">Pojemnośc dysku SSD:</label>
                    <select name="SSD" id="ssd" class="required" required>
                        <option value="Brak">Brak</option>
                        <option value="128 GB">128 GB</option>
						<option value="250 GB">250 GB</option>
						<option value="500 GB">500 GB</option>
                        <option value="1 TB">1 TB</option>
                        <option value="2 TB">2 TB</option>
					</select>
				</div>
                <div class="form-field">
					<label for="screendiagonal">Przekątna ekranu:</label>
                    <select name="ScreenDiagonal" id="screendiagonal" class="required" required>
                        <option value="13 cali">13 cali</option>
                        <option value="14 cali">14 cali</option>
						<option value="15 cali">15 cali</option>
						<option value="17 cali">17 cali</option>
					</select>
                </div>
                <div class="form-field">
					<label for="resolution">Rozdzielczość:</label>
                    <select name="Resolution" id="resolution" class="required" required>
                        <option value="1280x720">1280×720 (16:9)</option>
                        <option value="1366×768">1366×768 (16:9)</option>
						<option value="1280×800">1280×800 (16:10)</option>
						<option value="1600×1024">1600×1024 (16:10)</option>
                        <option value="1680×1050">1680×1050 (16:10)</option>
                        <option value="1920×1080">1920×1080 (16:9)</option>
                        <option value="1920×1200">1920×1200 (16:10)</option>
                        <option value="2048×1152">2048×1152 (16:9)</option>
                        <option value="2560×1440">2560×1440 (16:9)</option>
					</select>
                </div>
                <div class="form-field">
					<label for="screenfrequency">Częstotliwość odświeżania:</label>
                    <select name="ScreenFrequency" id="screenfrequency" class="required" required>
                        <option value="60 Hz">60 Hz</option>
                        <option value="120 Hz">120 Hz</option>
						<option value="144 Hz">144 Hz</option>
						<option value="240 Hz">240 Hz</option>
                        <option value="360 Hz">360 Hz</option>
					</select>
                </div>
                <div class="form-field">
					<label for="matrixtype">Rodzaj matrycy:</label>
					
					<?php											
						$list3 = mysqli_query($conn, "SELECT Name from matrix");
						$row3 = mysqli_fetch_array($list3);
						
						echo '<select name="MatrixType" id="matrixtype" class="required" required>';
						foreach($list3 as $row3){
							echo'						
								<option value="'.$row3['Name'].'">'.$row3['Name'].'</option>								
							';
						}
						echo '</select>';
					
					?>
										
				</div>
                <div class="form-field">
					<label for="ram">Ilość pamięci RAM:</label>
                    <select name="RAM" id="ram" class="required" required>
                        <option value="4 GB">4 GB</option>
                        <option value="8 GB">8 GB</option>
						<option value="12 GB">12 GB</option>
                        <option value="16 GB">16 GB</option>
                        <option value="32 GB">32 GB</option>
                        <option value="64 GB">64 GB</option>
					</select>
				</div>
                <div class="form-field">
					<label for="ramtype">Podaj rodzaj pamięci RAM:</label>
                    <select name="RamType" id="ramtype" class="required" required>
                        <option value="DDR1">DDR1</option>
                        <option value="DDR2">DDR2</option>
						<option value="DDR3">DDR3</option>
                        <option value="DDR4">DDR4</option>
					</select>
				</div>
                <div class="form-field">
					<label for="networkcard">Podaj przepustowość karty sieciowej (MB/s):</label>
					<input type="number" name="NetworkCard" id="networkcard" class="required" required min="10">
				</div>
                <div class="form-field">
					<label for="bluetooth">Bluetooth:</label>
					<select name="Bluetooth" id="bluetooth" class="required" required>
						<option value="Tak">Tak</option>
						<option value="Nie">Nie</option>
					</select>
				</div>
                <div class="form-field">
					<label for="height">Podaj wysokość(cm):</label>
					<input type="number" step="0.01" name="Height" id="height" class="required" required min="1">
				</div>
                <div class="form-field">
					<label for="width">Podaj szerokość(cm):</label>
					<input type="number" step="0.01" name="Width" id="width" class="required" required min="10">
				</div>
                <div class="form-field">
					<label for="depth">Podaj głębokość(cm):</label>
					<input type="number" step="0.01" name="Depth" id="depth" class="required" required min="10">
				</div>
                <div class="form-field">
					<label for="weight">Podaj wagę(kg):</label>
					<input type="number" step="0.01" name="Weight" id="weight" class="required" required min="0.5">
				</div>
                <div class="form-field">
					<label for="date">Podaj date zakończenia:</label>
					<input type="date" name="Data" id="date" class="required" required>
				</div>
                <div class="form-field">
					<label for="price">Podaj cene (PLN):</label>
					<input type="number" step="0.01" name="Price" id="price" class="required" required min="0.01">
				</div>
                <div class="form-field">
					<label for="description">Podaj opis:</label>
					<input type="text" name="Description" id="description" class="required" required minlength="250">
				</div>
                <div class="form-field">
					<label for="image1">Wybierz zdjęcie1:</label>
					<input type="file" id="image" name="Image1" accept=".jpg, .jpeg, .png" class="required" required>
				</div>
                <div class="form-field">
					<label for="image2">Wybierz zdjęcie2:</label>
					<input type="file" id="image2" name="Image2" accept=".jpg, .jpeg, .png" class="required" required>
				</div>
                <div class="form-field">
					<label for="image3">Wybierz zdjęcie3:</label>
					<input type="file" id="image3" name="Image3" accept=".jpg, .jpeg, .png" class="required" required>
				</div>
                <div class="form-field">
					<label for="image4">Wybierz zdjęcie4:</label>
					<input type="file" id="image4" name="Image4" accept=".jpg, .jpeg, .png" class="required" required>
				</div>
                <div class="form-field">
					<label for="image5">Wybierz zdjęcie5:</label>
					<input type="file" id="image5" name="Image5" accept=".jpg, .jpeg, .png" class="required" required>
				</div>
                <div class="form-field">
					<label for="image6">Wybierz zdjęcie6:</label>
					<input type="file" id="image6" name="Image6" accept=".jpg, .jpeg, .png" class="required" required>
				</div>
                <div class="form-field">
					<label for="image7">Wybierz zdjęcie7:</label>
					<input type="file" id="image7" name="Image7" accept=".jpg, .jpeg, .png" class="required" required>
				</div>
                <div class="form-field">
					<label for="image8">Wybierz zdjęcie8:</label>
					<input type="file" id="image8" name="Image8" accept=".jpg, .jpeg, .png" class="required" required>
				</div>
                <div class="form-field checkbox">
					<input type="checkbox" id="Aukcja" name="Aukcja" class="required">
					<label for="Aukcja">Aukcja</label>
                </div>
				
				<input class="btn" type="submit">
			</form>
		
	</div>

    <hr class="mt-20 mt-md-40 mt-lg-60" />

  </main>


<?php include ( '_footer.php' ); ?>

<?php else: ?>
<h3>Zaloguj się</h3>
<?php endif; ?>
