function searchByAuthor(){
    axios.get("http://localhost/PHP_test/api/author/read.php")
        .then(response => {
            var authors = response.data.items;
   
            var authors_table =`<select id= "search_author_cat" name="category">`;

             authors.map((author, key) => {
                authors_table+=`<option value="` + author.id + `">` + author.fullname + `</option>`;
            });
     
            authors_table+=`</select>`;
            authors_table+=`<button onclick="showPublicationByAuthor(document.getElementById('search_author_cat').value)">
                Вывести публикации по выбранному автору
            </button> `;
            
            document.getElementById("search_by_author").innerHTML = authors_table;

    });
}

function showPublicationByAuthor(id){
    console.log(id)
    axios.get("http://localhost/PHP_test/api/publication/read_by_author.php?id="+id)
    .then(response => {
        var authors = response.data.items;

        var authors_table =`<table class='table-publication'>
                    <tr>
                        <th>Заголовок</th>
                        <th>Текст</th>
                        <th>Фото</th>
                        <th>Автор</th>
                        <td>Категория`;
            var id=0;
            authors.map((publication, key) => {
            if(publication.id != id){
                authors_table+=`</td>
            </tr>
            <tr>
            <td>` + publication.title + `</td>
            <td>` + publication.text + `</td>    
            <td><img style="width:200px; height:150px;" src="http://localhost/PHP_test/app/assets/img/publications/` + publication.image + `"/></td>
            <td>` + publication.author + `</td>    
            <td>` + publication.category;
            }
            else {
                authors_table+= `, <br>` + publication.category;
            }

            id = publication.id;
            });

            authors_table+=`</td>
            </tr></table>`;
        
    document.getElementById("publications-table").innerHTML = authors_table;

})
.catch((error)=> {
    alert('Ничего не найдено');
    document.getElementById("publications-table").innerHTML = '';
});
}