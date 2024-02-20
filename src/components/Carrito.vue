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
			<div class="ctn-compra">
				<p class="p-total">Total: {{ total }}$</p>
				<button class="btn-comprar" @click="realizarCompra()">
					{{ currentLanguage === 'es' ? 'Finalizar pedido' : 'Finish order' }}
				</button>
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

	const total = ref(0);

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
				productosCarrito.value = JSON.parse(data).productos;
				total.value = JSON.parse(data).total;
			},
			error: function (error) {
				console.log(error);
			},
		});
	}
	getCarrito();

	function realizarCompra() {
		$.ajax({
			url: 'http://localhost:3000/database/handleCarrito.php',
			type: 'GET',
			data: {
				action: 'vaciar',
				usuario: usuario.value.id,
			},
			success: function (response) {
				console.log(response);
			},
			error: function (textStatus, errorThrown) {
				console.error(textStatus, errorThrown);
			},
		}).then(() => {
			getCarrito();
		});
	}
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
	.p-total {
		font-size: 30px;
		margin: 0;
	}
	.btn-comprar {
		background-color: #4caf50;
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 30px;
		margin: 4px 2px;
		cursor: pointer;
		border-radius: 5px;
	}

	.btn-comprar:hover {
		background-color: #45a049;
	}

	.ctn-compra {
		padding: 32px;
		border: 1px solid #3d3d3d;
		border-radius: 0 10px 10px 0;
		width: 50%;
		height: fit-content;
		display: flex;
		flex-direction: column;
	}
	.ctn {
		width: 100%;
		display: flex;
		justify-content: space-between;
		flex-direction: row;
		gap: 32px;
	}
	#carrito {
		display: flex;
		width: 100%;
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
