<template>
	<div>
		<div
			v-if="islogged && Object.keys(productosCarrito).length > 0"
			class="ctn"
		>
			<div class="ctn-productos">
				<ProductoCarrito
					class="producto-carrito"
					v-if="Object.keys(productosCarrito).length > 0"
					v-for="item in productosCarrito"
					:key="item.id"
					:carrito_id="item.id_carrito"
					:usuario_id="item.id_usuario"
					:producto_id="item.id_producto"
					:cantidad="item.cantidad"
					:currentLanguage="currentLanguage"
					@getCarrito="getCarrito"
				/>
			</div>
			<div>
				<p>Total$</p>
			</div>
		</div>
		<div v-if="!islogged" class="inicia-sesion">
			<a @click="redirectSingUp">{{ text.nolog[currentLanguage] }}</a>
			<a @click="redirectLogIn">{{ text.noUser[currentLanguage] }}</a>
		</div>
		<div v-if="Object.keys(productosCarrito).length == 0" class="inicia-sesion">
			<p>
				{{ text.noproducts[currentLanguage] }}
			</p>
		</div>
	</div>
</template>

<script setup>
	import $ from 'jquery';
	import { inject } from 'vue';
	import { ref } from 'vue';
	import ProductoCarrito from './ProductoCarrito.vue';
	const usuario = inject('usuario');
	const currentLanguage = inject('currentLanguage');
	const productos = inject('productos');
	const productosCarrito = ref({});
	const islogged = inject('islogged');

	function redirectLogIn() {
		ShowContent.value = {
			contenido: 'logIn',
		};
	}

	function redirectSingUp() {
		ShowContent.value = {
			contenido: 'signUp',
		};
	}
	function getCarrito() {
		$.ajax({
			url: 'http://localhost:3000/database/getCarrito.php',
			type: 'GET',
			data: {
				id_usuario: usuario.value.id,
			},
			success: function (data) {
				console.log(JSON.parse(data));
				productosCarrito.value = JSON.parse(data);
			},
			error: function (error) {
				console.log(error);
			},
		}).then(() => {
			console.log(Object.keys(productosCarrito.value).length);
		});
	}
	getCarrito();

	const text = ref({
		nolog: {
			en: 'Log in to see your cart.',
			es: 'Inicia sesión para ver tu carrito.',
		},
		noUser: {
			en: "Don't have an account? Sign up here.",
			es: '¿No tienes cuenta? Regístrate aquí.',
		},
		noproducts: {
			en: 'Your cart is empty.',
			es: 'Tu carrito está vacío.',
		},
	});

	const ShowContent = inject('ShowContent');
</script>

<style scoped>
	.ctn {
		width: 100%;
		display: flex;
		justify-content: space-between;
		flex-direction: row;
	}
	#carrito {
		display: flex;
		width: 50%;
	}

	.ctn-productos {
		border: 1px solid #3d3d3d;
		border-radius: 10px 0 0 10px;
		width: 100%;
	}
	.producto-carrito:last-child {
		border-bottom: 1px solid transparent;
	}
	.producto-carrito {
		border-bottom: 1px solid #3d3d3d;
	}

	.inicia-sesion {
		display: flex;
		flex-direction: column;
		align-items: start;
		width: fit-content;
		margin: 0 auto;
	}
	.inicia-sesion a {
		color: #fff;
		cursor: pointer;
	}

	.inicia-sesion a:hover {
		color: #45a049;
		text-decoration: underline;
	}
</style>
