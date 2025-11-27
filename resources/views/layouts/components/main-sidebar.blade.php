
			<aside class="app-sidebar sticky" id="sidebar">

				<!-- Start::main-sidebar-header -->
				<div class="main-sidebar-header">
					<a href="{{url('index')}}" class="header-logo">
						<img src="{{asset('build/assets/images/brand-logos/desktop-logo.png')}}" alt="logo" class="desktop-logo">
						<img src="{{asset('build/assets/images/brand-logos/toggle-dark.png')}}" alt="logo" class="toggle-dark">
						<img src="{{asset('build/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark">
						<img src="{{asset('build/assets/images/brand-logos/toggle-logo.png')}}" alt="logo" class="toggle-logo">
					</a>
				</div>
				<!-- End::main-sidebar-header -->

				<!-- Start::main-sidebar -->
				<div class="main-sidebar" id="sidebar-scroll">

					<!-- Start::nav -->
					<nav class="main-menu-container nav nav-pills flex-column sub-open">
						<div class="slide-left" id="slide-left">
							<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
						</div>
						<ul class="main-menu">
							<!-- Start::slide__category -->
							<li class="slide__category"><span class="category-name">Main</span></li>
							<!-- End::slide__category -->

							<!-- Start::slide -->
							<li class="slide has-sub">
								<a href="javascript:void(0);" class="side-menu__item">
									<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M133.66,34.34a8,8,0,0,0-11.32,0L40,116.69V216h64V152h48v64h64V116.69Z" opacity="0.2"/><line x1="16" y1="216" x2="240" y2="216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="152 216 152 152 104 152 104 216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="40" y1="116.69" x2="40" y2="216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="216" y1="216" x2="216" y2="116.69" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M24,132.69l98.34-98.35a8,8,0,0,1,11.32,0L232,132.69" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
									<span class="side-menu__label">Dashboards</span>
									<i class="ri-arrow-right-s-line side-menu__angle"></i>
								</a>
								<ul class="slide-menu child1">
									<li class="slide side-menu__label1">
										<a href="javascript:void(0)">Dashboards</a>
									</li>
									<li class="slide {{ request()->is('index') ? 'active' : '' }}">
										<a href="{{url('index')}}" class="side-menu__item"> 
											<svg xmlns="http://www.w3.org/2000/svg" class="side-menu-doublemenu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M54.46,201.54c-9.2-9.2-3.1-28.53-7.78-39.85C41.82,150,24,140.5,24,128s17.82-22,22.68-33.69C51.36,83,45.26,63.66,54.46,54.46S83,51.36,94.31,46.68C106.05,41.82,115.5,24,128,24S150,41.82,161.69,46.68c11.32,4.68,30.65-1.42,39.85,7.78s3.1,28.53,7.78,39.85C214.18,106.05,232,115.5,232,128S214.18,150,209.32,161.69c-4.68,11.32,1.42,30.65-7.78,39.85s-28.53,3.1-39.85,7.78C150,214.18,140.5,232,128,232s-22-17.82-33.69-22.68C83,204.64,63.66,210.74,54.46,201.54Z" opacity="0.2"/><path d="M54.46,201.54c-9.2-9.2-3.1-28.53-7.78-39.85C41.82,150,24,140.5,24,128s17.82-22,22.68-33.69C51.36,83,45.26,63.66,54.46,54.46S83,51.36,94.31,46.68C106.05,41.82,115.5,24,128,24S150,41.82,161.69,46.68c11.32,4.68,30.65-1.42,39.85,7.78s3.1,28.53,7.78,39.85C214.18,106.05,232,115.5,232,128S214.18,150,209.32,161.69c-4.68,11.32,1.42,30.65-7.78,39.85s-28.53,3.1-39.85,7.78C150,214.18,140.5,232,128,232s-22-17.82-33.69-22.68C83,204.64,63.66,210.74,54.46,201.54Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><circle cx="96" cy="96" r="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><circle cx="160" cy="160" r="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="88" y1="168" x2="168" y2="88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
											Sales</a>
									</li>
								</ul>
							</li>
							<!-- End::slide -->

							<!-- Start::slide__category -->
							<li class="slide__category"><span class="category-name">Pages</span></li>
							<!-- End::slide__category -->

							<!-- Start::slide -->
							<li class="slide has-sub">
								<a href="javascript:void(0);" class="side-menu__item">
									<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polygon points="152 32 152 88 208 88 152 32" opacity="0.2"/><path d="M200,224H56a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h96l56,56V216A8,8,0,0,1,200,224Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
									<span class="side-menu__label">Pages</span>
									<i class="ri-arrow-right-s-line side-menu__angle"></i>
								</a>
								<ul class="slide-menu child1 pages-ul">
									<li class="slide side-menu__label1">
										<a href="javascript:void(0)">Pages</a>
									</li>
									
									<li class="slide has-sub">
										<a href="javascript:void(0);" class="side-menu__item">
											<svg xmlns="http://www.w3.org/2000/svg" class="side-menu-doublemenu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polygon points="152 32 152 88 208 88 152 32" opacity="0.2"/><path d="M200,224H56a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h96l56,56V216A8,8,0,0,1,200,224Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="96" y1="136" x2="160" y2="136" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="96" y1="168" x2="160" y2="168" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
											Forms
											<i class="ri-arrow-right-s-line side-menu__angle"></i>
										</a>
										<ul class="slide-menu child2">
											<li class="slide">
												<a href="{{url('form-advanced')}}" class="side-menu__item">Form Advanced</a>
											</li>
											<li class="slide has-sub">
												<a href="javascript:void(0);" class="side-menu__item">Form Elements
													<i class="ri-arrow-right-s-line side-menu__angle"></i></a>
												<ul class="slide-menu child3">
													<li class="slide">
														<a href="{{url('form-inputs')}}" class="side-menu__item">Inputs</a>
													</li>
													<li class="slide">
														<a href="{{url('form-check-radios')}}" class="side-menu__item">Checks & Radios</a>
													</li>
													<li class="slide">
														<a href="{{url('form-input-group')}}" class="side-menu__item">Input Group</a>
													</li>
													<li class="slide">
														<a href="{{url('form-select')}}" class="side-menu__item">Form Select</a>
													</li>
													<li class="slide">
														<a href="{{url('form-range')}}" class="side-menu__item">Range Slider</a>
													</li>
													<li class="slide">
														<a href="{{url('form-input-masks')}}" class="side-menu__item">Input Masks</a>
													</li>
													<li class="slide">
														<a href="{{url('form-file-uploads')}}" class="side-menu__item">File Uploads</a>
													</li>
													<li class="slide">
														<a href="{{url('form-datetime-pickers')}}" class="side-menu__item">Date,Time Picker</a>
													</li>
													<li class="slide">
														<a href="{{url('form-color-pickers')}}" class="side-menu__item">Color Pickers</a>
													</li>
												</ul>
											</li>
											<li class="slide">
												<a href="{{url('floating-labels')}}" class="side-menu__item">Floating Labels</a>
											</li>
											<li class="slide">
												<a href="{{url('form-layout')}}" class="side-menu__item">Form Layouts</a>
											</li>
											<li class="slide">
												<a href="{{url('form-wizards')}}" class="side-menu__item">Form Wizards</a>
											</li>
											<li class="slide">
												<a href="{{url('quill-editor')}}" class="side-menu__item">Quill Editor</a>
											</li>
											<li class="slide">
												<a href="{{url('form-validation')}}" class="side-menu__item">Validation</a>
											</li>
											<li class="slide">
												<a href="{{url('form-select2')}}" class="side-menu__item">Select2</a>
											</li>
										</ul>
									</li>
									
								</ul>
							</li>
							<!-- End::slide -->

							<li class="slide has-sub">
								<a href="javascript:void(0);" class="side-menu__item">
									<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="32" y="104" width="56" height="96" opacity="0.2"/><path d="M32,56H224a0,0,0,0,1,0,0V192a8,8,0,0,1-8,8H40a8,8,0,0,1-8-8V56A0,0,0,0,1,32,56Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="32" y1="104" x2="224" y2="104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="32" y1="152" x2="224" y2="152" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="88" y1="104" x2="88" y2="200" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
									<span class="side-menu__label">Tables</span>
									<i class="ri-arrow-right-s-line side-menu__angle"></i>
								</a>
								<ul class="slide-menu child1"> 
									<li class="slide side-menu__label1">
										<a href="javascript:void(0)">Tables</a>
									</li>
									<li class="slide">
										<a href="{{url('tables')}}" class="side-menu__item">
											<svg xmlns="http://www.w3.org/2000/svg" class="side-menu-doublemenu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="48" y="48" width="160" height="160" rx="8" opacity="0.2"/><rect x="48" y="48" width="160" height="160" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="128" y1="48" x2="128" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="48" y1="128" x2="208" y2="128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
											Tables
										</a>
									</li>
									<li class="slide">
										<a href="{{url('grid-tables')}}" class="side-menu__item">
											<svg xmlns="http://www.w3.org/2000/svg" class="side-menu-doublemenu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="32" y="56" width="192" height="144" rx="8" opacity="0.2"/><rect x="32" y="56" width="192" height="144" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="96" y1="56" x2="96" y2="200" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="160" y1="56" x2="160" y2="200" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="32" y1="104" x2="224" y2="104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="32" y1="152" x2="224" y2="152" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
											Grid JS Tables</a>
									</li>
									<li class="slide">
										<a href="{{url('data-tables')}}" class="side-menu__item">
											<svg xmlns="http://www.w3.org/2000/svg" class="side-menu-doublemenu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M40,128h88a0,0,0,0,1,0,0v88a0,0,0,0,1,0,0H48a8,8,0,0,1-8-8V128A0,0,0,0,1,40,128Z" opacity="0.2"/><path d="M128,40h80a8,8,0,0,1,8,8v80a0,0,0,0,1,0,0H128a0,0,0,0,1,0,0V40A0,0,0,0,1,128,40Z" opacity="0.2"/><rect x="40" y="40" width="176" height="176" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="128" y1="40" x2="128" y2="216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="216" y1="128" x2="40" y2="128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
											Data Tables
										</a>
									</li>
								</ul>
							</li>
							<!-- End::slide -->

							<li class="slide has-sub">
								<a href="javascript:void(0);" class="side-menu__item">
									<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="48" y="48" width="64" height="64" rx="8" opacity="0.2"/><rect x="144" y="48" width="64" height="64" rx="8" opacity="0.2"/><rect x="48" y="144" width="64" height="64" rx="8" opacity="0.2"/><rect x="144" y="144" width="64" height="64" rx="8" opacity="0.2"/><rect x="144" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="48" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="144" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="48" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
									<span class="side-menu__label">Applications</span>
								</a>
								<ul class="slide-menu child1">
									<li class="slide has-sub">
										<a href="javascript:void(0);" class="side-menu__item">
											<svg xmlns="http://www.w3.org/2000/svg" class="side-menu-doublemenu__icon" width="32" height="32" fill="#000000" viewBox="0 0 256 256"><path d="M216,56v64H160V56ZM40,208a8,8,0,0,0,8,8H88a8,8,0,0,0,8-8V120H40Z" opacity="0.2"></path><path d="M216,48H40a8,8,0,0,0-8,8V208a16,16,0,0,0,16,16H88a16,16,0,0,0,16-16V160h48v16a16,16,0,0,0,16,16h40a16,16,0,0,0,16-16V56A8,8,0,0,0,216,48Zm-8,64H168V64h40ZM88,64v48H48V64Zm0,144H48V128H88Zm16-64V64h48v80Zm64,32V128h40v48Z"></path></svg>
											Task
											<i class="ri-arrow-right-s-line side-menu__angle"></i>
										</a>
										<ul class="slide-menu child2">
											<li class="slide">
												<a href="{{url('task-kanban-board')}}" class="side-menu__item">Kanban Board</a>
											</li>
											<li class="slide">
												<a href="{{url('task-list-view')}}" class="side-menu__item">List View</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>

							<!-- Start::slide Ventas -->
							<li class="slide has-sub">
								<a href="javascript:void(0);" class="side-menu__item">
									<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M40,112H216v32H40Z" opacity="0.2"/><path d="M40,112H216v32H40Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M64,48H192a8,8,0,0,1,8,8V208a8,8,0,0,1-8,8H64a8,8,0,0,1-8-8V56A8,8,0,0,1,64,48Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="96" y1="80" x2="160" y2="80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="96" y1="176" x2="160" y2="176" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
									<span class="side-menu__label">Ventas</span>
									<i class="ri-arrow-right-s-line side-menu__angle"></i>
								</a>
								<ul class="slide-menu child1">
									<li class="slide side-menu__label1">
										<a href="javascript:void(0)">Ventas</a>
									</li>
									<li class="slide {{ request()->is('ventas/lista') ? 'active' : '' }}">
										<a href="{{route('ventas', ['accion' => 'lista'])}}" class="side-menu__item">
											<svg xmlns="http://www.w3.org/2000/svg" class="side-menu-doublemenu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="32" y="104" width="56" height="96" opacity="0.2"/><path d="M32,56H224a0,0,0,0,1,0,0V192a8,8,0,0,1-8,8H40a8,8,0,0,1-8-8V56A0,0,0,0,1,32,56Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="32" y1="104" x2="224" y2="104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="32" y1="152" x2="224" y2="152" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="88" y1="104" x2="88" y2="200" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
											Lista de Ventas
										</a>
									</li>
									<li class="slide {{ request()->is('ventas/crear') ? 'active' : '' }}">
										<a href="{{route('ventas', ['accion' => 'crear'])}}" class="side-menu__item">
											<svg xmlns="http://www.w3.org/2000/svg" class="side-menu-doublemenu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polygon points="152 32 152 88 208 88 152 32" opacity="0.2"/><path d="M200,224H56a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h96l56,56V216A8,8,0,0,1,200,224Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="96" y1="136" x2="160" y2="136" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="96" y1="168" x2="160" y2="168" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
											Crear Venta
										</a>
									</li>
								</ul>
							</li>
							<!-- End::slide Ventas -->

						</ul>
						<ul class="doublemenu_bottom-menu main-menu mb-0 border-top">
							
							<!-- Start::slide -->
							<li class="slide">
								<a href="{{url('sign-in-cover')}}" class="side-menu__item">
									<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M48,40H208a16,16,0,0,1,16,16V200a16,16,0,0,1-16,16H48a0,0,0,0,1,0,0V40A0,0,0,0,1,48,40Z" opacity="0.2"/><polyline points="112 40 48 40 48 216 112 216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="112" y1="128" x2="224" y2="128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="184 88 224 128 184 168" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
									<span class="side-menu__label">Logout</span>
								</a>
							</li>
							<!-- End::slide -->
						</ul>
						<div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
					</nav>
					<!-- End::nav -->

				</div>
				<!-- End::main-sidebar -->

			</aside>