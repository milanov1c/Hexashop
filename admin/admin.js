function ajaxDelete(url, table, id, result){

    $.ajax({
        url:url,
        method:"POST",
        dataType:"json",
        data:{
            id:id,
            table:table
        },
        success:result,
        error:function (xhr){console.error(xhr)}
    });
}
function ajaxActivate(url,id,result){
    $.ajax({
        url:url,
        method:"POST",
        dataType:"json",
        data:{
            id:id
        },
        success:result,
        error:function (xhr){console.error(xhr)}

    })
}
function displayMessage(message){
    let box=document.querySelector("#messageBox");
    box.innerHTML=JSON.stringify(message);
}

function validateInput(regex, input) {
    return regex.test(input.val());

}

if(window.location.pathname=="/sajt/admin/editProducts.php"){
    console.log("Dgd")
    $(document).on("click",".deleteProduct",function(){

        ajaxDelete("../logic/delete.php", "products", $(this).data("id"), function (result){
            displayMessage(result);
        });
    });

}
if(window.location.pathname=="/sajt/admin/editCategories.php"){
    $(document).on("click",".deleteCategory",function (){
        ajaxDelete("../logic/delete.php", "categories", $(this).data("id"), function (result){
            displayMessage(result);
        });

    });
    console.log("Sfsf")
}
if(window.location.pathname=="/sajt/sajt/admin/editBrands.php"){
    $(document).on("click",".deleteBrand",function (){
        ajaxDelete("../logic/delete.php", "brands", $(this).data("id"), function (result){
            displayMessage(result);
        });

    });
    console.log("Sfsf")
}
if(window.location.pathname=="/sajt/admin/editUsers.php"){
    $(document).on("click",".activateUser",function (){
        ajaxActivate("../logic/activateUser.php", $(this).data("id"),function (result){
            displayMessage(result);
        });
    });
    console.log("Gs");
}
if (window.location.pathname == "/admin/editAccount.php") {
    console.log("S");
    const regExName = /^[A-ZŠĐŽČĆ][a-zšđčćž]{2,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{2,14})?$/;
    const regExLastName = /^[A-ZŠĐŽČĆ][a-zšđčćž]{3,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{3,14})?$/;
    const regExEmail = /.*@.*/;
    const regExUsername = /^[a-zA-Z0-9]{3,20}$/;

    let username = $("#username");
    let fName = $("#fName");
    let lName = $("#lName");
    let email = $("#email");
    let role = $("#role");
    let street = $("#street");
    let city = $("#city");
    let state = $("#state");
    let zip = $("#zip");



    $("#adminEditUser").on("click", function () {
        let errors = 0;
        errors += validateInput(regExName, fName) ? 0 : 1;
        errors += validateInput(regExLastName, lName) ? 0 : 1;
        errors += validateInput(regExEmail, email) ? 0 : 1;
        errors += validateInput(regExUsername, username) ? 0 : 1;

        if (errors) {
            $(this).siblings().removeClass("d-none");
            console.log(errors)
        } else {
            console.log("nema greske")
            $.ajax({
                url: "../logic/adminEditUser.php",
                method: "post",
                dataType: "json",
                data: {
                    username: username.val(),
                    fName: fName.val(),
                    lName: lName.val(),
                    email: email.val(),
                    role: role.val(),
                    street: street.val(),
                    city: city.val(),
                    state: state.val(),
                    zip: zip.val(),
                    id: $(this).data("id")
                },
                success: function(result) {
                    displayMessage(result);
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        }
    });
}
if(window.location.pathname=="/sajt/admin/editSingleProduct.php"){
    const regExNameProduct=/^[A-Z\s]+$/u;
    const regExPrice=/^\d{1,}\.\d{2}$/u;
    let errors=0;

    $(document).on("click","#adminEditProduct",function () {
        let productName = $("#productName");
        let description = $("#description");
        let price = $("#price");
        let category = $("#category");
        let brand = $("#brand");

        errors += validateInput(regExNameProduct, productName) ? 0 : 1;
        errors += validateInput(regExPrice, price) ? 0 : 1;

        if (errors) {
            $(this).siblings().removeClass("d-none");
            console.log(errors)
        }else{
            $.ajax({
                url: "../logic/adminEditProduct.php",
                method: "post",
                dataType: "json",
                data: {
                    prodName:productName.val(),
                    description:description.val(),
                    price:price.val(),
                    category:category.val(),
                    brand:brand.val(),
                    id: $(this).data("id")
                },
                success: function(result) {
                    displayMessage(result);
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        }

    });

}


