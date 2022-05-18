function searchPublication(value){
    console.log(value)
    axios.get("http://localhost/PHP_test/api/publication/search.php?value="+value)
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
                <td><img style="width:200px; height:150px;" src="http://localhost/PHP_test/app/assets/img/publications/` + publication.image + `"/></td>
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