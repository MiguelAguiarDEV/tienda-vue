<template>
      <button class="btn-dropdown">Products</button>
      <!-- <div class="dropdown hidden">
        <ul>
          <li v-for="producto in productos">{{ producto }}</li>
        </ul>
      </div> -->
  </template>
  
  <script lang="ts" setup>
  import { ref } from "vue";
  let productos = ref(["Prducto1", "Producto2", "Producto3"]);
  </script>
  
  <style scoped>

  .btn-dropdown {
    background-color: #333; 
    color: #fff; 
    border-radius: 5px;
    cursor: pointer;
  }
  
  .dropdown {
    position: absolute;
    background-color: rgba(0, 0, 0, 0.6); 
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.6); 
    overflow: hidden;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
  }
  
  .dropdown ul li {
    padding: 10px; 
    cursor: pointer;
    border: 1px solid #f2f2f2; 
  }
  
  .dropdown ul li:last-child {
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
  }


  .hidden {
    display: none;
  }
  li, ul{
    list-style: none;
  }
  </style>