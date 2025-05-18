// Modal functionality
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    const modals = document.getElementsByClassName('modal');
    for (let i = 0; i < modals.length; i++) {
        if (event.target == modals[i]) {
            modals[i].style.display = 'none';
        }
    }
}

// Slider functionality
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');

function initSlider() {
    if (slides.length > 0) {
        slides[0].classList.add('active');
        
        // Auto slide change every 5 seconds
        setInterval(() => {
            nextSlide();
        }, 5000);
    }
}

function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');
}

function prevSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
}

function goToSlide(index) {
    slides[currentSlide].classList.remove('active');
    currentSlide = index;
    slides[currentSlide].classList.add('active');
}

// Initialize slider when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    initSlider();
    
    // Add event listeners for slider navigation
    const nextButtons = document.querySelectorAll('.next-slide');
    const prevButtons = document.querySelectorAll('.prev-slide');
    
    nextButtons.forEach(button => {
        button.addEventListener('click', nextSlide);
    });
    
    prevButtons.forEach(button => {
        button.addEventListener('click', prevSlide);
    });
    
    // Cart functionality
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    updateCartCount();
});

// Cart functionality
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartCount = document.getElementById('cart-count');
    
    if (cartCount) {
        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
        cartCount.textContent = totalItems;
        cartCount.style.display = totalItems > 0 ? 'inline-block' : 'none';
    }
}

// Notification system
function showNotification(message, type = 'info', duration = 3000) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('fade-out');
        setTimeout(() => {
            notification.remove();
        }, 500);
    }, duration);
}

// Mobile menu toggle
function toggleMobileMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('active');
}

// Add to cart function
function addToCart(id, name, price) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    const existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id, name, price, quantity: 1 });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    showNotification('Producto agregado al carrito', 'success');
}

// Form validation helper
function validateForm(formId, rules) {
    const form = document.getElementById(formId);
    if (!form) return true;
    
    let isValid = true;
    
    for (const field in rules) {
        const element = form.querySelector(`[name="${field}"]`);
        if (!element) continue;
        
        const value = element.value.trim();
        const fieldRules = rules[field];
        
        if (fieldRules.required && !value) {
            isValid = false;
            showError(element, 'Este campo es requerido');
        } else if (fieldRules.email && !validateEmail(value)) {
            isValid = false;
            showError(element, 'Por favor ingrese un email válido');
        } else if (fieldRules.minLength && value.length < fieldRules.minLength) {
            isValid = false;
            showError(element, `Este campo debe tener al menos ${fieldRules.minLength} caracteres`);
        } else if (fieldRules.matchWith) {
            const matchElement = form.querySelector(`[name="${fieldRules.matchWith}"]`);
            if (matchElement && value !== matchElement.value.trim()) {
                isValid = false;
                showError(element, 'Los valores no coinciden');
            }
        }
    }
    
    return isValid;
}

function showError(element, message) {
    const errorElement = document.createElement('div');
    errorElement.className = 'error-message';
    errorElement.textContent = message;
    errorElement.style.color = '#e74c3c';
    errorElement.style.fontSize = '14px';
    errorElement.style.marginTop = '5px';
    
    const parent = element.parentElement;
    const existingError = parent.querySelector('.error-message');
    
    if (existingError) {
        existingError.textContent = message;
    } else {
        parent.appendChild(errorElement);
    }
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Initialize all forms with data-validation attribute
document.querySelectorAll('form[data-validation]').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!validateForm(this.id, window[this.dataset.validation])) {
            e.preventDefault();
        }
    });
});