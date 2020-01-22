/* Copyright (C) 2009 - 2018 SEBLOD. All Rights Reserved. */
if("undefined"===typeof JCck)var JCck={};
(function($) {
	if("undefined"===typeof JCck.Core){JCck.Core={}};
	JCck.Core.doTask = function(id, task, form) {
		if (typeof(form) === 'undefined') {
			form = document.getElementById('adminForm');
		}
		var cb = form[id];
		var tasks = task.split('.');
		if (cb) {
			for (var i = 0; true; i++) {
				var cbx = form['cb'+i];
				if (!cbx)
					break;
				cbx.checked = false;
			} // for
			cb.checked = true;
			form.boxchecked.value = 1;
			if (tasks[0] == "update" && tasks[1] != ""){
				task = tasks[0];
				jQuery("#seblod_form").append('<input type="hidden" id="task2" name="task2" value="'+tasks[1]+'">');
			}
			Joomla.submitbutton(task);
		}
		return false;
	};
	JCck.Core.executeFunctionByName = function(functionName, context) {
		var args = [].slice.call(arguments).splice(2);
		var namespaces = functionName.split(".");
		var func = namespaces.pop();
		
		for (var i = 0; i < namespaces.length; i++) {
			context = context[namespaces[i]];
		}
		
		return context[func].apply(this, args);
	};
	JCck.Core.getModal = function(options) {
		return myModal(options);
	};
	JCck.Core.submitForm = function(task, form) {
		if (typeof(form) === 'undefined') {
			form = document.getElementById('adminForm');
		}
		if (typeof(task) !== 'undefined' && task !== "") {
			form.task.value = task;
		}
		if (typeof form.onsubmit == 'function') {
			form.onsubmit();
		}
		if (typeof form.fireEvent == 'function') {
			form.fireEvent('onsubmit');
		}
		if (typeof jQuery != 'function' || task == "form.cancel" || task == "cancel") {
			form.submit();
		} else {
			if (task == 'search') {
				jQuery('[data-cck-remove-before-search]', '#'+form.id).removeAttr('name');
			}
			jQuery(form).submit();
		}
	};
	JCck.Core.submitTask = function(task, task_id, cb_id, form_id) {
		jQuery('#'+form_id+' input:checkbox[name="cid[]"]:checked').prop('checked',false);
		jQuery('#'+form_id+' #'+cb_id).prop('checked',true);
		jQuery('#'+form_id+' #boxchecked').myVal(1);
		jQuery('#'+form_id).append('<input type="hidden" name="tid" value="'+task_id+'">');
		JCck.Core.submitForm(task,document.getElementById(form_id));
		jQuery('#'+form_id+' #'+cb_id).prop('checked',false);
	};
	JCck.Core.trigger = function(element,event) {
		$(element).trigger(event);
	};
	JCck.Modals = [];
	function myCheck(v, values) {if ($.inArray(v, values) >= 0) { return 1; } else { return 0; }}
	function myModal( options ) {
		var m      = {};
		m.modal    = null;
		m.defaults = {
			backclose: true,
			backdrop: true,
			body: true,
			callbacks: {},
			class: '',
			close: true,
			group: 'ajax',
			header: true,
			html: {
				close:'<button type="button" class="close" data-dismiss="modal"><span>×</span></button>',
				loading:'<div class="loading"></div>',
				navigation:'<a class="prev" href="javascript:void(0);"><span><</span></a><a class="next" href="javascript:void(0);"><span>></span></a>'
			},
			keyboard: true,
			loading: true,
			loop: false,
			message: {
				selector:''
			},
			mode: 'ajax',
			navigation: false,
			/*parent: '',*/
			title: true,
			url: {
				tmpl:''
			}
		};
		
		m.settings =	$.extend(
			m.defaults,
			options || {}
		);
		
		m.groups		=	{ajax:[]};
		m.currentIndex	=	0;

		m.referrer = null;
		
		m.build = function () {
			m.remove();
			
			$('body').append('<div id="modal-cck" class="modal fade modal-' + m.settings.mode
				+ (m.settings.class != '' ? ' ' + m.settings.class : '') + '">'
				+ (m.settings.navigation ? '<div class="modal-navigation">' + m.settings.html.navigation + '</div>' : '')
				+ (m.settings.header ? '<div class="modal-header">'
				+ (m.settings.title ? '<h3>' + (m.settings.title !== true ? m.settings.title : '') + '</h3>' : '') + '</div>' : '')
				+ '<div class="modal-content">'
				+ (m.settings.message.selector != '' ? '<div class="modal-message"></div>' : '')
				+ (m.settings.body ? '<div class="modal-body"></div>' : '')
				+ '</div></div></div>');

			if (m.settings.message.selector != '') {
				if ($('body '+m.settings.message.selector).length) {
					$('body '+m.settings.message.selector).appendTo('.modal-message');
				}
			}

			m.modal     = $('#modal-cck');
			m.container = m.modal.find(m.settings.body ? '.modal-body' :  '.modal-content');

			if (m.settings.close) {
				$(m.settings.html.close).prependTo(m.settings.header ? m.modal.find('.modal-header') : m.modal);
			}

			m.modal.modal({
				show: false,
				backdrop: m.settings.backdrop == false ? false : (m.settings.backclose == false ? 'static' : true),
				keyboard: m.settings.keyboard
			});
	
			m.modal.on('show', function(e) {
				e.stopPropagation();
				$("html").removeClass("modal-off").addClass("modal-on");
				m.callbacks.show(e);
			});
	
			m.modal.on('shown', function(e) {
				e.stopPropagation();
				m.callbacks.shown(e);
			});
	
			m.modal.on('hide', function(e) {
				e.stopPropagation();
				m.callbacks.hide(e);
			});
			
			m.modal.on('hidden', function(e) {
				e.stopPropagation();
				$("html").removeClass("modal-on").addClass("modal-off");
				m.callbacks.hidden(e);
			});
			
			return m;
		}

		m.callbacks = {
			show: function(e) {
				if ("undefined" !== typeof m.settings.callbacks.show) {
					m.settings.callbacks.show(e);
				}
			},
			load: function() {
				m.container.empty();

				if (m.settings.loading) {
					m.container.append(m.settings.html.loading);
				}

				if (m.settings.navigation) {
					m.modal.find('.modal-navigation > a').addClass("hidden");
				}

				if ("undefined" !== typeof m.settings.callbacks.load) {
					m.settings.callbacks.load();
				}
			},
			loaded: function() {
				if (m.settings.loading) {
					m.container.find('.loading').remove();
				}

				if (m.settings.title) {
					var modal_title = m.modal.find('[data-cck-modal-title]');

					if (modal_title.length) {
						m.modal.find('.modal-header h3').html(modal_title.html());
					}
				}

				var modal_hash = m.modal.find('[data-cck-modal-hash]');

				if (modal_hash.length) {
					window.location.hash = modal_hash.html();
				}

				/*
				var modal_pagetitle = m.modal.find('[data-cck-modal-pagetitle]');

				if (document.title != modal_pagetitle.text()) {
					document.title = modal_pagetitle.text();
				}
				*/

				if (m.settings.navigation && m.groups[m.settings.group].length > 1) {

					if (m.settings.loop) {
						m.modal.find('.modal-navigation > a').removeClass("hidden");
					} else {
						if (m.currentIndex != 0) {
							m.modal.find('.modal-navigation > a.prev').removeClass("hidden");
						}

						if (m.currentIndex != m.groups[m.settings.group].length - 1) {
							m.modal.find('.modal-navigation > a.next.hidden').removeClass("hidden");
						}
					}
				}

				if ("undefined" !== typeof m.settings.callbacks.loaded) {
					m.settings.callbacks.loaded();
				}
			},
			shown: function(e) {
				var body_scroll = $(window).scrollTop();
				$(window).on('scroll', function() {
					$(document).scrollTop(body_scroll);
				});
				
				if (m.settings.navigation) {
					m.modal.find('.modal-navigation > a.prev').on('click' , function (event) {
						event.preventDefault();
						m.loadPrev();
					});
					m.modal.find('.modal-navigation > a.next').on('click' , function (event) {
						event.preventDefault();
						m.loadNext();
					});
				}
				
				if (m.settings.keyboard) {
						$(document.documentElement).on("keyup", m.keyboardHandler);
					}
				
				if ("undefined" !== typeof m.settings.callbacks.shown) {
					m.settings.callbacks.shown(e);
				}
			},
			hide: function(e) {
				if ("undefined" !== typeof m.settings.callbacks.hide) {
					m.settings.callbacks.hide(e);
				}
			},
			hidden: function(e) {
				$(window).off('scroll');
				history.replaceState("", document.title, window.location.pathname + window.location.search);
				m.remove();
				
				if ("undefined" !== typeof m.settings.callbacks.hidden) {
					m.settings.callbacks.hidden(e);
				}
			},
			destroy: function() {
				if ("undefined" !== typeof m.settings.callbacks.destroy) {
					m.settings.callbacks.destroy();
				}
				
				m.remove();
				m = {};
				
				if ("undefined" !== typeof m.settings.callbacks.destroyed) {
					m.settings.callbacks.destroyed();
				}
			},
			destroyed: function() {
				if ("undefined" !== typeof m.settings.callbacks.destroyed) {
					m.settings.callbacks.destroyed();
				}
			}
		}
		
		m.destroy = function() {
			m.callbacks.destroy();
			return this;
		}
		m.hide = function() {
			m.modal.modal('hide');
			return this;
		}
		
		m.init = function() {
			$.each(m.groups, function(g, e) {
				$.each(e, function(idx) {
					$(this).off('click');
					$(this).on('click', function(event) {
						event.preventDefault();
						var link   = $(this);
						var url	   = link.attr('href');
						m.referrer = this;
						m.settings = $.extend(
							m.settings,
							link.data('cck-modal') || {}
						);
						m.settings.group = g;
						m.currentIndex	 = idx;
						m.loadUrl(url);
					});
				});
			});
			
			return this;
		}
		
		m.keyboardHandler = function(event) {
			event.preventDefault();
			
			switch (event.keyCode) {
				case 27:
					m.hide();
					break;
			}
			if (m.settings.navigation) {
				switch (event.keyCode) {
					case 37:
						m.loadPrev();
						break;
					case 39:
						m.loadNext();
						break;
				}
			}
		}
		
		m.load = function (url,show) {
			m.callbacks.load();
			
			switch (m.settings.mode) {
				case 'iframe':
					var iframe_s = '<iframe src="' + url + '" width="100%" height="100%" frameborder="0"></iframe>';
					m.container.html(iframe_s);
					m.callbacks.loaded();
					if (show) {
						m.show();
					}
					break;
				case 'image':
					var image_html = '<img src="' + url + '" />';
					m.container.html(image_html);
					m.callbacks.loaded();
					if (show) {
						m.show();
					}
					break;
				default:
					$.ajax({
						url: url,
						cache: false
					}).done(function(html){
						m.container.html(html);
						m.callbacks.loaded();
						if (show) {
							m.show();
						}
					}).fail(function(jqXHR, textStatus){
						if (window.location.hash) {
							history.replaceState("", document.title, window.location.pathname + window.location.search);
						}
						/* We may add a callback later. */
						m.container.html("<span data-cck-modal-title style=\"display:none;\">"+jqXHR.status+" "+jqXHR.statusText+"</span>The requested page can't be found or you are not authorised to view this resource.");
						m.callbacks.loaded();
						if (show) {
							m.show();
						}
					});
					break;
			}
			
			return this;
		}

		m.loadPrev = function() {
			if (m.currentIndex == 0) {
				if (m.settings.loop) {
					m.currentIndex = (m.groups[m.settings.group].length - 1);
				} else {
					return this;
				}
			} else {
				m.currentIndex--;
			}
			
			m.load($( m.groups[m.settings.group][m.currentIndex]).attr('href'),false);
			return this;
		}

		m.loadNext = function() {
			if (m.currentIndex == m.groups[m.settings.group].length - 1) {
				if (m.settings.loop) {
					m.currentIndex = 0;
				} else {
					return this;
				}
			} else {
				m.currentIndex++;
			}

			m.load($(m.groups[m.settings.group][m.currentIndex]).attr('href'),false);
			return this;
		}

		m.loadHtml = function(html) {
			m.build();
			m.callbacks.load();
			m.container.html(html);
			m.callbacks.loaded();
			m.show();
		}
		
		m.loadUrl = function(url) {
			$.each(m.groups.ajax, function(i, e) {
				if (JCck.Core.sourceURI + e.attr('href') == url) {
					m.settings.group = 'ajax';
					m.currentIndex   = i;
					return false;
				}
			});
			if (m.settings.url.tmpl) {
				if (url.indexOf('?') > -1) {
					url += '&';
				} else {
					url += '?';
				}
				url += 'tmpl='+m.settings.url.tmpl;
			}
			m.build().load(url,true);
		}

		m.remove = function() {
			$('body').find('#modal-cck').remove();
			
			if (m.settings.keyboard) {
				$(document.documentElement).off("keyup", m.keyboardHandler);
			}
			
			return this;
		}

		m.show = function() {
			m.modal.modal('show');
			return this;
		}

		return m;
	}
	function myOpposite(v) {return (v == 1) ? 0 : 1;}
	$.fn.clearForm = function() {
	  // iterate each matching form
	  return this.each(function() {
		// iterate the elements within the form
		$(':input', this).each(function() {
			var type = this.type, tag = this.tagName.toLowerCase();
			if (type == 'text' || type == 'password' || tag == 'textarea') {
				this.value = '';
			} else if (type == 'hidden') {
				if (!$(this)[0].hasAttribute("data-cck-keep-for-search")) {
					this.value = '';
				}
			} else if (type == 'checkbox' || type == 'radio') {
				this.checked = false;
			} else if (type == 'select-multi' || type == 'select-multiple') {
				this.selectedIndex = -1;
			} else if (tag == 'select') {
				var yo = 0;
				for (var i = 0; i < this.options.length; i++) {
					if (this.options[i].value == '') {
						yo = 1; break;
					}
				}
				if (yo) {
					this.value = '';
				} else {
					this.selectedIndex = 0;
				}
			}
		});
	  });
	};
	$.fn.conditionalState	=	function(opts) {
		var slave	= $(this);
		var rule	= opts.rule || "";
		if (opts.conditions.length>1) {
			var len		= (rule == "or") ? 1 : opts.conditions.length;
			var resX	= {};
			jQuery.each(opts.conditions, function(i,condition) {
				var master = $('#'+condition.trigger);
				if (condition.trigger && master != null) {
					var ev = condition.type;
					if (ev == "isChanged") {
						ev = "change";
					} else if (ev == "isPressed") {
						ev = "click";
					} else if (ev == "isSubmitted") {
						ev = "keypress";
					} else {
						resX[master.attr("id")] = parseInt(master.myConditional(condition.type, condition));
						var r = 0;
						jQuery.each(resX, function(k,v) {
							if (v == 1) {r++;}
						});
						if (r >= len) {res = 1;} else {res = 0;}
						jQuery.each(opts.states, function(k,opt) {
							slave.myState(0, res, opt.type, opt);
						});
						ev = "change";
					}
					master.on(ev, function(e) {
						if (ev == "keypress" && e.which != 13) {
							return;
						}
						var now = parseInt(master.myConditional(condition.type, condition));
						if (ev == "click" || ev == "keypress") { /* TODO#SEBLOD: isChanged to improve -- should it be the same of should we check initial value?? */
							var r = now;
						} else {
							var r = 0;
							resX[master.attr("id")] = now;
						}
						jQuery.each(resX, function(k,v) {
							if (v == 1) {r++;}
						});
						if (r >= len) {res = 1;} else {res = 0;}
						jQuery.each(opts.states, function(k,opt) {
							slave.myState(1, res, opt.type, opt);
						});
					});
				}
			});
		} else {
			var master	= $('#'+opts.conditions[0].trigger);
			if (opts.conditions[0].trigger && master != null) {
				var ev = opts.conditions[0].type;
				if (ev == "isChanged") {
					ev = "change";
				} else if (ev == "isPressed") {
					ev = "click";
				} else if (ev == "isSubmitted") {
					ev = "keypress";
				} else {
					var res = master.myConditional(opts.conditions[0].type, opts.conditions[0]);
					jQuery.each(opts.states, function(k,opt) {
						slave.myState(0, res, opt.type, opt);
					});
					ev = "change";
				}
				master.on(ev, function(e) {
					if (ev == "keypress" && e.which != 13) {
						return;
					}
					var res = master.myConditional(opts.conditions[0].type, opts.conditions[0]);
					jQuery.each(opts.states, function(k,opt) {
						slave.myState(1, res, opt.type, opt);
					});
				});
			}
		}
	};
	$.fn.conditionalStateLegacy	=	function(opts) {
		var master	= $('#'+opts.conditions._0isEqual.trigger);
		var slave	= $(this);
		if (opts.conditions._0isEqual.trigger && master != null) {
			var res = master.myConditional("isEqual", opts.conditions._0isEqual);
			jQuery.each(opts.states, function(k,opt) {
				slave.myState(0, res, k.substr(2), opt);
			});
			master.on("change", function() {
				var res = master.myConditional("isEqual", opts.conditions._0isEqual);
				jQuery.each(opts.states, function(k,opt) {
					slave.myState(1, res, k.substr(2), opt);
				});
			});
		}
	};
	$.fn.conditionalStates	=	function(opts) {
		var slave = $(this);
		var len   = opts.length;
		if (len === undefined) {
			if(opts.rule) {slave.conditionalState(opts);} else {slave.conditionalStateLegacy(opts);}
		} else {
			for (var i=0; i<len; i++) {
				if(opts[i].rule) {slave.conditionalState(opts[i]);} else {slave.conditionalStateLegacy(opts[i]);}
			}
		}
	};
	$.fn.deepestHeight = function() { var h = 0; $(this).each(function() { h = Math.max(h, $(this).height()); }).height(h);	};
	$.fn.isStillReady = function() { if ($(this).hasClass("busy")) { return false; } else { $(this).addClass("busy"); return true; } };
	$.fn.myAttr = function(a) {
		var $el = $(this);
		if ($el.is("select")) {
			var v = $.trim($el.find("option:selected").attr(a));
		} else if ($el.is("fieldset")) {
			var v = $.trim($el.find("input:checked").attr(a));
		} else {
			var v = $.trim($el.attr(a));
		}
		return v;
	};
	$.fn.myConditional = function(condition, opts) {
		var el	= this.attr("id");
		var status = 0;
		if (!$(this).length) {return 0;}
		switch (condition) {
			case 'callFunction':
				var func = opts.value;
				if ( window[func] ) {
					status = window[func]();
				}
				break;
			case 'isChanged':
			case 'isPressed':
				return 1;
				break;
			case 'isFilled':
			case 'isEmpty':
				if ($(this).myVal() !== undefined && $(this).myVal() !== null && $(this).myVal()!="") { status = 1; }
				if (condition=='isEmpty') { status = myOpposite(status); }
				break;
			case 'isEqual':
			case 'isDifferent':
			default:
				var values = opts.value.split(',');
				/*if ($(this).is("fieldset") {*/
				if ( this[0].tagName == 'FIELDSET' ) {
					var v = "";
					if ($('#'+el+' input:checked').length > 1) {
						$('#'+el+' input:checked').each(function() {
							v =  parseInt(myCheck($(this).val(), values));
							status = status + v;
						});
					} else {
						if ($('#'+el+' input:checked').length == 1) {
							v = $('#'+el+' input:checked').val();
						}
						status = myCheck(v, values);
					}
				} else {
					status = myCheck(this.val(), values);
				}
				if (status > 0) { status = 1; } else { status = 0; }
				if (condition=='isDifferent') { status = myOpposite(status); }
				break;
		}
		return status;
	};
	$.fn.myState = function(run, status, state, opts) {
		var bypass = 0;
		var el	= this.attr("id")+opts.selector;
		var val = opts.value;
		var revert = (opts.revert == "0") ? 0 : 1;
		switch (state) {
			case 'hasClass':
			case 'hasNotClass':
				if (state=='hasNotClass') {
					if (revert) {
						status = myOpposite(status);
					} else if ( status == 1 ) {
						status = myOpposite(status);
						revert = 1;
					}
				}
				if (status == 1) {
					$("#"+el).addClass(val);
				} else if (revert) {
					$("#"+el).removeClass(val);
				}
				break;
			case 'isEnabled':
			case 'isDisabled':
				if (state=='isDisabled') {
					if (revert) {
						status = myOpposite(status);
					} else if ( status == 1 ) {
						status = myOpposite(status);
						revert = 1;
					}
				}
				if (status == 1) {
					$("#"+el).prop("disabled", false);
				} else if (revert) {
					$("#"+el).prop("disabled", true);
				}
				break;
			case 'isFilled':
			case 'isFilledBy':
			case 'isEmpty':
				if (state=='isEmpty') {
					if (revert) {
						status = myOpposite(status);
						bypass = 1;
					} else if ( status == 1 ) {
						status = myOpposite(status);
						revert = 1;
					}
				}
				var el2 = $("#"+el).attr("id");
				var fct = "";
				if (status == 1) {
					if (state=="isFilledBy") {
						var attr = val.split('@');
						if (attr[1]) {
							val = $("#"+attr[0]).myAttr(attr[1]);
						} else {
							val = $("#"+val).myVal();
						}
					}
					fct = ($("#"+el).is(":input") || $("#"+el).is("fieldset")) ? "myVal" : "text";
					if (!(bypass && val == "")) {
						$("#"+el)[fct](val);
						if($("#_"+el2).length){
							fct = ($("#_"+el2).is(":input") ? "myVal" : "text");
							$("#_"+el2)[fct](val);
						}
					}
				} else if (revert) {
					fct = ($("#"+el).is(":input") || $("#"+el).is("fieldset")) ? "myClear" : "text";
					$("#"+el)[fct]();
					if($("#_"+el2).length){
						fct = ($("#_"+el2).is(":input") ? "val" : "text");
						$("#_"+el2)[fct]("");
					}
				}
				break;
			case 'isComputed':
				/* TODO#SEBLOD: recalc(); */
				break;
			case 'triggers':
				var el2 = $("#"+el).attr("id");
				$("#"+el2).trigger(val);
				break;
			case 'isVisible':
			case 'isHidden':
			default:
				if (state=='isHidden') {
					if (revert) {
						status = myOpposite(status);
					} else if ( status == 1 ) {
						status = myOpposite(status);
						revert = 1;
					}
				}
				if (run == 0) { val = ""; }
				if (status == 1) {
					if (val == "fade") { $("#"+el).fadeIn(); } else if (val == "slide") { $("#"+el).slideDown(); } else { $("#"+el).show(); }
				} else if (revert) {
					if (val == "fade") { $("#"+el).fadeOut(); } else if (val == "slide") { $("#"+el).slideUp(); } else { $("#"+el).hide(); }
				}			
				break;
		}
	};
	$.fn.myClear = function(v) {
		if (!this[0]){
			return;
		}
		var elem = this[0];
		if ( elem.tagName == 'FIELDSET' ) {
			if (arguments.length == 1) {
				$("#"+this.attr("id")+" input:checked").each(function() {
					if (v == $(this).val()) {
						$("#"+$(this).attr("id")).prop("checked", false);
					}
				});
			} else {
				$("#"+this.attr("id")+" input").prop("checked", false);
			}
		} else if ( elem.tagName == 'SELECT' && this.prop("multiple") ) {
			this.find('option[value="'+v+'"]').prop("selected", false);
		} else if ( elem.tagName == 'SELECT' && !this.prop("multiple") ) {
			var yo = 0;
			for (var i = 0; i < elem.options.length; i++) {
				if (elem.options[i].value == '') {
					yo = 1; break;
				}
			}
			if (yo) {
				this.val("");
			} else {
				elem.selectedIndex = 0;
			}
		} else {
			this.val("");
		}
	};
	$.fn.myVal = function(v) {
		if (arguments.length == 1) {
			var a = 1;
		} else {
			var a = 0;
			var v = "";
		}
		if (!this[0]){
			return "";
		}
		var elem = this[0];
		if ( elem.tagName == 'FIELDSET' || elem.tagName == 'DIV' ) {
			var eid = '#'+this.attr("id");
			var val = "";
			if (v) {
				$(eid+' input').val(v.split(','));
			} else {
				if ($(eid+' input:checked').length > 1) {
					$(eid+' input:checked').each(function() {
						val +=  ","+$(this).val();
					});
					return val.substr(1);
				} else {
					if ($(eid+' input:checked').length == 1) {
						return $(eid+' input:checked').val();
					} else {
						return val;
					}
				}
			}
		} else if ( elem.tagName == 'SELECT' && this.prop("multiple") ) {
			if (a) {
				return v ? this.val(v.split(',')) : this.val(v);
			} else {
				var t = this.val();
				return t === null ? [] : t;
			}
		} else {
			return (a) ? this.val(v) : this.val();
		}
	};
	$.fn.CckModal = function() {
		var modals		=	{};
		var parents		=	[];

		$(this).each( function( i, e ) {
			var element	=	$(e);
			var parent	=	false;

			if ( "undefined" !== typeof element.data('cck-modal').parent ) {
				var parent	=	element.data('cck-modal').parent;
			}
				
			var group	=	"undefined" !== typeof element.data('cck-modal').mode ? element.data('cck-modal').mode : 'ajax';

			if ( "undefined" !== typeof element.data('cck-modal').group ) {
				group	=	element.data('cck-modal').group;
			}

			if ( "undefined" !== typeof element.data('cck-modal').parent ) {
				var parent	=	element.data('cck-modal').parent;

				if ( !( parents.indexOf(parent) > -1 ) ) {
					parents.push( parent );
				}

				if ( "undefined" === typeof eval(parent).groups[group] ) {
					eval(parent).groups[group]	=	[];
				}

				eval(parent).groups[group].push( element );
			} else {
				if ( "undefined" === typeof modals[group] ) {
					modals[group]	=	[];
				}

				modals[group].push( element );
			}
		});

		$.each( parents, function( i, e ) {
			eval(e).init();
		});

		$.each( modals, function( i, e ) {
			var m		=	myModal();
			m.groups[i]	=	e;
			m.init();
		});
	};
	$(document).ready( function() {
		$('a[data-cck-modal]').CckModal();

		var style = document.createElement('style');
		style.type = 'text/css';
		style.innerText = '.modal-on{overflow:hidden;height:auto;}.modal-on.scroll-bar{overflow:unset;position:static;top:0;bottom:0;left:0;right:0}.modal-off{overflow:auto;}';
		document.getElementsByTagName('head')[0].appendChild(style);
		var isApple = !!navigator.platform && /Mac|iPad|iPhone|iPod/.test(navigator.platform);
		if (!isApple){
			$("html").addClass("scroll-bar");
		}
	});
})(jQuery);