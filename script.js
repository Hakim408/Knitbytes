const openMenuBtn = document.getElementById('open-menu-btn');
const closeMenuBtn = document.getElementById('close-menu-btn');
const navMenu = document.querySelector('.nav_menu');

openMenuBtn.addEventListener('click', () => {
    navMenu.style.display = 'flex';
    openMenuBtn.style.display = 'none';
    closeMenuBtn.style.display = 'block';
});

closeMenuBtn.addEventListener('click', () => {
    navMenu.style.display = 'none';
    closeMenuBtn.style.display = 'none';
    openMenuBtn.style.display = 'block';
});

/* Navbar Scroll Effect */
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('nav');
    if (window.scrollY > 50) {
        navbar.classList.add('window-scroll');
    } else {
        navbar.classList.remove('window-scroll');
    }
});



document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {
        counter.innerText = '0+';

        const updateCounter = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText.replace('+', '');

            // Slow down the increment
            const increment = target / 300;

            if (count < target) {
                counter.innerText = `${Math.ceil(count + increment)}+`;
                // Slow down the interval
                setTimeout(updateCounter, 15);
            } else {
                counter.innerText = `${target}+`;
            }
        };

        updateCounter();
    });
});


var swiper = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 30,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    600: {
        slidesPerView: 2 
    }
  }
});


document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const form = event.target;

    fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            document.getElementById('formSuccessMessage').style.display = 'block';
            form.reset(); // Reset the form fields
        } else {
            alert('There was an error submitting the form.');
        }
    })
    .catch(error => {
        alert('There was an error submitting the form.');
        console.error('Error:', error);
    });
});



// JavaScript to toggle between dark and light mode
const toggleThemeButton = document.getElementById('theme-toggle');

toggleThemeButton.addEventListener('click', () => {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    if (currentTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
    } else {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    }
});

// Apply saved theme on page load
window.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
});

// Theme Toggle Functionality
const themeToggleButton = document.getElementById('theme-toggle');

themeToggleButton.addEventListener('click', () => {
    // Toggle the dark mode class on the body element
    document.body.classList.toggle('dark-mode');

    // Optional: Change button text based on theme
    if (document.body.classList.contains('dark-mode')) {
        themeToggleButton.textContent = 'Light Mode';
    } else {
        themeToggleButton.textContent = 'Dark Mode';
    }
});


