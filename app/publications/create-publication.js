function addPublication(){
    //получаем категорию
    let endpoints = [
        'http://localhost/PHP_test/api/category/read.php',
        'http://localhost/PHP_test/api/author/read.php'
      ];
      
      axios.all(endpoints.map((endpoint) => axios.get(endpoint))).then(
        (data) => {
            var categories = data[0].data.items;
            var create_form=`<br><br><h3>Новая публикация</h3><form>
                Заголовок: <input type="text" maxlength = "15" id="title_publication" required placeholder = "Введите заголовок"/><br>
                Текст: <textarea cols="50" rows = "5" type="text" id="text_publication" required placeholder = "Введите текст"></textarea><br>
                Фото: <input type="file" id="photo_publication" accept=".jpg,.jpeg"/><br>
                Раздел/разделы: `;
            create_form+=`<select multiple style = "width: 321px; height: 100px;" id= "category_publication" name="category">`;
            categories.map((category, key) => {
                create_form+=`<option value="` + category.id + `">` + category.nameCategory + `</option>`;
            });
            create_form+=`</select>`;

            var authors = data[1].data.items;
            create_form+=`<br>Автор: <select  id= "author_publication" name="category">`;
            authors.map((author, key) => {
                create_form+=`<option value="` + author.id + `">` + author.fullname + `</option>`;
            });
            create_form+=`</select>`;
            create_form+=`<br><button onclick = "savePublication(document.getElementById('title_publication').value, document.getElementById('text_publication').value,
            $('#category_publication').val(), document.getElementById('author_publication').value, document.getElementById('photo_publication').files)" >
            Сохранить публикацию</button>`;
            document.getElementById("create-publication").innerHTML = create_form;
        }
      );
}

function savePublication(title, text, categories, author, photo){
    if(title == ""){
        alert("Введите название публикации");
    }
    else if(text == ""){
        alert("Введите текст публикации");
    }
    else if(categories == null ){
        alert("Выберите категорию/категории публикации");
    }
    else {
        let cat = '';
        categories.map(el => {cat+=el; cat+=','});
        axios.post('http://localhost/PHP_test/api/publication/create.php?title='+title+'&text='+text+'&categories='+cat+'&author='+author+'&photo='+photo);
        alert('Публикация добавлена');
    }
}