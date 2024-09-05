<template>
  <div class="container mx-auto p-4 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold mb-4 text-gray-800">{{ car.make }} {{ car.model }}</h1>
    <p class="text-lg">연식: {{ car.year }}</p>
    <p :class="car.available ? 'text-green-500' : 'text-red-500'" class="text-lg">{{ car.available ? '대여 가능' : '대여 불가' }}</p>
    <Link v-if="car.available" :href="`/reservations/create/${car.id}`" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded block text-center">예약하기</Link>

    <div class="mt-8">
      <h2 class="text-2xl font-bold">예약 내역</h2>
      <ul class="mt-4">
        <li v-for="reservation in reservations" :key="reservation.id" class="reservation-item border p-4 rounded-lg mb-2">
          예약 기간: {{ formatDate(reservation.start_date) }} - {{ formatDate(reservation.end_date) }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  car: Object,
  reservations: Array
})

function formatDate(date) {
  return new Date(date).toLocaleDateString()
}
</script>

<style>
  .reservation-item {
    background-color: rgba(255, 255, 255, 0.9);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
  }

  .reservation-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
</style>