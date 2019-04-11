<template>
	<div>
	    <h1>Add a Wishlist</h1>
        <div class="alert alert-danger" v-if="error">Something went wrong</div>
        <div class="alert alert-success" v-if="success">Wishlist Added Successfully!</div>
        <form @submit.prevent="onSubmit($event)">
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" v-model="wishlist.name" />
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
            wishlist: {
                name: '',
                user_id: ''
            },
            error: null
        };
    },
    methods: {
        onSubmit(e) {
          this.wishlist.user_id = this.$auth.user().id
          axios.post('/wishlists', this.wishlist)
                .then(response => {
                    this.success = true
                    this.wishlist.name = ''
                })
                .catch(error => {
                    this.error = error
                })  
        }

    }
}
</script>