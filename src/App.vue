<script lang="js" setup>
	import NavBar from './components/NavBar.vue';
	import Carrusel from './components/Carrusel.vue';
	import AppFooter from './components/Footer.vue';

	const productos = [
		{
			id: 1,
			nombre: 'Manzana',
			descripcion: 'Fruta fresca y deliciosa.',
			precio: 1.99,
			img: 'manzana.jpg',
		},
		{
			id: 2,
			nombre: 'Leche',
			descripcion: 'Leche fresca de vaca.',
			precio: 2.49,
			img: 'leche.jpg',
		},
		{
			id: 3,
			nombre: 'Pan integral',
			descripcion: 'Pan integral recién horneado.',
			precio: 3.29,
			img: 'pan_integral.jpg',
		},
		{
			id: 4,
			nombre: 'Yogur natural',
			descripcion: 'Yogur natural sin azúcar añadido.',
			precio: 1.79,
			img: 'yogur.jpg',
		},
		{
			id: 5,
			nombre: 'Huevos',
			descripcion: 'Huevos frescos de granja.',
			precio: 2.99,
			img: 'huevos.jpg',
		},
	];

	var contenido = 'Products';
</script>

<template>
	<NavBar id="navbar" :productos="productos" />
	<Carrusel id="carrusel" />
	<section class="contenido"></section>
	<AppFooter id="footer" />
</template>

<style scoped>
	#navbar {
		background-color: #181a1b;
		border-bottom: 1px solid #3d3d3d;
	}

	#carrusel {
		width: 80%;
		margin: 2vh auto;
		height: 20vh;
		border-radius: 25px;
		padding: 2rem;
	}
	#footer {
		height: auto;
		background-color: aqua;
	}
</style>
