document.addEventListener("DOMContentLoaded", function() {
    var coll = document.getElementsByClassName("collapsible");
    for (var i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }

    var videoItems = document.querySelectorAll(".content ul li");
    videoItems.forEach(function(item) {
        item.addEventListener("click", function(event) {
            if (event.target.tagName !== 'INPUT') {
                var videoId = this.getAttribute("data-video-id");
                var iframe = document.getElementById("video");
                iframe.src = "https://www.youtube.com/embed/" + videoId;
            }
        });
    });

    var checkboxes = document.querySelectorAll(".content ul li input[type='checkbox']");
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener("change", function() {
            if (Array.from(checkboxes).every(cb => cb.checked)) {
                showPopup();
            }
        });
    });

    function showPopup() {
        var popup = document.createElement("div");
        popup.classList.add("popup");
        popup.textContent = "You did it!!!";

        var fireworks = document.createElement("div");
        fireworks.classList.add("fireworks");

        for (let i = 0; i < 30; i++) {
            let firework = document.createElement("div");
            firework.classList.add("firework");
            firework.style.left = Math.random() * 100 + "vw";
            firework.style.top = Math.random() * 100 + "vh";
            fireworks.appendChild(firework);
        }

        document.body.appendChild(popup);
        document.body.appendChild(fireworks);

        popup.style.display = "block";
        fireworks.style.display = "block";

        setTimeout(function() {
            popup.style.display = "none";
            fireworks.style.display = "none";
            document.body.removeChild(popup);
            document.body.removeChild(fireworks);
        }, 10000);
    }
});

document.addEventListener("DOMContentLoaded", function() {
  const fadeInSection = document.querySelector('.fade-in-section');

  function checkVisibility() {
    const rect = fadeInSection.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom >= 0) {
      fadeInSection.classList.add('visible');
    }
  }

  window.addEventListener('scroll', checkVisibility);
  window.addEventListener('resize', checkVisibility);

  checkVisibility(); // Initial check in case the section is already in view
});

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

document.addEventListener("DOMContentLoaded", function() {
    const questionData = [
        { id: 'q1', question: 'What class is used in Bootstrap to create a responsive container?', answers: ['A) .container-fluid', 'B) .container'], correct: 'A' },
        { id: 'q2', question: 'Which Bootstrap class is used to create a primary button?', answers: ['A) .btn-secondary', 'B) .btn-primary'], correct: 'B' },
        { id: 'q3', question: 'How do you create a horizontal navigation bar in Bootstrap?', answers: ['A) Use .navbar and .navbar-nav', 'B) Use .nav and .nav-horizontal'], correct: 'A' },
        { id: 'q4', question: 'Which Bootstrap class provides a fixed position for a navigation bar at the top of the page?', answers: ['A) .fixed-top', 'B) .navbar-fixed-top'], correct: 'A' },
        { id: 'q5', question: 'How can you align a column to the center in Bootstrap grid layout?', answers: ['A) Use .align-center', 'B) Use .justify-content-center'], correct: 'B' },
        { id: 'q6', question: 'What class do you use to create a responsive image in Bootstrap?', answers: ['A) .img-responsive', 'B) .img-fluid'], correct: 'B' },
        { id: 'q7', question: 'How do you create a card component with Bootstrap?', answers: ['A) Use .card and .card-body', 'B) Use .panel and .panel-body'], correct: 'A' },
        { id: 'q8', question: 'Which class should you use to hide an element on small screens but show it on larger screens?', answers: ['A) .d-none d-sm-block', 'B) .hidden-xs'], correct: 'A' },
        { id: 'q9', question: 'What class is used to add spacing between Bootstrap grid columns?', answers: ['A) .column-spacing', 'B) .g-3'], correct: 'B' },
        { id: 'q10', question: 'How do you create a dropdown menu using Bootstrap?', answers: ['A) Use .dropdown and .dropdown-menu', 'B) Use .menu and .dropdown-list'], correct: 'A' }
    ];

    function generateQuestions() {
        const questionsContainer = document.getElementById('questionsContainer');

        questionData.forEach((q, index) => {
            const questionElement = document.createElement('div');
            questionElement.className = 'question';

            const questionLabel = document.createElement('label');
            questionLabel.textContent = `(${index + 1}): ${q.question}`;

            questionElement.appendChild(questionLabel);

            q.answers.forEach(answer => {
                const radioInput = document.createElement('input');
                radioInput.type = 'radio';
                radioInput.name = q.id;
                radioInput.value = answer.charAt(0);  // Store only the first letter (A or B)
                radioInput.id = `${q.id}_${answer}`;

                const label = document.createElement('label');
                label.setAttribute('for', radioInput.id);
                label.textContent = answer;

                questionElement.appendChild(radioInput);
                questionElement.appendChild(label);
                questionElement.appendChild(document.createElement('br'));
            });

            questionsContainer.appendChild(questionElement);
        });
    }

    function submitExam(event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(document.getElementById('examForm'));
        const correctAnswers = questionData.reduce((acc, q) => {
            acc[q.id] = q.correct;
            return acc;
        }, {});
        let score = 0;

        formData.forEach((value, key) => {
            if (correctAnswers[key] === value) {
                score++;
            }
        });

        if (score >= 6) {
            document.getElementById('certificate').style.display = 'block';
        } else {
            alert(`You answered ${score} questions correctly. You need at least 6 correct answers to get the certificate. Please try again!`);
        }
    }

    generateQuestions();
    document.getElementById('examForm').addEventListener('submit', submitExam);
});

