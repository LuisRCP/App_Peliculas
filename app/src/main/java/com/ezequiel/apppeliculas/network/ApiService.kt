package com.ezequiel.apppeliculas.network

import com.ezequiel.apppeliculas.model.LoginRequest
import com.ezequiel.apppeliculas.model.LoginResponse
import com.ezequiel.apppeliculas.model.RegisterRequest
import com.ezequiel.apppeliculas.model.RegisterResponse
import com.ezequiel.apppeliculas.model.Pelicula
import retrofit2.Call
import retrofit2.http.Body
import retrofit2.http.GET
import retrofit2.http.POST

interface ApiService {

    // LOGIN
    @POST("login")
    fun login(
        @Body request: LoginRequest
    ): Call<LoginResponse>

    // REGISTER
    @POST("register")
    fun register(
        @Body request: RegisterRequest
    ): Call<RegisterResponse>

    // LISTAR PELICULAS
    @GET("peliculas")
    fun getPeliculas(): Call<List<Pelicula>>
}