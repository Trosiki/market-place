# Marketplace - TroskiShop
En este repositorio se podrá ver un ejemplo de prueba técnica donde se solicita realizar una web haciendo uso de Hexagonal
y principios DDD, la web trata de un pequeño marketplace reducido, con funcionalidades básicas donde se valora el uso de 
la arquitectura.

## Enunciado
Una pequeña start-up comienza un ambicioso proyecto para crear un market-place
tecnológico. Desde negocio quieren tener un pequeño piloto en producción lo antes posible. Esta primera versión tendrá 
funcionalidades reducidas que irán creciendo durante mucho tiempo.


Desde el departamento técnico se ponen las expectativas más altas para el producto.
El requisito principal es realizar un proyecto altamente tolerable al cambio.
Los objetivos de la prueba técnica son:

1. Crea una estructura para un proyecto que aplique un diseño táctico siguiendo **principios de DDD**. Durante el desarrollo,
en la medida de lo posible define un diseño estratégico usando un lenguaje ubicuo.
2. Define los límites de los **contextos, módulos y/o agregados** teniendo en cuenta que  aunque ahora mismo su dominio es 
pequeño y con pocas responsabilidades pero en el futuro este debe crecer de manera independiente.
3. El dominio debe proteger las siguientes invariantes:
   * Un usuario solo puede tener **1 carrito activo simultáneamente.**
   * Un usuario puede tener **varios carritos finalizados.**
   * Un carrito de la compra tiene como **máximo 3 productos.**
   * No se pueden añadir productos a un carrito finalizado.
   * Al finalizar el carrito se envía a la dirección.
   * El ńumero máximo de **productos para un envío es de 3.**
   * La dirección de envío no puede modificarse después de confirmar el envío.
4. Define los puntos de entrada de la aplicación que modifican el dominio desde el exterior.

## Razonamiento
Al tratarse de un marketplace de funcionalidades reducidas se ha realizado un posible esquema relacional pequeño que 
pueda servir para el desarrollo y hacer una pequeña demostración en un plazo de tiempo temprano, en esta base de datos 
hay cosas que no se tienen en cuenta con el fin de poder realizar un proyecto de manera rápida y no tener que realizar 
un gran número de tablas que serían necesarias para el Marketplace.

En este caso se ha decidido llamar a la web TroskiShop, nombre con el tal seguiremos denominando al Marketplace a partir
de este momento..


### Esquema E-R
![Diagrama relacional](/doc_images/e-r.png)
A través de la herramienta MIRO se ha realizado un pequeño esquema relacional que permita al funcionamiento básico de 
la web con funcionalidades reducidas.

Tal y como se indica en el enunciado, es necesario poder mostrar una demo rápida para poder mostrar al Cliente, es por 
ello que por mayor comodidad no se han pensado en funcionalidades comunes que suelen tener algunas de las tiendas, 
algunas de las funcionalidades eliminadas y que no serán contempladas tampoco en el E-R son las siguientes:
* No se ha pensado en la posibilidad de que el usuario pueda crearse múltiples direcciones, por lo que la información de la dirección de envío se determinará directamente en el Order.
* El usuario deberá iniciar sesión para comprar, así evitamos el tener que tener en cuenta la lógica para usuarios temporales o invitados.
* La categoría del producto no se obtendrá de otra tabla de categorías con tipados de categoría.
* No se tendrá en cuenta la gestión del Stock de los productos.

### Pantallas web
Para la realización de la demo y tener una serie de pantallas para el manejo de TroskiShop de manera reducida se han 
pensado en las pantallas básicas para el flujo de la compra, ignorando otras funcionalidades como son las siguientes:
* No se valora el cambio de información del perfil del Usuario.
* No se valorará confirmación de Email tras el registro.


Las pantallas serán:
* **Homepage:** Será la página donde aparecerán todos los productos, esta web tendrá en la parte superior un botón del carrito, un botón para poder iniciar sesión cómodamente a través de un modal o a su vez un botón de cerrar sesión. Constará de un botón para volver a la página principal en toda la aplicación y de un botón de previsualizar carrito.
* **Página de descripción del producto:** se podrá acceder al detalle del producto para permitir ver más información sobre el producto que estamos barajando añadir al carrito.
* **Página del detalle del carrito:** Podremos ver todos los productos añadidos al carrito.
* **Página completar compra:** En esta página podremos rellenar la información necesaria para la compra de los productos añadidos al carrito, introduciendo la información sobre la dirección y método de pago.
* **Pantalla “Mis Pedidos”:** Se podrá ver el historial de pedidos realizados por el usuario, el estado en el que se encuentran, etc…
* **Detalle del pedido:** Pantalla de detalle del pedido una vez realizado la compra, se podrá ver información como el estado del envío.

### Herramientas Utilizadas
* **Github con GitFlow:** Alojamiendo del proyecto y uso de GitFlow para el proyecto.
* **Miro:** Para realizar diagramas y otros gráficos.
* **Symfony 6.4:** Es actualmente la versión LTS del Framework.
* **HTMX:** Será utilizado para facilitar el manejo de las 
