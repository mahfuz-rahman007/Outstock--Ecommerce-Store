$(function($){
    ("use strict");


    // message show sweet alert
    const Toast2 = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    function success(message) {
            Toast2.fire({
                icon: 'success',
                title: message
            })
    };
    function error(message) {
            Toast2.fire({
                icon: 'error',
                title: message
            })
    };
    function warning(message) {
        Toast2.fire({
            icon: 'warning',
            title: message
        })
};
    // message show sweet alert end


    	//  Cart Plus Minus Js
	$(".cart-plus-minus").append('<div class="dec qtybutton">-</div><div class="inc qtybutton">+</div>');
	$(".qtybutton").on("click", function () {
		var $button = $(this);
		var current_qty = parseInt($button.parent().find("input").val());

		let stock = parseInt($button.parent().find("input").attr('data-href'));

		if ($button.text() == "+") {

            if(current_qty < stock ){
                var newVal = parseFloat(current_qty) + 1;
            }else{
				warning('Product Stock is '+ stock);
                newVal = stock;
            }

		} else {
			// Don't allow decrementing below zero
			if (current_qty > 1) {
				var newVal = parseFloat(current_qty) - 1;
			} else {
				warning('Product Minimum Quantity Must be 1');
				newVal = 1;
			}
		}
		$button.parent().find("input").val(newVal);
	});

    // cart amount validation
    $('.cart-plus-minus input').on('keyup', function(e){
        let current_qty = parseInt($(this).val());
		let stock = parseInt($(this).attr('data-href'));

        var invalidChars = [
            "-",
            "+",
            '.',
            "e",
            "E"
          ];

        if (invalidChars.includes(e.key) ) {
            warning('Product Quantity Invalid');
            $(this).val(1);
        }

        if($(this).val()[0] == 0 ){
            warning('Product Quantity Invalid');
            $(this).val(current_qty);
        }
        if(current_qty > stock ){
            warning('Product Stock is '+ stock);
            $(this).val(stock);
        }
        if(current_qty <= 0){
            warning('Product Minimum Quantity Must be 1');
            $(this).val(1);
        }
    });

    // show cart quintity
    function getCartQty(){
        let get_qty_url = $('.cart_count').attr('data-href');
        $.get(get_qty_url,function(qty){
            $('.cart_count').text(qty);
        });
    }

    // add to cart
    $(document).on('click', '#add_cart', function(){

        let cartUrl = $(this).attr('data-href');

        let cartItemCount =  $('.cart-plus-minus input').val();

        if(isNaN(cartItemCount) == true ){
            $('.cart-plus-minus input').val(1);
            cartItemCount = 1;
        }

        $.get(cartUrl+',,,'+cartItemCount,function(res){
            if(res.message){
                getCartQty();
                success(res.message);
                $('.cart-plus-minus input').val(1);
            }else{
                error(res.error)
                $('.cart-plus-minus input').val(1);
            }
        })

    });

    // remove cart
    $(document).on('click','.item-remove',function(){

        let removeItem = $(this).attr('rel');
        let removeItemUrl = $(this).attr('data-href');
        $.get(removeItemUrl,function(res){

            if(res.message){
                success(res.message);
                getCartQty();
                if(res.count == 0){
                    $(".cart-table").remove();
                    $('.remove_before').html( `
                        <div class="bg-light py-5 text-center">
                            <h3 class="text-uppercase">Cart is empty!</h3>
                        </div>`
                    );
                }
                $('.product_count').text(res.count);
                $('.product_totalPrice').text(res.total);
                $('.remove'+removeItem).remove();
            }else{
                error(res.error);
            }

        });

    });

    // update Cart
    $(document).on('click', '#cart_update', function(){

        $(this).prop('disabled',true);

        let cartQty = [];
        let cartPrice = [];
        let cartProduct = [];
        let cartUpdateurl = $(this).attr('data-href');

        // product quantity  array
        $('.quantity').each( function () {
                cartQty.push($(this).val());
        });

        // product price array
        $('.product_price').each( function(){
            let replaced_num = $(this).text().replace("," , "");
            cartPrice.push(parseFloat(replaced_num));
        });

        let cartSubtotal = [];
        // product subtottal price array
        let i = 0;
        while( i < cartQty.length ){
            let num = cartQty[i]*cartPrice[i];
            cartSubtotal.push( num.toLocaleString('en-US'));
            i++
        }
        
        // product id array
        $('.product_id').each( function(){
            cartProduct.push($(this).val());
        });

        let formData = new FormData();
        let x = 0;
        for(x=0; x<cartQty.length; x++) {
            formData.append('qty[]', cartQty[x]);
            formData.append('cartprice[]', cartPrice[x]);
            formData.append('product_id[]', cartProduct[x]);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
         });

         $.ajax({
            type: "POST",
            url: cartUpdateurl,
            data: formData,
            processData: false,
            contentType:false,
            success: function(data){
                if(data.message){
                    success(data.message);
                    let i = 0;
                        $('.cart_price').each(function(){
                            if(i < cartQty.length){
                                $(this).text(cartSubtotal[i]);
                                i++;
                            } else {
                                return false;
                            }
                        });
            
                    $('#cart_update').prop('disabled',false);
                    if(data.count){
                        $('.product_count').text(data.count);
                        $('.product_totalPrice').text(data.total);
                    }
                }else {
                    error(data.error);
                }
            }
        })

    });

    // header cart view with ajax
    $(document).on('mouseover', '#view_cart_ajax', function(){
        loadCart();
    });

    // header cart view with ajax
    $(document).on('mouseover', '#header_cart', function(){
        $('#header_load_cart').html('');
        $('#header_load_cart').html(`
            <p class="cart-empty">Cart is empty</p>
        
        `);
        
    });

    function loadCart(){
        let headerCartUrl = $('#view_cart_ajax').attr('data-href');

        $.get(headerCartUrl, function(res){
            $('#header_load_cart').html(res);
        });

    };

    // shipping cost add to cartsubtotal
    $(document).on('click', '.shipping_charge', function(){

        let shipping_cost = parseFloat( $(this).attr('data-href').replace("," , "") ).toFixed(2);
        let cart_subtotal = parseFloat( $('.cart_subtotal').attr('data-href').replace("," , "")).toFixed(2);

        let grand_total = parseFloat( shipping_cost ) + parseFloat( cart_subtotal );

        console.log(typeof grand_total);

        grand_total = grand_total.toLocaleString('en-US');

        shipping_cost = shipping_cost.toLocaleString('en-US');

        $('.shipping_cost').html(shipping_cost);
        $('.cart_grandtotal').html(grand_total);

    });


    // payment gateway check
    $(document).on('click', '.product_payment_gateway_check', function(){

        let gateway_check = $(this).attr('id');

        $('.product_payment_gateway_check').removeClass('active');

        $(this).addClass('active');

        if( gateway_check == 'Paypal' ){

            $('#payment_gateway_check').attr('action', $('#product_paypal').val());
            $('.payment_show_check').addClass('d-none');
            $('.payment_show_check input').prop('required', false);

        } 
        else if (gateway_check == 'Stripe') {

            $('#payment_gateway_check').attr('action', $('#product_stripe').val());
            $('.payment_show_check').removeClass('d-none');
            $('.payment_show_check input').prop('required', true);

        }
        else if (gateway_check == 'Cash On Delivery'){

            $('#payment_gateway_check').attr('action', $('#product_cash_on_delivery').val());
            $('.payment_show_check').addClass('d-none');
            $('.payment_show_check input').prop('required', false);
        }


        $('#payment_gateway').val($(this).attr('data-href'));
        
    });

    $(document).on('click', '.view_order_details' , function(){
        let orderUrl = $(this).attr('data-href');

        $.get(orderUrl, function(data){
            $('#order_info_view').html(data);
        });

    });

    $(document).on('click', '#add_wishlist', function(){

        let wishlistUrl = $(this).attr('data-href');
        let removeUrl = $(this).attr('data-remove');

        $(this).css("color", "#bc8246");
        $(this).attr('id', 'remove_wishlist');
        $(this).attr('data-href', removeUrl);
        $(this).attr('title', "Remove From Wishlist");
        
        


        $.get(wishlistUrl, function(res){
            if(res.message){
                success(res.message);
            } else {
                error(res.error);
            }
        });
    });

    $(document).on('click', '#remove_wishlist' , function(){
        let wishlistUrl = $(this).attr('data-href');
        let addUrl = $(this).attr('data-add');


        let removeItem = $(this).attr('rel');

        $(this).css("color", "#444");
        $(this).attr('id', 'add_wishlist');
        $(this).attr('data-href', addUrl);
        $(this).attr('title', "Add To Wishlist");


        if(removeItem == null){
            removeItem = false;
        }

        $.get(wishlistUrl, function(res){
            if(res.message){
                success(res.message);

                if(removeItem != false){
                    if(res.count == 0){
                        $(".cart-table").remove();
                        $('.remove_before').html( `
                            <div class="bg-light py-5 text-center">
                                <h3 class="text-uppercase">Cart is empty!</h3>
                            </div>`
                        );
                    }
                    $('.remove'+removeItem).remove();
                } else {

                }

            } else {
                error(res.error);
            }


        });
    })




});