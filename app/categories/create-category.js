function addCategory(){
    axios.get("http://localhost/PHP_test/api/category/read.php")
    .then(response => {
        var categories = response.data.items;
        var create_form=`<form>
        Категория: <input type="text" maxlength = "40" id="name_category" required placeholder = "Введите название категории"/><br>
        Раздел: `;
        create_form+=`<select id= "parent" name="category">`;
        categories.map((category, key) => {
            
            create_form+=`<option value="` + category.id + `">` + category.nameCategory + `</option>`;
        });
        
        create_form+=`</select><button onclick = "saveCategory(document.getElementById('name_category').value, document.getElementById('parent').value)" >
         Сохранить категорию</button>`;
         document.getElementById("create-category").innerHTML = create_form;
        });

}

function saveCategory(name, parent){
    if(name == ""){
        alert("Введите название категории!")
    }else{
        axios.post('http://localhost/PHP_test/api/category/create.php?name='+name+'&parentId='+parent);
        alert('Категория добавлена')
    }
}