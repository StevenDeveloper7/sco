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
                            <h3><strong>Usuarios</strong></h3>
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
                                            id="buscar"
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
                                                    getUsuarios(
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
                                                    getUsuarios(
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
                                                <th></th>
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
                                                <th scope="col">Rol</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="usuario in Usuarios"
                                                v-bind:key="usuario.id"
                                            >
                                                <td>
                                                    <center>
                                                        <img
                                                            :src="
                                                                'fotos/' +
                                                                    usuario.foto
                                                            "
                                                            class="avatar avatar-xl avatar-bordered"
                                                            height="70"
                                                            width="70"
                                                        />
                                                    </center>
                                                </td>
                                                <td class="td-style">
                                                    {{ usuario.tipo_documento }}
                                                </td>
                                                <td class="td-style">
                                                    {{
                                                        usuario.numero_documento
                                                    }}
                                                </td>
                                                <td class="td-style">
                                                    {{
                                                        usuario.nombre_completo
                                                    }}
                                                </td>
                                                <td class="td-style">
                                                    {{ usuario.telefono }}
                                                </td>
                                                <td class="td-style">
                                                    {{ usuario.direccion }}
                                                </td>
                                                <td class="td-style">
                                                    {{ usuario.email }}
                                                </td>
                                                <td class="td-style">
                                                    {{ usuario.nombre_role }}
                                                </td>
                                                <td class="td-style">
                                                    {{ usuario.nombre_estado }}
                                                </td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-warning btn-rounded"
                                                        data-toggle="modal tooltip"
                                                        data-placement="top"
                                                        title="Editar"
                                                        v-on:click.prevent="
                                                            editUsuarios(
                                                                usuario
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
                                                            deleteUsuarios(
                                                                usuario
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

        <form method="POST" v-on:submit.prevent="createUsuarios">
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
                            <h5 class="modal-title">Nuevo Usuario</h5>
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
                                    <div
                                        class="box card-inverse bg-img"
                                        style="background-image: url(images/fondo-clientes.jpg); padding-top: 150px"
                                    >
                                        <div
                                            class="flexbox align-items-center px-20"
                                            data-overlay="4"
                                        >
                                            <div
                                                class="flexbox align-items-center mr-auto"
                                            >
                                                <a href="#">
                                                    <img
                                                        class="avatar avatar-xl avatar-bordered"
                                                        :src="fotoMiniatura"
                                                        alt="foto"
                                                    />
                                                </a>
                                                <div
                                                    class="pl-10 d-none d-md-block"
                                                ></div>
                                            </div>

                                            <ul
                                                class="flexbox flex-justified text-center py-20"
                                            >
                                                <li class="pl-10">
                                                    <label
                                                        for="file-upload"
                                                        class="subir"
                                                    >
                                                        <i
                                                            class="fa fa-camera"
                                                            style="width:50px;"
                                                        ></i>
                                                    </label>
                                                    <input
                                                        id="file-upload"
                                                        type="file"
                                                        @change="obtenerFoto"
                                                        name="foto"
                                                        class="form-control-file"
                                                        style="display: none;"
                                                    />
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

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
                                                    min="1"
                                                    required
                                                    pattern="[0-9]+"
                                                    title="Ingrese sólo Números"
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
                                                    required
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

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="tipo_documento"
                                                >Role</label
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
                                                <select
                                                    class="custom-select"
                                                    v-model="newrole"
                                                    required
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="role in arrayroles"
                                                        :key="role.id"
                                                        :value="role.id"
                                                        >{{
                                                            role.nombre
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password"
                                                >Password</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-key"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="password1"
                                                    type="password"
                                                    class="form-control"
                                                    v-model="newpassword"
                                                    required
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
            v-on:submit.prevent="updateUsuarios(fillusuarios.id)"
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
                            <h5 class="modal-title">Editar Usuario</h5>
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
                                    <div
                                        class="box card-inverse bg-img"
                                        style="background-image: url(images/fondo-clientes.jpg); padding-top: 150px"
                                    >
                                        <div
                                            class="flexbox align-items-center px-20"
                                            data-overlay="4"
                                        >
                                            <div
                                                class="flexbox align-items-center mr-auto"
                                            >
                                                <a href="#">
                                                    <img
                                                        class="avatar avatar-xl avatar-bordered"
                                                        :src="
                                                            'fotos/' +
                                                                fillusuarios.fotoMiniatura
                                                        "
                                                        alt="foto"
                                                    />
                                                </a>
                                                <div
                                                    class="pl-10 d-none d-md-block"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>

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
                                                        fillusuarios.id_tipo_documento
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
                                                        fillusuarios.numero_documento
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
                                                        fillusuarios.nombre_completo
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
                                                        fillusuarios.telefono
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
                                                        fillusuarios.direccion
                                                    "
                                                    required
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
                                                    v-model="fillusuarios.email"
                                                    pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
                                                />
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="tipo_documento"
                                                >Role</label
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
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillusuarios.id_role
                                                    "
                                                    required
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="role in arrayroles"
                                                        :key="role.id"
                                                        :value="role.id"
                                                        >{{
                                                            role.nombre
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password"
                                                >Password</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-key"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    id="password"
                                                    type="password"
                                                    class="form-control"
                                                    v-model="
                                                        fillusuarios.password
                                                    "
                                                    required
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
        this.getUsuarios("", "nombre_completo");
        this.select_tipo_documento();
        this.select_role();
    },

    data() {
        return {
            fotoMiniatura: "",
            imagen: "",
            Usuarios: [],
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
            arrayroles: [],
            loading: true,
            newid_tipo: "",
            newrole: "",
            newnumero_documento: "",
            newnombre_completo: "",
            newtelefono: "",
            newdireccion: "",
            newemail: "",
            newusername: "",
            newpassword: "",
            errors: [],
            fillusuarios: {
                id: "",
                numero_documento: "",
                nombres_completo: "",
                telefono: "",
                direccion: "",
                email: "",
                id_tipo_documento: "",
                id_role: "",
                password: ""
            }
        };
    },

    computed: {
        foto() {
            return this.fotoMiniatura;
        },

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

        select_role() {
            let me = this;
            let url = "roles";
            axios
                .get(url)
                .then(function(response) {
                    me.arrayroles = response.data.roles;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        obtenerFoto(e) {
            let file = e.target.files[0];
            this.imagen = file;

            this.cargarImagen(file);
        },

        cargarImagen(file) {
            let reader = new FileReader();

            reader.onload = e => {
                this.fotoMiniatura = e.target.result;
            };
            reader.readAsDataURL(file);
        },

        getUsuarios(buscar, criterio) {
            let me = this;
            var url = "/usuarios?&buscar=" + buscar + "&criterio=" + criterio;
            axios
                .get(url)
                .then(function(response) {
                    (me.Usuarios = response.data.usuarios.data),
                        (me.pagination = response.data.pagination);
                    me.loading = false;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        editUsuarios(usuario) {
            this.fillusuarios.id = usuario.id;
            this.fillusuarios.numero_documento = usuario.numero_documento;
            this.fillusuarios.id_tipo_documento = usuario.id_tipo_documento;
            this.fillusuarios.nombre_completo = usuario.nombre_completo;
            this.fillusuarios.telefono = usuario.telefono;
            this.fillusuarios.direccion = usuario.direccion;
            this.fillusuarios.email = usuario.email;
            this.fillusuarios.id_role = usuario.id_role;
            this.fillusuarios.id_estado = usuario.id_estado;
            this.fillusuarios.fotoMiniatura = usuario.foto;
            // this.fillusuarios.estado = usuario.estado;

            $("#edit").modal("show");
        },

        updateUsuarios(id) {
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
                .put("usuarios/" + id, {
                    id_tipo_documento: this.fillusuarios.id_tipo_documento,
                    numero_documento: this.fillusuarios.numero_documento,
                    nombre_completo: this.fillusuarios.nombre_completo,
                    telefono: this.fillusuarios.telefono,
                    direccion: this.fillusuarios.direccion,
                    email: this.fillusuarios.email,
                    id_role: this.fillusuarios.id_role,
                    id_estado: this.fillusuarios.id_estado
                    //foto: this.fillusuarios.fotoMiniatura,
                })
                .then(response => {
                    $("#buscar").click();
                    this.getUsuarios();
                    this.errors = [];

                    $("#edit").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }
                    this.$swal(
                        "Actualizado",
                        "usuario actualizado con éxito.",
                        "success"
                    );
                })
                .catch(error => {
                    this.errors = errors.response.data;
                });
        },

        createUsuarios() {
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
            let url = "usuarios";
            axios
                .post(url, {
                    id_tipo_documento: this.newid_tipo,
                    numero_documento: this.newnumero_documento,
                    nombre_completo: this.newnombre_completo,
                    telefono: this.newtelefono,
                    direccion: this.newdireccion,
                    email: this.newemail,
                    id_role: this.newrole,
                    password: this.newpassword,
                    id_estado: 1,
                    foto: this.fotoMiniatura
                })
                .then(response => {
                    $("#buscar").click();

                    console.log(response);
                    this.getUsuarios();

                    this.newid_tipo = "";
                    this.newnumero_documento = "";
                    this.newapellidos = "";
                    this.newnombre_completo = "";
                    this.newtelefono = "";
                    this.newbarrio = "";
                    this.newdireccion = "";
                    this.newemail = "";
                    this.newrole = "";
                    this.newpassword = "";
                    this.fotoMiniatura = "";

                    this.errors = [];
                    $("#create").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    this.$swal(
                        "Creado",
                        "usuario creado con éxito.",
                        "success"
                    );
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

        deleteUsuarios(usuario) {
            this.$swal({
                title: "Está seguro de Eliminar este Usuario?",
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
                    let url = "usuarios";
                    axios
                        .delete("usuarios/" + usuario.id)
                        .then(response => {
                            $("#buscar").click();
                            this.getUsuarios();
                            this.$swal(
                                "Eliminado!",
                                "El Usuario ha sido Eliminado con éxito.",
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
            this.getUsuarios(page, this.buscar, this.criterio);
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
