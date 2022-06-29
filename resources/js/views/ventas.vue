<template>
    <div>
        <div class="content-wrapper">
            <div class="row">
                <div class=" col-md-12 ">
                    <div class="media align-items-center bg-white mb-20">
                        <span class="avatar  bg-primary"
                            ><i class="fa fa-fw fa-dollar"></i
                        ></span>
                        <div class="media-body">
                            <h3><strong>Ventas</strong></h3>
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
                                                <option value="id"
                                                    >Codigo</option
                                                >
                                                <option value="casillero"
                                                    >Casillero</option
                                                >
                                                <option value="gaveta"
                                                    >Gaveta</option
                                                >
                                                <option value="fecha"
                                                    >Fecha</option
                                                >
                                                <option value="id_cliente"
                                                    >Cliente</option
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
                                                    getVentas(buscar, criterio)
                                                "
                                                class="form-control"
                                                placeholder="Texto a buscar"
                                            />
                                            <button
                                                type="submit"
                                                @click="
                                                    getVentas(buscar, criterio)
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
                                                <th scope="col">Codigo</th>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Cliente</th>
                                                <th scope="col">
                                                    Laboratorio de Procedencia
                                                </th>
                                                <th scope="col">
                                                    Laboratorio Para Biselado
                                                </th>
                                                <th scope="col">Vendedor</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="venta in Ventas"
                                                v-bind:key="venta.id"
                                            >
                                                <td class="td-style">
                                                    {{ venta.id }}
                                                </td>
                                                <td class="td-style">
                                                    {{
                                                        moment(
                                                            venta.fecha
                                                        ).format("DD-MM-YYYY")
                                                    }}
                                                </td>
                                                <td class="td-style">
                                                    {{ venta.nombre_cliente }}
                                                </td>
                                                <td class="td-style">
                                                    {{
                                                        venta.nombre_laboratorio
                                                    }}
                                                </td>
                                                <td class="td-style">
                                                    {{
                                                        venta.nombre_laboratorio_bisel
                                                    }}
                                                </td>
                                                <td class="td-style">
                                                    {{ venta.nombre_vendedor }}
                                                </td>
                                                <td class="td-style">
                                                    {{ venta.nombre_estado }}
                                                </td>

                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-success btn-rounded"
                                                        data-toggle="modal tooltip"
                                                        data-placement="top"
                                                        title="Ver"
                                                        v-on:click.prevent="
                                                            verVentas(venta)
                                                        "
                                                    >
                                                        <i
                                                            class="fa fa-eye"
                                                        ></i>
                                                    </button>
                                                    &nbsp;
                                                    <button
                                                        type="button"
                                                        class="btn btn-warning btn-rounded"
                                                        data-toggle="modal tooltip"
                                                        data-placement="top"
                                                        title="Editar"
                                                        v-on:click.prevent="
                                                            editVentas(venta)
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
                                                            deleteVentas(venta)
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

        <form method="POST" v-on:submit.prevent="createVentas">
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
                            <h5 class="modal-title">Generar Nueva Venta</h5>
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
                                        <div class="col-md-6">
                                            <label for="id_cliente"
                                                >Cliente</label
                                            >

                                            <v-select
                                                label="nombre_completo"
                                                :options="arrayclientes"
                                                :reduce="
                                                    nombre_completo =>
                                                        nombre_completo.id
                                                "
                                                v-model="newid_cliente"
                                            ></v-select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="casillero"
                                                >Casillero</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-microchip"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="newcasillero"
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10"
                                                        >10</option
                                                    >
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="gaveta">Gaveta</label>
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-archive"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="newgaveta"
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10"
                                                        >10</option
                                                    >
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead class="bg-info">
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">ESF</th>
                                                        <th scope="col">CYL</th>
                                                        <th scope="col">EJE</th>
                                                        <th scope="col">ADD</th>
                                                        <th scope="col">DP</th>
                                                        <th scope="col">AF</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="td-style">
                                                            Ojo Derecho
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newod_esf
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newod_cyl
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newod_eje
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newod_add
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newod_dp
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newod_af
                                                                "
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="td-style">
                                                            Ojo Izquierdo
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newoi_esf
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newoi_cyl
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newoi_eje
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newoi_add
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newoi_dp
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    newoi_af
                                                                "
                                                            />
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <spinner v-show="loading"></spinner>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="medidas_especiales"
                                                >Medidas Especiales</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-arrows-h"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="medidas_especiales"
                                                    type="text"
                                                    v-model="
                                                        newmedidas_especiales
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="tipo_lente"
                                                >Tipo de Lente</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa  fa-circle-o"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="tipo_lente"
                                                    type="text"
                                                    v-model="newtipo_lente"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="Valor_lente"
                                                >Valor de Lente</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-dollar"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="valor_lente2"
                                                    type="number"
                                                    v-model="newvalor_lente"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="comision"
                                                >Comision</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-ticket"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="newcomision_lente"
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option value="1"
                                                        >Si</option
                                                    >
                                                    <option value="0"
                                                        >No</option
                                                    >
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="filtros_adicionales"
                                                >Filtros Adicionales</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-film"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="filtros_adicionales"
                                                    type="text"
                                                    v-model="
                                                        newfiltros_adicionales
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="id_laboratorio"
                                                >Laboratorio de
                                                Procedencia</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-hospital-o"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="newid_laboratorio"
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="laboratorio in arraylaboratorios"
                                                        :key="laboratorio.id"
                                                        :value="laboratorio.id"
                                                        >{{
                                                            laboratorio.nombre
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="id_laboratorio_bisel"
                                                >Laboratorio Para
                                                Biselado</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-hospital-o"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        newid_laboratorio_bisel
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="laboratorio in arraylaboratorios"
                                                        :key="laboratorio.id"
                                                        :value="laboratorio.id"
                                                        >{{
                                                            laboratorio.nombre
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="montura">Montura</label>
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-refresh"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="montura"
                                                    type="text"
                                                    v-model="newmontura"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="color">Color</label>
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-empire"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="color"
                                                    type="text"
                                                    v-model="newcolor"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="valor_montura"
                                                >Valor de Montura</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-dollar"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="valor_montura"
                                                    type="number"
                                                    v-model="newvalor_montura"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="comision_montura"
                                                >Comision</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-ticket"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        newcomision_montura
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option value="1"
                                                        >Si</option
                                                    >
                                                    <option value="0"
                                                        >No</option
                                                    >
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="id_vendedor"
                                                >Vendedor</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-user-md"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="newid_vendedor"
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="vendedor in arrayvendedores"
                                                        :key="vendedor.id"
                                                        :value="vendedor.id"
                                                        >{{
                                                            vendedor.nombre_completo
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="observaciones"
                                                >Observaciones</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-list-ul"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <textarea
                                                    class="form-control"
                                                    name="textarea"
                                                    rows="3"
                                                    v-model="newobservaciones"
                                                ></textarea>
                                            </div>
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

        <form method="POST" v-on:submit.prevent="updateVentas(fillventas.id)">
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
                            <h5 class="modal-title">Editar Venta</h5>
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
                                            <label for="id_estadoventa"
                                                >Estado de la Venta</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-reply-all"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.id_estado
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="estado in arrayestados"
                                                        :key="estado.id"
                                                        :value="estado.id"
                                                        >{{
                                                            estado.nombre
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="fecha">Fecha</label>
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
                                                    id="fecha2"
                                                    type="date"
                                                    class="form-control"
                                                    v-model="fillventas.fecha"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="id_cliente"
                                                >Cliente</label
                                            >

                                            <v-select
                                                label="nombre_completo"
                                                :options="arrayclientes"
                                                :reduce="
                                                    nombre_completo =>
                                                        nombre_completo.id
                                                "
                                                v-model="fillventas.id_cliente"
                                            ></v-select>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-2">
                                            <label for="casillero"
                                                >Casillero</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class=" fa fa-microchip"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.casillero
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10"
                                                        >10</option
                                                    >
                                                </select>
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="col-md-2">
                                            <label for="gaveta">Gaveta</label>
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-archive"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="fillventas.gaveta"
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10"
                                                        >10</option
                                                    >
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead class="bg-info">
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">ESF</th>
                                                        <th scope="col">CYL</th>
                                                        <th scope="col">EJE</th>
                                                        <th scope="col">ADD</th>
                                                        <th scope="col">DP</th>
                                                        <th scope="col">AF</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="td-style">
                                                            Ojo Derecho
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.od_esf
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.od_cyl
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.od_eje
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.od_add
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.od_dp
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.od_af
                                                                "
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="td-style">
                                                            Ojo Izquierdo
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.oi_esf
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.oi_cyl
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.oi_eje
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.oi_add
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.oi_dp
                                                                "
                                                            />
                                                        </td>
                                                        <td class="td-style">
                                                            <input
                                                                type="text"
                                                                class="validate"
                                                                v-model="
                                                                    fillventas.oi_af
                                                                "
                                                            />
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <spinner v-show="loading"></spinner>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="medidas_especiales"
                                                >Medidas Especiales</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-arrows-h"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="medidas_especiales2"
                                                    type="text"
                                                    v-model="
                                                        fillventas.medidas_especiales
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <label for="tipo_lente"
                                                >Tipo de Lente</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa  fa-circle-o"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="tipo_lente2"
                                                    type="text"
                                                    v-model="
                                                        fillventas.tipo_lente
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="Valor_lente"
                                                >Valor de Lente</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-dollar"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="valor_lente"
                                                    type="text"
                                                    v-model="
                                                        fillventas.valor_lente
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="comision"
                                                >Comision</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-ticket"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.comision_lente
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option value="1"
                                                        >Si</option
                                                    >
                                                    <option value="0"
                                                        >No</option
                                                    >
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="filtros_adicionales"
                                                >Filtros Adicionales</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-film"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="filtros_adicionales2"
                                                    type="text"
                                                    v-model="
                                                        fillventas.filtros_adicionales
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="id_laboratorio"
                                                >Laboratorio de
                                                Procedencia</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-hospital-o"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.id_laboratorio
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="laboratorio in arraylaboratorios"
                                                        :key="laboratorio.id"
                                                        :value="laboratorio.id"
                                                        >{{
                                                            laboratorio.nombre
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="id_laboratorio_bisel"
                                                >Laboratorio Para
                                                Biselado</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-hospital-o"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.id_laboratorio_bisel
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="laboratorio in arraylaboratorios"
                                                        :key="laboratorio.id"
                                                        :value="laboratorio.id"
                                                        >{{
                                                            laboratorio.nombre
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="montura">Montura</label>
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-refresh"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="montura2"
                                                    type="text"
                                                    v-model="fillventas.montura"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="color">Color</label>
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-empire"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="color2"
                                                    type="text"
                                                    v-model="fillventas.color"
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="valor_montura"
                                                >Valor de Montura</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-dollar"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <input
                                                    class="form-control"
                                                    id="valor_montura2"
                                                    type="text"
                                                    v-model="
                                                        fillventas.valor_montura
                                                    "
                                                />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="comision_montura"
                                                >Comision</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-ticket"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.comision_montura
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option value="1"
                                                        >Si</option
                                                    >
                                                    <option value="0"
                                                        >No</option
                                                    >
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="id_vendedor"
                                                >Vendedor</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-user-md"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.id_vendedor
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="vendedor in arrayvendedores"
                                                        :key="vendedor.id"
                                                        :value="vendedor.id"
                                                        >{{
                                                            vendedor.nombre_completo
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="observaciones"
                                                >Observaciones</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-list-ul"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <textarea
                                                    class="form-control"
                                                    name="textarea"
                                                    rows="3"
                                                    v-model="
                                                        fillventas.observaciones
                                                    "
                                                ></textarea>
                                            </div>
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
        </form>

        <!-- VER VENTAS MODAL -->
        <form method="POST" v-on:submit.prevent="updateVentas(fillventas.id)">
            <!-- Modal -->
            <div
                class="modal fade bs-example-modal-lg"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myLargeModalLabel"
                aria-hidden="true"
                style="display: none;"
                id="ver"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title">
                                Codigo de Venta N° {{ this.fillventas.id }}
                            </h5>
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
                                            <label
                                                id="label_ver"
                                                for="documento"
                                                >Fecha:</label
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
                                                    <span
                                                        class="input-group-text"
                                                        >{{
                                                            this.fillventas
                                                                .fecha
                                                        }}</span
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label
                                                id="label_ver"
                                                for="id_cliente"
                                                >Cliente</label
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
                                                        fillventas.id_cliente
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="cliente in arrayclientes"
                                                        :key="cliente.id"
                                                        :value="cliente.id"
                                                        >{{
                                                            cliente.nombre_completo
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-md-2">
                                            <label
                                                id="label_ver"
                                                for="casillero"
                                                >Casillero:</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-microchip"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <span
                                                    class="input-group-text"
                                                    >{{
                                                        this.fillventas
                                                            .casillero
                                                    }}</span
                                                >
                                            </div>
                                            <!-- /.input group -->
                                        </div>

                                        <div class="col-md-2">
                                            <label id="label_ver" for="gaveta"
                                                >Gaveta:</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-archive"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <span
                                                    class="input-group-text"
                                                    >{{
                                                        this.fillventas.gaveta
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead class="bg-info">
                                                    <tr>
                                                        <th scope="col"></th>
                                                        <th scope="col">ESF</th>
                                                        <th scope="col">CYL</th>
                                                        <th scope="col">EJE</th>
                                                        <th scope="col">ADD</th>
                                                        <th scope="col">DP</th>
                                                        <th scope="col">AF</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td
                                                            id="label_ver"
                                                            class="td-style"
                                                        >
                                                            Ojo Derecho
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .od_esf
                                                                }}</span
                                                            >
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .od_cyl
                                                                }}</span
                                                            >
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .od_eje
                                                                }}</span
                                                            >
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .od_add
                                                                }}</span
                                                            >
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .od_dp
                                                                }}</span
                                                            >
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .od_af
                                                                }}</span
                                                            >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            id="label_ver"
                                                            class="td-style"
                                                        >
                                                            Ojo Izquierdo
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .oi_esf
                                                                }}</span
                                                            >
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .oi_cyl
                                                                }}</span
                                                            >
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .oi_eje
                                                                }}</span
                                                            >
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .oi_add
                                                                }}</span
                                                            >
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .oi_dp
                                                                }}</span
                                                            >
                                                        </td>
                                                        <td class="td-style">
                                                            <span
                                                                class="input-group-text"
                                                                >{{
                                                                    this
                                                                        .fillventas
                                                                        .oi_af
                                                                }}</span
                                                            >
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <spinner v-show="loading"></spinner>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label
                                                id="label_ver"
                                                for="medidas_especiales"
                                                >Medidas Especiales</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-arrows-h"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <span
                                                    class="input-group-text form-control"
                                                    >{{
                                                        this.fillventas
                                                            .medidas_especiales
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <label
                                                id="label_ver"
                                                for="tipo_lente"
                                                >Tipo de Lente</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa  fa-circle-o"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <span
                                                    class="input-group-text form-control"
                                                    >{{
                                                        this.fillventas
                                                            .tipo_lente
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label
                                                id="label_ver"
                                                for="Valor_lente"
                                                >Valor de Lente</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-dollar"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <span
                                                    class="input-group-text form-control"
                                                    >{{
                                                        this.fillventas
                                                            .valor_lente
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label id="label_ver" for="comision"
                                                >Comision</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-ticket"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.comision_lente
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option value="1"
                                                        >Si</option
                                                    >
                                                    <option value="0"
                                                        >No</option
                                                    >
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label
                                                id="label_ver"
                                                for="filtros_adicionales"
                                                >Filtros Adicionales</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-film"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <span
                                                    class="input-group-text form-control"
                                                    >{{
                                                        this.fillventas
                                                            .filtros_adicionales
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label
                                                id="label_ver"
                                                for="id_laboratorio"
                                                >Laboratorio de
                                                Procedencia</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-hospital-o"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.id_laboratorio
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="laboratorio in arraylaboratorios"
                                                        :key="laboratorio.id"
                                                        :value="laboratorio.id"
                                                        >{{
                                                            laboratorio.nombre
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label
                                                id="label_ver"
                                                for="id_laboratorio3dd"
                                                >Laboratorio Para
                                                Biselado</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-hospital-o"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.id_laboratorio_bisel
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="laboratorio in arraylaboratorios"
                                                        :key="laboratorio.id"
                                                        :value="laboratorio.id"
                                                        >{{
                                                            laboratorio.nombre
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label id="label_ver" for="montura"
                                                >Montura</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-refresh"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <span
                                                    class="input-group-text form-control"
                                                    >{{
                                                        this.fillventas.montura
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label id="label_ver" for="color"
                                                >Color</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-empire"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <span
                                                    class="input-group-text form-control"
                                                    >{{
                                                        this.fillventas.color
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label
                                                id="label_ver"
                                                for="valor_montura"
                                                >Valor de Montura</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-dollar"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <span
                                                    class="input-group-text form-control"
                                                    >{{
                                                        this.fillventas
                                                            .valor_montura
                                                    }}</span
                                                >
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label
                                                id="label_ver"
                                                for="comision_montura"
                                                >Comision</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-ticket"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.comision_montura
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option value="1"
                                                        >Si</option
                                                    >
                                                    <option value="0"
                                                        >No</option
                                                    >
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label
                                                id="label_ver"
                                                for="id_vendedor"
                                                >Vendedor</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-user-md"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    v-model="
                                                        fillventas.id_vendedor
                                                    "
                                                >
                                                    <option value="0" disabled
                                                        >Seleccione</option
                                                    >
                                                    <option
                                                        v-for="vendedor in arrayvendedores"
                                                        :key="vendedor.id"
                                                        :value="vendedor.id"
                                                        >{{
                                                            vendedor.nombre_completo
                                                        }}</option
                                                    >
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label
                                                id="label_ver"
                                                for="observaciones"
                                                >Observaciones</label
                                            >
                                            <div class="input-group">
                                                <div
                                                    class="input-group-prepend"
                                                >
                                                    <span
                                                        class="input-group-text"
                                                        ><i
                                                            class="fa fa-fw fa-list-ul"
                                                        ></i
                                                    ></span>
                                                </div>
                                                <textarea
                                                    class="form-control"
                                                    name="textarea"
                                                    rows="3"
                                                    v-model="
                                                        fillventas.observaciones
                                                    "
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer modal-footer-uniform">
                            <button
                                type="button"
                                class="btn btn-bold btn-pure btn-success float-right btn-rounded"
                                data-dismiss="modal"
                            >
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
$(document).ready(function() {
    $(".my-select").selectpicker();
});

export default {
    created: function() {
        this.getVentas("", "id");
        this.select_tipo_documento();
        this.select_cliente();
        this.select_vendedor();
        this.select_laboratorio();
        this.select_role();
        this.select_estados();
    },

    data() {
        return {
            Ventas: [],
            pagination: {
                total: 0,
                current_page: 0,
                per_page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
            criterio: "id",
            buscar: "",
            arrayclientes: [],
            arraylaboratorios: [],
            arrayvendedores: [],
            arrayestados: [],
            loading: true,

            newfecha: "",
            newid_cliente: "",
            newcasillero: "",
            newgaveta: "",
            newod_esf: "",
            newod_cyl: "",
            newod_eje: "",
            newod_add: "",
            newod_dp: "",
            newod_af: "",
            newoi_esf: "",
            newoi_cyl: "",
            newoi_eje: "",
            newoi_add: "",
            newoi_dp: "",
            newoi_af: "",
            newmedidas_especiales: "",
            newtipo_lente: "",
            newvalor_lente: "",
            newcomision_lente: "",
            newfiltros_adicionales: "",
            newid_laboratorio: "",
            newid_laboratorio_bisel: "",
            newmontura: "",
            newcolor: "",
            newvalor_montura: "",
            newcomision_montura: "",
            newid_vendedor: "",
            newid_estado: "",
            newid_estado_venta: "",
            newobservaciones: "",
            errors: [],
            fillventas: {
                id: "",
                fecha: "",
                id_cliente: "",
                casillero: "",
                gaveta: "",
                od_esf: "",
                od_cyl: "",
                od_eje: "",
                od_add: "",
                od_dp: "",
                od_af: "",
                oi_esf: "",
                oi_cyl: "",
                oi_eje: "",
                oi_add: "",
                oi_dp: "",
                oi_af: "",
                medidas_especiales: "",
                tipo_lente: "",
                valor_lente: "",
                comision_lente: "",
                filtros_adicionales: "",
                id_laboratorio: "",
                id_laboratorio_bisel: "",
                montura: "",
                color: "",
                valor_montura: "",
                comision_montura: "",
                id_vendedor: "",
                id_estado: "",
                id_estado_venta: "",
                observaciones: ""
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

        select_cliente() {
            let me = this;
            let url = "select_cliente";
            axios
                .get(url)
                .then(function(response) {
                    me.arrayclientes = response.data.clientes;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        select_vendedor() {
            let me = this;
            let url = "select_vendedor";
            axios
                .get(url)
                .then(function(response) {
                    me.arrayvendedores = response.data.vendedores;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        select_laboratorio() {
            let me = this;
            let url = "select_laboratorio";
            axios
                .get(url)
                .then(function(response) {
                    me.arraylaboratorios = response.data.laboratorios;
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

        select_estados() {
            let me = this;
            let url = "select_estado";
            axios
                .get(url)
                .then(function(response) {
                    me.arrayestados = response.data.estados;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        getVentas(buscar, criterio) {
            let me = this;
            var url = "/ventas?&buscar=" + buscar + "&criterio=" + criterio;

            axios
                .get(url)
                .then(function(response) {
                    (me.Ventas = response.data.ventas.data),
                        (me.pagination = response.data.pagination);
                    me.loading = false;
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                });
        },

        editVentas(venta) {
            this.fillventas.id = venta.id;
            this.fillventas.fecha = venta.fecha;
            this.fillventas.id_cliente = venta.id_cliente;
            this.fillventas.casillero = venta.casillero;
            this.fillventas.gaveta = venta.gaveta;
            this.fillventas.od_esf = venta.od_esf;
            this.fillventas.od_cyl = venta.od_cyl;
            this.fillventas.od_eje = venta.od_eje;
            this.fillventas.od_add = venta.od_add;
            this.fillventas.od_dp = venta.od_dp;
            this.fillventas.od_af = venta.od_af;
            this.fillventas.oi_esf = venta.oi_esf;
            this.fillventas.oi_cyl = venta.oi_cyl;
            this.fillventas.oi_eje = venta.oi_eje;
            this.fillventas.oi_add = venta.oi_add;
            this.fillventas.oi_dp = venta.oi_dp;
            this.fillventas.oi_af = venta.oi_af;
            this.fillventas.medidas_especiales = venta.medidas_especiales;
            this.fillventas.tipo_lente = venta.tipo_lente;
            this.fillventas.valor_lente = venta.valor_lente;
            this.fillventas.comision_lente = venta.comision_lente;
            this.fillventas.filtros_adicionales = venta.filtros_adicionales;
            this.fillventas.id_laboratorio = venta.id_laboratorio;
            this.fillventas.id_laboratorio_bisel = venta.id_laboratorio_bisel;
            this.fillventas.montura = venta.montura;
            this.fillventas.color = venta.color;
            this.fillventas.valor_montura = venta.valor_montura;
            this.fillventas.comision_montura = venta.comision_montura;
            this.fillventas.id_vendedor = venta.id_vendedor;
            this.fillventas.id_estado = venta.id_estado;
            this.fillventas.id_estado_venta = venta.id_estado_venta;
            this.fillventas.observaciones = venta.observaciones;
            $("#edit").modal("show");
        },

        verVentas(venta) {
            this.fillventas.id = venta.id;
            this.fillventas.fecha = venta.fecha;
            this.fillventas.id_cliente = venta.id_cliente;
            this.fillventas.casillero = venta.casillero;
            this.fillventas.gaveta = venta.gaveta;
            this.fillventas.od_esf = venta.od_esf;
            this.fillventas.od_cyl = venta.od_cyl;
            this.fillventas.od_eje = venta.od_eje;
            this.fillventas.od_add = venta.od_add;
            this.fillventas.od_dp = venta.od_dp;
            this.fillventas.od_af = venta.od_af;
            this.fillventas.oi_esf = venta.oi_esf;
            this.fillventas.oi_cyl = venta.oi_cyl;
            this.fillventas.oi_eje = venta.oi_eje;
            this.fillventas.oi_add = venta.oi_add;
            this.fillventas.oi_dp = venta.oi_dp;
            this.fillventas.oi_af = venta.oi_af;
            this.fillventas.medidas_especiales = venta.medidas_especiales;
            this.fillventas.tipo_lente = venta.tipo_lente;
            this.fillventas.valor_lente = venta.valor_lente;
            this.fillventas.comision_lente = venta.comision_lente;
            this.fillventas.filtros_adicionales = venta.filtros_adicionales;
            this.fillventas.id_laboratorio = venta.id_laboratorio;
            this.fillventas.id_laboratorio_bisel = venta.id_laboratorio_bisel;
            this.fillventas.montura = venta.montura;
            this.fillventas.color = venta.color;
            this.fillventas.valor_montura = venta.valor_montura;
            this.fillventas.comision_montura = venta.comision_montura;
            this.fillventas.id_vendedor = venta.id_vendedor;
            this.fillventas.id_estado = venta.id_estado;
            this.fillventas.id_estado_venta = venta.id_estado_venta;
            this.fillventas.observaciones = venta.observaciones;
            $("#ver").modal("show");
        },

        updateVentas(id) {
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
                .put("ventas/" + id, {
                    fecha: this.fillventas.fecha,
                    id_cliente: this.fillventas.id_cliente,
                    casillero: this.fillventas.casillero,
                    gaveta: this.fillventas.gaveta,
                    od_esf: this.fillventas.od_esf,
                    od_cyl: this.fillventas.od_cyl,
                    od_eje: this.fillventas.od_eje,
                    od_add: this.fillventas.od_add,
                    od_dp: this.fillventas.od_dp,
                    od_af: this.fillventas.od_af,
                    oi_esf: this.fillventas.oi_esf,
                    oi_cyl: this.fillventas.oi_cyl,
                    oi_eje: this.fillventas.oi_eje,
                    oi_add: this.fillventas.oi_add,
                    oi_dp: this.fillventas.oi_dp,
                    oi_af: this.fillventas.oi_af,
                    medidas_especiales: this.fillventas.medidas_especiales,
                    tipo_lente: this.fillventas.tipo_lente,
                    valor_lente: this.fillventas.valor_lente,
                    comision_lente: this.fillventas.comision_lente,
                    filtros_adicionales: this.fillventas.filtros_adicionales,
                    id_laboratorio: this.fillventas.id_laboratorio,
                    id_laboratorio_bisel: this.fillventas.id_laboratorio_bisel,
                    montura: this.fillventas.montura,
                    color: this.fillventas.color,
                    valor_montura: this.fillventas.valor_montura,
                    comision_montura: this.fillventas.comision_montura,
                    id_vendedor: this.fillventas.id_vendedor,
                    id_estado: this.fillventas.id_estado,
                    id_estado_venta: this.fillventas.id_estado_venta,
                    observaciones: this.fillventas.observaciones
                })
                .then(response => {
                    this.getVentas("", "id");
                    this.errors = [];

                    $("#edit").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }
                    this.$swal(
                        "Actualizado",
                        "Venta actualizada con éxito.",
                        "success"
                    );
                })
                .catch(error => {
                    this.errors = errors.response.data;
                });
        },

        createVentas() {
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
            let url = "ventas";
            axios
                .post(url, {
                    fecha: this.newfecha,
                    id_cliente: this.newid_cliente,
                    casillero: this.newcasillero,
                    gaveta: this.newgaveta,
                    od_esf: this.newod_esf,
                    od_cyl: this.newod_cyl,
                    od_eje: this.newod_eje,
                    od_add: this.newod_add,
                    od_dp: this.newod_dp,
                    od_af: this.newod_af,
                    oi_esf: this.newoi_esf,
                    oi_cyl: this.newoi_cyl,
                    oi_eje: this.newoi_eje,
                    oi_add: this.newoi_add,
                    oi_dp: this.newoi_dp,
                    oi_af: this.newoi_af,
                    medidas_especiales: this.newmedidas_especiales,
                    tipo_lente: this.newtipo_lente,
                    valor_lente: this.newvalor_lente,
                    comision_lente: this.newcomision_lente,
                    filtros_adicionales: this.newfiltros_adicionales,
                    id_laboratorio: this.newid_laboratorio,
                    id_laboratorio_bisel: this.newid_laboratorio_bisel,
                    montura: this.newmontura,
                    color: this.newcolor,
                    valor_montura: this.newvalor_montura,
                    comision_montura: this.newcomision_montura,
                    id_vendedor: this.newid_vendedor,
                    id_estado: this.newid_estado,
                    id_estado_venta: this.newid_estado_venta,
                    observaciones: this.newobservaciones,
                    id_estado: 1,
                    id_estado_venta: 1
                })
                .then(response => {
                    console.log(response);
                    this.getVentas("", "id");
                    this.newfecha = "";
                    this.newid_cliente = "";
                    this.newcasillero = "";
                    this.newgaveta = "";
                    this.newod_esf = "";
                    this.newod_cyl = "";
                    this.newod_eje = "";
                    this.newod_add = "";
                    this.newod_dp = "";
                    this.newod_af = "";
                    this.newoi_esf = "";
                    this.newoi_cyl = "";
                    this.newoi_eje = "";
                    this.newoi_add = "";
                    this.newoi_dp = "";
                    this.newoi_af = "";
                    this.newmedidas_especiales = "";
                    this.newtipo_lente = "";
                    this.newvalor_lente = "";
                    this.newcomision_lente = "";
                    this.newfiltros_adicionales = "";
                    this.newid_laboratorio = "";
                    this.newid_laboratorio_bisel = "";
                    this.newmontura = "";
                    this.newcolor = "";
                    this.newvalor_montura = "";
                    this.newcomision_montura = "";
                    this.newid_vendedor = "";
                    this.newid_estado = "";
                    this.newid_estado_venta = "";
                    this.newobservaciones = "";

                    this.errors = [];
                    $("#create").modal("hide");
                    if ($(".modal-backdrop").is(":visible")) {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                    }

                    this.$swal("Creado", "Venta creada con éxito.", "success");
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

        deleteVentas(venta) {
            this.$swal({
                title: "Está seguro de Eliminar esta Venta?",
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
                    let url = "ventas";
                    axios
                        .delete("ventas/" + venta.id)
                        .then(response => {
                            this.getVentas("", "id");
                            this.$swal(
                                "Eliminado!",
                                "La Venta ha sido Eliminado con éxito.",
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
            this.getVentas(page, this.buscar, this.criterio);
        }
    }
};
$(document).ready(function() {
    $("select").selectpicker();
});
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

.parpadea {
    animation-name: parpadeo;
    animation-duration: 1s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;

    -webkit-animation-name: parpadeo;
    -webkit-animation-duration: 1s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

@-webkit-keyframes parpadeo {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

@keyframes parpadeo {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
#label_ver {
    font-weight: bold;
    font-size: 14px;
    color: black;
}
</style>
