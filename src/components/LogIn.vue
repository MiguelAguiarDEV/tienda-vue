<template>
	<form @submit.prevent="IniciarSesion">
		<h2>{{ text.login[currentLanguage] }}</h2>
		<label for="usuario"
			>{{ text.user[currentLanguage] }}
			<input
				id="usuario"
				type="text"
				name="usuario"
				:placeholder="text.user[currentLanguage]"
				required
			/>
			<div id="userError" class="error">
				{{ text.userError[currentLanguage] }}
			</div>
		</label>
		<label for="contraseña"
			>{{ text.password[currentLanguage] }}
			<input
				id="contraseña"
				type="password"
				name="contraseña"
				:placeholder="text.password[currentLanguage]"
				required
			/>
			<div id="passwordError" class="error">
				{{ text.passwordError[currentLanguage] }}
			</div>
		</label>
		<button id="submit" type="submit">{{ text.login[currentLanguage] }}</button>
		<a v-on:click="redirectSingUp">{{ text.noUser[currentLanguage] }}</a>
	</form>
</template>

<script setup>
	import { inject, ref } from 'vue';
	import $ from 'jquery';
	const ShowContent = inject('ShowContent');
	const usuario = inject('usuario');
	const islogged = inject('islogged');
	const currentLanguage = inject('currentLanguage');

	const text = ref({
		login: {
			en: 'Log In',
			es: 'Iniciar Sesión',
		},
		user: {
			en: 'User',
			es: 'Usuario',
		},
		password: {
			en: 'Password',
			es: 'Contraseña',
		},
		passwordError: {
			en: 'Wrong password',
			es: 'Contraseña incorrecta',
		},
		userError: {
			en: 'User does not exist',
			es: 'El usuario no existe',
		},
		noUser: {
			en: "Don't have an account? Sign up here",
			es: '¿No tienes cuenta? Regístrate aquí',
		},
	});

	function IniciarSesion() {
		let resultado;

		$.ajax({
			url: 'http://localhost:3000/database/iniciarSesion.php', // La URL del servidor
			type: 'GET', // El tipo de petición HTTP
			data: {
				// Los datos que quieres enviar
				usuario: $('#usuario').val(),
				contraseña: $('#contraseña').val(),
			},
			success: function (response) {
				// Esta función se ejecutará si la petición es exitosa
				// 'response' contiene la respuesta del servidor
				resultado = JSON.parse(response);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				// Esta función se ejecutará si la petición falla
				console.error(textStatus, errorThrown);
			},
		}).then(() => {
			if (resultado.resultado === 'true') {
				ShowContent.value = {
					contenido: 'home',
				};
				usuario.value = resultado.usuario;
				islogged.value = true;
				$('#userError').removeClass('invalid');
				$('#userError').hide();
				localStorage.setItem('usuario', JSON.stringify(resultado.usuario));
				console.log(localStorage.getItem('usuario'));
			} else {
				if (resultado.mensaje === 'El usuario no existe') {
					$('#userError').addClass('invalid');
					$('#userError').removeClass('error');

					$('#passwordError').removeClass('invalid');
					$('#passwordError').addClass('error');
				} else {
					$('#userError').removeClass('invalid');
					$('#userError').addClass('error');
					$('#passwordError').addClass('invalid');
					$('#passwordError').removeClass('error');
				}
				console.log(resultado.mensaje);
			}
		});
	}

	function redirectSingUp() {
		ShowContent.value = {
			contenido: 'signUp',
		};
	}
</script>

<style scoped>
	form {
		width: 50%;
		margin: 0 auto;
		display: flex;
		flex-direction: column;
	}
	.invalid {
		opacity: 100%;
		color: rgb(190, 54, 54);
		font-weight: bold;
	}
	.error {
		opacity: 0%;
	}
	label {
		display: block;
	}
	input[type='text'],
	input[type='password'] {
		width: 100%;
		padding: 10px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}

	button {
		margin-top: 20px;
		background-color: #4caf50;
		color: #fff;
		padding: 10px 20px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
		margin-bottom: 20px;
	}
	button:hover {
		background-color: #45a049;
	}
	a {
		text-decoration: underline;
	}

	a:hover {
		color: #45a049;
		cursor: pointer;
	}
</style>
