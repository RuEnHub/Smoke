let games;
let notesOnPage = 6;
let pageNumber = 1;
let countOfItems;
let userType;
let innerHtml = '';

$(document).ready ( function(){
	$.ajax({
		type: "POST",
		url: "../ajax/whatUser.php",
		success: function(data){
			userType = data;
			console.log(userType);
			GetDB();
		}
	});
});

function GetDB() {
	$.ajax({
		type: "POST",
		url: "../ajax/GetGameFromDB.php",
		dataType : "json",
		success: function(data){
			games = data;
			console.log(games);
			countOfItems = Math.ceil(games.length / notesOnPage);
			Update();
			pagination(countOfItems >= pageNumber ? pageNumber:pageNumber-1);
		}
	});
}

/*ВЫВОД ПАНЕЛИ НАВИГАЦИИ ПРИ ЗАГРУЗКЕ СТРАНИЦЫ*/
function Update(){
	countOfItems = Math.ceil(games.length / notesOnPage);
	/*SELECT*/
	innerHtml = '<select class="page-item page-link" id="select"><option>6</option><option ';
	if (notesOnPage == 12) innerHtml +=' selected="selected"';
	innerHtml += '>12</option><option';
	if (notesOnPage == 18) innerHtml +=' selected="selected"';
	innerHtml += '>18</option></select>';
	/*LI*/
	innerHtml += '<li class="page-item page-link" id="ll">&lsaquo;&lsaquo;</li>'+
	'<li class="page-item page-link" id="l">&lsaquo;</li>';
	for (let i = 1; i<= countOfItems; i++) {
		innerHtml += '<li class="page-item page-link" id="button">'+i+'</li>';
	}
	innerHtml += '<li class="page-item page-link" id="r">&rsaquo;</li>'+
	'<li class="page-item page-link" id="rr">&rsaquo;&rsaquo;</li>';
	if (document.getElementById("pagination"))
		document.getElementById("pagination").innerHTML = innerHtml;
};
/*ВЫВОД ИГР НА ТЕКУЩЕЙ СТРАНИЦЕ*/
function pagination (pageNum) {
	pageNumber = pageNum;

	/*ВЫДЕЛЕНИЕ*/
	let active = document.querySelector('#pagination li.active');
	let disabled = document.querySelectorAll('#pagination li.disabled');
	if (active)
		active.classList.remove('active');
	for (dis of disabled) {
		if (dis) 
			dis.classList.remove('disabled');
	}
	let items = document.querySelectorAll('#pagination li');
	for (let item of items) {
		if (pageNumber == item.innerHTML) {
			item.classList.add('active');
		}
	}
	if (pageNumber == 1) {
		document.getElementById("ll").classList.add('disabled');
		document.getElementById("l").classList.add('disabled');
	}
	if (pageNumber == countOfItems) {
		document.getElementById("rr").classList.add('disabled');
		document.getElementById("r").classList.add('disabled');
	}
	/*КОНЕЦ ВЫДЕЛЕНИЯ*/

	let start =	(pageNum - 1) * notesOnPage;
	let end = start + notesOnPage;
	let notes = games.slice(start, end);
	console.log(notes);

	innerHtml = "";
	for(let note of notes) {
		innerHtml += 
			'<div class="game-block">';
				if (userType == '') innerHtml += '<a href="'+note.download+'" class="full-div-link" target="_blank"></a>';
				innerHtml += '<div class="gb-image"><img src="'+note.image+'"></div>'+
				'<div class="gb-info">'+
					'<h2>'+note.name+'</h2>'+
					'<h4>'+note.year+'</h4>'+
					'<h6>'+note.text+'</h6>';

					
				if (userType != '') {
					innerHtml += '<button onclick="vis(id)" id="'+note.id+'">';
					if(note.visible == 1) innerHtml += 'Скрыть'; else innerHtml += 'Показать';
					innerHtml += '</button><button onclick="editGame(id)" id="'+note.id+'">Редактировать</button>';
					innerHtml += '<button onclick="del(id)" id="'+note.id+'">Удалить</button>';
				}
				innerHtml += '</div></div>';
	}
	if (userType != '') innerHtml += '<button class="regButton" id="append">Добавить</button>';
	document.getElementById("gb-container").innerHTML = innerHtml;
}

$(function() {
    $(document).on('change','#select', function() {
      notesOnPage = +this.value;
      Update();
      pagination(1);
    })
})
$(document).on('click', '#ll', function(){
	pagination(1);
})
$(document).on('click', '#l', function(){
	if (pageNumber > 1)
		pagination(--pageNumber);
})
$(document).on('click', '#button', function(){
	pagination($(this).context.innerHTML);
})
$(document).on('click', '#r', function(){
	if (pageNumber < countOfItems)
		pagination(++pageNumber);
})
$(document).on('click', '#rr', function(){
	pagination(countOfItems);
})

/*ОБРАБОТЧИК КНОПОК АДМИНА*/
$(document).on('click', '#append', function(){
	add('block');
})
function vis(id) {
	$.ajax({
		type: "POST",
		url: "../ajax/vis.php",
		data: {id:id},
		success: function(data){
			GetDB();
		}
	})
}
function del(id) {
	$.ajax({
		type: "POST",
		url: "../ajax/del.php",
		data: {id:id},
		success: function(data){
			GetDB();
		}
	})
}

/*EDIT*/
function editGame(id) {
	$.ajax({
		type: "POST",
		url: "../ajax/GetGameFromDB.php",
		data: {id:id},
		dataType : "json",
		success: function(data){
			innerHtml = '<div id="edit" class="modalWindow">'+
				'<img class="close" src="img/close.png" alt=""  onclick="edit(\'none\')">'+
				'<div class="form">'+
					'<h2>Редактирование</h2>'+
					    '<input type="text" placeholder="Название игры" id="nameEdit" class="input" value="'+data.name+'">'+
					    '<input type="text" placeholder="Путь к изображению" id="imageEdit" class="input" value="'+data.image+'">'+
					    '<textarea style="resize: none" id="textEdit" placeholder="Описание" rows="10" cols="36">'+data.text+'</textarea>'+
					    '<input type="date" id="yearEdit" class="input" value="'+data.year+'" min="2001-01-01" max="">'+
					    '<input type="text" placeholder="Ссылка на скачивание" id="downloadEdit" class="input" value="'+data.download+'">'+
					    '<input type="submit" onclick="edit_BD('+id+')" value="Редактировать" class="button" id="editbtn">'+
				'</div>'+
			'</div>';
			document.getElementById("content").innerHTML = innerHtml;
			edit('block');
		}
	})
}

function edit_BD(id) {
	edit('none');
	var data = {
		id : id,
		name: $('#nameEdit').val(),
		image: $('#imageEdit').val(),
		text: $('#textEdit').val(),
		year: $('#yearEdit').val(),
		download: $('#downloadEdit').val()
	};
   	$.ajax({
		type: "POST",
		url: "../ajax/edit.php",
		data: data,
		success: function(data){
			GetDB();
		}
	})
}