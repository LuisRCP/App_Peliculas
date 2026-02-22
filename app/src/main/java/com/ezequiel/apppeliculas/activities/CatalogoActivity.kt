package com.ezequiel.apppeliculas.activities

import android.os.Bundle
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.ezequiel.apppeliculas.R
import com.ezequiel.apppeliculas.model.Pelicula
import com.ezequiel.apppeliculas.network.RetrofitClient
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class CatalogoActivity : AppCompatActivity() {

    private lateinit var recycler: RecyclerView

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_catalogo)

        recycler = findViewById(R.id.recyclerPeliculas)
        recycler.layoutManager = LinearLayoutManager(this)

        cargarPeliculas()
    }

    private fun cargarPeliculas() {

        RetrofitClient.instance.getPeliculas()            .enqueue(object : Callback<List<Pelicula>> {

                override fun onResponse(
                    call: Call<List<Pelicula>>,
                    response: Response<List<Pelicula>>
                ) {
                    if (response.isSuccessful) {
                        val lista = response.body() ?: emptyList()
                        recycler.adapter = PeliculaAdapter(lista)
                    }
                }

                override fun onFailure(call: Call<List<Pelicula>>, t: Throwable) {
                    Toast.makeText(
                        this@CatalogoActivity,
                        "Error cargando películas",
                        Toast.LENGTH_LONG
                    ).show()
                }
            })
    }
}