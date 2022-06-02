<?php include ( '_header-start.php' ); ?>

<?php

require 'database.php';

if( isset($_SESSION['user_id']) ){

	$records = $conn->prepare('SELECT id,email,name,unique_id,password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}
}

?>

<header class="header full" id="navbar_top">

  <div class="container d-flex justify-content-between h100">

    <div class="col d-flex align-items-center header-logo">
      <a class="click-effect2 font-bungee d-flex align-items-center fs-40 fs-xl-50 color-normal" href="index.php" title="Snap-Buy">
        <span class="i-logo">SNAP</span>
        <img class="d-lg-inline" src="img/3-6.png" alt="Snap-Buy">
        <span class="i-logo">BUY</span>
      </a>
    </div>

    <div class="bx-rel">

      <a href="javascript:void(0);" role="menu-opener" class="menu-opener bx-abs" data-target="#topMenu">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </a>

      <nav role="navigation" class="top-menu" id="topMenu">
        <ul class="top-menu-in navbar-links sm" id="main-menu">
          <li class="bx-rel"><a class="has-submenu" data-sm-horizontal-sub="true" data-scroll-hash href="kategorie.php">Kategorie</a>
            <ul>
              <li><a href="kup-teraz.php" class="menu-scroll">Kup teraz</a></li>
              <li><a href="ShowAuctions.php" class="menu-scroll">Aukcja</a></li>
            </ul>
          </li>
		  <?php if( !empty($user) && $user['email'] == 'admin@snapbuy.pl'): ?>
		  <li><a class="menu-scroll" href="admin-panel.php">Panel admina</a></li>
		  <?php endif; ?>
          <li><a class="menu-scroll" href="o-nas.php">O nas</a></li>
          <li><a class="menu-scroll" href="kontakt.php">Kontakt</a></li>
			<?php if( !empty($user) ): ?>
				<li><a href="auction.php">Dodaj oferte</a></li>
				<li><a href="logout.php">Wyloguj</a></li>
			<?php else: ?>
				<li><a class="menu-scroll" type="button" data-toggle="modal" data-target="#registerModal">Rejestracja</a></li>
				<li><a class="menu-scroll" type="button" data-toggle="modal" data-target="#loginModal">Zaloguj się</a></li>
			<?php endif; ?>

        </ul>
      </nav>
    </div>

  </div>

</header>
