<template>
	<div>
		<h2>{{ usuario.nombre }}</h2>
		<div>
			<p>Mail: {{ usuario.mail }}</p>
			<p>{{ text.tlf[currentLanguage] + usuario.tlf }}</p>
			<p>IBAN: {{ usuario.iban }}</p>
		</div>
		<button id="btn-cerrar-sesion" @click="cerrarSesion">
			{{ text.cerrarSesion[currentLanguage] }}
		</button>
	</div>
</template>

<script setup>
	import { inject, ref } from 'vue';
	const usuario = inject('usuario');
	const islogged = inject('islogged');
	const currentLanguage = inject('currentLanguage');
	const ShowContent = inject('ShowContent');
	const text = {
		cerrarSesion: {
			en: 'Log Out',
			es: 'Cerrar Sesión',
		},
		tlf: {
			en: 'Phone: ',
			es: 'Teléfono: ',
		},
	};
	function cerrarSesion() {
		usuario.value = '';
		islogged.value = false;
		ShowContent.value.contenido = 'home';
	}
</script>

<style scoped>
	#perfil {
		display: grid;
		place-content: center;
	}

	#btn-cerrar-sesion {
		margin-top: 20px;
		border: 1px solid transparent;
		background-color: red;
	}

	#btn-cerrar-sesion:hover {
		background-color: rgb(255, 0, 0);
		border: 1px solid rgba(245, 245, 245, 0.842);
	}
</style>
