<template>
	<div>
		<div class="product-card">
			<img class="image-product" :src="producto.imagen" alt="" />
			<div class="product-info">
				<div class="info">
					<h2>{{ producto.nombre }}</h2>
					<p v-if="currentLanguage == 'es'">{{ producto.descripcion_es }}</p>
					<p v-else>{{ producto.descripcion_en }}</p>
				</div>
				<div class="precio-ctn">
					<p class="precio">{{ producto.precio }}$</p>
					<button
						v-if="producto.disponibilidad"
						@click="agregarAlCarrito()"
						class="btn-add-cart"
					>
						{{
							currentLanguage === 'es' ? 'Agregar al carrito' : 'Add to Cart'
						}}
					</button>
					<button
						v-if="!producto.disponibilidad"
						class="btn-add-cart btn-agotado"
					>
						{{ currentLanguage === 'es' ? 'Agotado' : 'Sold Out' }}
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { defineProps, inject, ref } from 'vue';
	import $ from 'jquery';

	const props = defineProps({
		producto: {
			type: Object,
		},
	});

	const currentLanguage = inject('currentLanguage');
	const usuario_id = inject('usuario').value.id;

	function agregarAlCarrito() {
		let resultado;
		$.ajax({
			url: 'http://localhost:3000/database/handleCarrito.php', // La URL del servidor
			type: 'GET', // El tipo de petición HTTP
			data: {
				// Los datos que quieres enviar
				action: 'agregar',
				usuario: usuario_id,
				producto: props.producto.id,
			},
			success: function (response) {
				// Esta función se ejecutará si la petición es exitosa
				// 'response' contiene la respuesta del servidor
				resultado = response;
				console.log(response);
			},
			error: function (textStatus, errorThrown) {
				// Esta función se ejecutará si la petición falla
				console.error(textStatus, errorThrown);
			},
		}).then(() => {
			console.log(resultado);
			emit('getCarrito');
		});
	}
</script>

<style scoped>
	.product-card {
		display: flex;
		gap: 20px;
		width: fit-content;
		justify-content: center;
		height: 20vh;
	}

	.producto {
		background-color: #252525;
	}
	.precio-ctn {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-top: auto;
	}
	.producto {
		border: 1px solid #505050;
		width: fit-content;
		border-radius: 15px;
		height: 200px;
		padding: 20px;
	}
	.precio-ctn .precio {
		font-size: 1.5rem;
	}
	.precio-ctn .btn-add-cart {
		color: #fff;
		border: 2px solid transparent;
		border-radius: 5px;
		cursor: pointer;
		background-color: #009660;
		display: flex;
		width: 200px;
	}

	.precio-ctn .btn-add-cart:hover {
		background-color: #26292b;
		border: 2px solid #009660;
	}

	.image-product {
		height: 150px;
		padding: 20px;
		border-radius: 15px;
	}
	.precio-ctn .btn-agotado {
		background-color: #ff0000;
	}
	.precio-ctn .btn-agotado:hover {
		background-color: #ff0000;
		border: 2px solid transparent;
	}

	p {
		margin: 0;
	}
	h2 {
		margin: 0;
	}
	.info {
		height: 120px;
		width: 300px;
	}

	.precio-ctn button {
		justify-content: center;
	}
</style>
