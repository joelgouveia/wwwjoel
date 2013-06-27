//CONTAGEM DE CARACTERES
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}

$(document).ready(function(){
	 //FILTRO
	$("#filter input").change(function(){
		var option_id = $('#filter input[name=type]:checked').val();
		var select = $('#reason');
		var option_to_select = $('option[value="' + option_id + '"]', select);
		select.val(option_to_select.val()).change();

		$.get($('#filter input[name=type]:checked').val(), function(data) {
			$('.image-grid').quicksand( $(data).find('li'), {adjustHeight: 'dynamic', useScaling: true} );
		}, "html");	
		e.preventDefault();		
	});
	
	//NAVEGAÇÃO MENU
	$('body').scrollspy({offset: 200});
	$('#menuh').scrollspy();
	
	$('#menuv li a').bind('click', function(e) {
        e.preventDefault();
        target = this.hash;
		//alert(target);
        //$.scrollTo(target, 1000);
		if(target != ''){
			$('html, body').animate({scrollTop: $(""+target+"").offset().top - 70}, 1000);
		}
   });
   
   $('#menuh li a').bind('click', function(e) {
        e.preventDefault();
        target = this.hash;
		//alert(target);
        //$.scrollTo(target, 1000);
		if(target != ''){
			$('html, body').animate({scrollTop: $(""+target+"").offset().top - 100}, 1000);
		}
   });
   
   
   $('#menum li a').bind('click', function(e) {
        e.preventDefault();
        target = this.hash;
		//alert(target);
        //$.scrollTo(target, 1000);
		if(target != ''){
			$('html, body').animate({scrollTop: $(""+target+"").offset().top - 100}, 1000);
		}
		$(".nav-collapse").css('height','0px');
		$(".nav-collapse").removeClass('in')
   });
   
   // MODAL 
   $('.launchmodal').click(function(){
	 	$('#launch').modal('toggle');  
	   
   });
   
   $('.orcamento').click(function(){
	 	$('#launch').modal('toggle');  
	}); 
   
   //MÁSCARAS
    $("#telefone").mask("(99) 9999-9999");
	
	// jQuery Masked Input
	$('#celular').mask("(99) 9999-9999?9").ready(function(event) {
		var target, phone, element;
		target = (event.currentTarget) ? event.currentTarget : event.srcElement;
		phone = target.value.replace(/\D/g, '');
		element = $(target);
		element.unmask();
		if(phone.length > 10) {
			element.mask("(99) 99999-999?9");
		} else {
			element.mask("(99) 9999-9999?9");  
		}
	});
	
	$('#celular').focusout(function(){
		var phone, element;
		element = $(this);
		element.unmask();
		phone = element.val().replace(/\D/g, '');
		if(phone.length > 10) {
			element.mask("(99) 9 9999-999?9");
		} else {
			element.mask("(99) 9999-9999?9");
		}
	}).trigger('focusout');

   
  	$('#formv').validate({
            rules:{
                nome:{lettersonly: true, required: true},
                email: {required: true, email: true},
				empresa:{lettersonly: true},
				cidade:{lettersonly: true},
				www:{letterswithbasicpunc: true},
				indica:{letterswithbasicpunc: true},
				mensagem:{letterswithbasicpunc: true, required: true,}
			},
            messages:{
                 nome:{lettersonly: "Somente letras.", required: "Nome é necessário"},
				 email:{email: "Digite um e-mail válido.", required: "E-mail é necessário"},
				 empresa:{lettersonly: "Somente letras."},
				 cidade:{lettersonly: "Somente letras."},
				 www:{letterswithbasicpunc: "Somente letras e números."},
				 indica:{letterswithbasicpunc: "Somente letras e números."},
				 mensagem:{letterswithbasicpunc: "Somente letras e números.", required: "Alguma mensagem é necessária."}
				 
			}
        }); 
		
		
	// FUNÇÃO MOBILE	
	$("#projetos").swiperight(function() {  
      $("#projetos").carousel('prev');  
    });  

   $("#projetos").swipeleft(function() {  
      $("#projetos").carousel('next');  
   });  
		
	//TOOLTIP
	 var targets = $( '[rel~=tooltip]' ),
        target  = false,
        tooltip = false,
        title   = false;
 
    targets.bind( 'mouseenter', function()
    {
        target  = $( this );
        tip     = target.attr( 'title' );
        tooltip = $( '<div id="tooltip"></div>' );
 
        if( !tip || tip == '' )
            return false;
 
        target.removeAttr( 'title' );
        tooltip.css( 'opacity', 0 )
               .html( tip )
               .appendTo( 'body' );
 
        var init_tooltip = function()
        {
            if( $( window ).width() < tooltip.outerWidth() * 1.5 )
                tooltip.css( 'max-width', $( window ).width() / 2 );
            else
                tooltip.css( 'max-width', 340 );
 
            var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
                pos_top  = target.offset().top - tooltip.outerHeight() - 20;
 
            if( pos_left < 0 )
            {
                pos_left = target.offset().left + target.outerWidth() / 2 - 20;
                tooltip.addClass( 'left' );
            }
            else
                tooltip.removeClass( 'left' );
 
            if( pos_left + tooltip.outerWidth() > $( window ).width() )
            {
                pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
                tooltip.addClass( 'right' );
            }
            else
                tooltip.removeClass( 'right' );
 
            if( pos_top < 0 )
            {
                var pos_top  = target.offset().top + target.outerHeight();
                tooltip.addClass( 'top' );
            }
            else
                tooltip.removeClass( 'top' );
 
            tooltip.css( { left: pos_left, top: pos_top } )
                   .animate( { top: '+=10', opacity: 1 }, 50 );
        };
 
        init_tooltip();
        $( window ).resize( init_tooltip );
 
        var remove_tooltip = function()
        {
            tooltip.animate( { top: '-=10', opacity: 0 }, 50, function()
            {
                $( this ).remove();
            });
 
            target.attr( 'title', tip );
        };
 
        target.bind( 'mouseleave', remove_tooltip );
        tooltip.bind( 'click', remove_tooltip );
    });


	$("[rel=tooltip]").click(function(event) {
	  event.preventDefault();
	});

	

}); 



   