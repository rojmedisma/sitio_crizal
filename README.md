# Proyecto Granero virtual

Proyecto para conectar productores agrícolas y compradores haciendo uso de la plataforma como medio de interacción

# Versiones

> Código fuente/origen sacado del proyecto **sitio_crizal** versión **0.0.1.14**

## Versión 0.0.1.14

> Cambios en la plataforma

- Implementación a partir del proyecto **enketo**

## Versión 0.0.1.15

> Cambios en la plataforma

- Clase core **ControladorBase**. Se cambió a público el método **getArrPermisos**
- Clase control **CatvistagenControl**. Nuevo parámetro en arreglo **arr_param**
- Archivo vista **FooterDesarrollador.php**. Despliege de los arreglos arr_param y arr_permisos.
- Clase core **ModeloBase**. Se modificó el método **setGuardarReg** para meter la bandera **solo_actualizar**
- Clase core **Ayuda**. Se corrigió el evento **getUsuarioId** con la variable de sesión correcta.

## Versión 0.1.1.16

> Cambios en el proyecto

- Nueva clase controlador **PrincipalControl**.
- Nueva clase controlador **RegistroControl**.
- Nueva clase controlador **TiendaControl**.
- Nueva clase core **TableroBase**
- Nueva clase modelo **Cultivo**


> Cambios en la plataforma

- Clase modelo **FormularioALTE3**. Nuevo campo para fechas **cmpFecha**
- Nueva clase modelo **FormularioCrizal**
- Archivo **index.php**. Se adaptaron los includes para llamar a las clases que pertenecen al proyecto

## Versión 0.1.2.16

> Cambios en el proyecto

- Nueva vista **registro** para registar usuario
- Nueva vista **sesion** para iniciar sesion
- Nueva clase controlador **SesionControl**
- Nuevo integración de paquete **stefangabos/zebra_pagination** para la paginación

## Versión 0.1.2.17

> Cambios en la plataforma

- Clase core **ModeloBase**. Se hizo pública la variable tipo objeto **bd** 
- Nueva clase core **Auxiliar**. Va a contener métdos estáticos. La intención es que sustituya gradualmente a la clase core Ayuda y las funciones del archivo core Frecuentes.func.php.

## Versión 0.1.2.18

> Cambios en la plataforma

- Se cambiaron las secciones de la página de contenido
