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
		<div class="kup-teraz-banner">
			<div><h1 class="color-white mt-50">Panel administratora</h1></div>
		</div>
    </section>

    <div class="container mt-40">
        <h2 class="h3">Oferty kup teraz</h2>
    </div>

	<?php
	$conn = mysqli_connect("localhost", "root", "", "snapbuy");

	if($conn === false){
		die("ERROR: Could not connect. "
		. mysqli_connect_error());
	}

	$ShowBuynow = mysqli_query($conn, "SELECT * FROM buynow WHERE End is NULL");
	$row = mysqli_fetch_array($ShowBuynow);

	foreach($ShowBuynow as $row){

		echo'
		<section class="container offers-section">
			<article>
				<img src="data:image/jpeg;base64,'.base64_encode( $row['Image1'] ).'" class="order-1"/>
				<div class="i-text order-0 order-md-2">
					<div>
						<strong class="d-inline-block fs-20 mb-10">'.$row['Producer'].'</strong>
						<p class="t-justify mb-20 mb-md-0">'.$row['Description'].'</p>
					</div>
                <div class="d-none d-md-flex flex-column flex-lg-row justify-content-between fs-14 fs-sm-16 fs-lg-18 mt-20">
                    <div class="d-flex align-items-center justify-content-end justify-content-lg-start">
                        <p class="mr-40">'.$row['Producer'].'</p>
                        <p>'.$row['Application'].'</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-end justify-content-lg-start mt-20 mt-lg-0">
                        <p class="mr-40">'.$row['Price'].'</p>
						<form method="POST" action="delete-item.php">
							<input type="hidden" name="ID" value='.$row['ID'].'>
							<input type="submit" name="more" class="btn  btn-delete" value="Usuń">
						</form>
                    </div>
                </div>
            </div>
            <div class="d-flex d-md-none flex-column flex-lg-row justify-content-between fs-14 fs-sm-16 fs-lg-18 mt-20 order-3">
                <div class="d-flex align-items-center justify-content-end justify-content-lg-start">
                    <p class="mr-30">'.$row['Producer'].'</p>
                    <p>'.$row['Application'].'</p>
                </div>
                <div class="d-flex align-items-center justify-content-end justify-content-lg-start mt-20 mt-lg-0">
                    <p class="mr-30">'.$row['Price'].'</p>
                    <form method="POST" action="delete-item.php">
						<input type="hidden" name="ID" value='.$row['ID'].'>
						<input type="submit" name="more" class="btn  btn-delete" value="Usuń">
					</form>
                </div>
            </div>
        </article>
		';
		$ID = $row['ID'];
		$CurrentDate = date("Y-m-d");
		$Start = $CurrentDate;
		$End   = $row['Data'];
		if($Start == $End){
			$InsertEnd = mysqli_query($conn,"UPDATE buynow SET End = 'Yes' WHERE ID='$ID'");
		}'
    </section>
	';
	}


	?>

    <div class="container mt-40">
        <h2 class="h3">Licytacje</h2>
    </div>

    <?php
	$conn = mysqli_connect("localhost", "root", "", "snapbuy");

	if($conn === false){
		die("ERROR: Could not connect. "
		. mysqli_connect_error());
	}

	$ShowBuynow = mysqli_query($conn, "SELECT * FROM auctions WHERE End is NULL");
	$row = mysqli_fetch_array($ShowBuynow);

	foreach($ShowBuynow as $row){

		echo'
		<section class="container offers-section">
			<article>
				<img src="data:image/jpeg;base64,'.base64_encode( $row['Image1'] ).'" class="order-1"/>
				<div class="i-text order-0 order-md-2">
					<div>
						<strong class="d-inline-block fs-20 mb-10">'.$row['Producer'].'</strong>
						<p class="t-justify mb-20 mb-md-0">'.$row['Description'].'</p>
					</div>
                <div class="d-none d-md-flex flex-column flex-lg-row justify-content-between fs-14 fs-sm-16 fs-lg-18 mt-20">
                    <div class="d-flex align-items-center justify-content-end justify-content-lg-start">
                        <p class="mr-40">'.$row['Producer'].'</p>
                        <p>'.$row['Application'].'</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-end justify-content-lg-start mt-20 mt-lg-0">
                        <p class="mr-40">'.$row['Price'].'</p>
						<form method="POST" action="delete-item2.php">
							<input type="hidden" name="ID" value='.$row['ID'].'>
							<input type="submit" name="more" class="btn  btn-delete" value="Usuń">
						</form>
                    </div>
                </div>
            </div>
            <div class="d-flex d-md-none flex-column flex-lg-row justify-content-between fs-14 fs-sm-16 fs-lg-18 mt-20 order-3">
                <div class="d-flex align-items-center justify-content-end justify-content-lg-start">
                    <p class="mr-30">'.$row['Producer'].'</p>
                    <p>'.$row['Application'].'</p>
                </div>
                <div class="d-flex align-items-center justify-content-end justify-content-lg-start mt-20 mt-lg-0">
                    <p class="mr-30">'.$row['Price'].'</p>
                    <form method="POST" action="delete-item2.php">
						<input type="hidden" name="ID" value='.$row['ID'].'>
						<input type="submit" name="more" class="btn  btn-delete" value="Usuń">
					</form>
                </div>
            </div>
        </article>
		';
		$ID = $row['ID'];
		$CurrentDate = date("Y-m-d");
		$Start = $CurrentDate;
		$End   = $row['Data'];
		if($Start == $End){
			$InsertEnd = mysqli_query($conn,"UPDATE buynow SET End = 'Yes' WHERE ID='$ID'");
		}'
    </section>
	';
	}


	?>



  </main>

<?php include ( '_footer.php' ); ?>
