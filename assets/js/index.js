

//********* formulaire SCROLL START ***********\\ 
function scrollToElement() {
  // Utilise la méthode `scrollIntoView()` pour faire défiler la page vers l'élément
  form.scrollIntoView({ behavior: 'smooth' });
}

const bouton = document.querySelector('#monbouton');
bouton.addEventListener('click', scrollToElement);
//********* formulaire SCROLL END ***********\\ 


//********* formulaire next question START ***********\\ 
const form = document.getElementById('question-form');
const questions = form.querySelectorAll('.question');
const nextBtn = document.getElementById('next-btn');
let currentQuestion = 0;

function showNextQuestion(e) {
  e.preventDefault();
  // Hide current question
  questions[currentQuestion].style.opacity = '0';
  questions[currentQuestion].style.visibility = 'hidden';
  
  // Show next question
  currentQuestion++;
  if (currentQuestion >= questions.length) {
    //If there are no more questions, submit form
    form.submit();
  } else {
    questions[currentQuestion].style.opacity = '1';
    questions[currentQuestion].style.visibility = 'visible';
  }
}

// Add event listener to Next button
nextBtn.addEventListener('click', showNextQuestion);
//********** formulaire next question END ***********\\ 