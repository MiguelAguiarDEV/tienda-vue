<template>
  <nav class="">
    <div class="navbar-contenedor">
        <img class="" src="../../assets/merca_dona.png">
        <div class="items">
            <DropDown />          
          <button class="item">
            Abauot
          </button>
        </div>
      </div>
  </nav>
</template>

<script lang="ts" setup>
import DropDown from './DropDown.vue'

</script>

<style scoped>
.items {
  display: flex;
  height: 40px;
  align-items: stretch;
}

.item {
    background-color: #333; 
    color: #fff; 
    border-radius: 5px;
    cursor: pointer; 
    height: 100%;
}
.navbar-contenedor {
  display: flex;
  align-items: center;
}

nav {
  width: 100wh;
  height: 80px;
}

nav div {
  height: 100%;
}

nav div img {
  height: 100%;
}
.logo-mercadona {
  width: 300px;
}
</style>