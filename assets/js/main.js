let myStorage = localStorage;
let cart = [];

$( document ).ready( function () {
    loadData();
    calcTotal();
});

$(".product-preview button").on('click', function() {
    let id =  $(this).data("id");
    let flag = false;
    cart.forEach(function(val, i, arr) {
        if(val.id == id) {
            arr[i].count++;
            flag = true;
        }
    });
    if(!flag) {
        cart.push({'id': $(this).data("id"), 'name': $(this).data("name"), 'price': $(this).data("price"), 'count': 1});
    }
    calcTotal();
    saveData();
});

$("#cart").click(function() { //на клик можно и так обработчик повесить)
    renderCart();
    $(".some-cart").toggle();
});

$("#clear-cart").click(function() {
    cart = [];
    saveData();
    calcTotal();
});

$("#buy-now").click(function() {
    if(cart.length > 0) {
        $(".overlay").fadeIn();
        $(".modal").fadeIn();
    }
});

$("#send").click(function() {
    if(($(".modal #username").val() != '') && ($(".modal #userphone").val() != '')) {
        $.ajax({
            method: "POST",
            url: "/site/buy",
            data: { name: $(".modal #username").val(), phone: $(".modal #userphone").val(), products: JSON.stringify(cart) }
        }).done(function() {
            alert( "Your order is accepted");
        });
        
        $(".overlay").fadeOut();
        $(".modal").fadeOut();
        $(".some-cart").fadeOut();
        cart = [];
        saveData();
        calcTotal();
    }
});

$(".some-cart").on('click','.fa-plus-square',function() {
    let id = $(this).parent().parent().data("id");
    cart.forEach(function(val,i,arr) {
        if(val.id == id) {
            arr[i].count++;
        }
    });
    saveData();
    calcTotal();
});

$(".some-cart").on('click','.fa-minus-square',function() {
    let id = $(this).parent().parent().data("id");
    cart.forEach(function(val,i,arr) {
        if(val.id == id) {
            if(val.count > 1) {
                arr[i].count--;
            } else {
                arr.splice(i,1);
            }
        }
    });
    saveData();
    calcTotal();
});

function renderCart() {
    $(".some-cart table").html('');
    $(".some-cart table").append('<tr style="font-weight: bold;"><td>Product</td><td>Price</td><td>Count</td><td>Sum</td></tr>');
    cart.forEach(function(val) {
        $(".some-cart table").append("<tr data-id='"+val.id+"'><td>"+val.name+"</td><td>"+val.price+"</td><td><i class='far fa-minus-square'></i>"+val.count+"<i class='far fa-plus-square'></td><td>"+(val.price*val.count)+"</i></td></tr>");
    });
}

function calcTotal() {
    let sum = 0;
    if(cart.length > 0) {
        $(".some-cart p").hide();
        cart.forEach(function(val) {
            sum += val.price * val.count;
        });
    } else {
        $(".some-cart p").show();
    }
    $("#cart #total").html(sum);
    renderCart();
}

function saveData() {
    myStorage.setItem('cart',JSON.stringify(cart));
}

function loadData() {
    if(myStorage.getItem('cart')) {
        cart =  JSON.parse(myStorage.getItem('cart'));
    }
}