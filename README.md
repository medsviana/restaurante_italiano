# 🍝 Trattoria Bella Italia - Sistema de Gestión (ERP)

![PHP](https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-DB-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![PDF](https://img.shields.io/badge/PDF-Export-EC1C24?style=for-the-badge&logo=adobeacrobatreader&logoColor=white)

## 📖 Descripción del Proyecto

**Trattoria Bella Italia** es un sistema web integral (ERP) desarrollado para la gestión operativa de un restaurante. El proyecto simula un entorno real de hostelería, permitiendo digitalizar el flujo completo de negocio: desde la toma de comandas en mesa hasta la facturación fiscal y el control de compras a proveedores.

El sistema destaca por su lógica de **persistencia de datos**, asegurando que ningún pedido se pierda durante el servicio, independientemente de su estado de cobro.

---

## 🔄 Flujo de Trabajo y Lógica de Negocio

El núcleo del proyecto se basa en un sistema de **validación en pasos** para garantizar la integridad financiera:

1.  **Toma de Comanda (POS):** * El camarero selecciona los productos desde `formularioComandas.php`.
    * Los datos se envían al servidor.

2.  **Persistencia y Resumen (Estado Pendiente):**
    * Al enviar la comanda, el sistema **guarda inmediatamente el pedido** en la base de datos con un estado *no confirmado*.
    * Se redirige a una vista de resumen (`resumenPedido.php`) donde se verifica la orden.
    * *Objetivo:* Evitar la pérdida de datos de mesas abiertas si el navegador se cierra.

3.  **Confirmación y Pago (Lógica Booleana):**
    * El sistema espera una confirmación explícita (pago realizado).
    * Se utiliza un campo booleano en la base de datos para cambiar el estado del pedido de "Pendiente" a "Pagado".

4.  **Facturación y PDF:**
    * Solo tras la confirmación se genera el registro en la tabla `facturas`.
    * **Procesamiento por Lotes:** Implementación de *checkboxes* para seleccionar múltiples pedidos y facturarlos simultáneamente.
    * **Exportación:** Generación automática de la factura en formato **PDF** para su impresión o envío digital.

---

## 📂 Estructura del Proyecto

| Archivo | Función |
| :--- | :--- |
| `formulariocomandas.php` | Interfaz principal de selección de productos (Menú). |
| `resumenPedido.php` | **Lógica Core:** Guarda el pedido inicial y muestra el desglose antes de pagar. |
| `Formulario_Facturacion.php` | Procesa la confirmación final y cierra la transacción. |
| `formularioCompras.php` | Gestión de inventario (Ingredientes vs. Suministros). |
| `estilo.css` | Diseño visual responsive y maquetación de facturas. |

---

## 🛠️ Stack Tecnológico

* **Backend:** PHP 8.x (Manejo de sesiones, arrays y POO para PDF).
* **Base de Datos:** MySQL (Tablas relacionales: `pedido`, `factura`, `plato`, `pedido_plato`).
* **Frontend:** HTML5, CSS3.
* **Librerías:** Generación de PDF (FPDF/Dompdf).

---

## ⚙️ Instalación

1.  Clonar el repositorio en la carpeta pública del servidor (`htdocs` o `www`).
2.  Importar la base de datos `restaurante_italiano` (Script SQL incluido).
3.  Configurar la conexión en los archivos PHP:
    ```php
    $conexion = mysqli_connect("localhost", "root", "", "restaurante_italiano");
    ```
4.  Acceder a través de `http://localhost/tu-proyecto/formulariocomandas.php`.

---

**Desarrollado por el equipo técnico de Trattoria Bella Italia - 2026**
