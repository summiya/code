<template>
	<div>
        <div class="row">
            <div class="col-md-10">
    	       <h1>My Wishlists</h1>
            </div>
            <div class="col-md-2">
                <router-link class="btn btn-primary" style="margin-top: 20px; float: right" :to="{ name: 'wishlists.add'}">Add New</router-link>
            </div>
        </div>
        <div class="alert alert-success" v-if="success">Wishlist Deleted Successfully!</div>
        <div v-if="!loading"> Loading ... </div>
	    <table class="table table-bordered" v-else>
	    	<thead>
	    		<tr>
	    			<th>Name</th>
	    			<th>Organizer</th>
                    <th>Items</th>
	    			<th>Actions</th>
	    		</tr>
	    		<tr v-for="wishlist in wishlists">
	    			<td>{{ wishlist.name }}</td>
                    <td>{{ ($auth.user().id == wishlist.user_id ? wishlist.user.name + ' (Me)': wishlist.user.name ) }}</td>
                    <td> <b>({{ wishlist.wishlist_items.length }})</b> <router-link :to="{ name: 'wishlist_items.list', params: { id: wishlist.id } }">View Items</router-link></td>
	    			<td>
                        <router-link :to="{ name: 'wishlists.edit', params: { id: wishlist.id } }">Edit</router-link> |
                        <a href="#" @click.prevent="deleteWishlist(wishlist.id)">Delete</a> | <router-link :to="{ name: 'wishlists.share', params: { id: wishlist.id } }">Share</router-link>
                    </td>
	    		</tr>
	    	</thead>
	    </table>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            loading: false,
            wishlists: null,
            error: null,
            success: false
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.wishlists = null;
            this.loading = true;
            axios.get('/wishlists')
                .then(response => {
                    this.wishlists = response.data
                })
                .catch(error => {
                	this.error = error
                })
        },
        deleteWishlist(id) {
            if (confirm('Are you sure you want to delete this Wishlist?')) {
            axios.delete('wishlists/' + id)
            .then((response) => {
                console.log(response);
              if (response.status == 204) {
                this.success = true
                const indexToDelete = this.wishlists.findIndex(row => row.id == id)
                if (indexToDelete !== -1) {
                  this.wishlists.splice(indexToDelete, 1)
                }
              }
            })
            .catch((error) => {
              this.error = error
            })
          }
        }
    }
}
</script>