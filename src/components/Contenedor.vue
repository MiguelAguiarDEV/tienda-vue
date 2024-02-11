<template>
	<!-- <div class="product-card" v-if="ShowContent.contenido == 'producto'">
		{{ productos[ShowContent.id].id }}
		{{ ShowContent.id }}
		{{ productos[ShowContent.id].nombre }}
		{{ productos[ShowContent.id].precio }}
		{{ productos[ShowContent.id].descripcion }}
		<img :src="productos[ShowContent.id].imagen" alt="" />
	</div> -->
	<div>
		<Producto
			class="producto"
			v-if="ShowContent.contenido == 'producto'"
			:producto="productos[ShowContent.id]"
		/>
	</div>
</template>

<script lang="js" setup>
	import Producto from './Producto.vue';
	const props = defineProps({
		ShowContent: {
			type: Object,
		},
		productos: {
			type: Array,
		},
	});
</script>

<style scoped>
	#contenedor {
		display: grid;
	}
</style>
