<aside class="main-sidebar hidden-print ">
    <section class="sidebar" id="sidebar-scroll">

        <div class="user-panel">
            <div class="f-left image"><img src="/images/avatar-1.png" alt="User Image" class="img-circle">
            </div>
            <div class="f-left info">
                <p>{{Auth::user()->usuario}}</p>
                <p class="designation">Administrador</i></p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="nav-level">Navigation</li>
            <li class="treeview">
                <a class="waves-effect waves-dark" @click="menu=0">
                    <i class="icon-paypal"></i><span> Donaciones</span>
                </a>
            </li>
            <li class="treeview">
                <a class="waves-effect waves-dark" @click="menu=1">
                    <i class="icon-list"></i><span> Niveles</span>
                </a>
            </li>
            <li class="treeview">
                <a class="waves-effect waves-dark" @click="menu=2">
                    <i class="icon-people"></i><span> Responsables</span>
                </a>
            </li>
            <li class="treeview">
                <a class="waves-effect waves-dark" @click="menu=3">
                    <i class="icon-graduation"></i><span> Alumnos</span>
                </a>
            </li>
            <!-- <li class="treeview">
                <a class="waves-effect waves-dark" @click="menu=4">
                    <i class="icon-chemistry"></i><span> Morbilidades</span>
                </a>
            </li> -->
            <li class="treeview"><a class="waves-effect waves-dark"><i
                        class="icofont icofont-wallet"></i><span>Gastos</span><i class="icon-arrow-down"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a class="waves-effect waves-dark" @click="menu=5">
                            <i class="icon-arrow-right"></i>
                            Gastos
                        </a>
                    </li>
                    <li>
                        <a class="waves-effect waves-dark" @click="menu=6">
                            <i class="icon-arrow-right"></i>
                            Nuevo Gasto
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a class="waves-effect waves-dark" @click="menu=7">
                    <i class="icon-docs"></i><span> Actualizar Datos</span>
                </a>
            </li>
            <li class="treeview">
                <a class="waves-effect waves-dark" @click="menu=8">
                    <i class="icon-heart"></i><span> Diagnostico</span>
                </a>
            </li>
            <li class="treeview">
                <a class="waves-effect waves-dark" @click="menu=9">
                    <i class="icon-doc"></i><span> Reportes</span>
                </a>
            </li>
    </section>
</aside>