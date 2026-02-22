package com.ezequiel.apppeliculas.model

data class Pelicula(
    val pelicula_Id: String,
    val nombre: String,
    val genero_Id: String,
    val imagen_url: String,
    val descripcion: String,
    val trailer_url: String,
    val esta_Activo: String,
    val genero: String
)