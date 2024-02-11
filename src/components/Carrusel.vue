<template>
	<div class="contenedor">
		<div class="carrusel">
			<img
				v-for="producto in productos"
				:key="producto.id"
				:src="producto.imagen"
				@click="callChangeContent(producto.id)"
			/>
		</div>
		<div class="carrusel">
			<img
				v-for="producto in productos"
				:key="producto.id"
				:src="producto.imagen"
				@click="callChangeContent(producto.id)"
			/>
		</div>
	</div>
</template>

<script lang="js" setup>
	import { defineProps, defineEmits, ref } from 'vue';
	const props = defineProps({
		productos: {
			type: Array,
			required: true,
		},
	});

	const emit = defineEmits(['changeContent']);

	function callChangeContent(id) {
		// Call the function passed from the parent component
		const contenido = 'producto';
		emit('changeContent', contenido, id);
	}
</script>

<style scoped>
	.contenedor {
		display: flex;
		margin: 0 auto;
		border: 1px solid red;
		overflow: hidden;
		width: fit-content;
	}

	.carrusel {
		width: fit-content;
		height: 100%;
		display: flex;
		justify-content: space-evenly;
		align-items: center;
		animation: carrusel_animation 20s infinite linear;
		display: flex;
	}

	img {
		height: 10rem;
		aspect-ratio: 1/1;
		margin: 0 5rem;
		cursor: pointer;
		-webkit-user-drag: none;
	}

	@keyframes carrusel_animation {
		from {
			transform: translateX(0%);
		}
		to {
			transform: translateX(-100%);
		}
	}
</style>
