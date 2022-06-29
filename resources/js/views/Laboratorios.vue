<template>
    <div>
        <div class="content-wrapper">
            <div class="row">
                <div class=" col-md-12 ">
                    <div class="media align-items-center bg-white mb-20">
                        <span class="avatar  bg-primary"
                            ><i class="glyphicon glyphicon-sunglasses"></i
                        ></span>
                        <div class="media-body">
                            <h3><strong>Laboratorios</strong></h3>
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
                                                <option value="nombre"
                                                    >Nombre</option
                                                >
                                                <option value="email"
                                                    >Email</option
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
                                                    getLaboratorios(
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
                                                    getLaboratorios(
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
                                                <th scope="col">Nit</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Teléfono</th>
                                                <th scope="col">Dirección</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="laboratorio in Laboratorios"
                                                v-bind:key="laboratorio.id"
                                            >
                                                <td class="td-style">
                                                    {{ laboratorio.nit }}
                                                </td>
                                                <td class="td-style">
                                                    {{ laboratorio.nombre }}
                                                </td>
                                                <td class="td-style">
                                                    {{ laboratorio.telefono }}
                                                </td>
                                                <td class="td-style">
                                                    {{ laboratorio.direccion }}
                                                </td>
                                                <td class="td-style">
                                                    {{ laboratorio.email }}
                                                </td>
                                                <td class="td-style">
                                                    {{
                                                        laboratorio.nombre_estado
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
                                                            editLaboratorios(
                                                                laboratorio
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
                                                            deleteLaboratorios(
                                                                laboratorio
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

        <form method="POST" v-on:submit.prevent="createLaboratorios">
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
                            <h5 class="modal-title">Nuevo Laboratorio</h5>
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
                                            <label for="nit">Nit</label>
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
                                                    id="nit"
                                                    type="number"
                                                    class="form-control"
                                                    v-model="newnit"
                                                    min="1"
                                                    required
                                                    pattern="[0-9]+"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nombre">Nombre</label>
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
                                                    id="nombre"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="newnombre"
                                                    required
                                                    pattern="[A-Z a-z\sáéíóú]+"
                                                    title="Ingrese sólo Letras"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="telefono"
                                                >Teléfono</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-phone"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="telefono"
                                                    type="number"
                                                    class="form-control"
                                                    v-model="newtelefono"
                                                    min="1"
                                                    required
                                                    pattern="[0-9]+"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="direccion"
                                                >Dirección</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-map-marker"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="direccion"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="newdireccion"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="col-md-4">
                                            <label for="email">Email</label>
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i class="fa fa-at"></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="email"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="newemail"
                                                    pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
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
            v-on:submit.prevent="updateLaboratorios(filllaboratorios.id)"
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
                            <h5 class="modal-title">Editar Laboratorio</h5>
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
                                            <label for="edit_nit">Nit</label>
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
                                                    id="edit_nit"
                                                    type="number"
                                                    class="form-control"
                                                    v-model="
                                                        filllaboratorios.nit
                                                    "
                                                    min="1"
                                                    required
                                                    pattern="[0-9]+"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="edit_nombre"
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
                                                    id="edit_nombre"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        filllaboratorios.nombre
                                                    "
                                                    required
                                                    pattern="[A-Z a-z\sáéíóú]+"
                                                    title="Ingrese sólo Letras"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="edit_telefono"
                                                >Teléfono</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-phone"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="edit_telefono"
                                                    type="number"
                                                    class="form-control"
                                                    v-model="
                                                        filllaboratorios.telefono
                                                    "
                                                    min="1"
                                                    required
                                                    pattern="[0-9]+"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="edit_direccion"
                                                >Dirección</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-map-marker"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="edit_direccion"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        filllaboratorios.direccion
                                                    "
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="col-md-4">
                                            <label for="edit_email"
                                                >Email</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i class="fa fa-at"></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="edit_email"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        filllaboratorios.email
                                                    "
                                                    pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
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
        this.getLaboratorios("", "nombre");
    },

    data() {
        return {
            criterio: "nombre",
            buscar: "",
            Laboratorios: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            newid_tipo: "",
            newnit: "",
            newnombre: "",
            newtelefono: "",
            newdireccion: "",
            id: "",
            newemail: "",
            errors: [],
            loading: true,
            filllaboratorios: {
                id: "",
                nit: "",
                nombre: "",
                telefono: "",
                direccion: "",
                email: ""
            }
        };
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
        getLaboratorios(buscar, criterio) {
            let me = this;
            var url =
                "/laboratorios?&buscar=" + buscar + "&criterio=" + criterio;
            axios
                .get(url)
                .then(function(response) {
                    (me.Laboratorios = response.data.laboratorios.data),
                        (me.pagination = response.data.pagination);
                    me.loading = false;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        editLaboratorios(laboratorio) {
            this.filllaboratorios.id = laboratorio.id;
            this.filllaboratorios.nit = laboratorio.nit;
            this.filllaboratorios.nombre = laboratorio.nombre;
            this.filllaboratorios.telefono = laboratorio.telefono;
            this.filllaboratorios.direccion = laboratorio.direccion;
            this.filllaboratorios.email = laboratorio.email;
            this.filllaboratorios.id_estado = laboratorio.id_estado;

            $("#edit").modal("show");
        },

        updateLaboratorios(id) {
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
                .put("laboratorios/" + id, {
                    nit: this.filllaboratorios.nit,
                    nombre: this.filllaboratorios.nombre,
                    telefono: this.filllaboratorios.telefono,
                    direccion: this.filllaboratorios.direccion,
                    email: this.filllaboratorios.email,
                    id_estado: this.filllaboratorios.id_estado
                })
                .then(response => {
                    $("#buscar").click();
                    this.getLaboratorios();
                    this.errors = [];

                    $("#edit").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }
                    this.$swal(
                        "Actualizado",
                        "Laboratorio actualizado con éxito.",
                        "success"
                    );
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        createLaboratorios() {
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
            let url = "laboratorios";
            axios
                .post(url, {
                    nit: this.newnit,
                    nombre: this.newnombre,
                    telefono: this.newtelefono,
                    direccion: this.newdireccion,
                    email: this.newemail,
                    id_estado: 1
                })
                .then(response => {
                    $("#buscar").click();

                    this.getLaboratorios();

                    this.newnit = "";
                    this.newnombre = "";
                    this.newtelefono = "";
                    this.newdireccion = "";
                    this.newemail = "";

                    this.errors = [];
                    $("#create").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    this.$swal(
                        "Creado",
                        "Laboratorio creado con éxito.",
                        "success"
                    );
                })
                .catch(error => {
                    console.log(error.response.data.code);
                    if (error.response.data.code == 1) {
                        this.$swal({
                            type: "error",
                            title:
                                "El correo ingresado ya se encuentra registrado",
                            text: "Por favor verifica los datos"
                        });
                    }
                    if (error.response.data.code == 3)
                        this.$swal({
                            type: "error",
                            title: "El nit ya se encuentra registrado",
                            text: "Por favor verifica los datos"
                        });
                });
        },

        deleteLaboratorios(laboratorio) {
            this.$swal({
                title: "Está seguro de Eliminar este Laboratorio?",
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
                    axios
                        .delete("laboratorios/" + laboratorio.id)
                        .then(response => {
                            $("#buscar").click();
                            this.getLaboratorios();
                            this.$swal(
                                "Eliminado!",
                                "El laboratorio ha sido Eliminado con éxito.",
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
            this.getVentas(page, this.buscar, this.criterio);
        },

        changePage: function(page) {
            this.pagination.current_page = page;
            this.getLaboratorios(page, this.buscar, this.criterio);
        }
    }
};
</script>
