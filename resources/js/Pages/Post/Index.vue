<template>
    <div class="w-96 mx-auto pt-8">
		<h1 class="text-lg">Записи</h1>
		
		<button class="btn btn-primary">
			<Link :href="route('post.create')">Добавить запись</Link>
		</button>
		
		<div v-if="posts">
			<div v-for="post in posts">
				<div>{{ post.content }}</div>
				
				<button class="btn btn-primary btn-sm" v-if="post.canUpdate">
					<Link :href="route('post.edit', post.id)">Изменить запись</Link>
				</button>
				<button class="btn btn-primary btn-sm" v-if="post.canDelete">
					<p @click="remove(post.id)">Удалить запись</p>
				</button>
				
				<hr>
			</div>
		</div>
		
	</div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
	name: "Index",
	
	props: [
		'posts'
	],
	
	components: {
		Link
	},
	
	methods: {
		remove(id){
			this.$inertia.delete('/posts/'+id)
		}
	}
}
</script>

<style scoped>

</style>