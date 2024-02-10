<template>
	<div>
		{{ producto.id }}
	</div>
</template>

<script setup>
	const props = defineProps({
		producto: {
			type: Object,
		},
	});
</script>

<style scoped></style>
