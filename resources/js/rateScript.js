import axios from 'axios';
window.Vue = require('vue');

const app = Vue.createApp({
	data() {
	return {
		rows: []
	};
	},
	mounted() {
		this.loadData();
	},
	methods: {
		loadData() {
			axios.get('/api/get-all/'+id)
				.then(response => {
					if (response.data.list.length > 0){
						this.rows = response.data.list;
					}else{
						this.rows = [{ price_in_rm: 0 , exchange_rate: this.getRate() }];
					}
				})
				.catch(error => {
				console.error(error);
			});
		},
		addRow() {
			
		  this.rows.push({ name: '', exchange_rate: this.getRate() , price_in_rm: 0 });
		},
		getRate(){
			var exchange_rate = 4;
			var requestURL = 'https://api.exchangerate.host/convert?from=USD&to=MYR'; 
			var request = new XMLHttpRequest(); 
			request.open('GET', requestURL);
			request.responseType = 'json';
			request.send();
			request.onload = function() {
			  var response = request.response;
			  exchange_rate = response.info.rate;
			}
			return exchange_rate;
		},
		deleteRow(index) {
			var delete_id = this.rows[index].id;
			if (typeof delete_id !== 'undefined'){
				axios.post('/api/delete/'+delete_id)
					.then(response => {
						console.log(response.data);
					})
					.catch(error => {
					console.error(error);
				});
			}
			this.rows.splice(index, 1);
		},
		saveRow(index) {
			var post = this.rows[index];
			post.user_id = id;
			axios.post('/api/update', { data: this.rows[index] })
				.then(response => {
					console.log(response.data);
				})
				.catch(error => {
				console.error(error);
			});

		},
	},
});


app.mount('#app');
