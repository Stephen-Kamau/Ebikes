function checkout(){
    // Check if any items are in cart
    var items = getCartItems();

    if(items.length == 0){
        alert('Your cart is empty!');
        return;
    }

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'checkout.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){
        if(this.readyState == 4 ){
            console.log(this.responseText);

            // If response is 1, orders were placed
            if(this.responseText == 1){
                alert('Your orders have been placed');
                clearCart();
            }else{
                alert('We are unable to place your orders');
            }

        }else{
            alert('Unable to make orders. Please try again');
        }
    }

    // Items will be sent as json
    xhr.send("cart=" + JSON.stringify(items));
}
