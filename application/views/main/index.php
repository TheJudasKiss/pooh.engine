<p><?=$title?></p>

<?php foreach ($news as $val): ?>
	<h3><?=$val['title']?></h3>
	<p><?=$val['msg']?></p>
	<hr>
<?php endforeach; ?>