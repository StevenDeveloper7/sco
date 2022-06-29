<template>

    <div>

        <div class="content-wrapper">

            <div class="row">

            <div class=" col-md-12 ">
				<div class="media align-items-center bg-white mb-20">
				  <span class="avatar  bg-primary"><i class="fa fa-money"></i></span>
				  <div class="media-body">
					<h3><strong>Comisiones</strong></h3>
				  </div>
				</div>
			</div>

            </div>

        <!-- Main content -->
    <section class="content">

	  <div class="row">

		<div class="col-12 col-lg-12">
          <div class="box">
            <div class="box-header with-border">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
				  <table class="table mb-0">
					  <thead class="bg-info">
						<tr>
						    <th scope="col">Venta N°</th>
						    <th scope="col">Fecha</th>
						    <th scope="col">Vendedor</th>
                            <th scope="col">Valor Comision</th>
                            <th scope="col">Tipo</th>
						</tr>
					  </thead>
					  <tbody>
			<tr v-for="comision in Comisiones" v-bind:key="comision.id">
              <td class="td-style">{{comision.id_solicitud_venta}}</td>
              <td class="td-style">{{moment(comision.fecha).format('DD-MM-YYYY')}}</td>
              <td class="td-style">{{comision.nombre_vendedor}}</td>
              <td class="td-style">{{comision.valor_comision | format-thousands}}</td>
              <td class="td-style">{{comision.tipo_comision}}</td>
            </tr>
					  </tbody>
					</table>
                    <spinner v-show="loading"></spinner>
				</div>
                <nav>
                                <ul class="pagination pull-right">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
                                            <span>Atrás</span>
                                        </a>
                                    </li>

                                    <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']" v-bind:key="page">
                                        <a class="page-link" href="#" @click.prevent="changePage(page)">
                                            {{ page }}
                                        </a>
                                    </li>

                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
                                            <span>Siguiente</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

	  </div>
    </section>
        </div>
    </div>

</template>

<script>

    export default{

        created: function(){

        this.getComisiones();
    },

        data(){

            return{

            Comisiones: [],
            pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
                },
            offset: 3,
            loading: true,
            newid_tipo:'',
            newrole:'',
            newnumero_documento:'',
            newnombre_completo:'',
            newtelefono:'',
            newdireccion:'',
            newemail:'',
            newusername:'',
            newpassword:'',
            errors: [],
            fillusuarios:{'id': '', 'numero_documento': '', 'nombres_completo': '', 'telefono': '', 'direccion': '','email': '','id_tipo_documento':'','id_role':'','password':''},

            }
        },

          computed: {

              isActived: function() {
			return this.pagination.current_page;
		},

		pagesNumber: function() {
			if(!this.pagination.to){
				return [];
			}

			var from = this.pagination.current_page - this.offset;
			if(from < 1){
				from = 1;
			}

			var to = from + (this.offset * 2);
			if(to >= this.pagination.last_page){
				to = this.pagination.last_page;
			}

			var pagesArray = [];
			while(from <= to){
				pagesArray.push(from);
				from++;
			}
			return pagesArray;
		}
    },

        methods:{

            getComisiones(){
                let me = this;
                let url = 'comisiones'
                axios.get(url).then(function (response) {
                    me.Comisiones = response.data.comisiones.data,
                    me.pagination = response.data.pagination
                    me.loading = false
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },




            changePage: function(page) {
			this.pagination.current_page = page;
			this.getComisiones(page);
		},


        }

    }


</script>


<style>

th,td{

    text-align: center;
}

.btn-warning{
    background-color: #ffc107;
    border-color: #ffc107;
}



</style>
