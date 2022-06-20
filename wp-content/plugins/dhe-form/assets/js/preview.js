jQuery( function( $ ) {
	"use strict"; // jshint ;_;
	if ( undefined !== window.elementorFrontend ) {
		elementor.settings.page.addChangeCallback( 'form_layout', function(value){
			var $form_container = elementor.getPreviewView().$el.closest('.dhe-form-container');
			$form_container.removeClass('dhe-form-vertical dhe-form-horizontal').addClass('dhe-form-'+value)
		} );
		elementor.settings.page.addChangeCallback( 'input_icon_position', function(value){
			var $form_container = elementor.getPreviewView().$el.closest('.dhe-form-container');
			$form_container.removeClass('dhe-form-icon-pos-left dhe-form-icon-pos-right').addClass('dhe-form-icon-pos-'+value)
		} );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/dhe_form_color.default', function( $scope ) {
			if($.isFunction( $.fn.minicolors ) ){
				$scope.find(".dhe-form-control").minicolors({
					theme: 'bootstrap'
				});
			}
		});
		elementorFrontend.hooks.addAction( 'frontend/element_ready/dhe_form_rate.default', function( $scope ) {
			if($.isFunction( $.fn.tooltip ) ){
				$scope.find('.dhe-form-rate-star').tooltip({ html: true,container:$('body')});
			}
		});
		elementorFrontend.hooks.addAction( 'frontend/element_ready/dhe_form_slider.default', function( $scope ) {
			if($.isFunction( $.fn.slider ) ){
				$scope.find('.dhe-form-slider-control').each(function(){
					var $this = $(this);
					$this.slider({
						 min: $this.data('min'),
					     max: $this.data('max'),
					     step: $this.data('step'),
					     range: ($this.data('type') == 'range' ? true : 'min'),
					     slide: function(event, ui){
					    	 if($this.data('type') == 'range'){
					    		 $this.closest('.dhe-form-group').find('.dhe-form-slider-value-from').text(ui.values[0]);
					    		 $this.closest('.dhe-form-group').find('.dhe-form-slider-value-to').text(ui.values[1]);
					    		 $this.closest('.dhe-form-group').find('input[type="hidden"]').val(ui.values[0] + '-' + ui.values[1]).trigger('change');
					    	 }else{
					    		 $this.closest('.dhe-form-group').find('.dhe-form-slider-value').text(ui.value);
					    		 $this.closest('.dhe-form-group').find('input[type="hidden"]').val(ui.value).trigger('change');
					    	 }
					     }
					});
					if($this.data('type') == 'range'){
						$this.slider('values',[0,$this.data('minmax')]);
					}else{
						$this.slider('value',$this.data('value'));
					}
				});
			}
		});
		elementorFrontend.hooks.addAction( 'frontend/element_ready/dhe_form_recaptcha.default', function( $scope ) {
			var initRecaptcha = function(){
				var $elements = $scope.find('[data-dheform-recaptcha="recaptcha"]');
				if (!$elements.length) {
					return;
				}
				var addRecaptcha = function($elements){
					$elements.each(function(){
						var el = this,
							$this=$(el);
						
						if($this.hasClass('dhe-form-recaptcha2')){

							var $widget_id = grecaptcha.render(el, $this.data()),
							    $form = $this.closest('form');
							
							$this.data('widget_id', $widget_id);
							
						}else{
							grecaptcha.ready(function() {
					             grecaptcha.execute($this.data('sitekey'), {action: 'homepage'}).then(function(token) {
					                 el.setAttribute( 'value', token );
					             });
					         })
						}
						
					});
				}
				
				var onRecaptchaApiReady = function(callback){
					if (window.grecaptcha && window.grecaptcha.render) {
						callback();
					} else {
						// If not ready check again by timeout..
						setTimeout(function () {
							onRecaptchaApiReady(callback);
						}, 350);
					}
				}
				
				onRecaptchaApiReady(function () {
					addRecaptcha($elements);
				});
			}
			initRecaptcha();
		});
		
		elementorFrontend.hooks.addAction( 'frontend/element_ready/dhe_form_datetime.default', function( $scope ) {
			if($.isFunction( $.fn.xdsoftDatetimepicker ) ){
				var datepicker = $scope.find('.dhe-form-datepicker');
				if(datepicker.length){
					datepicker.each(function(){
						var _this = $(this);
						_this.xdsoftDatetimepicker({
							format: dhe_form_params.date_format,
							formatDate: dhe_form_params.date_format,
							timepicker:false,
							scrollMonth:false,
							dayOfWeekStart: parseInt(dhe_form_params.dayofweekstart),
							scrollTime:false,
							minDate: _this.data('min-date'),
							maxDate: _this.data('max-date'),
							yearStart: _this.data('year-start'),
							yearEnd: _this.data('year-end'),
							scrollInput:false
						});
					});
					
				}
				var timepicker = $scope.find('.dhe-form-timepicker');
				if(timepicker.length){
					timepicker.each(function(){
						var _this = $(this);
						_this.xdsoftDatetimepicker({
							format: dhe_form_params.time_format,
							formatTime: dhe_form_params.time_format,
							datepicker:false,
							scrollMonth:false,
							scrollTime:true,
							scrollInput:false,
							dayOfWeekStart: parseInt(dhe_form_params.dayofweekstart),
							minTime: _this.data('min-time'),
							maxTime: _this.data('max-time'),
							minDate: _this.data('min-date'),
							maxDate: _this.data('max-date'),
							yearStart: _this.data('year-start'),
							yearEnd: _this.data('year-end'),
							step: parseInt(dhe_form_params.time_picker_step)
						});
					});
				}
				
				$scope.find('.dhe-form-datepicker[data-range_field]').each(function(){
					var $this = $(this),
						$range_field_name = $this.data('range_field'),
						$range_field = $('.dhe-form-control[data-field-name="' + $range_field_name + '"]');
	
					$range_field.xdsoftDatetimepicker('setOptions',{
						onChangeDateTime: function(_datetimepicker , _currentTime, _input, _event){
							var nextDate = new Date(
										_datetimepicker.getFullYear(), 
										_datetimepicker.getMonth(), 
										_datetimepicker.getDate() + parseInt($this.data('range_field_start_current')), 
										_datetimepicker.getHours(), 
										_datetimepicker.getMinutes(), 
										_datetimepicker.getSeconds(),
										_datetimepicker.getMilliseconds() ).toString();
							
						   
							if($this.data('range_field_set_value')==='yes'){
								 var dateHelper = $range_field.data('xdsoft_datetimepicker').getDateHelper(),
									format = $this.hasClass('dhe-form-datetimepicker') ? dhvcformL10n.date_format +' '+dhvcformL10n.time_format : dhvcformL10n.date_format,
									value = dateHelper.formatDate(new Date(nextDate),format);
										
								$this.val(value).attr('value',value);
								$this.trigger('change'); 
							}
							
							$this.xdsoftDatetimepicker('reset').xdsoftDatetimepicker('setOptions',{
								minDate: new Date(nextDate) 
							})
						}
					})
				})
				
				var datetimepicker = $scope.find('.dhe-form-datetimepicker');
				if(datetimepicker.length){
					datetimepicker.each(function(){
						var _this = $(this);
						_this.xdsoftDatetimepicker({
							format: dhe_form_params.date_format +' '+dhe_form_params.time_format,
							datepicker:true,
							scrollMonth:false,
							scrollTime:true,
							scrollInput:false,
							minTime: _this.data('min-time'),
							maxTime: _this.data('max-time'),
							step: parseInt(dhe_form_params.time_picker_step)
						});
					});
				}
			}
		});
	}
} );