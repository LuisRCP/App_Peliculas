package com.ezequiel.apppeliculas.activities

import android.content.Intent
import android.net.Uri
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import com.ezequiel.apppeliculas.R
import com.pierfrancescosoffritti.androidyoutubeplayer.core.player.YouTubePlayer
import com.pierfrancescosoffritti.androidyoutubeplayer.core.player.listeners.AbstractYouTubePlayerListener
import com.pierfrancescosoffritti.androidyoutubeplayer.core.player.views.YouTubePlayerView

class TrailerActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_trailer)

        val youtubePlayerView: YouTubePlayerView = findViewById(R.id.youtubePlayerView)
        lifecycle.addObserver(youtubePlayerView)

        val url = intent.getStringExtra("url") ?: ""
        val videoId = extraerVideoId(url)

        youtubePlayerView.addYouTubePlayerListener(object : AbstractYouTubePlayerListener() {

            override fun onReady(youTubePlayer: YouTubePlayer) {
                if (videoId.isNotEmpty()) {
                    youTubePlayer.loadVideo(videoId, 0f)
                } else {
                    abrirYoutubeExterno(url)
                }
            }
        })
    }

    private fun extraerVideoId(url: String): String {
        return when {
            url.contains("watch?v=") -> url.substringAfter("v=").substringBefore("&")
            url.contains("youtu.be/") -> url.substringAfter("youtu.be/").substringBefore("?")
            else -> ""
        }
    }

    private fun abrirYoutubeExterno(url: String) {
        val intent = Intent(Intent.ACTION_VIEW, Uri.parse(url))
        startActivity(intent)
        finish()
    }
}