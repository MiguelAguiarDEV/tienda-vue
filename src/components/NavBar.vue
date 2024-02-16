<template>
	<nav class="navbar-contenedor">
		<img class="logo" src="../assets/merca_dona.png" />
		<div class="items">
			<button
				v-if="ShowContent.contenido != 'home'"
				class="item home"
				@click="callChangeContent({ contenido: 'home' })"
			>
				{{ idioma.home }}
			</button>

			<div class="item-products">
				<button class="">{{ idioma.products }}</button>
				<div class="dropdown products">
					<button
						v-for="producto in productos"
						:key="producto.id"
						class="product"
						:value="producto.id"
						@click="
							callChangeContent({ contenido: 'producto', id: producto.id })
						"
					>
						{{ producto.nombre }}
					</button>
				</div>
			</div>
			<!-- <select v-model="contenido" class="products">
            <option class="label" value="" disabled selected hidden>Products</option>
           <option v-for="producto in productos" :key="producto.id" :value="producto.nombre" class="producto">
            {{ producto.nombre }}
           </option>
        </select> -->

			<button class="item" @click="callChangeContent({ contenido: 'aboutUs' })">
				{{ idioma.aboutUs }}
			</button>
			<button class="item boton-idioma" @click="callToggleLenguage">
				<img v-if="currentLanguage === 'es'" :src="idioma.language" alt="es" />
				<img v-else :src="idioma.language" alt="en" />
			</button>
			<button class="item" @click="callChangeContent({ contenido: 'cart' })">
				<img src="../assets/cart.png" alt="cart" /> {{ idioma.cart }}
			</button>
			<button
				v-if="islogged"
				class="item"
				@click="callChangeContent({ contenido: 'perfil' })"
			>
				<img src="../assets/perfil.png" alt="perfil" /> {{ usuario.nombre }}
			</button>
			<button
				v-else
				class="item"
				@click="callChangeContent({ contenido: 'logIn' })"
			>
				<img src="../assets/perfil.png" alt="perfil" /> {{ idioma.loggin }}
			</button>
		</div>
	</nav>
</template>

<script lang="js" setup>
	import { inject, ref } from 'vue';
	import $ from 'jquery';

	const props = defineProps({
		productos: {
			type: Array,
			required: true,
		},
		ShowContent: {
			type: Object,
		},
		currentLanguage: {
			type: String,
		},
	});

	$(document).ready(function () {
		$('.product').click(function () {
			let product = $(this).val();
			console.log(product);
		});
	});

	const languageTexts = {
		english: {
			home: 'Home',
			products: 'Products',
			aboutUs: 'About Us',
			cart: 'Cart',
			language: '/src/assets/en.png',
			perfil: 'My Profile',
			loggin: 'Log In',
		},
		spanish: {
			home: 'Inicio',
			products: 'Productos',
			aboutUs: 'Sobre Nosotros',
			cart: 'Carrito',
			language: '/src/assets/es.png',
			perfil: 'Mi Perfil',
			loggin: 'Iniciar Sesión',
		},
	};

	const idioma = ref(
		props.currentLanguage === 'es'
			? languageTexts.spanish
			: languageTexts.english
	);

	const emit = defineEmits(['changeContent', 'toggleLenguage']);
	function callToggleLenguage() {
		// Call the function passed from the parent component
		emit('toggleLenguage');
		if (props.currentLanguage === 'es') {
			idioma.value = languageTexts.english;
		} else {
			idioma.value = languageTexts.spanish;
		}
	}
	function callChangeContent(contenido) {
		// Call the function passed from the parent component
		emit('changeContent', contenido);
		console.log(contenido);
	}
	const islogged = inject('islogged');
	const usuario = inject('usuario');
</script>

<style scoped>
	.logo {
		height: 50%;
	}

	.items {
		display: flex;
		height: 40px;
		gap: 5%;
		width: 100%;
		margin-left: 5%;
	}
	.boton-idioma {
		margin-left: auto;
	}

	.item {
		display: flex;
		background-color: transparent;
		color: #fff;
		cursor: pointer;
		height: 100%;
		min-width: fit-content;
		align-items: center;
		gap: 5px;
	}

	.item:hover {
		text-decoration: underline;
	}
	.navbar-contenedor {
		display: flex;
		align-items: center;
		width: calc(100% - 8rem);
		height: 80px;
		padding: 1rem 4rem;
	}

	.item img {
		height: 30px;
	}
	nav div {
		height: 100%;
	}

	nav div img {
		height: 100%;
	}

	.item-products {
		width: 200px;
		height: fit-content;
		display: flex;
		flex-direction: column;
		background-color: #181a1b;
		border-radius: 5px;
		border: 1px solid transparent;
		z-index: 1;
	}

	.item-products:hover {
		border: 1px solid #fff;
	}

	.item-products .dropdown {
		display: none;
	}
	.item-products:hover .dropdown {
		display: flex;
		flex-direction: column;
		background-color: transparent;
		color: #fff;
		cursor: pointer;
		height: 100%;
		min-width: fit-content;
		text-align: center;
	}

	.product {
		border-top: 1px solid #ffffff1f;
		border-top-right-radius: 0px;
		border-top-left-radius: 0px;
	}
	.product:hover {
		text-decoration: underline;
	}
</style>
