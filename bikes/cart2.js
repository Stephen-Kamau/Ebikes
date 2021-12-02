// Update the cart ui when page is loaded
updateCartUi();

function addCartItem(productId, title, quantity, unitPrice, image){
    var items = getCartItems();

    // Check if item is in cart
    var cart_item_index = getCartItemIndex(productId);

    if(cart_item_index == null) {
        // Item does not exist in cart
        var item = {
            productId: productId,
            title: title,
            quantity: quantity,
            unitPrice: unitPrice,
            image: image
        };

        items.push(item);
    }else{
        var item = items[cart_item_index];

        // Update quantity
        item.quantity += quantity;

        items[cart_item_index] = item;
    }

    // Save cart changes
    saveCartChanges(items);
}

function removeCartItem(productId){
    var items = getCartItems();

    // Check if item is in cart
    var cart_item_index = getCartItemIndex(productId);

    if(cart_item_index != null) {
        var item = items[cart_item_index];

        // Check if quantity is more than 1
        if(item.quantity > 1){
            item.quantity -= 1;

            items[cart_item_index] = item;
        }else{
            // Remove item
            items.splice(cart_item_index, 1);
        }

        // Save cart changes
        saveCartChanges(items);
    }
}

function getCartItems(){
    var storage = window.localStorage;

    // If cart is empty
    if(storage.getItem("cart_items") == null){
        return [];
    }

    var items = storage.getItem("cart_items");

    // Items is in json string format, convert back to array
    items = JSON.parse(items);

    return items;
}

function getCartCounter(){
    var storage = window.localStorage;

    // If cart is empty
    if(storage.getItem("cart_counter") == null){
        return 0;
    }

    return storage.getItem("cart_counter");
}

function getCartCost(){
    var storage = window.localStorage;

    // If cart is empty
    if(storage.getItem("cart_cost") == null){
        return 0;
    }

    return storage.getItem("cart_cost");
}

function getCartItemIndex(productId){
    var items = getCartItems();

    // Check for item with the same id
    for(var i=0; i<items.length; i++){
        var check_item = items[i];

        // Found the item
        if(check_item.productId == productId){
            item = check_item;
            return i;
        }
    }

    // Index not found
    return null;
}

function saveCartChanges(items){
    // Cart summary
    var counter = 0, cost = 0;

    // Loop through items, updating summary
    items.forEach(function(item){
        if(item != null){
            cost += (item.unitPrice * item.quantity);
            counter++;
        }
    });

    // Convert items to json string
    items = JSON.stringify(items);

    // save to local storage
    var storage = window.localStorage;

    storage.setItem("cart_items", items);
    storage.setItem("cart_counter", counter);
    storage.setItem("cart_cost", cost);

    // Update ui
    updateCartUi();
}

function clearCart(){
    // save to local storage
    var storage = window.localStorage;

    storage.removeItem("cart_items");
    storage.removeItem("cart_counter");
    storage.removeItem("cart_cost");

    // Update ui
    updateCartUi();
}

function updateCartUi(){
    // Cart ui
    var cart_ui = '';

    var items = getCartItems();

    // Loop through items, updating summary
    items.forEach(function(item){
        if(item != null){
            // append html
            cart_ui += `
                <div class="single-cart clearfix">
                <div class="cart-image">
                <a href=""><img src="uploads/${item.image}" alt=""></a>
                </div>
                <div class="cart-info">
                <h5><a href="">${item.title}</a></h5>
                <p>${item.quantity} x ${item.unitPrice}</p>
                <button onclick="removeCartItem('${item.productId}')" class="cart-delete"  id="cartId${item.title}" title="Remove this item"><i class="fa fa-trash-o"></i></button>
                </div>
                </div>
            `
        }
    });

    // Update UI
    // Cart items
    document.getElementById('AllCarts').innerHTML = cart_ui;

    // Counter and price
    document.getElementById('cartNum').innerHTML = getCartCounter();
    document.getElementById('totalPrice').innerHTML = getCartCost();
}



// function ErrorAlert(message){
// return
//
// }
