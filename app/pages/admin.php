<main id="admin" class="wrapper">

	<?php

	$admin = new AuthAdmin();

	if (isset($_GET["logout"])) {
		$admin->out();
	}
	if (isset($_POST["name"], $_POST["passwd"])) {
		if (!$admin->in($_POST["name"], $_POST["passwd"])) {
			echo "<p class='error mtb fsb tac'>Špatně zadané údaje</p>";
		}
	}

	if ($admin->is_logged()): ?>
		<p class="fl"><a href="<?= ZKUSEBNA_APACHE_ROOT_URL ?>" class="button">Rezervace</a></p>
		<p class="fr"><a href="?page=admin&logout" class="button--red">Odhlásit</a></p>

		<h2 class="clear">Rezervace ke schválení</h2>
		<div id="unapproved-reservations" class="reservation-list editable-list"></div>

		<h2>Schválené rezervace</h2>
		<div id="approved-reservations" class="reservation-list editable-list"></div>

		<h2>Opakované rezervace</h2>
		<div id="repeated-reservations" class="reservation-list editable-list"></div>

		<h2 class="help tooltip dib" data-message="Slouží k odlišení rezervací na farní, osobní a jiné účely. Účel může poskytnout procentuální slevu na všechny položky">Účel rezervace</h2>
		<form method="post" id="add-purpose">
			<h3>Přidat nový</h3>
			<ul class="table cols-3">
				<li class="tar pr">
					<input type="text" name="purpose" placeholder="Název"/>
				</li>
				<li class="tac" data-column="price">
					<input type="text" name="discount" placeholder="Sleva" class="mrs"/>%
				</li>
				<li class="tal pl">
					<button type="submit">Uložit</button>
				</li>
			</ul>
		</form>
		<h3>Upravit existující</h3>
		<div id="edit-purpose"></div>

		<h2>Správa položek</h2>
		<form method="post" id="add-item" class="add-form" enctype="multipart/form-data">
			<h3>Přidat novou položku</h3>
			<input type="text" name="name" placeholder="Název"/>
			<input type="text" name="price" placeholder="Cena"/>
			<input type="file" name="image" placeholder="Obrázek"/>
			<div class="input">
				<input id="item-reservable" type="checkbox" name="reservable" checked="checked"/>
				<label for="item-reservable">Rezervovatelná <small>(nerezervovatelná položka bude braná jako podkategorie)</small></label>
			</div>
			<progress></progress>
			<button type="submit">Uložit</button>
			<span class="close icon-close"></span>
		</form>
		<form method="post" id="add-image" class="add-form" enctype="multipart/form-data">
			<h3>Přidat nový obrázek</h3>
			<input type="file" name="image" placeholder="Obrázek"/>
			<progress></progress>
			<button type="submit">Uložit</button>
			<span class="close icon-close"></span>
		</form>
		<h3>Upravit existující</h3>
		<div id="items" class="editable-list"></div>

	<?php else: ?>
		<form action="?page=admin" method="post" class="tac">
			<fieldset>
				<legend>Přihlaste se</legend>
				<ul class="no-style">
					<li>
						<input type="text" name="name" placeholder="Jméno"/>
					</li>
					<li>
						<input type="password" name="passwd" placeholder="Heslo"/>
					</li>
				</ul>
				<p><button type="submit">Přihlásit</button></p>
			</fieldset>
		</form>
	<?php endif; ?>
</main>