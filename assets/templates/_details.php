<style>
        img{
    width: 100%;
    display: block;
}
.main-wrapper{
    min-height: 100vh;
    background-color: #f1f1f1;
    display: flex;
    align-items: center;
    justify-content: center;
}
.details-container{
    max-width: 1200px;
    padding: 0 1rem;
    margin: 0 auto;
}
.dtl-product-div{
    margin: 1rem 0;
    padding: 2rem 0;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    background-color: #fff;
    border-radius: 3px;
    column-gap: 10px;
}
.dtl-product-div-left{
    padding: 10px;
}
.dtl-product-div-right{
    padding: 20px;
}
.dtl-img-container img{
    width: 200px;
    height: 200px;
    margin: 0 auto;
}
.hover-container{
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    margin-top: 32px;
}
.hover-container div{
    border: 2px solid rgba(252, 160, 175, 0.7);
    padding: 1rem;
    border-radius: 3px;
    margin: 0 4px 8px 4px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.active{
    border-color: rgb(255, 145, 163)!important;
}
.hover-container div:hover{
    border-color: rgb(255, 145, 163);
}
.hover-container div img{
    width: 50px;
    height: 50px;
    cursor: pointer;
}
.dtl-product-div-right span{
    display: block;
}
.dtl-product-name{
    font-size: 26px;
    margin-bottom: 22px;
    font-weight: 700;
    letter-spacing: 1px;
    opacity: 0.9;
}
.dtl-product-price{
    font-weight: 700;
    font-size: 24px;
    opacity: 0.9;
    font-weight: 500;
}
.dtl-product-rating{
    display: flex;
    align-items: center;
    margin-top: 12px;
}
.dtl-product-rating span{
    margin-right: 6px;
}
.dtl-product-description{
    font-weight: 18px;
    line-height: 1.6;
    font-weight: 300;
    opacity: 0.9;
    margin-top: 22px;
}
.btn-groups{
    margin-top: 22px;
}
.btn-groups button{
    display: inline-block;
    font-size: 16px;
    font-family: inherit;
    text-transform: uppercase;
    padding: 15px 16px;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
}
.btn-groups button .fas{
    margin-right: 8px;
}
.add-cart-btn{
    background-color: #FF9F00;
    border: 2px solid #FF9F00;
    margin-right: 8px;
}
.add-cart-btn:hover{
    background-color: #fff;
    color: #FF9F00;
}
.buy-now-btn{
    background-color: #000;
    border: 2px solid #000;
}
.buy-now-btn:hover{
    background-color: #fff;
    color: #000;
}

@media screen and (max-width: 992px){
    .dtl-product-div{
        grid-template-columns: 100%;
    }
    .dtl-product-div-right{
        text-align: center;
    }
    .dtl-product-rating{
        justify-content: center;
    }
    .dtl-product-description{
        max-width: 400px;
        margin-right: auto;
        margin-left: auto;
    }
}

@media screen and (max-width: 400px){
    .btn-groups button{
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>


<!-- Product Details -->

<div class = "main-wrapper">
    <div class = "details-container">
        <div class = "dtl-product-div">
            <div class = "dtl-product-div-left">
                <div class = "dtl-img-container">
                    <img src = "../assets/img/black-wig-1.png" alt = "wig">
                </div>
                <div class = "hover-container">
                    <div><img src = "../assets/img/black-wig-1.png"></div>
                    <div><img src = "../assets/img/black-wig-2.png"></div>
                    <div><img src = "../assets/img/black-wig-3.png"></div>
                    <!-- <div><img src = "../assets/img/black-wig-4.png"></div> -->
                    <!-- <div><img src = "../assets/img/black-wig-5.png"></div> -->
                </div>
            </div>
            <div class = "dtl-product-div-right">
                <span class = "dtl-product-name">(New)HD Brazilian Lace Wigs</span>
                <span class = "dtl-product-price">KES 2550.00</span>
                <div class = "dtl-product-rating">
                    <span><i class = "fas fa-star"></i></span>
                    <span><i class = "fas fa-star"></i></span>
                    <span><i class = "fas fa-star"></i></span>
                    <span><i class = "fas fa-star"></i></span>
                    <span><i class = "fas fa-star-half-alt"></i></span>
                    <span>(350 ratings)</span>
                </div>
                <p class = "dtl-product-description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae animi ad minima veritatis dolore. Architecto facere dignissimos voluptate fugit ratione molestias quis quidem exercitationem voluptas.</p>
                <div class = "btn-groups">
                    <button type = "button" class = "add-cart-btn"><i class = "fas fa-shopping-cart"></i>add to cart</button>
                    <a href="../cart"><button type = "button" class = "buy-now-btn"><i class = "fas fa-wallet"></i>buy now</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Details -->

<script>
// details
const allHoverImages = document.querySelectorAll('.hover-container div img');
const imgContainer = document.querySelector('.dtl-img-container');

window.addEventListener('DOMContentLoaded', () => {
    allHoverImages[0].parentElement.classList.add('active');
});

allHoverImages.forEach((image) => {
    image.addEventListener('mouseover', () =>{
        console.log('Mouseover event triggered');
        imgContainer.querySelector('img').src = image.src;
        resetActiveImg();
        image.parentElement.classList.add('active');
    });
});

function resetActiveImg(){
    allHoverImages.forEach((img) => {
        img.parentElement.classList.remove('active');
    });
}


</script>
