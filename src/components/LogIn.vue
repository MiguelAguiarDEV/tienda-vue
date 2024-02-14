<template>
	<form @submit.prevent="IniciarSesion">
		<h2>Iniciar Sesión</h2>
		<label for="usuario"
			>Usuario
			<input
				id="usuario"
				type="text"
				name="usuario"
				placeholder="Usuario"
				required
		/></label>
		<label for="contraseña"
			>Contraseña
			<input
				id="contraseña"
				type="password"
				name="contraseña"
				placeholder="Contraseña"
				required
		/></label>
		<button id="submit" type="submit">Iniciar Sesión</button>
	</form>
</template>

<script setup>
	import { inject, ref } from 'vue';
	import $ from 'jquery';
	const ShowContent = inject('ShowContent');
	const usuario = inject('usuario');
	const islogged = inject('islogged');
	function IniciarSesion() {
		let resultado;

		$.ajax({
			url: 'http://localhost:3000/database/iniciarSesion.php', // La URL del servidor
			type: 'POST', // El tipo de petición HTTP
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
				console.log(resultado.mensaje);
				ShowContent.value = {
					contenido: 'home',
				};
				usuario.value = $('#usuario').val();
				islogged.value = true;
			} else {
				console.log(resultado.mensaje);
			}
		});
	}
</script>

<style scoped>
	form {
		width: 50%;
		margin: 0 auto;
	}
	input[type='text'],
	input[type='password'] {
		width: 100%;
		padding: 10px;
		margin-bottom: 15px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}
	button {
		background-color: #4caf50;
		color: #fff;
		padding: 10px 20px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}
	button:hover {
		background-color: #45a049;
	}
</style>
