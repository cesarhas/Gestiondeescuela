   CREATE TABLE estudiantes (
    estudiante_id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    grado VARCHAR(20) NOT NULL
);

CREATE TABLE profesores (
    profesor_id  SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE asignaciones (
    asignacion_id SERIAL PRIMARY KEY,
    estudiante_id INT NOT NULL,
    profesor_id INT NOT NULL,
    materia VARCHAR(100) NOT NULL,
    FOREIGN KEY (estudiante_id) REFERENCES estudiantes(estudiante_id),
    FOREIGN KEY (profesor_id) REFERENCES profesores(profesor_id)
);