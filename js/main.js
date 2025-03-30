(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    // Initiate the wowjs
    new WOW().init();

    // Sticky Navbar (No logo resize)
    $(window).scroll(function () {
        var scrollTop = $(this).scrollTop();

        // Sticky navbar handling
        if (scrollTop > 45) {
            $('.navbar').addClass('sticky-top shadow-sm'); // Add sticky class with shadow
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm'); // Remove sticky class and shadow
        }

        // Back to top button visibility
        if (scrollTop > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });

    // Back to top button click functionality
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    // Skills (Progress bars)
    $('.skill').waypoint(function () {
        $('.progress .progress-bar').each(function () {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, {offset: '80%'});

    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });

    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 25,
        dots: false,
        loop: true,
        nav: true,
        navText: [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            992: {
                items: 2
            }
        }
    });

    // Portfolio isotope and filter
    var portfolioIsotope = $('.portfolio-container').isotope({
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows'
    });
    $('#portfolio-flters li').on('click', function () {
        $("#portfolio-flters li").removeClass('active');
        $(this).addClass('active');

        portfolioIsotope.isotope({filter: $(this).data('filter')});
    });

})(jQuery);


 // Ensure the DOM is fully loaded before adding event listeners
 document.addEventListener("DOMContentLoaded", function() {
    const chatButton = document.getElementById('chatButton');
    const chatboxContainer = document.getElementById('chatboxContainer');
    const closeChatButton = document.getElementById('closeChat');
    const sendButton = document.getElementById('sendButton');
    const userMessageInput = document.getElementById('userMessage');
    const chatbox = document.getElementById('chatbox');

    // Toggle chatbox visibility when the chat button is clicked
    chatButton.addEventListener('click', function() {
        chatboxContainer.style.display = 'flex'; // Show the chatbox
    });

    // Close the chatbox when the close button is clicked
    closeChatButton.addEventListener('click', function() {
        chatboxContainer.style.display = 'none'; // Hide the chatbox
    });

    // Handle sending the message when the send button is clicked
    sendButton.addEventListener('click', function() {
        const userMessage = userMessageInput.value.trim();

        if (userMessage) {
            // Display the user's message in the chatbox
            const userMessageElement = document.createElement('div');
            userMessageElement.classList.add('user-message');
            userMessageElement.textContent = userMessage;
            chatbox.appendChild(userMessageElement);

            // Scroll to the bottom of the chatbox
            chatbox.scrollTop = chatbox.scrollHeight;

            // Clear the input field
            userMessageInput.value = '';

            // Simulate bot response after a short delay
            setTimeout(() => {
                const botMessageElement = document.createElement('div');
                botMessageElement.classList.add('bot-message');
                botMessageElement.textContent = 'Hello! How can I assist you today?';
                chatbox.appendChild(botMessageElement);

                // Scroll to the bottom of the chatbox
                chatbox.scrollTop = chatbox.scrollHeight;
            }, 1000);
        }
    });

    // Close the chatbox if the user presses Enter (optional feature)
    userMessageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            sendButton.click();
        }
    });
});