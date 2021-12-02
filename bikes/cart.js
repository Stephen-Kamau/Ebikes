// get item from the item clicked




var addToCartBtn = document.getElementsByClassName('addToCart');
var cartNum = document.getElementById('cartNum');
var allCarts = document.getElementById('AllCarts');
var myCart = document.getElementById('MyCart');
var totalDiv = document.getElementById('totalPrice');
// var delItem = document.getElementById('DeleteItem');
let itemDel = "";
// console.log(addToCartBtn)
let storage = sessionStorage;
storage.setItem("counter",0)
storage.setItem("cost",0)
// declare array to hold items
var carts = [];

var counter = JSON.parse(storage.getItem('carts')) ? JSON.parse(storage.getItem('carts')).length:0
var cost = counter;

cartNum.innerHTML = counter;
// loop through all the btns
for (var i = 0; i < addToCartBtn.length; i++) {
  addToCartBtn[i].addEventListener("click" ,
  function(e){

    e.preventDefault();
    // get a sincle item into objecty
    var item = {
      id : i+1,
      productId: '',
      title : e.target.parentElement.parentElement.parentElement.querySelector(".title a").innerHTML,
      price : e.target.parentElement.parentElement.parentElement.querySelector(".new").innerHTML,
      image : e.target.parentElement.parentElement.parentElement.querySelector("img").src,
      quantity : 1
    }

    // put the item in the local storage
    counter = counter +1;
    // console.log();
    cost = cost + parseInt(item.price.substring(1))
    storage.setItem("counter" , counter)
    storage.setItem("cost" , cost)
    if(JSON.parse(storage.getItem('carts'))== null){
      console.log("Data");
      carts.push(item);
      storage.setItem("carts" , JSON.stringify(carts))
    }
    else{
      const presentItems = JSON.parse(storage.getItem('carts'));

// solve it later
      // presentItems.map(data =>{
      //   console.log(item.title == data.title);
      //     if(item.title == data.title){
      //       data.quantity = data.quantity+1;
      //     }
      //     else{
      //       console.log("Pushing item");
      //       presentItems.push(item);
      //     }
      //   })
      for (var i = 0; i < presentItems.length; i++) {
        // console.log(presentItems[i].title == item.title);
        if (presentItems[i].title == item.title) {
            presentItems[i].quantity = presentItems[i].quantity+1;
          break;
        }
        if (i==(presentItems.length-1)) {
            presentItems.push(item);
        }

      }


      console.log(presentItems)
      // push the items to cart
    // presentItems.push(item)
    storage.setItem("carts" , JSON.stringify(presentItems))
    }
    console.log(storage.counter);
    cartNum.innerHTML = storage.counter;
    totalDiv.innerHTML = storage.cost;
  });
}



function addToCart(productId, title, quantity, price){

}




function CheckoutCart(){
  // for
  var allItems = JSON.parse(storage.getItem('carts'));

  allCarts.innerHTML = "";
  if(allItems){
    for (var i = 0; i < allItems.length; i++) {
      disp = `
      <div class="single-cart clearfix">
      <div class="cart-image">
      <a href=""><img src="${allItems[i].image}" alt=""></a>
      </div>
      <div class="cart-info">
      <h5><a href="">${allItems[i].title}</a></h5>
      <p>${allItems[i].quantity} x ${allItems[i].price}</p>
      <button href="" onclick="DeleteItemFromCart('${allItems[i].title}')" class="cart-delete"  id="cartId${allItems[i].title}" title="Remove this item"><i class="fa fa-trash-o"></i></button>
      </div>
      </div>
      `
      allCarts.innerHTML+=disp;
      console.log(disp)
    }
  }

}


myCart.addEventListener('click' ,CheckoutCart)



function DeleteItemFromCart(title){
  // alert("hehe");
var allItems = JSON.parse(storage.getItem('carts'))
var cost = storage.getItem('cost')
for (var i = 0; i < allItems.length; i++) {
  if (allItems[i].title == title) {
    var qty = allItems[i].quantity;
    if(qty >1){
      cost = cost - allItems[i].price
      allItems[i].quantity -=1
    }
    else{
      cost = cost - allItems[i].price
      allItems.pop(allItems[i])
    }

    if (allItems.length ==0) {
        storage.removeItem("carts")
    }else{

      storage.setItem("carts",JSON.stringify(allItems));
    }
    var counter = JSON.parse(storage.getItem('carts')) ? JSON.parse(storage.getItem('carts')).length:0
    cartNum.innerHTML = counter;
    totalDiv.innerHTML = cost;
    break;
  }
}}

// delItem.addEventListener("click" , DeleteItemFromCart)
