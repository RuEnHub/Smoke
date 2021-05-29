<div onclick="time_info('none');add('none');edit('none');" id="gray"></div>
	<div id="add" class="modalWindow">
	<img class="close" src="img/close.png" alt=""  onclick="add('none')">
	<div class="form">
		<h2>Добавление игры</h2>
		<form method="post">
		    <input type="text" placeholder="Название игры" id="nameAdd" class="input">
		    <input type="text" placeholder="Путь к изображению" id="imageAdd" class="input" value="../img/01.png">
		    <textarea style="resize: none" id="textAdd" placeholder="Описание" rows="10" cols="36"></textarea>
		    <input type="date" id="yearAdd" class="input" value="<?=date("Y-m-d")?>" min="2001-01-01" max="<?=date("Y-m-d")?>">
		    <input type="text" placeholder="Ссылка на скачивание" id="downloadAdd" class="input">
		    <input type="submit" onclick="add('none')" value="Добавить" class="button" id="addbtn">
		</form>
	</div>
</div>

<script>
	addbtn.addEventListener('click', function (e) {
		var data = {
			name: $('#nameAdd').val(),
			image: $('#imageAdd').val(),
			text: $('#textAdd').val(),
			year: $('#yearAdd').val(),
			download: $('#downloadAdd').val()
		};
	   	$.ajax({
			type: "POST",
			url: "../ajax/add.php",
			data: data,
			success: function(data){
				document.getElementById('nameAdd').value = '';
				document.getElementById('textAdd').value = '';
				document.getElementById('downloadAdd').value = '';
				GetDB();
			}
		}) 
	    e.preventDefault();
	});
</script>

