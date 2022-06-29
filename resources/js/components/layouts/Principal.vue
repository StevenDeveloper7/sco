<template>
    <div>
        <header class="main-header ">
            <!-- Logo -->
            <a href="index.html" class="logo bg-info-gradient-animet">
                <!-- mini logo -->
                <b class="logo-mini">
                    <span class="light-logo"
                        ><img src="images/logo-mini.png" alt="logo"
                    /></span>
                    <span class="dark-logo"
                        ><img src="images/logo-mini.png" alt="logo"
                    /></span>
                </b>
                <!-- logo-->
                <span class="logo-lg">
                    <img
                        src="images/logo-nombre.png"
                        alt="logo"
                        class="light-logo"
                    />
                    <img
                        src="images/logo-nombre.png"
                        alt="logo"
                        class="dark-logo"
                    />
                </span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top bg-info-gradient-animet">
                <!-- Sidebar toggle button-->
                <a
                    href="#"
                    class="sidebar-toggle"
                    data-toggle="push-menu"
                    role="button"
                >
                    <span class="sr-only">Barra de navegacion</span>
                </a>

                <div class="navbar-custom-menu ">
                    <ul class="nav navbar-nav">
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"
                                ><i class="fa fa-cog fa-spin"></i
                            ></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar bg-pale-secondary ">
            <!-- sidebar-->
            <section class="sidebar ">
                <!-- sidebar menu-->
                <ul class="sidebar-menu " data-widget="tree">
                    <li class="user-profile treeview">
                        <a href="#">
                            <img src="images/user5-128x128.jpg" alt="user" />
                            <span>Steven Manyoma</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="javascript:void()"
                                    ><i class="fa fa-cog mr-5"></i>Configuracion
                                    de cuenta</a
                                >
                            </li>
                            <li>
                                <a href="javascript:void()"
                                    ><i class="fa fa-power-off mr-5"></i>Cerrar
                                    Sesion</a
                                >
                            </li>
                        </ul>
                    </li>
                    <li class="header nav-small-cap ">Modulos</li>
                    <li class="li_hover_menu">
                        <router-link :to="{ name: 'dashboard' }">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>
                    <li class="li_hover_menu">
                        <router-link :to="{ name: 'clientes' }">
                            <i class="fa fa-users"></i>
                            <span>Clientes</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>
                    <li class="li_hover_menu">
                        <router-link :to="{ name: 'categoria_productos' }">
                            <i class="fa fa-users"></i>
                            <span>Cat. Productos</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>
                    <li class="li_hover_menu">
                        <router-link :to="{ name: 'laboratorios' }">
                            <i class="glyphicon glyphicon-sunglasses"></i>
                            <span>Laboratorios</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>
                    <li class="li_hover_menu">
                        <router-link :to="{ name: 'ventas' }">
                            <i class="fa fa-fw fa-dollar"></i>
                            <span>Ventas</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>
                    <li class="li_hover_menu">
                        <router-link :to="{ name: 'usuarios' }">
                            <i class="fa fa-users"></i>
                            <span>Usuarios</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>
                    <li class="li_hover_menu">
                        <router-link :to="{ name: 'comisiones' }">
                            <i class="fa fa-money"></i>
                            <span>Comisiones</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>
                    <li class="li_hover_menu">
                        <router-link :to="{ name: 'reportes' }">
                            <i class="fa fa-table"></i>
                            <span>Reportes</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li>
                    <!-- <li class="li_hover_menu">
                        <router-link :to="{ name: 'configuracion' }">
                            <i class="fa fa-cog"></i>
                            <span>Configuración</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </router-link>
                    </li> -->
                </ul>
            </section>
        </aside>

        <router-view></router-view>
    </div>
</template>

<style>
.li_hover_menu:hover {
    background-color: #1e9ff2;
    border: 2px solid #1e9ff2;
    border-radius: 10px;
}

.li_hover_menu span:hover {
    color: white;
}
</style>
