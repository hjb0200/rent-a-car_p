<template>
  <div class="container mx-auto p-4 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold mb-4 text-center text-gray-800">차량 목록</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div v-for="car in cars" :key="car.id" class="car-card bg-white rounded-lg shadow-md p-4">
        <h2 class="text-xl font-bold">{{ car.make }} {{ car.model }}</h2>
        <p class="text-gray-600">연식: {{ car.year }}</p>
        <p :class="car.available ? 'text-green-500' : 'text-red-500'">{{ car.available ? '대여 가능' : '대여 불가' }}</p>
        <Link :href="`/cars/${car.id}`" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded block text-center">상세 보기</Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  cars: Array
})
</script>

<style>
  .car-card {
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .car-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
</style>


