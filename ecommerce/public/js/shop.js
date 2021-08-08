
function loadMore() {
    var lastID = $('#productLastID').val();
    var brandID = $('#selectedBrand').val();
    var cat_and_sub = $('#selectedCatAndSubcat').val();
    var LastproductFrom = $('#productFrom').val();

    var split = cat_and_sub.split(",");
    var cs = split[0];
    var csID = split[1];

    if(cs == 0 && brandID == 0) { // this is none
        //alert("This is None");
        var updatedPfrom = '0,0';
        if(updatedPfrom != LastproductFrom){
            lastID = 1000;
        }
        $.ajax({
            url: '/ajaxShopLoad_C_and_d_none',
            data:{lastID:lastID},
            method: "GET",
            success: function (response) {
                //console.log(response['output']);
                if(updatedPfrom != LastproductFrom){
                    $('#productLastID').val(response['upLastID']);
                    $('#product_BODY').html(response['output']);
                    $('#productFrom').val(updatedPfrom);
                    if(response['noMorePSts'] == 'no'){
                        var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                        addPRODUCTbutton.classList.add("d-none");
                    }
                }
                else {
                    $('#productLastID').val(response['upLastID']);
                    //$("product_BODY").empty();
                    $('#product_BODY').append(response['output']);
                    $('#productFrom').val(updatedPfrom);
                    if(response['noMorePSts'] == 'no'){
                        var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                        addPRODUCTbutton.classList.add("d-none");
                    }
                }
            }
        });
    }
    else if(cs != 0 && brandID == 0) { // this is for category or subcategory
        if(cs == 'c') {
            
            var updatedPfrom = 'c,'+csID;
            if(updatedPfrom != LastproductFrom){
                //alert(cs);
                lastID = 1000;
            }
            $.ajax({
                url: '/ajaxShopLoad_C_yes_brand_none',
                data:{
                    lastID:lastID,
                    catID:csID,
                },
                method: "GET",
                success: function (response) {
                    //console.log(response['output']);
                    if(updatedPfrom != LastproductFrom){
                        $('#productLastID').val(response['upLastID']);
                        $('#product_BODY').html(response['output']);
                        $('#productFrom').val(updatedPfrom);
                        if(response['noMorePSts'] == 'no'){
                            var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                            addPRODUCTbutton.classList.add("d-none");
                        }
                        
                    }
                    else {
                        $('#productLastID').val(response['upLastID']);
                        //$("product_BODY").empty();
                        $('#product_BODY').append(response['output']);
                        $('#productFrom').val(updatedPfrom);
                        if(response['noMorePSts'] == 'no'){
                            var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                            addPRODUCTbutton.classList.add("d-none");
                        }
                    }
                }
            });
            //alert("This is category active");
        }
        else {

            //alert("This is Only Sub category active");
            var updatedPfrom = 's,'+csID;
            //alert(updatedPfrom);
            if(updatedPfrom != LastproductFrom){
                //alert(cs);
                lastID = 1000;
            }
            $.ajax({
                url: '/ajaxShopLoad_SubCat_yes_brand_and_cat_none',
                data:{
                    lastID:lastID,
                    subCatID:csID,
                },
                method: "GET",
                success: function (response) {
                    //console.log(response['output']);
                    if(updatedPfrom != LastproductFrom){
                        $('#productLastID').val(response['upLastID']);
                        $('#product_BODY').html(response['output']);
                        $('#productFrom').val(updatedPfrom);
                        if(response['noMorePSts'] == 'no'){
                            var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                            addPRODUCTbutton.classList.add("d-none");
                        }
                    }
                    else {
                        $('#productLastID').val(response['upLastID']);
                        //$("product_BODY").empty();
                        $('#product_BODY').append(response['output']);
                        $('#productFrom').val(updatedPfrom);
                        if(response['noMorePSts'] == 'no'){
                            var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                            addPRODUCTbutton.classList.add("d-none");
                        }
                    }
                }
            });
        }
    }
    else if(cs != 0 && brandID != 0){ // this is for brand with category or subcategory

        if(cs == 'c') {
            //alert("This is category With Brand active");
            var updatedPfrom = brandID+',c,'+csID;
            if(updatedPfrom != LastproductFrom){
                //alert(cs);
                lastID = 1000;
            }
            $.ajax({
                url: '/ajaxShopLoad_Brand_yes_cat_yes_subcat_none',
                data:{
                    lastID:lastID,
                    brandID:brandID,
                    csID:csID,
                },
                method: "GET",
                success: function (response) {
                    //console.log(response['output']);
                    if(updatedPfrom != LastproductFrom){
                        $('#productLastID').val(response['upLastID']);
                        $('#product_BODY').html(response['output']);
                        $('#productFrom').val(updatedPfrom);
                        if(response['noMorePSts'] == 'no'){
                            var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                            addPRODUCTbutton.classList.add("d-none");
                        }
                    }
                    else {
                        $('#productLastID').val(response['upLastID']);
                        //$("product_BODY").empty();
                        $('#product_BODY').append(response['output']);
                        $('#productFrom').val(updatedPfrom);
                        if(response['noMorePSts'] == 'no'){
                            var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                            addPRODUCTbutton.classList.add("d-none");
                        }
                    }
                }
            });
        }
        else if(cs == 's') {
            //alert("Sub Category with Brand active");
            var updatedPfrom = brandID+',s,'+csID;
            if(updatedPfrom != LastproductFrom){
                //alert(cs);
                lastID = 1000;
            }
            $.ajax({
                url: '/ajaxShopLoad_Brand_yes_subcat_yes_cat_none',
                data:{
                    lastID:lastID,
                    brandID:brandID,
                    csID:csID,
                },
                method: "GET",
                success: function (response) {
                    //console.log(response['output']);
                    if(updatedPfrom != LastproductFrom){
                        $('#productLastID').val(response['upLastID']);
                        $('#product_BODY').html(response['output']);
                        $('#productFrom').val(updatedPfrom);
                        if(response['noMorePSts'] == 'no'){
                            var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                            addPRODUCTbutton.classList.add("d-none");
                        }
                    }
                    else {
                        $('#productLastID').val(response['upLastID']);
                        //$("product_BODY").empty();
                        $('#product_BODY').append(response['output']);
                        $('#productFrom').val(updatedPfrom);
                        if(response['noMorePSts'] == 'no'){
                            var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                            addPRODUCTbutton.classList.add("d-none");
                        }
                    }
                }
            });
        }
    }
    else if(cs == 0 && brandID != 0){ // this is only for brand
        //alert("This is only brand");
        var updatedPfrom = 'b,'+brandID;
        
        if(updatedPfrom != LastproductFrom){
            //alert(cs);
            lastID = 1000;
        }
        $.ajax({
            url: '/ajaxShopLoad_Brand_yes_subcat_and_cat_none',
            data:{
                lastID:lastID,
                brandID:brandID,
            },
            method: "GET",
            success: function (response) {
                //console.log(response['output']);
                if(updatedPfrom != LastproductFrom){
                    $('#productLastID').val(response['upLastID']);
                    $('#product_BODY').html(response['output']);
                    $('#productFrom').val(updatedPfrom);
                    if(response['noMorePSts'] == 'no'){
                        var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                        addPRODUCTbutton.classList.add("d-none");
                    }
                }
                else {
                    $('#productLastID').val(response['upLastID']);
                    //$("product_BODY").empty();
                    $('#product_BODY').append(response['output']);
                    $('#productFrom').val(updatedPfrom);
                    if(response['noMorePSts'] == 'no'){
                        var addPRODUCTbutton = document.getElementById("addProductBUTTON");
                        addPRODUCTbutton.classList.add("d-none");
                    }
                }
            }
        });
    }

    //alert(lastID);

}


// This is for brand change in shop page
$('input:radio[name="brand"]').change(function() {
    var brandID = $(this).val();
    $('#selectedBrand').val(brandID);
    var addPRODUCTbutton = document.getElementById("addProductBUTTON");
    addPRODUCTbutton.classList.remove("d-none");
    loadMore();
    
});

// This is for Category and Subcategory change in shop page
$('input:radio[name="catAndSubcat"]').change(function() {
    var catAndSubcat = $(this).val();
    $('#selectedCatAndSubcat').val(catAndSubcat);
    var addPRODUCTbutton = document.getElementById("addProductBUTTON");
    addPRODUCTbutton.classList.remove("d-none");
    loadMore();
    
});


