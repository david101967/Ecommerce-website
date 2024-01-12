const payBtn = document.querySelector('.btn-buy');

payBtn.addEventListener('click',()=>{
    fetch('/stripe-checkout',{
        method:'post',
        headers:new Headers({"Content-Type":"application/Json"}),
        body: JSON.stringify({
            items: JSON.parse(localStorage.getItem('cartItems')),
        }),
    })
        .then((res)=>res.json())
        .then((data) => {
            console.log(data);
            location.href = data.url;
            clearCart()
        })
        .catch((err)=>console.log(err));
});