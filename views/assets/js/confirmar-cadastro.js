document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.getElementById('loginButton');
    const userEmailPlaceholder = document.querySelector('.confirmation-message strong');
    
    if (userEmailPlaceholder) {
        const urlParams = new URLSearchParams(window.location.search);
        const emailFromUrl = urlParams.get('email');
        if (emailFromUrl) {
            userEmailPlaceholder.textContent = decodeURIComponent(emailFromUrl);
        }
    }

    const confettiColors = ['#FCB628', '#80CDEB', '#7BAEC2', '#F0D1A6', '#FCB628', '#80CDEB'];

    function createPageLoadConfetti() {
        const confettiCount = 250; 
        
        for (let i = 0; i < confettiCount; i++) {
            const confetti = document.createElement('div');
            confetti.classList.add('confetti');
            
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.top = -Math.random() * 60 - 20 + 'vh'; 
            
            confetti.style.backgroundColor = confettiColors[Math.floor(Math.random() * confettiColors.length)];
            
            const size = Math.random() * 8 + 5; 
            confetti.style.width = size + 'px';
            confetti.style.height = size * (Math.random() * 0.5 + 0.75) + 'px'; 
            confetti.style.transform = `rotate(${Math.random() * 360}deg)`;
            
            document.body.appendChild(confetti);
            animatePageLoadConfetti(confetti);
        }
    }

    function animatePageLoadConfetti(confettiEl) {
        const duration = Math.random() * 4000 + 5500; 
        const xEnd = Math.random() * 100 - 50;
        const rotateEnd = Math.random() * 720 - 360;

        confettiEl.animate([
            { transform: `translateY(0vh) translateX(0vw) rotate(${confettiEl.style.transform.match(/(\d+)deg/)[1]}deg)`, opacity: 1 },
            { transform: `translateY(130vh) translateX(${xEnd}vw) rotate(${rotateEnd}deg)`, opacity: 0 } 
        ], {
            duration: duration,
            easing: 'cubic-bezier(0.25, 0.1, 0.25, 1)', 
            fill: 'forwards'
        });

        setTimeout(() => {
            if (confettiEl.parentNode) {
                confettiEl.parentNode.removeChild(confettiEl);
            }
        }, duration);
    }

    function createButtonConfetti(event) {
        const buttonRect = loginButton.getBoundingClientRect();
        const buttonCenterX = buttonRect.left + buttonRect.width / 2;
        const buttonCenterY = buttonRect.top + buttonRect.height / 2;

        const confettiCount = 60;
        for (let i = 0; i < confettiCount; i++) {
            const confetti = document.createElement('div');
            confetti.classList.add('confetti', 'button-confetti'); 
            
            confetti.style.left = buttonCenterX + 'px';
            confetti.style.top = buttonCenterY + 'px';
            
            confetti.style.backgroundColor = confettiColors[Math.floor(Math.random() * confettiColors.length)];
            
            const size = Math.random() * 7 + 4;
            confetti.style.width = size + 'px';
            confetti.style.height = size * (Math.random() * 0.4 + 0.8) + 'px'; 
            
            document.body.appendChild(confetti); 
            animateButtonConfetti(confetti, buttonCenterX, buttonCenterY);
        }
    }

    function animateButtonConfetti(confettiEl, startX, startY) {
        const angle = Math.random() * Math.PI * 2; 
        const distance = Math.random() * 90 + 60;
        const endX = Math.cos(angle) * distance;
        const endY = Math.sin(angle) * distance - (Math.random() * 50);
        
        const duration = Math.random() * 900 + 800;
        const rotateEnd = Math.random() * 360 - 180;

        confettiEl.style.transform = 'translate(-50%, -50%)'; 

        confettiEl.animate([
            { transform: `translate(-50%, -50%) translate(0px, 0px) rotate(0deg)`, opacity: 1 }, 
            { transform: `translate(-50%, -50%) translate(${endX}px, ${endY}px) rotate(${rotateEnd}deg)`, opacity: 0 }
        ], {
            duration: duration,
            easing: 'cubic-bezier(0.1, 0.8, 0.25, 1)', 
            fill: 'forwards'
        });

        setTimeout(() => {
            if (confettiEl.parentNode) {
                confettiEl.parentNode.removeChild(confettiEl);
            }
        }, duration);
    }

    createPageLoadConfetti();

    if (loginButton) {
        loginButton.addEventListener('click', (event) => {
            event.preventDefault(); 
            createButtonConfetti(event);
            console.log("Botão Fazer Login clicado!");
        });
    }
});