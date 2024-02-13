<template>
	<footer>
		<div class="ctn">
			<p>{{ text[currentLanguage].info }}</p>
			<p>{{ text[currentLanguage].direccion }}</p>
			<p>{{ text[currentLanguage].email }}</p>
			<p>{{ text[currentLanguage].telefono }}</p>
		</div>
	</footer>
</template>

<script lang="js" setup>
	import { ref, inject } from 'vue';
	const currentLanguage = inject('currentLanguage');

	const text = ref({
		es: {
			info: 'Información de derechos de autor y otros',
			direccion:
				'Dirección de la compañía: 123 Calle Ficticia, Ciudad Imaginaria',
			email: 'Correo electrónico: info@companiaimaginaria.com ',
			telefono: 'Número de teléfono: +123 456 7890',
		},
		en: {
			info: 'Copyright and other information',
			direccion: 'Company address: 123 Fictitious Street, Imaginary City',
			email: 'Email: info@companiaimaginaria.com',
			telefono: 'Phone number: +123 456 7890',
		},
	});
</script>

<style scoped>
	footer {
		text-align: center;
		display: flex;
		justify-content: center;
		height: 20vh;
		align-items: flex-end;
	}

	.ctn {
		font-size: 14px;
		color: #666;
	}

	.ctn p {
		margin: 5px 0;
	}
</style>
