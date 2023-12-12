<template>
    <div class="w-96 mx-auto pt-8">
		<h1 class="text-lg">Добавить запись</h1>
		
		<form>

			<label for="content">Текст:</label>
			<input id="content" v-model="content" />
			<div v-if="errors.content">{{ errors.content }}</div>
			
			<button @click.prevent="store">Отправить</button>
		  </form>
		
	</div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
	name: "Index",
	
	components: {
		Link
	},
	
	data() {
		return  {
			content: '',
		}
	},
	
	props: [
		'errors'
	],
	
	methods: {
		store() {
			this.$inertia.post('/posts', { content: this.content })
		}
	}
}
</script>

<style scoped>

</style>