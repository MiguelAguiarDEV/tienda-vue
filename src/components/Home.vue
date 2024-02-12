<template>
	<div>
		<Producto
			class="producto"
			v-for="producto in productos"
			:key="producto.id"
			:producto="producto"
		/>
	</div>
</template>

<script setup>
	import Producto from './Producto.vue';

	const props = defineProps({
		productos: {
			type: Array,
		},
	});
</script>

<style scoped>
	#home {
		display: flex;
		width: 100%;
		flex-wrap: wrap;
		justify-content: space-around;
		padding-top: 40px;
	}

	.producto {
		margin-bottom: 80px;
	}
</style>
