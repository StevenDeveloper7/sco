<template>


    <div>

        <div class="content-wrapper">

            <div class="row">

                <div class=" col-md-12 ">
                    <div class="media align-items-center bg-white mb-20">
                    <span class="avatar  bg-primary"><i class="fa fa-table"></i></span>
                    <div class="media-body">
                        <h3><strong>Reportes</strong></h3>
                    </div>
                    </div>
                </div>

            </div>

<section class="content">

	  <div class="row">

        <div class="col-6 col-lg-3">
            <div class="box box-body">
              <div class="text-center">
                <a href="#">
                  <img class="avatar avatar-xxl rounded-circle mb-15" src="images/cliente.jpg" alt="">
                </a>
				<h3 class="mb-5"><a href="#">Reporte de clientes</a></h3>
				<a href="#" class="btn btn-rounded btn-danger" v-on:click.prevent="generateReporte_clientes()"><i class="fa fa-file-pdf-o"></i>&nbsp;Generar</a>
              </div>
            </div>
          </div>

          <div class="col-6 col-lg-3">
            <div class="box box-body">
              <div class="text-center">
                <a href="#">
                  <img class="avatar avatar-xxl rounded-circle mb-15" src="images/venta.jpg" alt="">
                </a>
				<h3 class="mb-5"><a href="#">Reporte de ventas</a></h3>


                        <label for="fecha1">Fecha</label>
                                <v-date-picker mode='range' v-model='range' :columns="$screens({ lg: 2 }, 1)"/>


                    <br><br>
				<a href="#" class="btn btn-rounded btn-danger" v-on:click.prevent="generateReporte_ventas()"><i class="fa fa-file-pdf-o"></i>&nbsp;Generar</a>
              </div>
            </div>
          </div>

        <div class="col-6 col-lg-3">
            <div class="box box-body">
              <div class="text-center">
                <a href="#">
                  <img class="avatar avatar-xxl rounded-circle mb-15" src="images/comision.jpg" alt="">
                </a>
				<h3 class="mb-5"><a href="#">Reporte de comisiones</a></h3>


                        <label for="fecha2">Fecha</label>

                                <v-date-picker mode='range' v-model='range_comisiones' :columns="$screens({ lg: 2 }, 1)"/>

                        <br>
                        <label for="documento">Número Documento</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                                </div>
                                <input type="number" name="documento" class="form-control" v-model="documento">
                            </div>


                    <br>

				<a href="#" class="btn btn-rounded btn-danger" v-on:click.prevent="generateReporte_comisiones()"><i class="fa fa-file-pdf-o"></i>&nbsp;Generar</a>
              </div>
            </div>
          </div>

	  </div>
</section>


        </div>



    </div>


</template>

<script>

       export default {

            data() {
                return {
                range: {
                    start: '',
                    end: ''
                },

                range_comisiones: {
                    start: '',
                    end: ''
                },

                documento:0

            };
        },



           methods:{

            generateReporte_clientes(){

             this.$swal({
                title: 'Cargando!',
                text: 'Espere un momento por favor..',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                showConfirmButton: false,
                imageUrl: "img/spinner.gif",
                onOpen: () => {
                    swal.showLoading()
                }
            });

                axios({
                url: 'reporte-clientes',
                method: 'GET',
                responseType: 'blob', // important
                }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'clientes.pdf');
                document.body.appendChild(link);
                link.click();
                this.$swal(
                        'Generado',
                        'Reporte Generado con éxito.',
                        'success'
                    )
                });
        },

        generateReporte_ventas(){

             this.$swal({
                title: 'Cargando!',
                text: 'Espere un momento por favor..',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                showConfirmButton: false,
                imageUrl: "img/spinner.gif",
                onOpen: () => {
                    swal.showLoading()
                }
            });

                axios({
                url: 'reporte-ventas/'+ this.range.start + '/' + this.range.end,
                method: 'GET',
                responseType: 'blob', // important
                }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'ventas.pdf');
                document.body.appendChild(link);
                link.click();
                this.$swal(
                        'Generado',
                        'Reporte Generado con éxito.',
                        'success'
                    )
                });
        },

        generateReporte_comisiones(){


             this.$swal({
                title: 'Cargando!',
                text: 'Espere un momento por favor..',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                showConfirmButton: false,
                imageUrl: "img/spinner.gif",
                onOpen: () => {
                    swal.showLoading()
                }
            });

                axios({
                url: 'reporte-comisiones/'+ this.range_comisiones.start + '/' + this.range_comisiones.end + '/' + this.documento,
                method: 'GET',
                responseType: 'blob', // important
                }).then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'ventas.pdf');
                document.body.appendChild(link);
                link.click();
                this.$swal(
                        'Generado',
                        'Reporte Generado con éxito.',
                        'success'
                    )
                });
        },


           }
       }


</script>

<style>

.center-block {
    display: table;  /* Instead of display:block */
    margin-left: auto;
    margin-right: auto;
}

.date-picker /deep/ input {
    display: block !important;
    width: 100% !important;
    color: #495057 !important;
    background-color: #fff !important;
    background-clip: padding-box !important;
    border: 1px solid #ced4da !important;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out !important;
    padding: .25rem .5rem !important;
    font-size: .875rem !important;
    line-height: 1.5 !important;
    border-radius: .2rem !important;
}

</style>
