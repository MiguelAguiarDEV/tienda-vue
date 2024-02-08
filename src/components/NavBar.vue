<template>
    <nav class="navbar-contenedor">
      <img class="logo" src="../assets/merca_dona.png" />
      <div class="items">
        <button class="item home">Home</button>

        <select v-model="contenido" class="products">
            <option class="label" value="" disabled selected hidden>Products</option>
           <option v-for="producto in productos" :key="producto.id" :value="producto.nombre" class="producto">
            {{ producto.nombre }}
           </option>
        </select>

        <button class="item">Abauot Us</button>
        <button class="item boton-idioma">Lenguage</button>
        <button class="item">Cart</button>
        <button class="item icono-perfil"><img src="../assets/perfil.png" alt="perfil"></button>
      </div>
    </nav>
</template>

<script lang="js" setup>
  import { ref } from 'vue';
  import $ from 'jquery';

  const props = defineProps({
    productos: {
      type: Array,
      required: true
    }
  });

  let contenido = ref('')

  $(document).ready(function () {
      $("option").click(function(){
        contenido.value = $(this).val();
        console.log(contenido.value)
      })
  });
  
</script>

<style scoped>
.logo {
  height: 50%;
}

.products {
  background-color: #181A1B;
  border-radius: 5px;
  font-family: Inter, system-ui, Avenir, Helvetica, Arial, sans-serif;
  line-height: 1.5;
  font-weight: 400;
  border: none;
}

.items {
  display: flex;
  height: 40px;
  gap: 5%;
  width: 100%;
  margin-left: 5%;
}
.boton-idioma {
  margin-left: auto;
}

.item:last-child {
  padding: 0;
}
.item {
  display: flex;
  background-color: transparent ;
  color: #fff;
  cursor: pointer;
  height: 100%;
  min-width: fit-content;
}
.navbar-contenedor {
  display: flex;
  align-items: center;
  width: calc( 100% - 8rem);
  height: 80px;
  padding: 1rem 4rem;
}



nav div {
  height: 100%;
}

nav div img {
  height: 100%;
}
</style>
