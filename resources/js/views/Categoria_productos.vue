<template>
    <div>
        <div class="content-wrapper">
            <div class="row">
                <div class=" col-md-12 ">
                    <div class="media align-items-center bg-white mb-20">
                        <span class="avatar  bg-primary"
                            ><i class="fa fa-users"></i
                        ></span>
                        <div class="media-body">
                            <h3><strong>Categoria de Productos</strong></h3>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <button
                                            type="button"
                                            class="btn btn-success btn-rounded"
                                            data-toggle="modal"
                                            data-target="#create"
                                        >
                                            <i class="fa fa-plus"></i
                                            >&nbsp;Nuevo
                                        </button>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <select
                                                id="label_ver"
                                                class="custom-select"
                                                v-model="criterio"
                                            >
                                                <option value="nombre_categoria"
                                                    >Nombre</option
                                                >
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                v-model="buscar"
                                                @keyup.enter="
                                                    getCategorias(
                                                        buscar,
                                                        criterio
                                                    )
                                                "
                                                class="form-control"
                                                placeholder="Texto a buscar"
                                            />
                                            <button
                                                id="buscar"
                                                type="submit"
                                                @click="
                                                    getCategorias(
                                                        buscar,
                                                        criterio
                                                    )
                                                "
                                                class="btn btn-primary"
                                            >
                                                <i class="fa fa-search"></i>
                                                Buscar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="bg-info">
                                            <tr>
                                                <th scope="col">
                                                    ID
                                                </th>
                                                <th scope="col">
                                                    Nombre
                                                </th>
                                                <th scope="col">
                                                    Descripcion
                                                </th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="categoria_producto in Categoria_productos"
                                                v-bind:key="
                                                    categoria_producto.id
                                                "
                                            >
                                                <td class="td-style">
                                                    {{ categoria_producto.id }}
                                                </td>
                                                <td class="td-style">
                                                    {{
                                                        categoria_producto.nombre_categoria
                                                    }}
                                                </td>
                                                <td class="td-style">
                                                    {{
                                                        categoria_producto.descripcion_categoria
                                                    }}
                                                </td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-warning btn-rounded"
                                                        data-toggle="modal tooltip"
                                                        data-placement="top"
                                                        title="Editar"
                                                        v-on:click.prevent="
                                                            editCategorias(
                                                                categoria_producto
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="fa fa-edit"
                                                        ></i>
                                                    </button>
                                                    &nbsp;
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-rounded"
                                                        data-toggle="modal tooltip"
                                                        data-placement="top"
                                                        title="Eliminar"
                                                        v-on:click.prevent="
                                                            deleteCategorias(
                                                                categoria_producto
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="fa fa-trash"
                                                        ></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <spinner v-show="loading"></spinner>
                                </div>
                                <nav>
                                    <ul class="pagination pull-right">
                                        <li
                                            class="page-item"
                                            v-if="pagination.current_page > 1"
                                        >
                                            <a
                                                class="page-link"
                                                href="#"
                                                @click.prevent="
                                                    changePage(
                                                        pagination.current_page -
                                                            1
                                                    )
                                                "
                                            >
                                                <span>Atrás</span>
                                            </a>
                                        </li>

                                        <li
                                            class="page-item"
                                            v-for="page in pagesNumber"
                                            v-bind:class="[
                                                page == isActived
                                                    ? 'active'
                                                    : ''
                                            ]"
                                            v-bind:key="page"
                                        >
                                            <a
                                                class="page-link"
                                                href="#"
                                                @click.prevent="
                                                    changePage(page)
                                                "
                                            >
                                                {{ page }}
                                            </a>
                                        </li>

                                        <li
                                            class="page-item"
                                            v-if="
                                                pagination.current_page <
                                                    pagination.last_page
                                            "
                                        >
                                            <a
                                                class="page-link"
                                                href="#"
                                                @click.prevent="
                                                    changePage(
                                                        pagination.current_page +
                                                            1
                                                    )
                                                "
                                            >
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

        <form method="POST" v-on:submit.prevent="createCategorias">
            <!-- Modal -->
            <div
                class="modal fade bs-example-modal-lg"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myLargeModalLabel"
                aria-hidden="true"
                style="display: none;"
                id="create"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title">Nueva Categoria</h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col s12">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="nombre_categoria"
                                                >Nombre</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-user"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="documento"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        newnombre_categoria
                                                    "
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-8">
                                            <label for="descripcion_categoria"
                                                >Descripcion</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-id-card"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="nombre"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        newdescripcion_categoria
                                                    "
                                                    required
                                                    pattern="[A-Z a-z\sáéíóú]+"
                                                    title="Ingrese sólo Letras"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer modal-footer-uniform">
                            <button
                                type="button"
                                class="btn btn-bold btn-pure btn-secondary btn-rounded"
                                data-dismiss="modal"
                            >
                                Cerrar
                            </button>
                            <button
                                type="submit"
                                class="btn btn-bold btn-pure btn-success float-right btn-rounded"
                            >
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
        </form>

        <form
            method="POST"
            v-on:submit.prevent="updateCategorias(fillcategoria_productos.id)"
        >
            <!-- Modal -->
            <div
                class="modal fade bs-example-modal-lg"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myLargeModalLabel"
                aria-hidden="true"
                style="display: none;"
                id="edit"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title">Editar Categoria</h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col s12">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="documento"
                                                >Nombre</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-user"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        fillcategoria_productos.nombre_categoria
                                                    "
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-8">
                                            <label for="descripcion"
                                                >Descripcion</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-id-card"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        fillcategoria_productos.descripcion_categoria
                                                    "
                                                    required
                                                    pattern="[A-Z a-z\sáéíóú]+"
                                                    title="Ingrese sólo Letras"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer modal-footer-uniform">
                            <button
                                type="button"
                                class="btn btn-bold btn-pure btn-secondary btn-rounded"
                                data-dismiss="modal"
                            >
                                Cerrar
                            </button>
                            <button
                                type="submit"
                                class="btn btn-bold btn-pure btn-success float-right btn-rounded"
                            >
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal -->
        </form>
    </div>
</template>

<script>
export default {
    created: function() {
        this.getCategorias("", "nombre_categoria");
    },

    data() {
        return {
            Categoria_productos: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
            criterio: "nombre_categoria",
            buscar: "",
            loading: true,
            newnombre_categoria: "",
            newdescripcion_categoria: "",
            errors: [],
            fillcategoria_productos: {
                id: "",
                nombre_categoria: "",
                descripcion_categoria: ""
            }
        };
    },
    mounted() {
        this.getCategorias(buscar, criterio);
    },

    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },

        pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },

    methods: {
        getCategorias(buscar, criterio) {
            let me = this;
            var url =
                "/categoria_productos?&buscar=" +
                buscar +
                "&criterio=" +
                criterio;
            axios
                .get(url)
                .then(function(response) {
                    (me.Categoria_productos =
                        response.data.categoria_productos.data),
                        (me.pagination = response.data.pagination);
                    me.loading = false;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        editCategorias(categoria_producto) {
            this.fillcategoria_productos.id = categoria_producto.id;
            this.fillcategoria_productos.nombre_categoria =
                categoria_producto.nombre_categoria;
            this.fillcategoria_productos.descripcion_categoria =
                categoria_producto.descripcion_categoria;
            $("#edit").modal("show");
        },

        updateCategorias(id) {
            this.$swal({
                title: "Cargando!",
                text: "Espere un momento por favor..",
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                showConfirmButton: false,
                imageUrl: "img/spinner.gif",
                onOpen: () => {
                    swal.showLoading();
                }
            });

            let me = this;
            axios
                .put("categoria_productos/" + id, {
                    nombre_categoria: this.fillcategoria_productos
                        .nombre_categoria,
                    descripcion_categoria: this.fillcategoria_productos
                        .descripcion_categoria
                })
                .then(response => {
                    $("#buscar").click();
                    this.getCategorias();
                    this.errors = [];

                    $("#edit").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }
                    this.$swal(
                        "Actualizado",
                        "Cliente actualizado con éxito.",
                        "success"
                    );
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        clickbutton() {
            // simulamos el click del mouse en el boton del formulario
            $("#action-button").click();
        },

        createCategorias() {
            this.$swal({
                title: "Cargando!",
                text: "Espere un momento por favor..",
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showCancelButton: false,
                showConfirmButton: false,
                imageUrl: "images/spinner.gif",
                onOpen: () => {
                    swal.showLoading();
                }
            });

            let me = this;
            let url = "categoria_productos";
            axios
                .post(url, {
                    nombre_categoria: this.newnombre_categoria,
                    descripcion_categoria: this.newdescripcion_categoria
                })
                .then(response => {
                    $("#buscar").click();
                    this.newnombre_categoria = "";
                    this.newdescripcion_categoria = "";
                    this.errors = [];
                    $("#create").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    this.$swal(
                        "Creado",
                        "Categoria creada con éxito.",
                        "success"
                    );
                    this.getCategorias(buscar, criterio);
                })
                .catch(error => {
                    console.log(error.response.data.code);
                    //this.errors = 'error.response.data'
                });
        },

        deleteCategorias(categoria_producto) {
            this.$swal({
                title: "Está seguro de Eliminar esta Categoria?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00BFF3",
                cancelButtonColor: "#d33",
                confirmButtonText: "Aceptar!",
                cancelButtonText: "Cancelar",
                confirmButtonClass: "btn btn-info",
                cancelButtonClass: "btn btn-danger",
                buttonsStyling: false,
                reverseButtons: true
            }).then(result => {
                if (result.value) {
                    this.$swal({
                        title: "Cargando!",
                        text: "Espere un momento por favor..",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        showCancelButton: false,
                        showConfirmButton: false,
                        imageUrl: "img/spinner.gif",
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });

                    let me = this;
                    let url = "categoria_productos";
                    axios
                        .delete("categoria_productos/" + categoria_producto.id)
                        .then(response => {
                            $("#buscar").click();
                            this.getCategorias();
                            this.$swal(
                                "Eliminado!",
                                "La Categoria ha sido Eliminada con éxito.",
                                "success"
                            );
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                }
            });
        },

        changePage: function(page) {
            this.pagination.current_page = page;
            this.getCategorias(page, this.buscar, this.criterio);
        }
    }
};
</script>

<style>
th,
td {
    text-align: center;
}

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
}
</style>
