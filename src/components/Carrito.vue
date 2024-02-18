<template>
	<div>
		<div class="ctn-productos">
			<ProductoCarrito
				class="producto-carrito"
				v-if="Object.keys(productosCarrito).length > 0"
				v-for="item in Object.keys(productosCarrito)"
				:key="item"
				:producto_id="item"
				:cantidad="productosCarrito[item]"
			/>
		</div>
		<div>Hola</div>
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
</script>

<style scoped>
	#carrito {
		display: flex;
	}

	.ctn-productos {
		overflow: auto;
		border: 1px solid #3d3d3d;
		border-radius: 10px 0 0 10px;
		width: 60%;
	}
	.producto-carrito:last-child {
		border-bottom: 1px solid transparent;
	}
	.producto-carrito {
		border-bottom: 1px solid #3d3d3d;
	}
</style>
