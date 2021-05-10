<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Bsale</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/bsalelogo.png" height="60" class="d-inline-block align-text-top">
            </a>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Producto" aria-label="Search" id="productS" onkeyup="FilterDataEnter(event)">
                <button class="btn btn-light" type="button" onclick="FilterData()">Buscar</button>
            </form>
        </div>
        </div>
    </nav>


    <div class="container" id="contenedor_carrocompra">
        <div class="card p-3 mt-2" >
            <div class="row">
                <div class="col-md-3">Categorias:
                    <select id="categories" class="form-select " onchange="FilterData()">
                        <option value=""> Todas</option>
                    </select>
                </div>
                <div class="col-md-3">Precio:
                    <select id="orderbyprice" class="form-select " onchange="FilterData()">
                        <option value="ASC"> Ascendente</option>
                        <option value="DESC"> Descendente</option>
                    </select>
                </div>
            </div>

        </div>



        <div class="row" id="rowprincipal">

        </div>

        <div class="row mt-2" id="Paginador">
           
        </div>

    </div>





</body>

</html>
<script>


    //funcion para cuando se presiobna enter
    function FilterDataEnter(event){
        if (event.keyCode === 13) {
            FilterData();
        }
    }

    //funcion del filtro, para que rellene la interfax
    function FilterData(pagina){

        if (typeof arguments[0] == "undefined"){
            var pagina = 1; 
        }
        let name = document.getElementById('productS').value;
        let categorieselect = document.getElementById('categories').value;
        let orderby = document.getElementById('orderbyprice').value;

        builddata([name,categorieselect,orderby,pagina]);
    }

    //se conecta de forma asincronica a la api creada
    async function GetData(type, arg) {
        
        let response = await fetch(`http://167.99.120.147/${type}?name=${arg[0]}&category=${arg[1]}&orderby=${arg[2]}&page=${arg[3]}`);
        let data = await response.json();
        return data;
    }

    async function categoryselect(){
     
        const categories = await GetData('categories',['','','']);
        let select = document.getElementById('categories');
        //se rellena el select de categoria con la API
        categories.forEach(element => {
            select.insertAdjacentHTML('beforeend', `<option value ="${element.id}" >${element.name} </option>`);
        });

    }


    async function builddata(arg){

        const products = await GetData('products',arg);   
        let rowprincipal = document.getElementById('rowprincipal');

        //vaciamos el html
        rowprincipal.innerHTML = '';

        let datos = '';
        let precio = '';
        let preciocd = 0;
        let url = '';



        products.products.data.forEach(element => {
            //aqui se aplica el descuento si corresponde al producto.
            if (element.discount > 0) {
                preciocd = element.price - (element.price * element.discount / 100);
                precio = `<span class="text-decoration-line-through redtext">$${element.price}</span>    $${preciocd}`;
            } else {
                precio = `<span>$${element.price}</span>`;
            }

            //se arega filtro para las imagenes nulas
            if (element.url_image == '' ||element.url_image == null ) {
                url = "{{asset('img/imagenotfound.png')}}";
            } else {
                url = element.url_image;
            }


            datos = `<div class="col-md-3 mt-2">
                        <div class="card" style="width: 18rem; min-height:380px;">
                            <img src="${url}" class="card-img-top imagentest" alt="..." >
                            <div class="card-body">
                                <p class="card-text">${element.name}</p>
                               ${precio}
                            </div>
                        </div>
                    </div> `;

            rowprincipal.insertAdjacentHTML('beforeend', datos);
        });

        if (products.products.current_page == 1){
            document.getElementById('Paginador').innerHTML =  `<p>Página  ${products.products.current_page} de ${products.products.last_page}    <button class="rounded-circle" id="currentpage"> ${products.products.current_page}  </button> <button class="rounded-circle buttonpage" onclick="FilterData(${products.products.current_page + 1})"> > </button>  <p> `;
        }else if (products.products.current_page == products.products.last_page){
            document.getElementById('Paginador').innerHTML =  `<p>Página  ${products.products.current_page} de ${products.products.last_page}   <button class="rounded-circle" buttonpage onclick="FilterData(${products.products.current_page - 1})">  < </button>  <button class="rounded-circle" id="currentpage"> ${products.products.current_page}  </button> <p> `;
        }else{
            document.getElementById('Paginador').innerHTML =  `<p>Página  ${products.products.current_page} de ${products.products.last_page}   <button class="rounded-circle" buttonpage" onclick="FilterData(${products.products.current_page - 1})" >  < </button>  <button class="rounded-circle" id="currentpage"> ${products.products.current_page}  </button> <button class="rounded-circle buttonpage" onclick="FilterData(${products.products.current_page + 1})"> > </button>  <p> `;
        }
        
        
    }



    window.onload = async function () {
        categoryselect();
        builddata(['','','asc','1']);
    };
</script>  