
new Vue({
	el: '#table',
	data: {
		areas:[],
	},

	created: function() {
		this.getAreas();
		//this.$nextTick(function() {
		//	$('#table-areas').DataTable();
		  //})
	},

	methods: {
		//metodo para obtener listado de todas las areas
		getAreas: function() {
			var urlAreas = 'listaAreas';
      axios.get(urlAreas).then(response => {
				this.areas = response.data
				});//fin de peticion ajax
		},//fin de getAreas

			//metodo para eliminar un area
		deleteArea: function(area){
			var url= 'areas/'+area.id;
			confirm('Seguro de Eliminar el area: '+area.nombre, function(result){
				if(!result) {
				   return false;
				}
			});
			axios.delete(url).then(response=>{
				this.getAreas();
				toastr.success('Area'+' '+area.id+' '+ 'Eliminada correctamente');
			},
			(error) => { alert(error) }
		);
		}//termina metodo delete

	},//cierre de todos los metodos
}); //fin de instancia de vue
