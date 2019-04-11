<template>
	<div>
	    <h1>Edit Wishlist</h1>
        <div class="alert alert-success" v-if="success">Wishlist Updated Successfully!</div>
        <div v-if="loading">Loading...</div>
        <form @submit.prevent="onSubmit($event)" v-else>
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" v-model="wishlist.name" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
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
            loading: false,
            success: false,
            wishlist: {
                id: null,
                name: '',
                user_id: ''
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
                    this.wishlist.name = response.data.name,
                    this.wishlist.id = this.$route.params.id,
                    this.wishlist.user_id = this.$auth.user().id
                })
                .catch(error => {
                	this.error = error
                })
        },
        onSubmit(e) {
          axios.put('/wishlists/' + this.$route.params.id, this.wishlist)
                .then(response => {
                    this.success = true
                })
                .catch(error => {
                    this.error = error
                })  
        }

    }
}
</script>