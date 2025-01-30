function showBookInfo(bookId) {
    fetch(`get_book_info.php?id=${bookId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const modal = document.getElementById('book-modal');
            modal.innerHTML = `
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h3>${data.title}</h3>
                    <p><strong>Author:</strong> ${data.author}</p>
                    <p><strong>Description:</strong> ${data.description}</p>
                    <button onclick="window.location.href='book-details.php?id=${bookId}'" 
                            class="view-details-btn">
                        View Full Details
                    </button>
                </div>
            `;
            modal.style.display = 'block';
            
            // Add close button functionality
            modal.querySelector('.close-btn').addEventListener('click', () => {
                modal.style.display = 'none';
            });
        })
        .catch(error => {
            console.error('Error fetching book details:', error);
            alert('Failed to load book details. Please try again.');
        });
}

// Close modal when clicking outside
document.addEventListener('click', (event) => {
    const modal = document.getElementById('book-modal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});
document.addEventListener('DOMContentLoaded', () => {
    // Initialize book descriptions
    document.querySelectorAll('.book-item').forEach(book => {
        const description = book.dataset.description;
        const descriptionDiv = book.querySelector('.book-description');
        descriptionDiv.textContent = description;
    });

    // Mobile touch support
    document.querySelectorAll('.book-item').forEach(book => {
        let tapTimer;
        
        book.addEventListener('click', () => {
            const descriptionDiv = book.querySelector('.book-description');
            descriptionDiv.classList.toggle('visible');
            
            clearTimeout(tapTimer);
            tapTimer = setTimeout(() => {
                descriptionDiv.classList.remove('visible');
            }, 3000);
        });
    });
});
const loginForm = document.getElementById('loginForm');
const signupForm = document.getElementById('signupForm');
const switchToSignup = document.getElementById('switchToSignup');
const switchToLogin = document.getElementById('switchToLogin');

switchToSignup.addEventListener('click', (e) => {
    e.preventDefault();
    loginForm.style.display = 'none';
    signupForm.style.display = 'block';
});

switchToLogin.addEventListener('click', (e) => {
    e.preventDefault();
    signupForm.style.display = 'none';
    loginForm.style.display = 'block';
});
