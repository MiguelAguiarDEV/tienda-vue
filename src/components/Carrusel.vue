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
		emit('changeContent', { contenido: 'producto', id: id });
	}
</script>

<style scoped>
	.contenedor {
		display: flex;
		margin: 0 auto;
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
		height: 5rem;
		aspect-ratio: 1/1;
		margin: 0 5rem;
		cursor: pointer;
		-webkit-user-drag: none;
		transition: transform 0.3s;
		position: relative;
		z-index: 1;
	}

	.contenedor:hover .carrusel {
		animation-play-state: paused;
	}

	img:hover {
		transform: scale(1.3);
		transition: transform 0.3s;
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
