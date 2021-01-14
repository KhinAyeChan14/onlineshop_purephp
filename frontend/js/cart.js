var oldstate = localStorage.getItem('item');
$(document).ready(function(){
    setInterval(watch,1000);

    function watch(){
        var now =  localStorage.getItem('item')
        if (oldstate!=now) {
            oldstate=now;
            itemCount();
            calculateTotal()
        }
    };

    itemCount();
    calculateTotal();

    
    function itemCount(){
       var totalItem=0;
       var itemList=localStorage.getItem("item");
       if(itemList){
        itemArray=JSON.parse(itemList);

        itemArray.forEach(function(v,i){
         totalItem+=v.qty;
         
     });

        // console.log(totalItem);
        // $("#isitem").show();
        // $("#noitem").().hide();
        // $('#noitem').html('');
        $(".cartNoti").html(totalItem);
        $('#noitem').hide();

    }
    else{
        totalItem=0;
        $(".cartNoti").html(totalItem);
        $('#isitem').hide();
        $('#noitem').show();
        
    }
}

function calculateTotal(){

    itemList=localStorage.getItem("item");

    if(itemList){
        itemArray=JSON.parse(itemList);

        var total=0;
        var subtotal=0;

        itemArray.forEach(function(v,i){

            if(v.discount==""){
                total=parseInt(v.price*v.qty);
            }

            else{
                total=parseInt(v.discount*v.qty);
            }
            subtotal+=total;
                    // console.log(total);

                });

        $('.total').html(subtotal+"Ks");


    }
    

}

$('.checkoutBtn').on('click',function(){
    var cart=localStorage.getItem('item');
    console.log(cart);
    var note=$('#notes').val();
    console.log(note);

    var total=0;

    var cartArray=JSON.parse(cart);
    $.each(cartArray,function(i,v){

        var unitprice=v.price;
        var discount=v.discount;
        var qty=v.qty;
        if(discount){
            var price=discount;
        }
        else{
            var price=unitprice;
        }
        var subtotal=price*qty;
        total+=subtotal++;
    });
    console.log(total);

    $.post('storeOrder.php',{
        carts:cartArray,
        note:note,
        total:total
    },function(response){   
        localStorage.clear();
        location.href = "ordersuccess.php";

    });


});

});