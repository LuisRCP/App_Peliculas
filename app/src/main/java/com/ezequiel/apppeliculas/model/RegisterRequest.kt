package com.ezequiel.apppeliculas.model

data class RegisterRequest(
    val nombre: String,
    val apellido_paterno: String,
    val apellido_materno: String,
    val email: String,
    val password: String
)