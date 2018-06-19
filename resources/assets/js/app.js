
new Vue({
	el: '#Equipos',
	data: {
		equipos:[],
	},

	created: function() {
		this.getEquipos();
		//this.$nextTick(function() {
		//	$('#table-areas').DataTable();
		  //})
	},

	methods: {
		//metodo para obtener listado de todas las areas
		getEquipos: function() {
      axios.get('listaEquipos').then(response => {
				this.equipos = response.data
				});//fin de peticion ajax
		},//fin de getAreas

			//metodo para eliminar un equipo
			
			deleteEquipo(equipo) {
                if (confirm("Do you really want to delete:?"+equipo.nombre)) {
                    var app = this;
                    axios.delete('equipos/' + equipo.id)
                        .then(function (resp) {
							//app.companies.splice(index, 1);
							this.getEquipos();
                        })
                        .catch(function (resp) {
                            alert("Could not delete equipo");
						});
					}
		}//termina metodo delete

	},//cierre de todos los metodos
}); //fin de instancia de vue
