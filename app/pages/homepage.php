<div class="wrapper">
	<?php if($auth->is_logged()): ?>
		<!--a class="button" href="?page=admin">Zpět</a-->
		<p class="fr"><a href="?page=admin&logout" class="button--red">Odhlásit</a></p>
		<button onclick="$.ajax({
				method: 'POST',
				url: AJAX_URL + 'fill-reservation-price.php',
				dataType: 'json',
				data: '',
				success: function(result) {
					console.log(result);
				},
				error: function(e) {
					alert(error);
					console.log(e);
				}
		})">fill prices</button>
	<?php else: ?>
		<!--a class="button" href="<?= ZKUSEBNA_APACHE_ROOT_URL ?>">Zpět</a-->
	<?php endif; ?>


	<h1>Vítejte na rezervační stránce kobyliské zkušebny</h1>
	<p>Tyto stránky slouží jako rezervační systém <strong>pouze pro potřeby farnosti Kobylisy</strong> nebo výjimečně po dohodě se správcem zkušebny i jiným zájemcům.</p>
	<p>Zde si můžete k zapůjčení rezervovat zkušebnu, zvukovou techniku a hudební nástroje.</p>
	<h2>Jak rezervovat</h2>
	<ol>
		<li>V kalendáři zjistěte, zda váš termín nekoliduje s jinou rezervací.</li>
		<li>Zvolte si datum a čas rezervace.</li>
		<li>Vyplňte všechny požadované údaje jako název akce (např. svatba Josefky Novákové), jméno a kontakt toho, kdo si rezervuje a účel rezervace.</li>
		<li>Vyberte si položky (u položek uvidíte, zda je možné je rezervovat).</li>
		<li>Rezervaci odešlete a vyčkejte na její schválení.</li>
		<li>Případnou platbu poukazujte na účet číslo <strong><?= Zkusebna::getFormattedAccountNumber() ?></strong> (preferujeme), <strong>do zprávy pro příjemce napište název akce</strong>.<br>Nebo hotově správci zkušebny.</li>
	</ol>
	<p class="h2">Pomoc, dotazy a připomínky na <strong>zkusebna.kobylisy@centrum.cz</strong></p>

	<ul class="tabs">
		<li><a class="active" href="#homepage">Kalendář</a></li>
		<li><a href="#reserve">Rezervace</a></li>
	</ul>
</div>
<main id="homepage" class="wrapper">

	<!--a class="button" href="?page=reserve">Rezervovat</a-->

	<ul class="legend">
		<li class="zkusebna">Zkušebna</li>
		<li class="technika">Technika</li>
		<li class="nastroje">Nástroje</li>
	</ul>
	<div id="calendar"></div>

</main>
<main id="reserve" class="wrapper" style="display: none;">

	<form action="" method="post" id="form__reserve">
		<fieldset class="date">
			<legend>Zvolte termín vypůjčení</legend>
			<ul class="table cols-2 pt mbn">
				<li class="tar pr">
										<input value="5.11.2017 08:00" type="text" name="date_from" data-role="render" id="date_from" class="datetimepicker" data-date-type="from" data-connected-to="#date_to"  placeholder="Datum a čas výpůjčky"/>
<!--					<input class="datetimepicker" data-role="render" type="text" name="date_from" id="date_from" data-date-type="from" data-connected-to="#date_to" placeholder="Datum a čas výpůjčky"/>-->
				</li>
				<li class="tal pl">
										<input value="05.11.2017 12:00" type="text" name="date_to" data-role="render" id="date_to" class="datetimepicker" data-date-type="to" data-connected-to="#date_from"  placeholder="Datum a čas navrácení"/>
<!--					<input class="datetimepicker" data-role="render" type="text" name="date_to" id="date_to" data-date-type="to" data-connected-to="#date_from" placeholder="Datum a čas navrácení"/>-->
				</li>
			</ul>
		</fieldset>
		<fieldset class="contact">
			<legend>Vyplňte kontaktní údaje</legend>
			<ul class="inline-blocks tac pt pln">
				<li>
										<input type="text" name="reservation_name" id="reservation_name" placeholder="Název akce" value="Mejdan!"/>
<!--					<input type="text" name="reservation_name" id="reservation_name" placeholder="Název akce" />-->
				</li>
				<li>
										<input type="text" name="name" id="name" placeholder="Celé jméno" value="Jafa Kree"/>
<!--					<input type="text" name="name" id="name" placeholder="Celé jméno"/>-->
				</li>
				<li>
										<input type="text" name="phone" id="phone" placeholder="Telefon" value="123123123"/>
<!--					<input type="text" name="phone" id="phone" placeholder="Telefon"/>-->
				</li>
				<li>
										<input type="email" name="email" id="email" placeholder="Email" value="ondr@centrum.cz"/>
<!--					<input type="email" name="email" id="email" placeholder="Email"/>-->
				</li>
				<li>
					<?php
					$items = new Items();
					print $items->getSelectPurpose();
					?>
				</li>
			</ul>
		</fieldset>
		<?php if($auth->is_logged()): ?>
			<fieldset class="repeat">
				<legend>Opakování</legend>
				<ul class="table cols-2 pt">
					<li class="tar prb">
						<select name="repeat_type" id="repeat">
							<option disabled selected>Vyberte četnost</option>
							<option value="weekly">Jednou týdně</option>
							<option value="weekly2">Jednou za 14 dní</option>
							<option value="monthly">Jednou za měsíc</option>
						</select>
					</li>
					<li class="tal plb">
						<!--						<input class="datetimepicker" data-role="check" type="text" name="repeat_to" id="repeat_to" data-type="date" placeholder="Opakovat do" value="29.04.2016"/>-->
						<input class="datetimepicker" data-role="check" type="text" name="repeat_to" id="repeat_to" data-type="date" data-date-type="to" data-connected-to="#repeat_from" placeholder="Opakovat do"/>
					</li>
				</ul>
			</fieldset>
		<?php endif; ?>
	</form>

	<div id="reserved-items-wrapper" class="empty">
		<div id="reserved-items"></div>
	</div>

	<div id="items-wrapper"></div>

</main>