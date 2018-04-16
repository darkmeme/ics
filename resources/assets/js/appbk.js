
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

//window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('prueba', require('./components/prueba.vue'));

const app = new Vue({
    el: '#app',

    created: function() {
		this.getAreas();
	},
	data: {
		areas: [],
	},
	methods: {
		//metodo para obtener listado de todas las areas
		getAreas: function() {
			var urlAreas = 'areas';
      axios.get(urlAreas).then(response => {
				this.areas = response.data.data
				console.log(response.data.data);
			});
		},
			//metodo para eliminar un area
		deleteArea: function(area){
			var url= 'areas/'+area.id;
			axios.delete(url).then(response=>{
				this.getAreas();
				toastr.success('Area'+' '+area.id+' '+ 'Eliminada correctamente');
			},
			(error) => { alert(error) }
		);
		}

	}
});
