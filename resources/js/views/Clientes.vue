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
                            <h3><strong>Clientes</strong></h3>
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
                                                <option value="numero_documento"
                                                    >No. de Documento</option
                                                >
                                                <option value="nombre_completo"
                                                    >Nombre</option
                                                >
                                                <option value="telefono"
                                                    >Telefono</option
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
                                                    getClientes(
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
                                                    getClientes(
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
                                                    Tipo Documento
                                                </th>
                                                <th scope="col">
                                                    Número Documento
                                                </th>
                                                <th scope="col">
                                                    Nombre Completo
                                                </th>
                                                <th scope="col">Teléfono</th>
                                                <th scope="col">Dirección</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="cliente in Clientes"
                                                v-bind:key="cliente.id"
                                            >
                                                <td class="td-style">
                                                    {{ cliente.tipo_documento }}
                                                </td>
                                                <td class="td-style">
                                                    {{
                                                        cliente.numero_documento
                                                    }}
                                                </td>
                                                <td class="td-style">
                                                    {{
                                                        cliente.nombre_completo
                                                    }}
                                                </td>
                                                <td class="td-style">
                                                    {{ cliente.telefono }}
                                                </td>
                                                <td class="td-style">
                                                    {{ cliente.direccion }}
                                                </td>
                                                <td class="td-style">
                                                    {{ cliente.email }}
                                                </td>
                                                <td class="td-style">
                                                    {{ cliente.nombre_estado }}
                                                </td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-warning btn-rounded"
                                                        data-toggle="modal tooltip"
                                                        data-placement="top"
                                                        title="Editar"
                                                        v-on:click.prevent="
                                                            editClientes(
                                                                cliente
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
                                                            deleteClientes(
                                                                cliente
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

        <form method="POST" v-on:submit.prevent="createClientes">
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
                            <h5 class="modal-title">Nuevo Cliente</h5>
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
                                            <label for="tipo_documento"
                                                >Tipo Documento</label
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
                                                <select
                                                    class="custom-select"
                                                    v-model="newid_tipo"
                                                    required
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="documento in arraydocumentos"
                                                        :key="documento.id"
                                                        :value="documento.id"
                                                        >{{
                                                            documento.nombre
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="documento"
                                                >Número Documento</label
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
                                                    id="documento"
                                                    type="number"
                                                    class="form-control"
                                                    v-model="
                                                        newnumero_documento
                                                    "
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nombre"
                                                >Nombre Completo</label
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
                                                    id="nombre"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="newnombre_completo"
                                                    required
                                                    pattern="[A-Z a-z\sáéíóú]+"
                                                    title="Ingrese sólo Letras"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
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
                                                    title="Ingrese sólo Números"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>

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
            v-on:submit.prevent="updateClientes(fillclientes.id)"
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
                            <h5 class="modal-title">Editar Cliente</h5>
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
                                            <label for="tipo_documento"
                                                >Tipo Documento</label
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
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillclientes.id_tipo_documento
                                                    "
                                                    required
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="documento in arraydocumentos"
                                                        :key="documento.id"
                                                        :value="documento.id"
                                                        >{{
                                                            documento.nombre
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="documento"
                                                >Número Documento</label
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
                                                    type="number"
                                                    class="form-control"
                                                    v-model="
                                                        fillclientes.numero_documento
                                                    "
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nombre"
                                                >Nombre Completo</label
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
                                                        fillclientes.nombre_completo
                                                    "
                                                    required
                                                    pattern="[A-Z a-z\sáéíóú]+"
                                                    title="Ingrese sólo Letras"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
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
                                                    type="number"
                                                    class="form-control"
                                                    v-model="
                                                        fillclientes.telefono
                                                    "
                                                    min="1"
                                                    required
                                                    pattern="[0-9]+"
                                                    title="Ingrese sólo Números"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>

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
                                                    type="text"
                                                    class="form-control"
                                                    v-model="
                                                        fillclientes.direccion
                                                    "
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
                                                    type="text"
                                                    class="form-control"
                                                    v-model="fillclientes.email"
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
        this.getClientes("", "nombre_completo");
        this.select_tipo_documento();
    },

    data() {
        return {
            Clientes: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
            criterio: "nombre_completo",
            buscar: "",
            arraydocumentos: [],
            loading: true,
            newid_tipo: "",
            newnumero_documento: "",
            newnombre_completo: "",
            newtelefono: "",
            newdireccion: "",
            newemail: "",
            errors: [],
            fillclientes: {
                id: "",
                numero_documento: "",
                nombres_completo: "",
                telefono: "",
                direccion: "",
                email: "",
                id_tipo_documento: ""
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
        select_tipo_documento() {
            let me = this;
            let url = "documentos";
            axios
                .get(url)
                .then(function(response) {
                    me.arraydocumentos = response.data.documentos;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        getClientes(buscar, criterio) {
            let me = this;
            var url = "/clientes?&buscar=" + buscar + "&criterio=" + criterio;
            axios
                .get(url)
                .then(function(response) {
                    (me.Clientes = response.data.clientes.data),
                        (me.pagination = response.data.pagination);
                    me.loading = false;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        editClientes(cliente) {
            this.fillclientes.id = cliente.id;
            this.fillclientes.numero_documento = cliente.numero_documento;
            this.fillclientes.id_tipo_documento = cliente.id_tipo_documento;
            this.fillclientes.nombre_completo = cliente.nombre_completo;
            this.fillclientes.telefono = cliente.telefono;
            this.fillclientes.direccion = cliente.direccion;
            this.fillclientes.email = cliente.email;
            this.fillclientes.id_role = cliente.id_role;
            this.fillclientes.id_estado = cliente.id_estado;
            // this.fillclientes.estado = cliente.estado;

            $("#edit").modal("show");
        },

        updateClientes(id) {
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
                .put("clientes/" + id, {
                    id_tipo_documento: this.fillclientes.id_tipo_documento,
                    numero_documento: this.fillclientes.numero_documento,
                    nombre_completo: this.fillclientes.nombre_completo,
                    telefono: this.fillclientes.telefono,
                    direccion: this.fillclientes.direccion,
                    email: this.fillclientes.email,
                    id_role: this.fillclientes.id_role,
                    id_estado: this.fillclientes.id_estado
                })
                .then(response => {
                    $("#buscar").click();
                    this.getClientes();
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

        createClientes() {
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
            let url = "clientes";
            axios
                .post(url, {
                    id_tipo_documento: this.newid_tipo,
                    numero_documento: this.newnumero_documento,
                    nombre_completo: this.newnombre_completo,
                    telefono: this.newtelefono,
                    direccion: this.newdireccion,
                    email: this.newemail,
                    id_estado: 1,
                    id_role: 3
                })
                .then(response => {
                    $("#buscar").click();
                    this.getClientes();

                    this.newid_tipo = "";
                    this.newnumero_documento = "";
                    this.newnombre_completo = "";
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
                        "Cliente creado con éxito.",
                        "success"
                    );
                    this.getClientes();
                })
                .catch(error => {
                    console.log(error.response.data.code);
                    //this.errors = 'error.response.data'
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
                            title: "El documento ya se encuentra registrado",
                            text: "Por favor verifica los datos"
                        });
                });
        },

        deleteClientes(cliente) {
            this.$swal({
                title: "Está seguro de Eliminar este Cliente?",
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
                    let url = "clientes";
                    axios
                        .delete("clientes/" + cliente.id)
                        .then(response => {
                            $("#buscar").click();
                            this.getClientes();
                            this.$swal(
                                "Eliminado!",
                                "El cliente ha sido Eliminado con éxito.",
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
            this.getClientes(page, this.buscar, this.criterio);
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
