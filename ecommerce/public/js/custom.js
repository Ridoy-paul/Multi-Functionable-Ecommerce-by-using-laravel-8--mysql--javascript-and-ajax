
// for right button click off
// document.addEventListener("contextmenu", function(e){
//    e.preventDefault();
// }, false);
// for right button click off


$(document).ready(function () {
   
    cartload();
    total_wishlist_itmes();

    $('.increment-btn').click(function (e) {
      e.preventDefault();
      var incre_value = $(this).parents('.quantity').find('.qty-input').val();
      var value = parseInt(incre_value, 10);
      value = isNaN(value) ? 0 : value;
      // if(value > 1){
          value++;
          $(this).parents('.quantity').find('.qty-input').val(value);
      // }
  });

  $('.decrement-btn').click(function (e) {
      e.preventDefault();
      var decre_value = $(this).parents('.quantity').find('.qty-input').val();
      var value = parseInt(decre_value, 10);
      value = isNaN(value) ? 0 : value;
      if(value>1){
          value--;
          $(this).parents('.quantity').find('.qty-input').val(value);
      }
      else {
         Toastify({
            text: "Can't decrease below 1!!",
            backgroundColor: "linear-gradient(to right, #F50057, #1B1F85)",
            className: "error",
          }).showToast();
      }
  });

  leftCartSidebar();

  //Total_Calculation_In_checkout_Page();

});

// function for product quantity minus
function Q_minus(pid) {
   var current_Q = $('#pQuantity'+pid).val();
   if(current_Q >= 2) {
      var update_Q = current_Q - 1;
      $('#pQuantity'+pid).val(update_Q);
   }
   else {
      Toastify({
         text: 'Minimum Quentity Is 1',
         backgroundColor: "linear-gradient(to right, #F50057, #F9A826)",
         className: "error",
       }).showToast();
   }

  
}

// function for product quantity Plus
function Q_plus(pid) {
   var current_Q = $('#pQuantity'+pid).val();
   var update_Q = parseInt(current_Q) + 1;
   $('#pQuantity'+pid).val(update_Q);
}


// Change cart Quantity
function changeCartQty(id){
   // alert("changed");
   var secPID = id;
   var qty = $('#cartQty'+id).val();
   
   $.ajax({
      url: '/update_to_cart',
      method:"GET",
      data:{ 
         secPID:secPID,
         qty: qty,
      },
      success: function (response) {
          //window.location.reload();
          var grndTotal = response['grandtotal'].toFixed(2);
          var setgtotal = $('#indGtotal'+id).text(grndTotal);
          TotalPriceCalc();
          leftCartSidebar();
          //console.log(grndTotal);
          Toastify({
           text: response['status'],
           backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
           className: "error",
         }).showToast();
      }
  });
}

//Begin::Change Cart Qty Plus Button in cart and sidecart
function update_cart_qty_in_sideCart_and_cart_plus(id) {

   var secPID = id;
   var qty = $('#cartQty'+id).val();
   var qty =parseFloat(qty) + parseInt(1);
   $('#cartQty'+id).val(qty);
   
   $.ajax({
      url: '/update_to_cart',
      method:"GET",
      data:{ 
         secPID:secPID,
         qty: qty,
      },
      success: function (response) {
          var grndTotal = response['grandtotal'].toFixed(2);
          var setgtotal = $('#indGtotal'+id).text(grndTotal);
          TotalPriceCalc();
          leftCartSidebar();
          //console.log(grndTotal);
          Toastify({
           text: response['status'],
           backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
           className: "error",
         }).showToast();
      }
  });

}
//End::Change Cart Qty Plus Button in cart and sidecart

//Begin::Change Cart Qty Minus Button in cart and sidecart
function update_cart_qty_in_sideCart_and_cart_Minus(id) {

   var secPID = id;
   var qty = $('#cartQty'+id).val();
   if(qty > 1) {
      var qty =parseFloat(qty) - parseInt(1);
      $('#cartQty'+id).val(qty);
      
      $.ajax({
         url: '/update_to_cart',
         method:"GET",
         data:{ 
            secPID:secPID,
            qty: qty,
         },
         success: function (response) {
             var grndTotal = response['grandtotal'].toFixed(2);
             var setgtotal = $('#indGtotal'+id).text(grndTotal);
             TotalPriceCalc();
             leftCartSidebar();
             //console.log(grndTotal);
             Toastify({
              text: response['status'],
              backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
              className: "error",
            }).showToast();
         }
     });
   }
   

}
//End::Change Cart Qty Minus Button in cart and sidecart




// to calculate subtotal in cart page
function TotalPriceCalc() {
   var total = 0;
   $(".indCartGrndTotal").each(function() {
       total += parseFloat($(this).text());
   });
   var subTotal = total.toFixed(2);
   var placetotal = $("#cart_page_subtotal").text(subTotal);
   //$("#right_side_cart_subtotal").text(subTotal);
   $('#inputSubtotal').val(subTotal);
  
   var minimum_buy = $('#minimumBuyAm').val();


   var couponType = $('#couponType').val();
   if(couponType == 'Fixed'){

      // if(subTotal <= minimum_buy){
      //    alert("hello");
      // }

      var disValue = $('#couponValue').val();
      subTotal = parseFloat(subTotal) - parseFloat(disValue);
      $('#couponDiscountValue_show').text(disValue);

      var couponDiv = document.getElementById("couponCodeDiv");
      couponDiv.classList.add("d-none");

      var couponSuccessDiv = document.getElementById("AppliedCoupon");
      couponSuccessDiv.classList.remove("d-none");

   }
   else if(couponType == 'Percentage'){

      // if(minimum_buy < subTotal){
      //    alert(minimum_buy);
      // }

      var disValue = $('#couponValue').val();
      var maxDis = $('#maxCValue').val();
      var discountAmount_in_percent = (disValue * subTotal)/100;
      if(discountAmount_in_percent > maxDis) {
         $('#couponDiscountValue_show').text(maxDis);
         subTotal = parseFloat(subTotal) - parseFloat(maxDis);
      }
      else {
         $('#couponDiscountValue_show').text(discountAmount_in_percent);
         subTotal = parseFloat(subTotal) - parseFloat(discountAmount_in_percent);
      }

      var couponDiv = document.getElementById("couponCodeDiv");
      couponDiv.classList.add("d-none");

      var couponSuccessDiv = document.getElementById("AppliedCoupon");
      couponSuccessDiv.classList.remove("d-none");

   }


   var shippingCrg = $('#shippingchargeHi').val();
   var subtotalWithSh = parseFloat(subTotal) + parseFloat(shippingCrg);

   $('#cart_grandTotal').text(subtotalWithSh);
   //alert(subtotalWithSh);
   //console.log(total);
}

// Total Calculation in checkout page
function Total_Calculation_In_checkout_Page() {
  
   var subTotal = $("#cart_page_subtotal").text();
  
   var minimum_buy = $('#minimumBuyAm').val();

   var couponType = $('#couponType').val();
   if(couponType == 'Fixed'){

      var disValue = $('#couponValue').val();
      subTotal = parseFloat(subTotal) - parseFloat(disValue);
      $('#couponDiscountValue_show').text(disValue);
      $('#couponDiscountValue').val(disValue);

      var couponDiv = document.getElementById("couponCodeDiv");
      couponDiv.classList.add("d-none");

      var couponSuccessDiv = document.getElementById("AppliedCoupon");
      couponSuccessDiv.classList.remove("d-none");

   }
   else if(couponType == 'Percentage'){

      var disValue = $('#couponValue').val();
      var maxDis = $('#maxCValue').val();
      var discountAmount_in_percent = (disValue * subTotal)/100;
      if(discountAmount_in_percent > maxDis) {
         $('#couponDiscountValue_show').text(maxDis);
         $('#couponDiscountValue').val(maxDis);
         subTotal = parseFloat(subTotal) - parseFloat(maxDis);
      }
      else {
         $('#couponDiscountValue_show').text(discountAmount_in_percent);
         $('#couponDiscountValue').val(discountAmount_in_percent);
         subTotal = parseFloat(subTotal) - parseFloat(discountAmount_in_percent);
      }

      var couponDiv = document.getElementById("couponCodeDiv");
      couponDiv.classList.add("d-none");

      var couponSuccessDiv = document.getElementById("AppliedCoupon");
      couponSuccessDiv.classList.remove("d-none");

   }


   var shippingCrg = $('#shippingchargeHi').val();
   var subtotalWithSh = parseFloat(subTotal) + parseFloat(shippingCrg);

   var wallet_bl_value = $('#wallet_bl_use').val();
   if(wallet_bl_value > subtotalWithSh) {
      //alert('Hello change');
      var total_pay = 0.00;
      $('#wallet_bl_use').val(subtotalWithSh);
      $('#wallet_bl_used').text(subtotalWithSh);

   }
   else {
      var total_pay = subtotalWithSh - wallet_bl_value;
   }
   

   $('#checkout_grand_total').text(total_pay);
   // alert(subtotalWithSh);
   //console.log(total);
}




// Delete Cart page row
function DeleteCartRow(id) {
   $.ajax({
      url: '/delete_from_cart',
      method:"GET",
      data:{ 
         secPID:id,
      },
      success: function (response) {
         if(response['deleteSts'] == 1){
            $("#cartTr"+id).remove();
            leftCartSidebar();
            cartload();
            Toastify({
               text: response['status'],
               backgroundColor: "linear-gradient(to right, #F50057, #1B1F85)",
               className: "error",
             }).showToast();

             TotalPriceCalc();
         }
      }
  });
}

// Add to Cart Function --------------------------------------------------->>>>>>>>>>>>>>>>>>>>>>
function add_to_cart(pid, pst){
      
    var price = $('#pPrice'+pid).text();
    if(pst != 1){
      var qty = $('#pQuantity'+pid).val();
    }
    else {
       qty = 1;
    }
    
    
    var variationArray = [];
    //alert(qty);

    var pid_withVN = pid;
    var pType = $('#checkV_'+pid).val();
    if(pType == 'variation') {

       var color = $('#colorVID').val();
       if(color != '') {
         variationArray.push(color);
       }
       const intagName = [];
       var ids = {};
       $("#inside_variation_id>input").each(function(i){
          ids[i] = $(this).prop('id');
          intagName.push(ids[i]);
          
       });

       for (const val of intagName) {
       // console.log(val);
          var inputValue = $('#'+val).val();
          if(inputValue != ''){
                variationArray.push(inputValue);
          }
          
       }

         let variNum = "";
         variationArray.forEach(myFunction);
         function myFunction(value, index, array) {
            variNum += value; 
          }
          //console.log(variNum);

            pid_withVN += variNum; 
        // console.log(pid_withVN);

    }

    
    var variArRy = JSON.stringify(variationArray);

    $.ajax({
       url:'/add_to_cart',
       method:"GET",
       data:{ 
          proid:pid,
          secID:pid_withVN,
          price: price,
          type: pType,
          qty: qty,
          variations: variArRy,
       },
       success:function(response){
          cartload();
          leftCartSidebar();
          //console.log(data);
          Toastify({
            text: response['status'],
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
            className: "error",
          }).showToast();

       }
    });

   // console.log(variationArray);
    
 }

 function selectColor(color, colorID) {
    jQuery('#colorVID').val(colorID);
    
 }

 function selectSV(idName, attribute) {
    var temp = $('#'+idName).children(":selected").text();
    var idv = '#'+idName+'_i';
    $(idv).val(attribute);
 }

 //Begin:: Direct Buy Now >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Buy Now Button Click
 function Buy_NOW(pid, pst){
      
   var price = $('#pPrice'+pid).text();
   if(pst != 1){
     var qty = $('#pQuantity'+pid).val();
   }
   else {
      qty = 1;
   }
   
   
   var variationArray = [];
   //alert(qty);

   var pid_withVN = pid;
   var pType = $('#checkV_'+pid).val();
   if(pType == 'variation') {

      var color = $('#colorVID').val();
      if(color != '') {
        variationArray.push(color);
      }
      const intagName = [];
      var ids = {};
      $("#inside_variation_id>input").each(function(i){
         ids[i] = $(this).prop('id');
         intagName.push(ids[i]);
         
      });

      for (const val of intagName) {
      // console.log(val);
         var inputValue = $('#'+val).val();
         if(inputValue != ''){
               variationArray.push(inputValue);
         }
         
      }

        let variNum = "";
        variationArray.forEach(myFunction);
        function myFunction(value, index, array) {
           variNum += value; 
         }
         //console.log(variNum);

           pid_withVN += variNum; 
       // console.log(pid_withVN);

   }

   
   var variArRy = JSON.stringify(variationArray);

   $.ajax({
      url:'/add_to_cart',
      method:"GET",
      data:{ 
         proid:pid,
         secID:pid_withVN,
         price: price,
         type: pType,
         qty: qty,
         variations: variArRy,
      },
      success:function(response){
         //cartload();
         //leftCartSidebar();
         //console.log(data);
         Toastify({
           text: response['status'],
           backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
           className: "error",
         }).showToast();
         window.location.href = "/cart";

      }
   });

  // console.log(variationArray);
   
}
 //End:: End Buy Now >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Buy Now Button Click


 // End:: Add to Cart Function --------------------------------------------------->>>>>>>>>>>>>>>>>>>>>>

 // Begin:: Total Item in cart
 function cartload(){

        $.ajax({
            url: '/load_cart_data',
            method: "GET",
            success: function (response) {
                var totalItem = response['totalcartcount'];
                $('#totalItem_in_cart').text(totalItem);
            }
        });
}
// End::  Total Item in cart

//Begin:: Wishlist -------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Wishlist

// Add to Wishlist
function Add_to_wishlist(pid) {
   var price = $('#pPrice'+pid).text();

   $.ajax({
      url:'/add_to_wishList',
      method:"GET",
      data:{ 
         proid:pid,
         price: price,
      },
      success:function(response){
         total_wishlist_itmes()
         if(response['YN'] == 1){
            Toastify({
               text: response['status'],
               backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
               className: "error",
             }).showToast();
         }
         else {
            Toastify({
               text: response['status'],
               backgroundColor: "linear-gradient(to right, #F50057, #6C63FF)",
               className: "error",
             }).showToast();
         }

      }
   });

}
// Add to wishlist

// total wishlist items
function total_wishlist_itmes(){
   $.ajax({
       url: '/wishlist/count_wishlist_data',
       method: "GET",
       success: function (response) {
           var totalItem = response['totalWcount'];
           //alert(totalItem);
           $('#total_wishlist_count').text(totalItem);
       }
   });
}
// total wishlist items

// Delete wishlist items
function Delete_Wishlist_item(id) {
   $.ajax({
      url: '/wishlist/delete_item',
      method:"GET",
      data:{ 
         pid:id,
      },
      success: function (response) {
         if(response['deleteSts'] == 1){
            $("#WishlistTr"+id).remove();
            total_wishlist_itmes()
            Toastify({
               text: response['status'],
               backgroundColor: "linear-gradient(to right, #F50057, #1B1F85)",
               className: "error",
             }).showToast();
         }
      }
  });
}
//Delete wishlist items


//End:: Wishlist -------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Wishlist



// Shipping Charge Changes
function ShippingCng(){
   var x = document.getElementById("shippingAreaChange").value;
   var split = x.split(",");
   var id = split[0];
   var amount = split[1];
   $('#shippingchargeHi').val(amount);
   $('#setshippingID').val(id);
   $('#shippingChargeshow').text(amount);

   TotalPriceCalc();
   $.ajax({
      url:'/setShippingCookie',
      method:"GET",
      data:{ 
         shipID:id,
         amount:amount,
      },
      success:function(response){
         
      }
   });
}
// Shipping Charge Changes

// Shipping Charge Changes in Checkout page
function ShippingCngCheckout(){
   var x = document.getElementById("shippingAreaChange").value;
   var split = x.split(",");
   var id = split[0];
   var amount = split[1];
   $('#shippingchargeHi').val(amount);
   $('#shippingChargeshow').text(amount);
   Total_Calculation_In_checkout_Page();
   $.ajax({
      url:'/setShippingCookie',
      method:"GET",
      data:{ 
         shipID:id,
         amount:amount,
      },
      success:function(response){
         
      }
   });
   
}
// Shipping Charge Changes in Checkout page



// Begin:: apply Coupon
function ApplyCoupon(){
   var inputs = $('#couponCode').val();
   var getSubtotal = $('#cart_page_subtotal').text();
   //alert(getSubtotal);
   if(inputs == ''){
      Toastify({
         text: '⚠️ Coupon is empty',
         backgroundColor: "linear-gradient(to right, #F50057, #F9A826)",
         className: "error",
       }).showToast();
   }
   else {
      $.ajax({
         url:'/checkcouponCode',
         method:"GET",
         data:{ 
            code:inputs,
            subtotal:getSubtotal,
         },
         success:function(response){
            if(response['status'] == 'not'){
               Toastify({
                  text: response['reason'],
                  backgroundColor: "linear-gradient(to right, #F50057, #F9A826)",
                  className: "error",
                }).showToast();
            }
            else if(response['status'] == 'yes'){
               $('#couponIDforCheckout').val(response['couponID']);
               $('#couponValue').val(response['d_amount']);
               $('#maxCValue').val(response['d_max_am']);
               $('#couponType').val(response['dtype']);
               $('#minimumBuyAm').val(response['minimum_buy_am']);
               TotalPriceCalc();
               
            }
            
         }
      });
   }

   
   //alert(inputs);
}
// End:: apply Coupon

// Begin:: apply Coupon in Checkout page
function ApplyCouponCheckout(){
   var inputs = $('#couponCode').val();
   var getSubtotal = $('#cart_page_subtotal').text();
  // alert(inputs);
   if(inputs == ''){
      Toastify({
         text: '⚠️ Coupon is empty',
         backgroundColor: "linear-gradient(to right, #F50057, #F9A826)",
         className: "error",
       }).showToast();
   }
   else {
      $.ajax({
         url:'/checkcouponCode',
         method:"GET",
         data:{ 
            code:inputs,
            subtotal:getSubtotal,
         },
         success:function(response){
            if(response['status'] == 'not'){
               Toastify({
                  text: response['reason'],
                  backgroundColor: "linear-gradient(to right, #F50057, #F9A826)",
                  className: "error",
                }).showToast();
            }
            else if(response['status'] == 'yes'){
               $('#couponIDforCheckout').val(response['couponID']);
               $('#couponValue').val(response['d_amount']);
               $('#maxCValue').val(response['d_max_am']);
               $('#couponType').val(response['dtype']);
               $('#minimumBuyAm').val(response['minimum_buy_am']);
               Total_Calculation_In_checkout_Page();
            }
            
  
         }
      });
   }

   
   //alert(inputs);
}
// End:: apply Coupon in Checkout page



// Begin:: Create OTP
function create_otp(){
   var number = $("#phoneForOTP").val();
   var otp = Math.floor(100000 + Math.random() * 900000);
   //otp_sent_regular();
   if(number!=""){
      otp_sent_regular();
      $.ajax({
         url:'/sendotp',
         method:"GET",
         data:{ otp_code:otp,number:number},
         success:function(response){

         }
    })

   }else{
       no_number();
   }
}
// Begin:: Create OTP

// Begin:: For OTP
function otp_sent_regular(){
   swal({
      title: "OTP SENT!",
      text: "Please check your mobile phone",
      icon: "success",
      button: "Ok",
    });
 }
 // End:: For OTP

// Begin:: For OTP
 function no_number(){
   Toastify({
      text: 'Please Enter Your Number',
      backgroundColor: "linear-gradient(to right, #6C63FF, #F50057)",
      className: "error",
    }).showToast();
 }
// End:: For OTP

//Begin:: Checkout Page phone Check
$(document).on("change paste keyup cut select", "#CheckoutPhone", function() {
   var logedIN = $('#checkLoggedin').val();
   var phone = $('#CheckoutPhone').val();
   var phoneLength = phone.length;
   if(logedIN == 0 && phoneLength == 11){
      $.ajax({
         url:'/checkoutPhone',
         method:"GET",
         data:{ phone:phone },
         success:function(response){
            if(response['status'] == 'yes'){
               $('#checkPhoneWarning').text(response['reason']);
            }
            else {
               $('#checkPhoneWarning').text('  ');
            }
         }
    })
   }
   else if(logedIN == 0 && phoneLength < 11) {
      $('#checkPhoneWarning').text('  ');
   }
   
}); 
//End:: Checkout Page phone Check

//Begin:: Checkout Page email Check
$(document).on("change paste keyup cut select", "#CheckoutEmail", function() {
   var logedIN = $('#checkLoggedin').val();
   var email = $('#CheckoutEmail').val();
   if(logedIN == 0){
      $.ajax({
         url:'/checkoutEmail',
         method:"GET",
         data:{ email:email },
         success:function(response){
            if(response['status'] == 'yes'){
               $('#checkEmailWarning').text(response['reason']);
            }
            else if(response['status'] == 'no'){
               $('#checkEmailWarning').text('  ');
            }
         }
    })
   }
   
   
}); 
//End:: Checkout Page email Check

// Begin:: Checkout District to Thana ajax
$(document).ready(function() {
$('#checkoutDistrict').on('change', function() {
   var districtID = $(this).val();
   //console.log(111);
   if(districtID) {
       $.ajax({
           url: '/findDistrictIDtoThana/'+districtID,
           type: "GET",
           data : {"_token":"{{ csrf_token() }}"},
           dataType: "json",
           success:function(data) {
             //console.log(data);
             if(data){
               $('#checkoutThanas').empty();
               $('#checkoutThanas').focus;
               $('#checkoutThanas').append('<option value="">-- Select Area --</option>'); 
               $.each(data, function(key, value){
               $('select[name="checkoutThana"]').append('<option value="'+ value.id +'">' + value.shipping_sub_name+ '</option>');
           });
         }else{
           $('#subCat').empty();
         }
         }
       });
   }else{
     $('#subCat').empty();
   }
});
});
// End:: Checkout District to Thana ajax

//Begin:: checkout use wallet balance function
function Use_wallet_bl(user_bl) {
   // alert(user_bl);
   var maximun_use_in_percent = $('#maximum_wallet_use_parcent').val();
   // alert(maximun_use_in_percent);
   var usable_wallet_bl = (maximun_use_in_percent * user_bl)/100;
   $('#wallet_bl_use').val(usable_wallet_bl);
   $('#wallet_bl_used').text(usable_wallet_bl);

   var wallet_show = document.getElementById("wallet_bl_show_tag");
   wallet_show.classList.remove("d-none");

   var use_wallet_button = document.getElementById("use_wallet_button");
   use_wallet_button.classList.add("d-none");
   Total_Calculation_In_checkout_Page();
   
}
//End:: checkout use wallet balance function

//Start:: checkout Payment Method Change radio function
$('input[type=radio][name=paymentMethod]').change(function() {
   
   if(this.value != 'cashonD') {
      // alert(this.value);
      var number = $('#num_'+this.value).val();

      var methodShow = document.getElementById("transIDrow");
      methodShow.classList.remove("d-none");

      var name_and_num = this.value+" "+number;
      $('#meth_Name_and_num').text(name_and_num);

      $("#transactionID").prop('required',true);

   }
   else {
      var methodShow = document.getElementById("transIDrow");
      methodShow.classList.add("d-none");
      $("#transactionID").prop('required',false);
   }
});

//End:: checkout Payment Method Change radio function

//Begin:: order Cancle Button click to open modal
function orderCancleButtonClick() {
   $('#orderCancleModal').modal('show');
}

function OrderCancleModalClose() {
   $('#orderCancleModal').modal('hide');
}
//Begin:: order Cancle Button click to open modal and close modal


//Begin:: Blog Load More Button
function BlogLoadMore() {
   var lastID = $('#BlogLastID').val();
   $.ajax({
      cache: false,
      url: '/Blog_load_more_using_ajax',
      data:{lastID:lastID},
      method: "GET",
      success: function (response) {
         $('#BlogLastID').val(response['upLastID']);
         $('#blog_body').append(response['output']);
         if(response['noMorePSts'] == 'no'){
            var addPRODUCTbutton = document.getElementById("LoadMoreButtonRow");
            addPRODUCTbutton.classList.add("d-none");
         }
          
      }
  });
}

//End:: Blog Load More Button

//Begin::Ship to another address check or not
$("#ship_to_another_address_check").change(function() {
   if($(this).prop('checked')) {
      var order_address = document.getElementById("order_address_div");
      order_address.classList.add("d-none");

      var ship_to_another_address = document.getElementById("ship_to_another_address");
      ship_to_another_address.classList.remove("d-none");
   } else {
      var order_address = document.getElementById("order_address_div");
      order_address.classList.remove("d-none");

      var ship_to_another_address = document.getElementById("ship_to_another_address");
      ship_to_another_address.classList.add("d-none");
   }
});
//End::Ship to another address check or not

//Begin::Set Shipping Address in without login Checkout page
$( document ).ready(function() {
   $(document).on("change", "#checkoutDistrict", function() {
      set_shipping_address_without_login();
   });

   $(document).on("change", "#checkoutThanas", function() {
      set_shipping_address_without_login();
   });
   
   $(document).on("click change paste keyup cut select", "#full_address", function() {
      set_shipping_address_without_login();
  });
});


function set_shipping_address_without_login() {
   var full_address = $('#full_address').val();
   var district = $('#checkoutDistrict :selected').text();
   var thana = $('#checkoutThanas :selected').text();
   if(thana == '-- Select Area --' || thana == '') {
      thana = '';
   }
   if(district == '-- Select District --' || district == '') {
      district = '';
   }
   
   var shipping_address = full_address+', '+thana+', '+district;
   document.getElementById("order_address").value = shipping_address;
   
}

//End::Set Shipping Address in without login Checkout page
















