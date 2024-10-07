<template>
  <div class="container mx-auto p-4 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold mb-4 text-center text-gray-800">새로운 차량 추가</h1>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label for="make" class="block text-lg font-semibold mb-2 text-gray-700">제조사</label>
        <input id="make" v-model="form.make" type="text" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        <div v-if="form.errors.make" class="text-red-500 mt-2">{{ form.errors.make }}</div>
      </div>
      <div>
        <label for="model" class="block text-lg font-semibold mb-2 text-gray-700">모델</label>
        <input id="model" v-model="form.model" type="text" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        <div v-if="form.errors.model" class="text-red-500 mt-2">{{ form.errors.model }}</div>
      </div>
      <div>
        <label for="year" class="block text-lg font-semibold mb-2 text-gray-700">연식</label>
        <input id="year" v-model="form.year" type="number" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        <div v-if="form.errors.year" class="text-red-500 mt-2">{{ form.errors.year }}</div>
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">차량 추가</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  make: '',
  model: '',
  year: ''
})

function submit() {
  form.post('/cars')
}
</script>

<style>
  .container {
    max-width: 600px;
    margin: auto;
    padding: 1.5rem;
    background-color: rgba(255, 255, 255, 0.9);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 0.75rem;
    transition: all 0.3s ease-in-out;
  }

  .container:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }

  button {
    transition: background-color 0.3s ease-in-out;
  }

  button:hover {
    background-color: #2563eb;
  }
</style>