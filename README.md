# Proyecto Sitio Crizal

Código principal para sitios web implementando plantilla boostrap Crizal. Usando arquitectura MVC.

# Versiones

> Código fuente/origen sacado del proyecto **enketo** versión **0.0.1.14**

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



