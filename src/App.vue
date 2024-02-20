<script lang="js" setup>
	import NavBar from './components/NavBar.vue';
	import Carrusel from './components/Carrusel.vue';
	import Footer from './components/Footer.vue';
	import Contendor from './components/Contenedor.vue';
	import { ref, provide } from 'vue';
	import $ from 'jquery';

	const productos = ref([]);
	const usuarios = ref([]);

	$.ajax({
		url: 'http://localhost:3000/database/getProductos.php',
		method: 'GET',
		success: function (response) {
			// Handle the response data here
			// let data = JSON.parse(response);
			productos.value = JSON.parse(response);
		},
		error: function (error) {
			// Handle any errors that occur during the request
			console.error(error);
			console.log('error');
		},
	});

	console.log(usuarios.value);
	const ShowContent = ref({
		contenido: 'home',
	});

	function changeContent(contenido) {
		ShowContent.value = contenido;
	       console.log("El contenido de la web cambio: ", ShowContent.value.contenido);
	}

	const currentLanguage = ref('en');

	function toggleLenguage() {
		currentLanguage.value = currentLanguage.value === 'es' ? 'en' : 'es';
	}
	provide('ShowContent', ShowContent);
	provide('currentLanguage', currentLanguage);

	//LOGIN / SIGNIN
	const usuario = ref('');
	const islogged = ref(false);

	provide('usuario', usuario);
	provide('islogged', islogged);
	provide('productos', productos);

	if (localStorage.getItem('usuario')) {
		console.log(localStorage.getItem('usuario'));
		usuario.value = JSON.parse(localStorage.getItem('usuario'));
		islogged.value = true;
	}
</script>

<template>
	<NavBar
		id="navbar"
		:currentLanguage="currentLanguage"
		:productos="productos"
		@toggleLenguage="toggleLenguage"
		@changeContent="changeContent"
		:ShowContent="ShowContent"
	/>
	<Carrusel
		id="carrusel"
		:productos="productos"
		@changeContent="changeContent"
	/>
	<Contendor
		id="contenedor"
		:currentLanguage="ref(currentLanguage)"
		:ShowContent="ShowContent"
		:productos="productos"
		@changeContent="changeContent"
	/>
	<Footer id="footer" />
</template>

<style scoped>
	#navbar {
		background-color: #181a1b;
		border-bottom: 1px solid #3d3d3d;
	}
	#contenedor {
		width: 80%;
		margin: 2vh auto;
		border-radius: 25px;
		padding: 2rem;
		border: 1px solid #3d3d3d;
	}
	#carrusel {
		width: 80%;
		margin: 2vh auto;
		border-radius: 25px;
		padding: 2rem;
		border: 1px solid #3d3d3d;
		height: 10vh;
	}

	#footer {
		margin-top: auto;
	}

	img {
		height: 100px;
	}
</style>
