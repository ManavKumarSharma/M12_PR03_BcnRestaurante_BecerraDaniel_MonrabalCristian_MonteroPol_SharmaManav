# BCNRestaurant

BCNRestaurant es una aplicación web desarrollada con Laravel cuyo objetivo es proporcionar una guía completa de restaurantes en la ciudad. La plataforma permite a los usuarios gestionar su cuenta, valorar restaurantes mediante reseñas y estrellas, marcar sus restaurantes favoritos y aplicar filtros para encontrar lugares que se ajusten a sus preferencias.

---

## Características Principales

### 1. Autenticación y Gestión de Usuarios
- Los usuarios pueden registrarse e iniciar sesión en la plataforma.
- Cada usuario tiene un perfil con información personal, imagen de perfil y rol asignado.
- Existen diferentes roles para los usuarios, permitiendo una mejor organización y seguridad dentro de la aplicación.

### 2. Restaurantes
- La aplicación almacena una lista de restaurantes con detalles como descripción, ubicación, horarios, teléfono y precio promedio.
- Cada restaurante pertenece a una zona geográfica determinada.
- Los restaurantes pueden tener etiquetas (tags) para categorizar su tipo de cocina o estilo.
- Los usuarios pueden subir imágenes de los platos servidos en los restaurantes.

### 3. Valoraciones y Reseñas
- Los usuarios pueden calificar los restaurantes con un puntaje de 1 a 5 estrellas.
- Se pueden dejar comentarios en cada reseña para compartir opiniones sobre la experiencia.
- La puntuación promedio de un restaurante se calcula a partir de las valoraciones de los usuarios.

### 4. Favoritos
- Los usuarios pueden marcar restaurantes como favoritos para acceder fácilmente a ellos desde su perfil.

### 5. Filtros de Búsqueda
- Los usuarios pueden filtrar restaurantes según diferentes criterios como:
  - Zona geográfica
  - Puntuación media
  - Precio promedio
  - Tipo de cocina (mediante etiquetas)

---

## Tecnologías Utilizadas
- **Framework:** Laravel
- **Base de Datos:** MySQL
- **Lenguajes:** PHP, JavaScript, HTML, CSS
- **ORM:** Eloquent
- **Autenticación:** Sistema de autenticación nativo de Laravel

---

## Base de Datos

La base de datos de la aplicación está diseñada para manejar eficientemente la información de usuarios, restaurantes y sus relaciones. A continuación, se presentan las tablas principales:

### 1. `rol`
Tabla que almacena los roles de los usuarios.

### 2. `users`
Contiene la información de los usuarios, incluyendo sus datos personales y su rol.

### 3. `zones`
Almacena las zonas donde se encuentran los restaurantes.

### 4. `restaurants`
Guarda la información de cada restaurante, incluyendo descripción, ubicación y horarios.

### 5. `tags`
Permite categorizar los restaurantes según el tipo de cocina o características.

### 6. `restaurant_tags`
Tabla intermedia que permite la asignación de múltiples etiquetas a los restaurantes.

### 7. `food_images`
Almacena imágenes de los platos servidos en cada restaurante.

### 8. `reviews`
Permite a los usuarios dejar valoraciones y comentarios sobre los restaurantes.

### 9. `favorites`
Guarda los restaurantes favoritos de cada usuario.

---

## Integrantes del Proyecto
Este proyecto ha sido desarrollado por:
- **Pol Marc Montero**
- **Daniel Becerra**
- **Christian Monrabal**
- **Manav Kumar Sharma**
