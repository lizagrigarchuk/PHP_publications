function showAuthors(){
    axios.get("http://localhost/PHP_test/api/author/read.php")
        .then(response => {
            var authors = response.data.items;
   
            var authors_table=`<table class='table-author'>
                                    <tr>
                                        <th>id</th>
                                        <th>ФИО</th>
                                        <th>Аватар</th>
                                    </tr>`;

            authors.map((author, key) => {
                authors_table+=`<tr>
                                    <td>` + author.id + `</td>
                                    <td>` + author.fullname + `</td>
                                    <td><img style="width:150px; height:150px;" 
                                    src="http://localhost/PHP_test/app/assets/img/authors/` + author.avatar + `"/></td>
                                    </tr>`;
            });
     
            authors_table+=`</table>`;

    document.getElementById("authors-table").innerHTML = authors_table;

    });
}