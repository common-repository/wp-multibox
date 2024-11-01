MultiBox.implement({
		setContentType: function(link){
		var str = link.href.substr(link.href.lastIndexOf('.')+1).toLowerCase();
		var contentOptions = {};
		if(link.rel != null){
			var optArr = link.rel.split(',');
			optArr.each(function(el){
				var ta = el.split(':');
				contentOptions[ta[0]] = ta[1];
			});
		}
		if(contentOptions.type != undefined){
			str = contentOptions.type;
		}
		this.contentObj = {};
		this.contentObj.url = link.href;
		this.contentObj.xH = 0;
		this.contentObj.linkid = link.id;
		if(contentOptions.width){
			this.contentObj.width = contentOptions.width;
		}else{
			this.contentObj.width = this.options.movieWidth;
		}
		if(contentOptions.height){
			this.contentObj.height = contentOptions.height;
		}else{
			this.contentObj.height = this.options.movieHeight;
		}
		if(contentOptions.panel){
			this.panelPosition = contentOptions.panel;
		}else{
			this.panelPosition = this.options.panel;
		}
		switch(str){
			case 'jpg':
			case 'gif':
			case 'png':
				this.type = 'image';
				break;
			case 'swf':
				this.type = 'flash';
				break;
			case 'flv':
				this.type = 'flashVideo';
				this.contentObj.xH = 70;
				break;
			case 'mov':
				this.type = 'quicktime';
				break;
			case 'wmv':
				this.type = 'windowsMedia';
				break;
			case 'rv':
			case 'rm':
			case 'rmvb':
				this.type = 'real';
				break;
			case 'mp3':
				this.type = 'flashMp3';
				this.contentObj.width = 320;
				this.contentObj.height = 70;
				break;
			case 'element':
				this.type = 'htmlelement';
				this.elementContent = link.content;
				this.elementContent.setStyles({
					display: 'block',
					opacity: 0,
					width: 'auto'//added this to get htmlElement to behave
				})
				if(this.elementContent.getStyle('width') != 'auto'){
					this.contentObj.width = this.elementContent.getWidth();
				}
				this.contentObj.height = this.elementContent.getHeight();
				this.elementContent.setStyles({
					display: 'none',
					opacity: 1
				})
				break;
			default:
				this.type = 'iframe';
				if(contentOptions.ajax){
					this.type = 'ajax';
				}
				if(contentOptions.wpajax){
					this.type = 'wpajax';
				}
				break;
		}
	},
	showContent: function(){
		this.box.removeClass('MultiBoxLoading');
		this.removeContent();
		this.contentContainer = new Element('div').setProperties({id: 'MultiBoxContentContainer'}).setStyles({opacity: 0, width: this.contentObj.width+'px', height: (Number(this.contentObj.height)+this.contentObj.xH)+'px'}).inject(this.box,'inside');
		if(this.type == 'image'){
			this.contentObj.inject(this.contentContainer,'inside');
			this.fireEvent('success');
		}else if(this.type == 'iframe'){
			new Element('iframe').setProperties({
				id: 'iFrame'+new Date().getTime(),
				width: this.contentObj.width,
				height: this.contentObj.height,
				src: this.contentObj.url,
				frameborder: 0,
				scrolling: 'auto'
			}).inject(this.contentContainer,'inside');
			this.fireEvent('success');
		}else if(this.type == 'htmlelement'){
			this.contentContainer.setStyle('overflow', 'auto');
			this.elementContentParent = this.elementContent.getParent();
			this.elementContent.setStyle('display','block').inject(this.contentContainer,'inside');
			this.fireEvent('success');
		}else if(this.type == 'ajax'){
		  	var ActualBox = this;
			var req = new Request.HTML({
				url: this.contentObj.url,
				update: $('MultiBoxContentContainer'),
				method: 'get',
				evalScripts: true,
				onSuccess: function() {
					ActualBox.fireEvent('success');
				} 
			}).get();
		}else if(this.type == 'wpajax'){
		  	var ActualBox = this;
			var AjaxUrl = WMPAjaxParams.AjaxUrl;
			//var BlogUrl = WMPAjaxParams.BlogUrl;
			//var Trigger = link.id;
			//var Trigger = this.content.indexOf(el).id;
			//var Trigger = this.content[index].id;
			var Trigger = this.contentObj.linkid;
			if ( typeof WMPAjaxParams.AjaxLang !== "undefined" || WMPAjaxParams.AjaxLang !== null) {
			    var data = {
			      action: 'multibox_ajax_inclusion', //the POST parameter that wordpress requires to look for this action.
			      //target_id: openSlide.replace("stretch-","")
			      target_id: Trigger.replace(WMPAjaxParams.WMPclassName+"-ajax-",""),
			      //target_name: link.href.replace(BlogUrl,"")
			      lang: WMPAjaxParams.AjaxLang
			    };
			} else {
			    var data = {
			      action: 'multibox_ajax_inclusion', //the POST parameter that wordpress requires to look for this action.
			      //target_id: openSlide.replace("stretch-",""),
			      target_id: Trigger.replace(WMPAjaxParams.WMPclassName+"-ajax-","")
			      //target_name: link.href.replace(BlogUrl,""),
			    };
			}
			var req = new Request.HTML({
				url: AjaxUrl,
				update: $('MultiBoxContentContainer'),
				evalResponse: true,
				evalScripts: true,
				onSuccess: function() {
					ActualBox.fireEvent('success');
				} 
			}).post(data);
		}else{
			var obj = this.createEmbedObject().inject(this.contentContainer,'inside');
			if(this.str != ''){
				$('MultiBoxMediaObject').innerHTML = this.str;
				this.fireEvent('success');
			}
		}
		this.contentEffects = new Fx.Morph(this.contentContainer, {duration: 500});
		this.contentEffects.start({
			opacity: 1
		});
		this.title.set('html',this.contentToLoad.title);
		this.number.set('html',this.contentToLoad.number+' of '+this.content.length);
		if (this.options.descClassName) {
			if (this.description.getFirst()) {
				this.description.getFirst().destroy();
			}
			if(this.contentToLoad.desc.nodeName == 'DIV') {
				this.contentToLoad.desc.inject(this.description,'inside').setStyles({
					display: 'block'
				});
			}
	}
		//this.removeContent.bind(this).delay(500);
		if (this.options.showControls) {
			this.timer = this.showControls.bind(this).delay(800);
		}
	this.fireEvent('success');
	}
});