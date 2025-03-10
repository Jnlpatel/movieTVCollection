// JavaScript for filtering and show/hide review functionality
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const mediaCards = document.querySelectorAll('.media-card');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            mediaCards.forEach(card => {
                if (filter === 'all') {
                    card.style.display = 'flex';
                } else if (card.classList.contains(filter.toLowerCase().replace(' ', '-'))) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Review toggle functionality
    const reviewToggles = document.querySelectorAll('.review-toggle');
    
    reviewToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const reviewContent = this.nextElementSibling;
            
            if (reviewContent.style.maxHeight) {
                reviewContent.style.maxHeight = null;
                this.textContent = 'Show Review';
            } else {
                reviewContent.style.maxHeight = reviewContent.scrollHeight + 'px';
                this.textContent = 'Hide Review';
            }
        });
    });
});