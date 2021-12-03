# oficinas-synergie
## Detalles generales
El objetivo de este plugin es crear un tipo de contenido en WordPress que nos permita registrar y administrar las diferentes oficinas que hay a nivel nacional. Este plugin crea una estructura de URL lógica y ordenada, tal y como sigue: **mysite/oficinas/provincia/nombre-oficina**
Siguiendo esta estructura, detallamos los diferentes niveles:

**mysite/oficinas**

Esta es la única página que tiene que crear el usuario desde el panel de WordPress. Hay libertad absoluta a la hora de crear esta página, pero existe un requisito indispensable: debe añadir el shortcode [provincias]. Este shortcode lista todas las provincias que existan en nuestras oficinas. Cada provincia es clicable y nos lleva al siguiente nivel.

**mysite/oficinas/provincia**

Esta página se crea automáticamente con la plantilla taxonomy-provincia.php. Genera un encabezado con el nombre de la provincia y un listado de las oficinas que hay en esa provincia. Cada oficina es clicable y nos lleva al siguiente nivel..

**mysite/oficinas/provincia/nombre-oficina**

Esta página también se crea automáticamente con la plantilla single-oficinas.php. Genera un encabezado con el nombre de la oficina y un todos los datos de contacto de la oficina que el usuario ha introducido al crear la oficina. 
  
## Detalle de los archivos del plugin

- img
  - map-phone.png
- templates
  - archive-oficinas.php
  - single-oficinas.php
  - taxonomy-provincia.php
- index.php
- oficinas-styles.css
- oficinas-synergie.php

### Raiz

**index.php**

Archivo en blanco tal y como indican los estándares de desarrollo WordPress por motivos de seguridad.

**oficinas-synergie.php**

Archivo principal del plugin. En este archivo se crean las taxonomías "Provincias" y "Codigo", el Custom Post Type "Oficinas", crea la estructura de enlaces que hemos visto, crea campos automáticos en el CPT "Oficinas" (dirección, cp, ciudad, horario, telefono, email, link de bookings y link de ofertas), se añaden las plantillas que se van a utilizar, registra y pone en cola los estilos CSS, crea un shortcode para mostrar un listado de las oficinas que acepta un parámetro "provincia" y crea otro shortcode para listar la provincias.

_Listado de funciones_

+ _Taxonomía "provincias"_

  Registramos la taxonomía "provincia" al CPT "oficinas". Hacemos que el slug de la taxonomía sea "oficinas", de esta forma podemos mantener una estructura de enlaces lógica.
  
+ _Taxonomía "codigo"_

  Registramos la taxonomía "codigo" al CPT "oficinas". El slug de esta taxonomía es "codigos", pero no es relevante ya que no tiene que haber navegación de los usuarios en los archivos de esta taxonomía.

+ _Custom Post Type "oficinas" + modificación del slug "%provincia%"_

  Registramos el CPT "oficinas" y establecemos el slug a "/oficinas/%provincia%" para luego modificarlo. En los **args** establecemos 'supports' con el array ('title', 'custom-fields', 'page-attributes', 'post-formats'). Con esto limitamos lo que el usuario puede añadir al crear una nueva oficina, quedando solo disponible para rellenar el título, los campos personalizados (que creamos automáticamente), los atributos de página y los formatos del post.
  
  La segunda función va muy relacionada con la primera y lo que hace es reemplazar del slug la palabra %provincia% por la provincia en cuestión.

+ _Campos personalizados automatizados para el CPT "oficinas"_

  Creamos los siguientes campos automatizados para el CPT "oficinas": dirección, cp, ciudad, horario, teléfono, email, link de bookings, link de ofertas.

+ _Añadir plantillas para las páginas de oficina y para las páginas de provincia_

  Incluimos las plantillas PHP que tenemos dentro de la carpeta "templates". Cargamos las plantillas de forma condicional en función de si es una pagina singular de oficina o bien una página de taxonomía de provincia.
 
+ _Registrar y poner en cola los estilos CSS_

  Registramos y ponemos en cola los archivos CSS de forma condicional para que solo se carguen cuando sean necesarios para ahorrar procesos.

+ _Shortcode para mostrar los listados de oficinas en función de la provincia_

  Este shortcode retorna un listado de oficinas según la provincia que le pasemos por parámetro. Por lo que, si queremos un listado de todas las oficinas de la provincia de Barcelona, tenemos que llamar al siguiente shortcode: [oficinas provincia="barcelona"].

+ _Shortcode para mostrar el listado de provincias_

  Este shortcode retorna un listado de todas las provincias que tenemos. Si una provincia no tiene ninguna delegación, esta provincia no aparecerá en el listado.


**oficinas-styles.css**

Archivo con los estilos CSS del plugin. Están creados a medida para Synergie.

### img

Esta carpeta contiene las imagenes del plugin, en este caso solo hay una: map-phone.png. Se utiliza para los encabezados de las páginas de provincia y de oficina.

### templates

**single-oficinas.php**

Plantilla PHP que se carga en las páginas de oficina. Esta plantilla recoge los datos que introduce el usuario en los campos personalizados y los almacena en variables para luego generar el contenido de la página y poner las variables donde sea necesario.

**taxonomy-provincia.php**

Plantilla PHP que se carga en las páginas de provincia. Esta plantilla crea el encabezado con el nombre de la provincia y hace una query que retorna una lista de oficinas que están en la provincia en cuestión.
