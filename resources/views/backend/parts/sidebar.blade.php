<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

	{{-- Logo --}}
	<div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
		<a href="{{ route('dashboard') }}">
			<img alt="Logo" src="{{ asset('wncms/images/logos/logo_white.png') }}" class="h-25px app-sidebar-logo-default"/>
			<img alt="Logo" src="{{ asset('wncms/images/logos/favicon.png') }}" class="h-20px app-sidebar-logo-minimize" />
		</a>
		<div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
			<span class="svg-icon svg-icon-2 rotate-180">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
					<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
				</svg>
			</span>
		</div>
		<span class="badge bg-info fw-bold">v {{ gss('version', null, false)}}</span>
	</div>

	{{-- Menu --}}
	<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
		<div id="wncms_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
			<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

				@if(gss('check_beta_functions'))
					<div class="menu-item">
						<div class="menu-content px-2">
							<select name="change_website_id" id="" class="form-select form-select-sm wncms-change-website">
								@foreach(wncms()->website()->getListByUser() ?? [] as $sitebarWebsite)
								<option value="{{ $sitebarWebsite->id }}" @if($sitebarWebsite->id == session('selected_website_id')) selected @endif>{{ $sitebarWebsite->domain }}</option>
								@endforeach
							</select>
						</div>

						@push('foot_js')
							<script>
								$(document).ready(function() {
									// Add change event listener to the select element
									$('.wncms-change-website').on('change', function() {
										// Get the selected website_id
										var selectedWebsiteId = $(this).val();
										var selectedDomain = $('option:selected', this).text();
						
										// Send an AJAX request to the Laravel API route
										$.ajax({
											headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
											url: "{{ route('dashboard.switch_website') }}",
											data:{
												websiteId:selectedWebsiteId,
												domain:selectedDomain,
											},
											type:"POST",
											success:function(response){
												Swal.fire({
													icon: 'success',
													title: response.message,
												});

												location.reload();

											}
										});
										
									});
								});
							</script>
						@endpush
					</div>
				@endif

				{{-- Admin --}}
				@include('backend.parts.sidebar.admin')

				{{-- User --}}
				@include('backend.parts.sidebar.member')

				{{-- Active routes --}}
				@if(!empty(gss('active_models')))

					{{-- Models CRUD --}}
					<div class="menu-item">
						<div class="menu-content pt-5 pb-2">
							<span class="menu-section text-white fw-bold text-uppercase fs-8 ls-1">@lang('word.models')</span>
						</div>
					</div>

					@php
						$models = wncms_get_model_names()->sortByDesc('priority');
						$modelMenuItems = [];
					
						foreach ($models as $modelData) {
							$model_class_name = $modelData['model_name_with_namespace'];
							$model = (new $model_class_name)->newModelInstance();
							$snake_name = str()->snake($modelData['model_name'], '_');
							$table_name = $model->getTable();
					
							if (defined(get_class($model) . "::ROUTES") && in_array($modelData['model_name'], json_decode(gss('active_models'), true))) {
								$menuItem = [
									'model' => $model,
									'routes' => array_map(fn($route) => $snake_name . '_' . $route, $model::ROUTES),
									'table_name' => $table_name,
									'snake_name' => $snake_name,
									'icon' => defined(get_class($model) . "::ICONS") && !empty($model::ICONS['fontaweseom']) ? $model::ICONS['fontaweseom'] : 'fa-solid fa-cube',
									'sub_routes' => [],
								];
					
								if (defined(get_class($model) . "::SUB_ROUTES") && in_array($modelData['model_name'], json_decode(gss('active_models'), true))) {
									foreach ($model::SUB_ROUTES as $route_name) {
										$sub_model_class_name = explode(".", $route_name)[0] ?? '';
										$route_suffix = explode(".", $route_name)[1] ?? '';
										if (empty($sub_model_class_name) || empty($route_suffix)) {
											continue;
										}
										$sub_snake_name = str($sub_model_class_name)->singular();
										$permission_name = $sub_snake_name . "_" . $route_suffix;
					
										$menuItem['sub_routes'][] = [
											'route_name' => $route_name,
											'permission_name' => $permission_name,
											'sub_snake_name' => $sub_snake_name,
											'sub_model_class_name' => $sub_model_class_name,
											'route_suffix' => $route_suffix,
										];
									}
								}
					
								$modelMenuItems[] = $menuItem;
							}
						}
					@endphp
					
					{{-- New --}}
					@foreach($modelMenuItems as $menuItem)
						@canany($menuItem['routes'])
							<div data-kt-menu-trigger="click" class="menu-item menu-accordion @if(request()->routeIs(array_map(fn($route) => $menuItem['table_name'] . '.' . $route, array_merge($menuItem['model']::ROUTES, ['edit'])))) show @endif">
								<span class="menu-link py-2">
									<span class="menu-icon">
										<i class="fa-lg {{ $menuItem['icon'] }} @if(request()->routeIs(array_map(fn($route) => $menuItem['table_name'] . '.' . $route, array_merge($menuItem['model']::ROUTES, ['edit'])))) fa-beat @endif"></i>
									</span>
									<span class="menu-title fw-bold">@lang('word.model_management', ['model_name' => __('word.' . $menuItem['snake_name'])])</span>
									<span class="menu-arrow"></span>
								</span>
					
								<div class="menu-sub menu-sub-accordion">
									@foreach($menuItem['model']::ROUTES as $route_name)
										@if(wncms_route_exists($menuItem['table_name'] . '.' . $route_name))
											@can($menuItem['snake_name'] . "_" . $route_name)
												<div class="menu-item">
													<a class="menu-link @if(request()->routeIs($menuItem['table_name'] . '.'. $route_name .'*')) active @endif" href="{{ route($menuItem['table_name'] . '.' . $route_name) }}">
														<span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
														<span class="menu-title fw-bold">{{ wncms_model_word($menuItem['snake_name'] . '', $route_name) }}</span>
													</a>
												</div>
											@endcan
										@endif
									@endforeach
					
									@foreach($menuItem['sub_routes'] as $subRoute)
										@if(wncms_route_exists($subRoute['route_name']))
											@can($subRoute['permission_name'])
												<div class="menu-item">
													<a class="menu-link @if(request()->routeIs($subRoute['sub_model_class_name'] . '.' . $subRoute['route_suffix'])) active @endif" href="{{ route($subRoute['route_name']) }}">
														<span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
														<span class="menu-title fw-bold">{{ wncms_model_word($subRoute['sub_snake_name'] . '', $subRoute['route_suffix']) }}</span>
													</a>
												</div>
											@endcan
										@endif
									@endforeach
								</div>
							</div>
						@endcanany
					@endforeach

					{{-- Old --}}
					@foreach([] as $modelData)
					
						@php
							$model_class_name = $modelData['model_name_with_namespace'];
							$model = (new $model_class_name)->newModelInstance();
							$snake_name = str()->snake($modelData['model_name'], '_');
							$table_name = $model->getTable();
						@endphp
			
						@if(defined(get_class($model) . "::ROUTES") && in_array($modelData['model_name'], json_decode(gss('active_models'), true)))
							@canany(array_map(fn($route) => $snake_name . '_' . $route, $model::ROUTES))
								<div data-kt-menu-trigger="click" class="menu-item menu-accordion @if(request()->routeIs(array_map(fn($route) => $table_name . '.' . $route, array_merge($model::ROUTES, ['edit']))))) show @endif">
									<span class="menu-link py-2">
										<span class="menu-icon">
											<i class="fa-lg 
												{{ defined(get_class($model) . "::ICONS") && !empty($model::ICONS['fontaweseom']) ? $model::ICONS['fontaweseom'] : 'fa-solid fa-cube' }} 
												@if(request()->routeIs(array_map(fn($route) => $table_name . '.' . $route, array_merge($model::ROUTES, ['edit']))))) fa-beat @endif"></i>
										</span>
										<span class="menu-title fw-bold">@lang('word.model_management', ['model_name' => __('word.' . $snake_name)])</span>
										<span class="menu-arrow"></span>
									</span>
			
									<div class="menu-sub menu-sub-accordion">
										@foreach($model::ROUTES as $route_name)
											@if(wncms_route_exists($table_name . '.' . $route_name))
												@can($snake_name . "_" . $route_name)
													<div class="menu-item">
														<a class="menu-link @if(request()->routeIs($table_name . '.'. $route_name .'*')) active @endif" href="{{ route($table_name . '.' . $route_name) }}">
															<span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
															{{-- <span class="menu-title fw-bold">@lang('word.' . $table_name . "_" . $route_name)</span> --}}
															<span class="menu-title fw-bold">{{ wncms_model_word($snake_name . '', $route_name) }}</span>
														</a>
													</div>
												@endcan
											@endif
										@endforeach

										@if(defined(get_class($model) . "::SUB_ROUTES") && in_array($modelData['model_name'], json_decode(gss('active_models'), true)))
											@foreach($model::SUB_ROUTES as $route_name)

												@php
													$sub_model_class_name = explode(".", $route_name)[0] ?? '';
													$route_suffix = explode(".", $route_name)[1] ?? '';
													if(empty($sub_model_class_name) || empty($route_suffix)){
														continue;
													}
													$sub_snake_name = str($sub_model_class_name)->singular();
													$permission_name = $sub_snake_name . "_" . $route_suffix;
												@endphp

												@if(wncms_route_exists($route_name))
													@can($permission_name)
														<div class="menu-item">
															<a class="menu-link @if(request()->routeIs($sub_model_class_name . '.' . $route_suffix)) active @endif" href="{{ route($route_name) }}">
																<span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
																<span class="menu-title fw-bold">{{ wncms_model_word($sub_snake_name . '', $route_suffix) }}</span>
															</a>
														</div>
													@endcan
												@endif
											@endforeach
										@endif
									</div>
								</div>
							@endrole
						@endif

					@endforeach

				@endif
				
			</div>
		</div>
	</div>
	
	{{-- Sidebar Footer --}}
	<div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
		{{-- <a href="https://t.me/secretwebmaster" target="_blank" class="btn btn-flex flex-center btn-custom btn-primary overflow-hidden text-nowrap px-0 h-40px w-100 mb-3" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="200+ in-house components and 3rd-party plugins">
			<span class="btn-label">@lang('word.contact_support')</span>
			<span class="svg-icon btn-icon svg-icon-2 m-0">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="currentColor" />
					<rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor" />
					<rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor" />
					<rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor" />
					<path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
				</svg>
			</span>
		</a> --}}
	</div>

</div>