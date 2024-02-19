<template>
	<div>
		<div class="product-card">
			<img class="image-product" :src="producto.imagen" alt="" />
			<div class="product-info">
				<div class="info">
					<h2>{{ producto.nombre }}</h2>
					<p>{{ producto.descripcion_es }}</p>
				</div>
				<div class="precio-ctn">
					<p class="precio">{{ producto.precio }}$</p>
					<div class="ctn-cantidad">
						<button class="btn-eliminar" @click="eliminar()">
							<img
								class="img-btn-eliminar"
								src="../assets/eliminar.png"
								alt=""
							/>
						</button>
						<div class="ctn-btns">
							<button class="btn-menos btn" @click="menos()">
								<img class="btn-img" src="../assets/menos.png" alt="" />
							</button>
							<div class="p-cantidad">{{ props.cantidad }}</div>
							<button class="btn-mas btn" @click="mas()">
								<img class="btn-img" src="../assets/mas.png" alt="" />
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { defineProps, inject } from 'vue';
	import { ref } from 'vue';
	const props = defineProps({
		producto_id: {
			type: String,
		},
		cantidad: {
			type: Number,
		},
	});

	const currentLanguage = inject('currentLanguage');
	const productos = inject('productos');
	const producto = ref(productos.value[props.producto_id]);

	//Se modifica la linea del carrito en la base de datos con ajax, y se recoge de nuevo la informacion del carrito
	function eliminar() {
		console.log('eliminado');
	}
	function mas() {
		console.log('mas');
	}
	function menos() {
		console.log('menos');
	}
</script>

<style scoped>
	.btn-menos {
		display: flex;
		border: 1px solid #000;
		border-radius: 5px;
		border-radius: 5px 0 0 5px;
		padding: 0;
		width: 40px;
		display: flex;
		align-items: center;
		justify-content: center;
		height: 40px;
	}
	.btn-mas {
		border: 1px solid #000;
		border-radius: 5px;
		border-radius: 0 5px 5px 0;
		padding: 0;
		width: 40px;
		display: flex;
		align-items: center;
		justify-content: center;
		height: 40px;
	}
	.p-cantidad {
		border-top: 1px solid #000;
		border-bottom: 1px solid #000;
		display: flex;
		align-items: center;
		width: 30px;
		justify-content: center;
	}

	.ctn-cantidad {
		display: flex;
		align-items: center;
		margin-right: 40px;
	}
	.ctn-btns {
		display: flex;
	}
	.btn-img {
		width: 20px;
		height: 20px;
	}
	.img-btn-eliminar {
		width: 20px;
		height: 20px;
	}
	.product-card {
		display: flex;
		gap: 20px;
		width: fit-content;
		justify-content: center;
		padding: 20px 0;
		width: 100%;
	}
	.product-info {
		width: 100%;
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
	.image-product {
		height: 70px;
		padding: 20px;
		border-radius: 15px;
	}

	h2 {
		margin: 0;
	}
	.info {
		width: 100%;
	}

	.precio-ctn button {
		justify-content: center;
	}
</style>
