<?php
session_start();
include_once("app/core/inc/bootstrap.php");

$sql = new mysql();
$auth = new AuthAdmin();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Zkušebna Kobylisy</title>
	<link rel="stylesheet" href="<?= ZKUSEBNA_CSS_URL; ?>site.css?<?= time() ?>"/>
	<?php /*?>
	<link rel="stylesheet" href="<?= ZKUSEBNA_CSS_URL; ?>site.min.css?15062017"/>
	<?php */?>
</head>
<body<?= $auth->is_logged() ? ' class="admin-logged"' : '' ?>>
<noscript>
	<p>Bez javascriptu se na této stránce nepohnete</p>
</noscript>
<script type="text/javascript">
	var AJAX_URL = '<?= ZKUSEBNA_APACHE_ROOT_URL ?>app/core/ajax/';
</script>

<?php

const PAGES_URL = "app/pages/";

$page = isset($_GET["page"]) ? $_GET["page"] : "homepage";

switch ($page) {
	case "reserve": 	include_once(PAGES_URL . "reserve.php"); break;
	case "admin": 		include_once(PAGES_URL . "admin.php"); break;
	default: 			include_once(PAGES_URL . "homepage.php");
}
?>

<script type="text/javascript" src="<?= ZKUSEBNA_JS_URL; ?>all.js?<?= time() ?>"></script>
<?php /*?>
<script type="text/javascript" src="<?= ZKUSEBNA_JS_URL; ?>all.min.js?15062017"></script>
<?php */?>
</body>
</html>