<template>
	<section class="about">
		<div class="about-img">
			<img src="../assets/merca_dona.png" alt="Donuts" />
		</div>
		<div class="about-text">
			<h1>{{ text.welcome[currentLanguage] }}</h1>
			<p>{{ text.description[currentLanguage] }}</p>
			<p>{{ text.discover[currentLanguage] }}</p>
		</div>
	</section>
</template>

<script setup>
	import { inject, ref } from 'vue';

	const currentLanguage = inject('currentLanguage');

	const text = ref({
		welcome: {
			en: 'Welcome to MercaDona!',
			es: '¡Bienvenidos a MercaDona!',
		},
		description: {
			en: 'We are a company dedicated to selling the most delicious donuts you can find. With a wide variety of flavors and exceptional quality, at MercaDona we strive to satisfy the sweetest cravings of our customers!',
			es: 'Somos una empresa dedicada a la venta de los donuts más deliciosos que puedas encontrar. Con una amplia variedad de sabores y una calidad excepcional, en MercaDona nos esforzamos por satisfacer los antojos más dulces de nuestros clientes.',
		},
		discover: {
			en: "¡Come and discover why our donuts are everyone's favorite!",
			es: '¡Ven y descubre por qué nuestros donuts son los favoritos de todos!',
		},
	});
</script>

<style scoped>
	h1 {
		margin: 0;
		color: #fff;
	}
	.about {
		display: flex;
		justify-content: space-evenly;
		align-items: center;
		gap: 40px;
		height: 35vh;
	}

	.about-img img {
		width: 100%;
	}

	.about-text {
		max-width: 600px;
	}
</style>
