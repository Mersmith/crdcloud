 <!--MENU-->
 @php
     $json_menu = file_get_contents('menuEncargado.json');
     $menuPrincipal = collect(json_decode($json_menu, true));
 @endphp
 <!--MENU-PRINCIPAL-->
 <div class="menu_principal" x-on:click.away="seleccionado = null">
     @foreach ($menuPrincipal as $key => $menu)
         <!--ELEMENTOS MENU PRINCIPAL-->
         <div x-data="subMenu1" class="elementos_menu_principal">

             <!--MENU ÍCONO-->
             <div x-on:click="seleccionar({{ $key }})" class="menu_icono">
                 @if (count($menu['subMenu1']))
                     <a class="menu_nombre"><i
                             class="{{ $menu['iconoPrincipal'] }}"></i>{{ $menu['nombrePrincipal'] }}</a>
                     <i class="fa-solid fa-sort-down abajo_menu"></i>
                 @else
                     <a class="menu_nombre" href="{{ route($menu['nombrePrincipalUrl']) }}"><i
                             class="{{ $menu['iconoPrincipal'] }}"></i>{{ $menu['nombrePrincipal'] }}</a>
                 @endif
             </div>

             <!--SubMenu1-->
             <div :style="seleccionado == {{ $key }} && { display: 'block' }" x-transition class="submenu_1"
                 x-on:click.away="seleccionadoSubMenu1 = null">
                 @if (count($menu['subMenu1']))
                     @foreach ($menu['subMenu1'] as $keySub1 => $subMenu1)
                         <div x-data="subMenu2" class="elementos_submenu_1">

                             <!--SubMenu1 Nombres-->
                             <div x-on:click="seleccionarSubMenu1({{ $keySub1 }})"
                                 class="menu_icono menu_icono_submenu">
                                 @if (count($subMenu1['subMenu2']))
                                     <a class="submenu_nombre"><i
                                             class="{{ $subMenu1['iconoSubMenu1'] }}"></i>{{ $subMenu1['nombreSubMenu1'] }}</a>
                                     <i class="fa-solid fa-sort-down abajo_menu"></i>
                                 @else
                                     <a class="submenu_nombre" href="{{ route($subMenu1['nombreSubMenu1Url']) }}"><i
                                             class="{{ $subMenu1['iconoSubMenu1'] }}"></i>{{ $subMenu1['nombreSubMenu1'] }}</a>
                                 @endif
                             </div>

                             <!--SubMenu2-->
                             <div :style="seleccionadoSubMenu1 == {{ $keySub1 }} && { display: 'block' }"
                                 x-transition x-on:click.away="seleccionadoSubMenu2 = null" class="submenu_2">
                                 @if (count($subMenu1['subMenu2']))
                                     @foreach ($subMenu1['subMenu2'] as $keySub2 => $subMenu2)
                                         <div x-data="subMenu3" class="elementos_submenu_2">

                                             <!--SubMenu2 Nombres-->
                                             <div x-on:click="seleccionarSubMenu2({{ $keySub2 }})"
                                                 class="menu_icono menu_icono_submenu">

                                                 @if (count($subMenu2['subMenu3']))
                                                     <a class="submenu_nombre"><i
                                                             class="{{ $menu['iconoPrincipal'] }}"></i>{{ $subMenu2['nombreSubMenu2'] }}</a>
                                                     <i class="fa-solid fa-sort-down abajo_menu"></i>
                                                 @else
                                                     <a class="submenu_nombre"
                                                         href="{{ route($subMenu2['nombreSubMenu2Url']) }}"><i
                                                             class="{{ $subMenu2['iconoSubMenu2'] }}"></i>{{ $subMenu2['nombreSubMenu2'] }}</a>
                                                 @endif
                                             </div>

                                             <!--SubMenu3-->
                                             <div :style="seleccionadoSubMenu2 == {{ $keySub2 }} && { display: 'block' }"
                                                 x-on:click.away="seleccionadoSubMenu3 = null" x-transition
                                                 class="submenu_3">
                                                 @if (count($subMenu2['subMenu3']))
                                                     @foreach ($subMenu2['subMenu3'] as $keySub3 => $subMenu3)
                                                         <div x-data="subMenu4" class="elementos_submenu_3">

                                                             <!--SubMenu3 Nombres-->
                                                             <div x-on:click="seleccionarSubMenu3({{ $keySub3 }})"
                                                                 class="menu_icono menu_icono_submenu">

                                                                 <a class="submenu_nombre"
                                                                     href="{{ route($subMenu3['nombreSubMenu3Url']) }}"><i
                                                                         class="{{ $subMenu3['iconoSubMenu2'] }}"></i>{{ $subMenu3['nombreSubMenu3'] }}</a>
                                                             </div>
                                                         </div>
                                                     @endforeach
                                                 @endif
                                             </div>
                                         </div>
                                     @endforeach
                                 @endif
                             </div>
                         </div>
                     @endforeach
                 @endif
             </div>
         </div>
     @endforeach
 </div>
