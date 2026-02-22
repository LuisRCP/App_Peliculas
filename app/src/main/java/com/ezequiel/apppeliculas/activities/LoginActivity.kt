package com.ezequiel.apppeliculas.activities

import android.content.Intent
import android.os.Bundle
import android.widget.*
import androidx.appcompat.app.AppCompatActivity
import com.ezequiel.apppeliculas.R
import com.ezequiel.apppeliculas.model.LoginRequest
import com.ezequiel.apppeliculas.model.LoginResponse
import com.ezequiel.apppeliculas.network.RetrofitClient
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class LoginActivity : AppCompatActivity() {

    private lateinit var etEmail: EditText
    private lateinit var etPassword: EditText
    private lateinit var btnLogin: Button
    private lateinit var tvRegister: TextView

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)

        etEmail = findViewById(R.id.etEmail)
        etPassword = findViewById(R.id.etPassword)
        btnLogin = findViewById(R.id.btnLogin)
        tvRegister = findViewById(R.id.tvRegister)

        btnLogin.setOnClickListener {
            loginUsuario()
        }

        tvRegister.setOnClickListener {
            startActivity(Intent(this, RegisterActivity::class.java))
        }
    }

    private fun loginUsuario() {

        val email = etEmail.text.toString().trim()
        val password = etPassword.text.toString().trim()

        if (email.isEmpty() || password.isEmpty()) {
            Toast.makeText(
                this,
                "Por favor completa todos los campos",
                Toast.LENGTH_LONG
            ).show()
            return
        }

        val request = LoginRequest(
            email = email,
            password = password
        )

        RetrofitClient.instance.login(request)
            .enqueue(object : Callback<LoginResponse> {

                override fun onResponse(
                    call: Call<LoginResponse>,
                    response: Response<LoginResponse>
                ) {

                    if (response.isSuccessful) {

                        val body = response.body()

                        Toast.makeText(
                            this@LoginActivity,
                            body?.message,
                            Toast.LENGTH_LONG
                        ).show()

                        if (body?.status == "success") {

                            // 🔥 REDIRECCIÓN AL CATÁLOGO
                            val intent = Intent(
                                this@LoginActivity,
                                CatalogoActivity::class.java
                            )
                            startActivity(intent)
                            finish()
                        }
                    } else {
                        Toast.makeText(
                            this@LoginActivity,
                            "Credenciales incorrectas",
                            Toast.LENGTH_LONG
                        ).show()
                    }
                }

                override fun onFailure(call: Call<LoginResponse>, t: Throwable) {
                    Toast.makeText(
                        this@LoginActivity,
                        "Error de conexión",
                        Toast.LENGTH_LONG
                    ).show()
                }
            })
    }
}