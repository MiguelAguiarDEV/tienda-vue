<template>
	<nav class="navbar-contenedor">
		<img class="logo" src="../assets/merca_dona.png" />
		<div class="items">
			<button class="item home">Home</button>

			<div class="item-products">
				<button class="">Products</button>
				<div class="dropdown products">
					<button
						v-for="producto in productos"
						:key="producto.id"
						class="product"
						:value="producto.id"
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

			<button class="item">Abauot Us</button>
			<button class="item boton-idioma">Lenguage</button>
			<button class="item">Cart</button>
			<button class="item icono-perfil">
				<img src="../assets/perfil.png" alt="perfil" />
			</button>
		</div>
	</nav>
</template>

<script lang="js" setup>
	import { ref } from 'vue';
	import $ from 'jquery';

	const props = defineProps({
		productos: {
			type: Array,
			required: true,
		},
	});

	$(document).ready(function () {
		$('.product').click(function () {
			let product = $(this).val();
			console.log(product);
		});
	});
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

	.item:last-child {
		padding: 0;
	}
	.item {
		display: flex;
		background-color: transparent;
		color: #fff;
		cursor: pointer;
		height: 100%;
		min-width: fit-content;
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
