# Listado de tareas por hacer
Al tratarse de un proyecto pequeño, el cual trata de cumplir unas espectativas y
la realización de una demo rápida del market place, existen ciertas funcionalidades 
que han sido obviadas por el bien de la entrega del desarrollo.

En este listado se recogerán de manera categorizada por prioridad algunos desarrollos 
que pueden ser necesarios de forma obligatoria o que pueden ser mejoras notables.

## Mejoras Obligatorias
- **Inclusión de la entidad Invoice y LineInvoice:** Actualmente para el desarrollo ágil 
del proyecto se ha obviado la entidad Invoice y LineInvoice, haciendo que la visualización 
del pedido u Order se base en los elementos contenidos en el ShoppingCart para mostrar el 
pedido realizado. Esto provoca una inconsistencia en el precio de los pedidos realizados 
en caso de modificación del precio del producto, éste se verá afectado en el Order, poniendo un precio que no corresponde con lo realmente pagado, 
en lugar de hacer uso de una "ScreenShot" del precio que tenía al momento de hacer el pedido.

- **Descarga de Factura:** Debería ser posible, al igual que en todos los market-place, tener 
la posibilidad de descargar las facturas de los pedidos realizados.

- **Diferencias distintos entornos:** Un paso vital y necesario para la verdadera salida a producción
de la aplicación es la de configurar los distintos entornos "dev", "pre" y "prod" como mínimo
para así evitar la visualización de ciertos errores con sus trazas y del web_profiler.

## Mejoras de menor prioridad
- **Eliminación de EasyAdmin y realización de un Backoffice custom:** para cumplir las 
espectativas del DDD y Hexagonal, es recomendable no depender de muchas utilidades de terceros y
aunque en algunos casos resulta inevitable, para la gestión del Backoffice de Troskishop
no sería un impedimento deshacerse del bundle de EasyAdmin y hacer uso de un panel 
totalmente personalizado y que se encuentre dentro de nuestra arquitectura.

- **Modificar mi perfil:** Una utilidad simple y casi obligatoria a incluir sería la de 
modificar los datos del perfil y contraseña.

- **Incluir "Mis direcciones":** Sería útil para el proceso de compra poder tener un
registro de las distintas direcciones del usuario y así evitar tener que escribir la dirección 
completa por cada compra.

- **Incluir más Pasarelas de pago:** Cuantos más metodos de pago sean incluídos en la tienda online
más fácil será poder atraer clientes y realización de compras en la tienda.