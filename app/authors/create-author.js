

function addAuthor(){
    var create_form=`<form>
    ФИО: <input maxlength = "50" type="text" id="fullname_author" required placeholder = "Введите ФИО"/><br>
    Аватар: <input type="file" id="avatar_author" accept=".jpg,.jpeg"/><br>
    <button onclick = "saveAuthor(document.getElementById('fullname_author').value,document.getElementById('avatar_author').files[0])" >
    Сохранить автора</button>`;
    document.getElementById("create-author").innerHTML = create_form;
}

function saveAuthor(fullname, avatar){
  if(fullname == ""){
      alert("Введите название категории!")
  }else{
    axios.post('http://localhost/PHP_test/api/author/create.php?fullname='+fullname+'&avatar='+avatar.name);     
     alert('Автор добавлен')
  }
}