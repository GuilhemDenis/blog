function confirmDelete() {
    let confirm = window.confirm("Etes-vous sûr de vouloir supprimer l'article ?");
    if (!confirm)
        event.preventDefault();
}

function confirmDeleteComment() {
    let confirm = window.confirm("Etes-vous sûr de vouloir supprimer le commentaire ?");
    if (!confirm){
        event.preventDefault();
    }
}
function confirmDeleteCategory() {
    let confirm = window.confirm("Etes-vous sûr de vouloir supprimer la catégorie ?");
    if (!confirm){
        event.preventDefault();
    }
}
function confirmDeleteWriter() {
    let confirm = window.confirm("Etes-vous sûr de vouloir supprimer cet auteur ?");
    if (!confirm){
        event.preventDefault();
    }
}



function searchCompletion(){
    let search = document.getElementById('searchArticles').value;
	fetch(`index.php?page=searchCompletion&search=${search}`)
	//analyser la réponse
	.then(response => response.text())
	//utilise la réponse
	.then(response => {
		document.querySelector(".listArticles").innerHTML = response;
	});
    
}

function searchCompletionHome(){
    let search = document.getElementById('search').value;
	fetch(`index.php?page=searchCompletion&search=${search}`)
	//analyser la réponse
	.then(response => response.text())
	//utilise la réponse
	.then(response => {
		document.querySelector("section").innerHTML = response;
	});
}

//script pour TinyMCE pour le text area
tinymce.init({
    selector: '#text',
    plugins: 'autolink lists media table',
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    width : "640",
    
});




//pour gérer le tri dans la liste des articles
document.addEventListener("DOMContentLoaded",function(){
    
    document.getElementById("search").addEventListener('input', searchCompletionHome);
    document.getElementById("searchArticles").addEventListener('input', searchCompletion);
    
    
    let select = document.getElementById("sort");
    select.addEventListener('change', function(){
        //sélectionner ton formulaire et le submit
        document.getElementById("sortArts").submit();
    });
});

















