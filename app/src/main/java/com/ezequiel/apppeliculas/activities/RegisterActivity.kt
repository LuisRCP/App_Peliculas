package com.ezequiel.apppeliculas.activities

import android.os.Bundle
import android.widget.*
import androidx.appcompat.app.AppCompatActivity
import com.ezequiel.apppeliculas.R
import com.ezequiel.apppeliculas.model.RegisterRequest
import com.ezequiel.apppeliculas.model.RegisterResponse
import com.ezequiel.apppeliculas.network.RetrofitClient
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class RegisterActivity : AppCompatActivity() {

    private lateinit var etNombre: EditText
    private lateinit var etApellidoP: EditText
    private lateinit var etApellidoM: EditText
    private lateinit var etEmail: EditText
    private lateinit var etPassword: EditText
    private lateinit var btnRegister: Button

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_register)

        etNombre = findViewById(R.id.etNombre)
        etApellidoP = findViewById(R.id.etApellidoP)
        etApellidoM = findViewById(R.id.etApellidoM)
        etEmail = findViewById(R.id.etEmail)
        etPassword = findViewById(R.id.etPassword)
        btnRegister = findViewById(R.id.btnRegister)

        btnRegister.setOnClickListener {
            registrarUsuario()
        }
    }

    private fun registrarUsuario() {

        val request = RegisterRequest(
            nombre = etNombre.text.toString(),
            apellido_paterno = etApellidoP.text.toString(),
            apellido_materno = etApellidoM.text.toString(),
            email = etEmail.text.toString(),
            password = etPassword.text.toString()
        )

        RetrofitClient.instance.register(request)
            .enqueue(object : Callback<RegisterResponse> {

                override fun onResponse(
                    call: Call<RegisterResponse>,
                    response: Response<RegisterResponse>
                ) {

                    if (response.isSuccessful) {

                        val body = response.body()

                        Toast.makeText(
                            this@RegisterActivity,
                            body?.message,
                            Toast.LENGTH_LONG
                        ).show()

                        if (body?.status == "success") {
                            finish()
                        }
                    }
                }

                override fun onFailure(call: Call<RegisterResponse>, t: Throwable) {
                    Toast.makeText(
                        this@RegisterActivity,
                        "Error de conexión",
                        Toast.LENGTH_LONG
                    ).show()
                }
            })
    }
}