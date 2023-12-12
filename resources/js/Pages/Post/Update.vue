<template>
    <div class="w-96 mx-auto pt-8">
		<h1 class="text-lg">Изменить записаь</h1>
		
		<form>
			<label for="content">Текст:</label>
			<input id="content" v-model="content" />
			
			<button @click.prevent="update">Сохранить</button>
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
	
	props: [
		'post',
	],
	
	data() {
		return  {
			id: this.post.id,
			content: this.post.content,
		}
	},
	
	methods: {
		update() {
			this.$inertia.patch('/posts/'+this.id, { content: this.content })
		}
	}
}
</script>

<style scoped>

</style>