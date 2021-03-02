
const inputText = document.querySelector('.input');
const form = document.querySelector('.formSearch');
const divProducts = document.querySelector('.products');

const createVegetable = (oneData) =>{
    const productItemDiv = document.createElement('div');
    productItemDiv.classList.add('product-item');
    const headingName = document.createElement('h4');
    headingName.classList.add('product-name');
    headingName.innerText = oneData.name;
    const headingPrice = document.createElement('h5');
    headingPrice.classList.add('product-price');
    headingPrice.innerText = oneData.price;
    const imgProductDiv = document.createElement('div');
    imgProductDiv.classList.add('image-card');
    const image = document.createElement('img');
    image.src = `http://localhost/prodavnica/public/img/${oneData.image}.jpg`;
    imgProductDiv.appendChild(image);
    productItemDiv.appendChild(headingName);
    productItemDiv.appendChild(imgProductDiv);
    productItemDiv.appendChild(headingPrice);
    divProducts.appendChild(productItemDiv);

};



const showFiltered = () =>{

    const formToBePassed = new FormData(form);

    fetch('/prodavnica/products/search',{
        body:formToBePassed,
        method:'post',
        credentials: 'same-origin'
    })
        .then(response =>{
            if (!response.ok) {
                throw Error("ERROR");
            }
            return response.json();
        })
        .then(data => {
            divProducts.innerHTML= '';
            if (Object.keys(data).length > 0) {
                data.map(oneData => {
                    createVegetable(oneData);
                })
            }
            else
            {
                const productItemDiv = document.createElement('div');
                productItemDiv.classList.add('product-item');
                const headingName = document.createElement('h4');
                headingName.classList.add('product-name');
                headingName.innerText = "Nema rezultata";
                productItemDiv.appendChild(headingName);
                divProducts.appendChild(productItemDiv);
            }
        })

}



form.addEventListener('submit',(e)=>{
    e.preventDefault();
    showFiltered();
});