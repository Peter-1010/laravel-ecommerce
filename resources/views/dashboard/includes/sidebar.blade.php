<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{route('admin.dashboard')}}"><i class="la la-x"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/edit.main')}} </span></a>
            </li>

            <li class="nav-item  open ">
                <a href=""><i class="la la-language"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.languages')}}</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                </a>
                <ul>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-database"></i>
                    <span class="menu-title"
                          data-i18n="nav.dash.main">{{__('admin/categories.main categories')}}  </span><span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{ \App\Models\Category::parent()->count() }}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.maincategories')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.view all')}} </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.maincategories.create')}}"
                           data-i18n="nav.dash.crypto">{{__('admin/sidebar.create new category')}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-table"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/categories.subcategories')}}</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{ \App\Models\Category::child()->count() }}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.subcategories')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/sidebar.view all')}} </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.subcategories.create')}}"
                           data-i18n="nav.dash.crypto">{{__('admin/sidebar.create new subcategory')}}</a>

                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-tag"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.brands')}}</span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{ \App\Models\Brand::count() }}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.brands')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.view all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.brands.create')}}"
                           data-i18n="nav.dash.crypto">{{__('admin/sidebar.add new brand')}}</a>
                    </li>
                </ul>
            </li>

            @can('tags')
            <li class="nav-item"><a href=""><i class="la la-tags"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.tags')}}</span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{ \App\Models\Tag::count() }}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.tags')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.view all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.tags.create')}}"
                           data-i18n="nav.dash.crypto">{{__('admin/sidebar.add new tag')}}</a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('products')
            <li class="nav-item"><a href=""><i class="la la-shopping-cart"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.products')}}</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{\App\Models\Product::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.products')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.view all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.products.create')}}"
                           data-i18n="nav.dash.crypto">{{__('admin/sidebar.add new product')}}</a>
                    </li>
                </ul>
            </li>
            @endcan


            <li class="nav-item"><a href=""><i class="la la-database"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.product attributes')}}</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{\App\Models\Attribute::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.attributes')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.view all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.attributes.create')}}"
                           data-i18n="nav.dash.crypto">{{__('admin/sidebar.add new attribute')}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-check-circle"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.options')}}</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{\App\Models\Option::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.options')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.view all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.options.create')}}"
                           data-i18n="nav.dash.crypto">{{__('admin/sidebar.add new option')}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href="#"><i class="la la-key"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.roles')}}</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{\App\Models\Role::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.roles.index')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.view all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.roles.create')}}"
                           data-i18n="nav.dash.crypto">{{__('admin/sidebar.add new role')}}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href="#"><i class="la la-users"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.roles users')}}</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{\App\Models\Role::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.users.index')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.view all')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.users.create')}}"
                           data-i18n="nav.dash.crypto">{{__('admin/sidebar.add new role user')}}</a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="la la-gears"></i><span class="menu-title"
                                                                               data-i18n="nav.templates.main">{{__('admin/sidebar.settings')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#"
                           data-i18n="nav.templates.vert.main"> {{__('admin/sidebar.shipping methods')}}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('edit.shipping.methods', 'free')}}"
                                   data-i18n="nav.templates.vert.classic_menu">{{__('admin/sidebar.free shipping')}}</a>
                            </li>
                            <li><a class="menu-item"
                                   href="{{route('edit.shipping.methods', 'inner')}}">{{__('admin/sidebar.local shipping')}}</a>
                            </li>
                            <li><a class="menu-item" href="{{route('edit.shipping.methods', 'outer')}}"
                                   data-i18n="nav.templates.vert.compact_menu">{{__('admin/sidebar.outer shipping')}}</a>
                            </li>
                        </ul>
                </ul>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#"
                           data-i18n="nav.templates.vert.main"> {{__('admin/sidebar.slider')}}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.slider.create')}}"
                                   data-i18n="nav.templates.vert.classic_menu">{{__('admin/sidebar.slider images')}}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
