# Lumen PHP Framework
API REST
version con PHP 8.0.2 y Laravel/Lumen  version 9

Tener en cuenta que al estar alojada en un hosting gratuito, carece de los verbos PUT,PATCH,DELETE por tal motivo prestar atencion a las rutas con su respectiva peticion.
En el caso de los 'id', verificar los existentes con GET read para luego poder hacer update o delete. 

Las rutas para las peticiones son:

(read) GET :  http://localhost/api_lumen/public/libros 
(read/id) POST : http://localhost/api_lumen/public/libros/id
(create Body(titulo, breve_dec, imagen)) POST : http://localhost/api_lumen/public/libros 
(delete/id) POST : http://localhost/api_lumen/public/libros/id


Tambien puedes probar su funcionamiento desde el font-end con React en https://consume-api-rest.netlify.app/
