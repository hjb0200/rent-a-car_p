<template>
  <div class="container mx-auto p-4 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold mb-4 text-center text-gray-800">차량 예약</h1>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label for="start_date" class="block text-lg font-semibold mb-2 text-gray-700">예약 시작일</label>
        <Datepicker 
          v-model="form.start_date" 
          :disabled-dates="disabledDates" 
          @change="checkAvailability" 
          class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
          type="datetime" 
        />
        <div v-if="form.start_date" class="text-green-500 mt-2">선택한 시작일: {{ new Date(form.start_date).toLocaleString() }}</div>
        <div v-if="form.errors.start_date" class="text-red-500 mt-2">{{ form.errors.start_date }}</div>
      </div>
      <div>
        <label for="end_date" class="block text-lg font-semibold mb-2 text-gray-700">예약 종료일</label>
        <Datepicker 
          v-model="form.end_date" 
          :disabled-dates="disabledDates" 
          @change="checkAvailability" 
          class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
          type="datetime" 
        />
        <div v-if="form.end_date" class="text-green-500 mt-2">선택한 종료일: {{ new Date(form.end_date).toLocaleString() }}</div>
        <div v-if="form.errors.end_date" class="text-red-500 mt-2">{{ form.errors.end_date }}</div>
      </div>
      <div v-if="!isAvailable" class="text-red-500 mt-4">
        날짜가 중복되었습니다. 다시 선택해주세요.
      </div>
      <button type="submit" class="btn btn-primary mt-4" :disabled="!isAvailable">예약</button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { defineProps, ref, onMounted, watch } from 'vue'
import axios from 'axios'
import Datepicker from 'vue-datepicker-next'
import 'vue-datepicker-next/index.css'

const props = defineProps({
  car: Object
})

const form = useForm({
  start_date: '',
  end_date: ''
})

const isAvailable = ref(true)
const disabledDates = ref([])

onMounted(async () => {
  const response = await axios.get(`/reservations/dates/${props.car.id}`)
  const reservations = response.data

  disabledDates.value = reservations.flatMap(reservation => {
    const start = new Date(reservation.start_date)
    const end = new Date(reservation.end_date)
    const dates = []

    while (start <= end) {
      dates.push(new Date(start))
      start.setDate(start.getDate() + 1)
    }

    return dates
  })
})

watch([() => form.start_date, () => form.end_date], checkAvailability)

async function checkAvailability() {
  if (form.start_date && form.end_date) {
    const response = await axios.post('/reservations/check-availability', {
      car_id: props.car.id,
      start_date: form.start_date,
      end_date: form.end_date
    })
    isAvailable.value = response.data.available
    if (!isAvailable.value) {
      alert('예약일이 중복됩니다.');
    }
  } else {
    isAvailable.value = true
  }
}

function submit() {
  if (isAvailable.value) {
    form.post(`/reservations/store/${props.car.id}`)
  }
}
</script>

<style>
  .container {
    max-width: 600px;
    margin: auto;
    padding: 1.5rem;
    background-color: rgba(255, 255, 255, 0.9); /* 반투명 배경 */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 0.75rem;
    transition: all 0.3s ease-in-out;
  }

  .container:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }

  .btn {
    display: inline-block;
    font-weight: 500;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.75rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }

  .btn-primary {
    color: #fff;
    background-color: #3b82f6;
    border-color: #3b82f6;
  }

  .btn-primary:hover {
    color: #fff;
    background-color: #2563eb;
    border-color: #2563eb;
  }

  .btn-primary:focus, .btn-primary.focus {
    box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.5);
  }
</style>
