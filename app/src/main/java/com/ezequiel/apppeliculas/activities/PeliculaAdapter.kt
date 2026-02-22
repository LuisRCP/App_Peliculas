package com.ezequiel.apppeliculas.activities

import android.content.Intent
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide
import com.ezequiel.apppeliculas.R
import com.ezequiel.apppeliculas.model.Pelicula

class PeliculaAdapter(
    private val lista: List<Pelicula>
) : RecyclerView.Adapter<PeliculaAdapter.ViewHolder>() {

    class ViewHolder(view: View) : RecyclerView.ViewHolder(view) {
        val imagen: ImageView = view.findViewById(R.id.imgPelicula)
        val titulo: TextView = view.findViewById(R.id.tvTitulo)
        val descripcion: TextView = view.findViewById(R.id.tvDescripcion)
        val btnVer: Button = view.findViewById(R.id.btnVer)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_pelicula, parent, false)
        return ViewHolder(view)
    }

    override fun getItemCount(): Int = lista.size

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {

        val pelicula = lista[position]

        holder.titulo.text = pelicula.nombre
        holder.descripcion.text = pelicula.descripcion

        Glide.with(holder.itemView.context)
            .load(pelicula.imagen_url)
            .into(holder.imagen)

        holder.btnVer.setOnClickListener {

            val urlOriginal = pelicula.trailer_url

            if (urlOriginal.startsWith("http")) {

                val urlFinal = convertirYoutubeEmbed(urlOriginal)

                val intent = Intent(
                    holder.itemView.context,
                    TrailerActivity::class.java
                )

                intent.putExtra("url", urlFinal)
                holder.itemView.context.startActivity(intent)

            } else {

                Toast.makeText(
                    holder.itemView.context,
                    "No hay trailer disponible",
                    Toast.LENGTH_SHORT
                ).show()
            }
        }
    }

    // 🔥 Convierte link normal de YouTube a formato embed
    private fun convertirYoutubeEmbed(url: String): String {

        return if (url.contains("youtube.com/watch?v=")) {

            val videoId = url.substringAfter("v=")
            "https://www.youtube.com/embed/$videoId"

        } else if (url.contains("youtu.be/")) {

            val videoId = url.substringAfter("youtu.be/")
            "https://www.youtube.com/embed/$videoId"

        } else {
            url
        }
    }
}