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
			id="producto"
			v-if="ShowContent.contenido == 'producto'"
			:producto="productos[ShowContent.id]"
		/>
		<Home
			id="home"
			v-if="ShowContent.contenido == 'home'"
			:productos="productos"
		/>

		<AboutUs
			id="aboutUs"
			v-if="ShowContent.contenido == 'aboutUs'"
			:currentLanguage="currentLanguage"
		/>

		<SignUp
			id="signUp"
			v-if="ShowContent.contenido == 'signUp'"
			:currentLanguage="currentLanguage"
		/>
		<LogIn
			id="logIn"
			v-if="ShowContent.contenido == 'logIn'"
			:currentLanguage="currentLanguage"
		/>
	</div>
</template>

<script lang="js" setup>
	import Producto from './Producto.vue';
	import Home from './Home.vue';
	import AboutUs from './AboutUs.vue';
	import SignUp from './SignUp.vue';
	import LogIn from './LogIn.vue';
	import { defineProps, ref } from 'vue';
	const props = defineProps({
		ShowContent: {
			type: Object,
		},
		productos: {
			type: Array,
		},
		currentLanguage: {
			type: Object,
		},
	});

	const emit = defineEmits(['changeContent']);
</script>

<style scoped></style>
