function showCategories(){
    axios.get("http://localhost/PHP_test/api/category/read.php")
        .then(response => {
            var categories = response.data.items;
            var categories_table=`<table class='table-category'>
                                    <tr>
                                        <th>id</th>
                                        <th>Раздел</th>
                                        <th>Категория</th>
                                    </tr>`;

            categories.map((category, key) => {
                categories_table+=`<tr>
                                    <td>` + category.id + `</td>
                                    <td>` + category.nameParentCategory + `</td>
                                    <td>` + category.nameCategory + `</td>    
                                </tr>`;
            });
     
            categories_table+=`</table>`;

    document.getElementById("categories-table").innerHTML = categories_table;

    });
}