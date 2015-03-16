define(['jquery'], function ($) {
 
	return function Toggler(options, onComplete){

		var t = this,
			onComplete = onComplete || false,
			settings = {
				toggle_btn: 'toggle_btn',
				class_net: 'body',
				toggle_class: 'is_open'
			};

		$.extend(settings, options);

		if(settings.class_net != "self"){
			settings.class_prefixer = $(settings.toggle_btn).data('control');
			settings.class_net = $(settings.class_net);
			settings.toggle_class = settings.class_prefixer + "--" + settings.toggle_class;
		}

		if(settings.class_net != "self"){
			$(settings.toggle_btn).on(settings.toggle_event, function(e){
				settings.class_net.toggleClass(settings.toggle_class);
				if(onComplete){ onComplete(); }
			});
		}else{
			$(settings.toggle_btn).on(settings.toggle_event, function(e){
				var $this = $(this);
				if(settings.one_open){ $this.siblings().removeClass(settings.toggle_class); }
				$this.toggleClass(settings.toggle_class);
				if(onComplete){ onComplete(); }
			});
		}

	}
	
});