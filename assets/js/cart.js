let cart = [];
let totalPrice = 0;

document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', () => {
        let name = button.getAttribute('data-name');
        let price = parseFloat(button.getAttribute('data-price'));
        let image = button.parentElement.querySelector('img').src; // Get image source

        cart.push({ name, price, image });
        updateCart();
    });
});

function updateCart() {
    let cartItems = document.getElementById('cart-items');
    let total = document.getElementById('total-price');
    let count = document.getElementById('cart-count');

    cartItems.innerHTML = "";
    totalPrice = 0;

    cart.forEach(item => {
        totalPrice += item.price;
        
        let cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');

        cartItem.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <div>
                <p><strong>${item.name}</strong></p>
                <p>$${item.price.toFixed(2)}</p>
            </div>
        `;
        cartItems.appendChild(cartItem);
    });

    total.innerText = totalPrice.toFixed(2);
    count.innerText = cart.length;
}

function toggleCart() {
    let cartSidebar = document.getElementById('cart-sidebar');
    cartSidebar.classList.toggle('open');
}

function clearCart() {
    cart = [];
    updateCart();
}
