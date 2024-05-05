const productPhotos = document.querySelectorAll('.product-photo');
productPhotos.forEach(element => {
    element.addEventListener('click', function() {
        // console.log(this.dataset.productId)
        id = this.dataset.productId;
        getProductDetai(id);
    });
    
});

async function getProductDetai(id){
   //1
  const url = 'app/api/productdetail.php';
  const data = {productId: id}
   //2
  const respone = await fetch(url , {
    method : 'POST' ,
    body : JSON.stringify(data)

  });
   //3
  const result = await respone.json();
  const divResult = document.querySelector('.result');
  const product_view = document.querySelector('.product-view'+ result.id);

  product_view.innerHTML = `<i class="bi bi-eye-fill"></i>` + result.product_view;
  divResult.innerHTML = `
  <h2>${result.product_name}</h2>
  <p>${result.product_price}</p>
  <img src="public/images/${result.product_photo}" alt="">
  <div>${result.product_description}</div>`
}

const btnLikes = document.querySelectorAll('.btn-like');
btnLikes.forEach(element => {
    element.addEventListener('click', function() {
        id = this.dataset.productId;
        const list_ids = JSON.parse(window.localStorage.getItem('list_id')) || [];
        if (!list_ids.includes(id)) {
            list_ids.push(id);
            
            localStorage.setItem('list_id', JSON.stringify(list_ids));
            likeProduct(id, this);
        }
    });
    
});


async function likeProduct(id, btnLike){
    //
    const url = 'app/api/like.php';
    const data = {productId: id}
    //2
    const respone = await fetch(url , {
        method : 'POST' ,   
        body : JSON.stringify(data)
    });
    //3
    const result = await respone.json();
   btnLike.innerHTML = `<i class="bi bi-heart-fill"></i> ` + result.product_like;

}

// Tifm kiem san pham
const listSearch = document.querySelector('.list-search');

const input = document.querySelector('.inputclass');
input.addEventListener('input',function(){
    searchProduct(this.input);
});

async function searchProduct(q){
    // 1.
    const url = 'app/api/search.php';
    const data = {q: q}
    // 2.
    const respone = await fetch(url,{
        method : 'POST',
        body: JSON.stringify(data)
    });
    //3.
    const result = await respone.json();
    listSearch.innerHTML = '';
    result.forEach(element => {
        
        listSearch.innerHTML += `<li class="list-search-item">${result.product_name}</li>`
    });
}