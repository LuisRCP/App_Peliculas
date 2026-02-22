package com.ezequiel.apppeliculas.model

data class LoginResponse(
    val status: String,
    val message: String,
    val data: UserData?
)

data class UserData(
    val usuario_id: String,
    val email: String,
    val rol_id: String
)