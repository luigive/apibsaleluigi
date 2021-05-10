Creacion api Bsale.

*Primero crear proyecto en laravel 7.0 llamado “api bsale”.

*crear modelo “producto” basado en la tabla “products” de la base de datos otorgada en el documento.

*relacionar modelo “ producto” con modelo Category a travez de la llave foranea category con la funcion con nombre category

*crear funciones scopeSearchNameProducts, scopeSearchCategory las cuales recibiran como argumento el $query(este sera el objeto de base de datos) y $argument(este sera el argumento que se recibira por GET), las cuales aplicaran los filtros de categoria y nombre.

*crear funcion scopeOrderProduct la cual recibirancomo argumento el $query(este sera el objeto de base de datos) y $orderby(este sera el argumento que se recibira por GET), verifica si el argumento recibido orderby esta dentro de los valores validos, y realiza el orden by a la query.
*crear modelo category a travez de la base de datos category dada en la base de datos otorgada en el documento.

*crear funcion products dentro del modelo category el cual tendra la relacion entre products y category.

*crear controlador CategoryController, este tendra una funcion index que devolvera todas las categorias en la base de datos.

*crear controlador ProducController, el cual tendra una funcion index que recibira como argumento $request( este sera el arreglo donde se recibiran todos los parametros por GET), esta funcion debe llamar a todos los productos junto con los 3 filtros creados en en el modelo products, y devolver los datos recibidos como JSON

*crear ruta WEB.php, la cual tendra las rutas que llamaran a nuestros controlador CategoryController ( este con el enlace APIBSALE/categories) y el ProducController (este sera con el enlace APIBSALE/products)

*conectar el archivo .env con los datos de la base de datos solicitada en el documento.
