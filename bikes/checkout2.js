var cart_items = getCartItems();

var ui = '';

// Append all items to ui
cart_items.forEach(function(item){
    ui += `
    <div class="col-lg-4 col-md-6 col-12 mb-60">
        <div class="product">
            <div class="image">
                <a href="details.php?id=${item.productId}" class="img"><img src='uploads/${item.image}' alt="Product"></a>
            </div>

            <div class="content">
                <div class="head fix">
                    <div class="title-category float-left">
                        <h5 class="title"><a href="details.php?id=${item.productId}">${item.title}</a></h5>
                    </div>
                    <div class="price float-right">
                        <span class="new">$${item.unitPrice}</span>
                    </div>
                </div>

                <div class="action-button fix">
                    <button class="addToCart" onclick="removeCartItem('${item.productId}')">Remove Item</button>
                </div>
            </div>
        </div>
    </div>
    `;
});

document.getElementById('cart_items').innerHTML += ui;
