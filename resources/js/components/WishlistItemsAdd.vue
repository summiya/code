<template>
	<div>
	    <h1>Add an Item to "{{wishlistName}}"</h1>
        <div class="alert alert-danger" v-if="error">Something went wrong</div>
        <div class="alert alert-success" v-if="success">Item Updated Successfully!</div>
        <form @submit.prevent="onSubmit($event)">
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" v-model="item.name" />
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" v-model="item.description"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" v-model="item.price" />
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input id="image" v-model="item.image" />
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input id="url" v-model="item.url" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                <router-link class="btn btn-default" :to="{ name: 'wishlists' }">Cancel</router-link>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            success: false,
            wishlistName: '',
            item: {
                name: '',
                wishlist_id: '',
                price: '',
                description: '',
                image: '',
                url: ''
            },
            error: null
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.loading = true;
            axios.get('/wishlists/' + this.$route.params.id)
                .then(response => {
                    this.loading = false;
                    this.wishlistName = response.data.name
                })
                .catch(error => {
                    this.error = error
                })
        },
        onSubmit(e) {
          this.item.wishlist_id = this.$route.params.id
          axios.post('/wishlist_items', this.item)
                .then(response => {
                    this.success = true
                    this.resetForm()
                })
                .catch(error => {
                    this.error = error
                })
        },
        resetForm() {
            this.item.name = ''
            this.item.wishlist_id = ''
            this.item.price = ''
            this.item.description = ''
            this.item.image = ''
            this.item.url = ''
        }
    }
}
</script>