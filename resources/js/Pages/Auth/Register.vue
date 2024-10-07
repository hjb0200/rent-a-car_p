<template>
  <HomeButton /> <!-- 홈페이지로 이동 버튼 -->
  <div class="container mx-auto p-4 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold mb-4 text-center">회원가입</h1>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label for="name" class="block text-lg">이름</label>
        <input id="name" v-model="form.name" type="text" class="w-full p-2 border rounded" />
      </div>
      <div>
        <label for="email" class="block text-lg">이메일</label>
        <input id="email" v-model="form.email" type="email" class="w-full p-2 border rounded" />
      </div>
      <div>
        <label for="password" class="block text-lg">비밀번호</label>
        <input id="password" v-model="form.password" type="password" class="w-full p-2 border rounded" />
      </div>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">회원가입</button>
    </form>
    <Link href="/login" class="text-blue-500 hover:underline mt-4 block text-center">로그인 페이지로 이동</Link>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import HomeButton from '../../Components/HomeButton.vue'

const form = useForm({
  name: '',
  email: '',
  password: ''
})

function submit() {
  form.post('/register', {
    onSuccess: () => {
      form.reset()
      window.location.href = '/login' // 회원가입 후 로그인 페이지로 리디렉션
    }
  })
}
</script>