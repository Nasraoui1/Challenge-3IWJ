function talk(){
    var know = {
    "Bonjour" : "Bonjour et bienvenue ! ",
    "Renseigne-moi" : "Veuillez me demander dans quel domaine pourrais-je vous aider",
    "Avis" : "Vous pouvez donnez votre avis dans la section d'opinion",
    "Blog" : "Vous trouvrez les blogs de nos spécialiste dans la section blog ",
    "Reservation" : "Vous pouvez reserver des scéances avec nos specialistes dans la section reservation ",
    "Reclamation" : "Vous pouvez déposer vos réclamations dans la section reclamation",
    "Merci" : "Pas de problème !",
    "Bye" : "A bientôt !",
    };
    var user = document.getElementById('userBox').value;
    document.getElementById('chatLog').innerHTML = user + "<br>";
    if (user in know) {
    document.getElementById('chatLog').innerHTML = know[user] + "<br>";
    }else{
    document.getElementById('chatLog').innerHTML = "Sorry,I didn't understand <br>";
    }
    }