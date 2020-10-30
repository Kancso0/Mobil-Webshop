$(document).ready(function(){

    $(function() {
        var path = window.location.href; 
        $('.nav .nav-item a').each(function() {
         if (this.href === path) {
          $(this).addClass('active');
         }
        });
       });

       load_cart_data();

       $(window).scroll(function(){
        cartScroll();  
      });
      
     
       $('#cart-popover').popover({
        html:true,
        container: 'body',
        sanitize: false,
        content: function()
        {
            return $('#popover_content_wrapper').html();
        }
    });

    $(document).on('click', '.add_to_cart', function(){    // Add to Cart    
        var car_id = $(this).attr('id');
         
         $.ajax({
            url: "./functions/Get_Post_Sessions.php",
            method: "POST",
            data: {action: "getCarByID", car_id: car_id},
            success:function(data)
            {   
                if(data != '')
                {
                    alert(data);
                    return;
                }
                load_cart_data();
                $('#cart-popover').popover('hide');
                
            }
         });
    });

    $(document).on('click', '.remove', function(){  // remove single item from Cart
        var rowID = $(this).attr("id");

        if(confirm("Are you sure to remove this item?"))
        {
            $.ajax({
            url: "./functions/Get_Post_Sessions.php",
            method: "POST",
            data: {action: "removeRow", rowID: rowID},
            success:function()
            {
                load_cart_data();    
                $('#cart-popover').popover('hide');
            }
        });

        }    

    });

    $(document).on('click', '#clear_cart', function(){     // Clear all Cart
        
        if(confirm("Are you sure to remove all items?"))
        {
            $.ajax({
            url: "./functions/Get_Post_Sessions.php",
            method: "POST",
            data: {action: "clearCart"},
            success:function(data)
                {
                load_cart_data();
                $('#cart-popover').popover('hide');
                
                }
            });

        }
        
    });

    


});   // document.ready END



    function load_cart_data()
    {
        $.ajax({
            url: "./functions/Get_Post_Sessions.php",
            method: "POST",
            dataType: "json",
            data: {action: "loadCartData"},
            success: function(data)
            {
                $('#cart_details').html(data.cart_details);
                $('.count').text(data.total_item);
            }
        });
    }


    function cartScroll()
    {
        var cart = $(".shoppingCart");
        if($(window).scrollTop()> 100)
        {
            cart.addClass("offset");
        }
        else 
        {
            cart.removeClass("offset");
        }
    }



