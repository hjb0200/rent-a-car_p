<template>
  <div class="container mx-auto p-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-5xl font-bold mb-6 text-center text-gray-800">렌터카 서비스에 오신 것을 환영합니다</h1>
    <p class="text-center text-gray-600 mb-8">간편하게 차량을 예약하고 관리할 수 있는 서비스를 제공해드립니다.</p>
    <div class="flex justify-center space-x-4">
      <Link href="/cars" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-300">
        차량 목록 보기
      </Link>
      <Link href="/cars/create" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300">
        새로운 차량 추가
      </Link>
      <Link href="/login" class="bg-yellow-500 text-white px-6 py-3 rounded-lg hover:bg-yellow-600 transition duration-300">
        로그인
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<style>
  .container {
    max-width: 800px;
    margin: auto;
    padding: 2rem;
    background-color: rgba(255, 255, 255, 0.9);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 0.75rem;
    transition: all 0.3s ease-in-out;
  }

  .container:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }

  a {
    transition: background-color 0.3s ease-in-out;
  }

  a:hover {
    background-color: #2563eb;
  }
</style>
