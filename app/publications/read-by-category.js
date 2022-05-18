function searchByCategory(){
    axios.get("http://localhost/PHP_test/api/category/read.php")
        .then(response => {
            var publications = response.data.items;
   
            var publications_table =`<select id= "search_publication_cat" name="category">`;

             publications.map((publication, key) => {
                publications_table+=`<option value="` + publication.id + `">` + publication.nameCategory + `</option>`;
            
            });
     
            publications_table+=`</select>`;
            publications_table+=`<button onclick="showPublicationByCategory(document.getElementById('search_publication_cat').value)">
                Вывести публикации по выбранной категории
            </button> `;
            
            document.getElementById("search_by_cat").innerHTML = publications_table;

    });
}

function showPublicationByCategory(id){
    console.log(id)
    axios.get("http://localhost/PHP_test/api/publication/read_by_category.php?id="+id)
    .then(response => {
        var publications = response.data.items;
        
        var publications_table =`<table class='table-publication'>
                                <tr>
                                    <th>Заголовок</th>
                                    <th>Текст</th>
                                    <th>Фото</th>
                                    <th>Автор</th>
                                    <td>Категория`;
                        var id=0;
                        publications.map((publication, key) => {
                        if(publication.id != id){
                        publications_table+=`</td>
                        </tr>
                        <tr>
                        <td>` + publication.title + `</td>
                        <td>` + publication.text + `</td>    
                        <td>` + publication.image + `</td>
                        <td>` + publication.author + `</td>    
                        <td>` + publication.category;
                        }
                        else {
                        publications_table+= `, <br>` + publication.category;
                        }

                        id = publication.id;
                        });

                        publications_table+=`</td>
                        </tr></table>`;

                        document.getElementById("publications-table").innerHTML = publications_table;

})
.catch((error)=> {
    alert('Ничего не найдено');
    document.getElementById("publications-table").innerHTML = '';
});
}