//form validation



let regExName=/^[A-ZŠĐŽČĆ][a-zšđčćž]{2,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{2,14})?$/;
let regExLastName=/^[A-ZŠĐŽČĆ][a-zšđčćž]{3,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{3,14})?$/;
let regExEmail=/^[a-z0-9\.]+@[a-z]+\.[a-z]{2,3}$/;
let regExPassword=/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;
let regExUsername=/^[a-zA-Z0-9]{3,20}$/;
var formErrors=0;
function regExCheck(regEx, input){

    if(!regEx.test(input.value)){

        input.nextElementSibling.classList.remove("invisible");
        formErrors++;
    }else{

        input.nextElementSibling.classList.remove("visible");
        input.nextElementSibling.classList.add("invisible");
        formErrors=0;
    }
}

function checkForm(){
    let fNameReg=document.querySelector("#fNameRegister");
    let lNameReg=document.querySelector("#lNameRegister");
    let usernameReg=document.querySelector("#usernameRegister");
    let emailReg=document.querySelector("#emailRegister");
    let passwordReg=document.querySelector("#passwordRegister");
    let passwordReReg=document.querySelector("#passwordReRegister");

    regExCheck(regExName, fNameReg);
    regExCheck(regExLastName, lNameReg);
    regExCheck(regExUsername, usernameReg);
    regExCheck(regExEmail, emailReg);
    regExCheck(regExPassword, passwordReg);
    regExCheck(regExPassword, passwordReReg);

    if(passwordReReg.value!=passwordReg.value)
    {

        passwordReReg.nextElementSibling.classList.remove("invisible");
        formErrors++;
    }else{

        passwordReReg.nextElementSibling.classList.remove("visible");
        passwordReReg.nextElementSibling.classList.add("invisible");
        formErrors=0;
    }
    if(formErrors>0){
        console.log(formErrors)
        return false;

    }else{

        console.log("nini");
        return true;

    }
}



//end form validation



//ajax
function ajaxCallBack(url, method, data){

}
var lastPage=1;
$(document).on("change", ".category", function(){

    ajaxFilter(function (result){
        displayProducts(result)
        displayPagination(result);
    });
});
$(document).on("change", "#ddlSort", function(){

    ajaxFilter(function (result){
        displayProducts(result)
        displayPagination(result);
    });
    //console.log($("#ddlSort").val())
});
$(document).on("change", "#ddlBrands", function(){

    ajaxFilter(function (result){
        displayProducts(result)
        displayPagination(result);
    });
    //console.log($("#ddlBrands").val())
});
$(document).on("click", "#searchButton", function(){

    ajaxFilter(function (result){
        displayProducts(result)
        displayPagination(result);
    });
    //console.log($("#search").val())
});
$(document).on("click", ".page", function(){
    lastPage=$(this).data("id");
    ajaxFilter(function (result){
        displayProducts(result);
        //displayPagination(result);
    });

});
$(document).on("click", ".add-cart", function (){
    ajaxAddToCart($(this).data("id"), $(this).data("user"),function (result){
        console.log(result);
    });
});
$(document).on("click", ".remove-cart", function (){
    ajaxRemoveFromCart($(this).data("id"), $(this).data("user"),function (result){
        displayCart(result);
        displayCartSummary(result);
    });
});

function ajaxFilter(result){
    let selectedCategories = $(".category:checked").map(function(){
        return $(this).data("id");
    }).get();

    let search=$("#search").val();

    let brand=$("#ddlBrands").val();

    let sort=$("#ddlSort").val();

    let page=lastPage;

    $.ajax({
        url: "logic/filter.php",
        method: "post",
        data: {
            page:page,
            categories: selectedCategories,
            search:search,
            brand:brand,
            sort:sort
        },
        dataType: "json",
        success:result,

        error: function(xhr) {
            console.error(xhr);
        }
    });
}

function displayProducts(productsObj){
    let html="";
    if(productsObj.length>0){
        for (const productsObjElement of productsObj) {
            html+=`<div class='col-lg-3'>
                    <div class='item'>
                        <div class='thumb'>
                            <div class='hover-content'>
                                <ul>
                                    <li><a href='single-product.php?id=${productsObjElement.product_id}'><i class='fa fa-eye'></i></a></li>
                                    
                                </ul>
                            </div>
                            <img src='assets/images/shop/${productsObjElement.product_img}' class='img-fluid' alt='${productsObjElement.product_name}'>
                        </div>
                        <div class='down-content'>
                            <h4>${productsObjElement.product_name}</h4>
                            <span>$${productsObjElement.price}</span>
                            <ul class='stars'>
                                <li><i class='fa fa-star'></i></li>
                            </ul>
                        </div>
                    </div>
                </div>`;

        }
    }
    else if(productsObj.length===0){
        html="<h3 class='text-center mt-5'>Seems like none of our products match your search. Please try again.\n</h3>";
    }

    document.querySelector("#productsDisplay").innerHTML=html;


}

function displayPagination(productsObj){
    let html="";
    let paginationNum=Math.ceil(productsObj.length/12);

    if(paginationNum!=0){
        for(let i=0; i<paginationNum; i++){
            html+=`<li class="active"><a href="#" data-id="${paginationNum}" class="page">${paginationNum}</a></li>`;
        }
    }

    document.querySelector("#paginationList").innerHTML=html;

}

function displayCart(productsObj){
    let html="";
    let cartBlock=document.querySelector("#cartItems");

    if(productsObj.length>0){
        productsObj.forEach(p=>{
            html+=`<div class="row border-top border-bottom">
                    <div class="row main align-items-center">
                        <div class="col-2"><img class="img-fluid" src="assets/images/shop/${p.product_img}"></div>
                        <div class="col">
                            <div class="row text-muted">${p.category_name}</div>
                            <div class="row">${p.product_name}</div>
                        </div>
                        <div class="col">
                            <a href="#">-</a><a href="#" class="border">${p.quantity}</a><a href="#">+</a>
                        </div>
                        <div class="col">&dollar; ${p.price*p.quantity},00 <a class="remove-cart" href="#" data-id="${p.product_id}">&#10005;</a></div>
                    </div>
                </div>`;
        })
    }
    else{
        html+=`<h3 class="text-center py-5">Seems like you cart is empty. Go back to shop :)</h3>`;
    }
    cartBlock.innerHTML=html;
}

function displayCartSummary(productsObj){
    let html="";
    let summaryBlock=document.querySelector(".summary");
    let itemsCount=0;
    let total=0;
    let shipping=0;
    let totalPrice=productsObj.length>0 ? total+shipping: 0;

    productsObj.forEach(p=>{
        itemsCount++;
        total+=p.quantity*p.price;
    });

    html+=` <div><h5><b>Summary</b></h5></div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">ITEMS ${itemsCount}</div>
                    <div class="col text-right">&euro; ${total}.00</div>
                </div>
                <form>
                    <p>SHIPPING</p>
                    <select><option class="text-muted">Standard-Delivery- &euro;5.00</option></select>
                    <p>GIVE CODE</p>
                    <input id="code" placeholder="Enter your code">
                </form>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">TOTAL PRICE</div>
                    <div class="col text-right">&euro; ${totalPrice}.00</div>
                </div>
                <button class="btn">CHECKOUT</button>
            </div>`;
    summaryBlock.innerHTML=html;
}

function ajaxAddToCart(id, user, result){
    $.ajax({
        url:"logic/addToCart.php",
        method:"POST",
        data:{
            product:id,
            user:user,
            quantity:document.querySelector("#quantity")!=null?document.querySelector("#quantity").value:1
        },
        success: result,
        error:function (xhr){
            console.error(xhr);
        }
    })
}

function ajaxRemoveFromCart(id, user, result){
    $.ajax({
        url:"logic/removeFromCart.php",
        method:"POST",
        data:{
            product:id,
            user:user
        },
        success: result,
        error:function (xhr){
            console.error(xhr);
        }
    })
}





