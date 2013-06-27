$(document).ready(function(){
	
	 
		$('#mensagem[placeholder], #indica[placeholder], #www[placeholder], #email[placeholder], #celular[placeholder], #empresa[placeholder], #nome[placeholder], #cidade[placeholder], #telefone[placeholder]').each(function(){
			var ph = $(this).attr('placeholder');
			$(this).val(ph).focus(function(){
					if($(this).val() == ph) $(this).val('');
			}).blur(function(){
			
			if(!$(this).val()) $(this).val(ph);
			});
		});
			
	
}); 


