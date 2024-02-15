<template>
	<form @submit.prevent="Registrar">
		<h2>{{ text.signup[currentLanguage] }}</h2>
		<!-- User Input -->
		<label for="usuario">
			{{ text.user[currentLanguage] }}
			<input
				id="user"
				type="text"
				name="usuario"
				:placeholder="text.user[currentLanguage]"
				required
				@keyup="handleInput('user')"
			/>
			<div id="userError" class="error">
				{{ validationRules.user[currentLanguage] }}
			</div>
		</label>
		<!-- Email Input -->
		<label for="mail">
			{{ text.mail[currentLanguage] }}
			<input
				id="mail"
				type="text"
				name="mail"
				:placeholder="text.mail[currentLanguage]"
				required
				@keyup="handleInput('mail')"
			/>
			<div id="mailError" class="error">
				{{ validationRules.mail[currentLanguage] }}
			</div>
		</label>
		<!-- IBAN Input -->
		<label for="iban">
			{{ text.iban[currentLanguage] }}
			<input
				id="iban"
				type="text"
				name="iban"
				:placeholder="text.iban[currentLanguage]"
				required
				@keyup="handleInput('iban')"
			/>
			<div id="ibanError" class="error">
				{{ validationRules.iban[currentLanguage] }}
			</div>
		</label>
		<!-- Phone Number Input -->
		<label for="tlf">
			{{ text.tlf[currentLanguage] }}
			<input
				id="tlf"
				type="text"
				name="tlf"
				:placeholder="text.tlf[currentLanguage]"
				required
				@keyup="handleInput('tlf')"
			/>
			<div id="tlfError" class="error">
				{{ validationRules.tlf[currentLanguage] }}
			</div>
		</label>

		<!-- Password Input -->
		<label for="contraseña">
			{{ text.password[currentLanguage] }}
			<input
				id="contrasena"
				type="password"
				name="contraseña"
				:placeholder="text.password[currentLanguage]"
				required
				@keyup="handleInput('contrasena')"
			/>
			<div id="contrasenaError" class="error">
				{{ validationRules.contrasena[currentLanguage] }}
			</div>
		</label>
		<!-- Repeat Password Input -->
		<label for="repetirContraseña">
			{{ text.repeatPassword[currentLanguage] }}
			<input
				id="repetirContrasena"
				type="password"
				name="repetirContraseña"
				:placeholder="text.repeatPassword[currentLanguage]"
				required
				@keyup="handleInput('repetirContrasena')"
			/>
			<div id="repetirPasswordError" class="error">
				{{ validationRules.repetirContrasena[currentLanguage] }}
			</div>
		</label>

		<!-- Btn Registrarse -->
		<button id="submit" type="submit">
			{{ text.signup[currentLanguage] }}
		</button>
		<a @click="redirectLogIn">{{ text.noUser[currentLanguage] }}</a>
	</form>
</template>

<script setup>
	import { inject, ref } from 'vue';
	import $ from 'jquery';
	const ShowContent = inject('ShowContent');
	const usuario = inject('usuario');
	const islogged = inject('islogged');
	const currentLanguage = inject('currentLanguage');
	const text = ref({
		signup: {
			en: 'Sign Up',
			es: 'Registrarse',
		},
		user: {
			en: 'Username',
			es: 'Nombre de Usuario',
		},
		mail: {
			en: 'Email',
			es: 'Correo Electrónico',
		},
		iban: {
			en: 'IBAN',
			es: 'IBAN',
		},
		tlf: {
			en: 'Phone Number',
			es: 'Número de Teléfono',
		},
		password: {
			en: 'Password',
			es: 'Contraseña',
		},
		repeatPassword: {
			en: 'Repeat Password',
			es: 'Repetir Contraseña',
		},
		userError: {
			en: 'User already exists',
			es: 'El usuario ya existe',
		},
		noUser: {
			en: 'Already have an account? Log in here',
			es: '¿Ya tienes una cuenta? Inicia sesión aquí',
		},
		repeatPasswordError: {
			en: 'Passwords do not match',
			es: 'Las contraseñas no coinciden',
		},
		tlfError: {
			en: 'Invalid phone number',
			es: 'Número de teléfono inválido',
		},
		ibanError: {
			en: 'Invalid IBAN',
			es: 'IBAN inválido',
		},
		mailError: {
			en: 'Invalid email',
			es: 'Correo electrónico inválido',
		},
	});

	const validationRules = {
		user: {
			regex: /^[a-zA-Z0-9_-]{3,20}$/,
			es: 'Usuario debe contener entre 3 y 20 caracteres (letras, números, guiones bajos y guiones)',
			en: 'Username must be between 3 and 20 characters (letters, numbers, underscores, and hyphens)',
		},
		mail: {
			regex: /^\S+@\S+\.\S+$/,
			es: 'El mail debe tener formato usuario@dominio.extension',
			en: 'The mail must have format user@domain.extension',
		},
		tlf: {
			regex: /^(6|7|8|9)\d{8}$/,
			es: 'Teléfono debe comenzar con 6, 7, 8 o 9 y tener 9 dígitos',
			en: 'Phone number must start with 6, 7, 8 or 9 and have 9 digits',
		},
		iban: {
			regex: /^ES\d{2}\s?\d{4}\s?\d{4}\s?\d{4}\s?\d{4}\s?\d{4}$/,
			es: 'IBAN debe tener formato ESXX XXXX XXXX XXXX XXXX XXXX',
			en: 'IBAN must have format ESXX XXXX XXXX XXXX XXXX XXXX',
		},
		contrasena: {
			regex: /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{12,}$/,
			es: 'Contraseña debe tener al menos 12 caracteres, incluyendo una letra, un número y un carácter especial',
			en: 'Password must be at least 12 characters long, including one letter, one number, and one special character',
		},
		repetirContrasena: {
			regex: /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{12,}$/,
			es: 'Las contraseñas deben coincidir',
			en: 'Passwords must match',
		},
	};

	function validateField(field, value) {
		const rule = validationRules[field].regex;

		if (!rule.test(value)) {
			$('#' + field + 'Error').addClass('invalid');
			$('#' + field + 'Error').removeClass('error');

			console.log('invalid');
			return false;
		} else {
			$('#' + field + 'Error').removeClass('invalid');
			$('#' + field + 'Error').addClass('error');
			return true;
		}
	}

	function handleInput(field) {
		validateField(field, $('#' + field).val());
	}
	function redirectLogIn() {
		ShowContent.value = {
			contenido: 'logIn',
		};
	}
</script>

<style scoped>
	form {
		width: 50%;
		margin: 0 auto;
		display: flex;
		flex-direction: column;
	}
	.invalid {
		opacity: 100%;
		color: rgb(190, 54, 54);
		font-weight: bold;
	}
	.error {
		opacity: 0%;
	}
	label {
		display: block;
	}
	input[type='text'],
	input[type='password'] {
		width: 100%;
		padding: 10px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
	}

	button {
		margin-top: 20px;
		background-color: #4caf50;
		color: #fff;
		padding: 10px 20px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
		margin-bottom: 20px;
	}
	button:hover {
		background-color: #45a049;
	}
	a {
		text-decoration: underline;
	}

	a:hover {
		color: #45a049;
		cursor: pointer;
	}
</style>
