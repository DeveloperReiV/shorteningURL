<head>
	<title>Сокращение ссылки</title>
</head>
<body>
	<form>
		<table>
		<tr>
			<td><label>Полный URL<sup>*</sup></label></td>
			<td><input type="url" id="url" style='width:700px;'/></td>
		</tr>
		<tr>
			<td><label>Собственный URL</label></td>
			<td><input type="url" id="main_url" style='width:700px;'/></td>
		</tr>
		<tr>
			<td><input type="button" id="createBTN" value="Сократить"></td>
		<tr>
		</table>
	</form>
	<label><sup>*</sup> Поле обязятельно для заполнения</label>
	<hr>

	<?php if($status):?>
		<p style='color:red;'><?=$status?></p>
	<?php endif;?>

	<?php if($url && $short_url):?>
		<p>Короткий URL: <a href='<?=$url?>' target="_blank"><?=$short_url?></a></p>
		<hr>
	<?php endif;?>
<a href="main/all" id="all_show">Показать все</a>
</body>