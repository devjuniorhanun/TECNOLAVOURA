<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<!-- Cadastros -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Cadastros</a>
    <ul class="nav-dropdown-items">
        @if(backpack_user()->hasRole('Admin'))
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Autenticação</a>
            <ul class="nav-dropdown-items">
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Usuários</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Perfis</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permições</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('cadastros/empresas') }}"><i class="nav-icon las la-house-damage"></i> <span>Empresa</span></a></li>
            </ul>
        </li>
        @endif
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Safras</a>
            <ul class="nav-dropdown-items">
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('cadastros/safra') }}"><i class="nav-icon la la-user"></i> <span>Safras</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('cadastros/cultura') }}"><i class="nav-icon la la-id-badge"></i> <span>Culturas</span></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('cadastros/variedade-cultura') }}"><i class="nav-icon la la-key"></i> <span>Variedades</span></a></li>
            </ul>
        </li>
        <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i>Propriedades</a>
            <ul class="nav-dropdown-items">
                <li class="nav-item"><a class="nav-link" href="{{ backpack_url('cadastros/proprietario') }}"><i class="nav-icon la la-user"></i> <span>Proprietario</span></a></li>
                
            </ul>
        </li>
    </ul>
</li><!-- Fim Cadastros -->
