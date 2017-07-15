<head>
	<title>Все ссылки</title>
</head>
<body>
<a href="/">Назад</a><br/><br/>
<?php if(isset($urls)): ?>
	<table border="1">
		<tr>
			<td>Полная ссылка</td>
			<td>Короткая ссылка</td>
		</tr>
	<?php foreach($urls as $url): ?>
		<tr>
			<td style="width: 70%;"><a href="<?=$url->url?>" target="_blank"><?=$url->url?></a></td>
			<td style="width: 30%;"><a href="<?=$url->url?>" target="_blank"><?=$url->shortURL?></a></td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</body>
