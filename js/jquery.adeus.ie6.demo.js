/**!
 * Adeus IE6 v1.0.2
 * http://www.mateussouza.com/adeus-ie6/
 *
 * Copyright 2010
 * By Mateus Souza - http://www.mateussouza.com
 * Licensed under MIT and GPL License - http://www.opensource.org/licenses/mit-license.php || http://www.gnu.org/licenses/gpl.html
 */
(function($){

$(window).bind('load', function(){
		
			var AdeusIE6 = '<div id=adeus-ei6-fundo style="margin: 0; padding: 0;position: absolute;top: 0;left: 0; display: block; z-index: 999; width: 100%; height: 100%; min-height: 100%; opacity: .5; filter:alpha(opacity=50); background: #000"></div><div id=adeus-ie6 style="margin: 0; padding: 0; border: 1px solid #096182; background: #83bed4; width: 548px;height: 410px; font-family: Arial, Helvetica, sans-serif; font-size: 15px;position: absolute; top: 50%; left: 50%; z-index: 9999; margin-left: -274px; margin-top: -250px;"><div id=adeus-ie6-topo style="margin: 0; padding: 0; background: #b5d8e5; border-top: 1px solid #f1f8fa; border-bottom: 1px solid #6d909e; padding: 20px"><h3 style="margin: 0; padding: 0; margin-bottom: 15px; color: #000; font-size: 23px; font-weight: normal; font-family: Arial, Helvetica, sans-serif; line-height: 22px; text-transform: none">Você está usando um navegador vulnerável!</h3><p style="margin: 0; padding: 0; color: #494848; margin-bottom: 15px; font-size: 15px; line-height: 22px; padding-right: 15px">A sua versão do Internet Explorer é extremamente vulnerável e não é suportada por este site. Para navegar neste site, e em outros, por favor, atualize seu navegador. Os motivos são muitos:</p><ul style="margin: 0; padding: 0; margin-left: 26px; color: #010101; line-height: 25px; font-size: 16px"><li>Ganhe mais Segurança.</li><li>Fique livre de Vírus e Spywares.</li><li>Tenha melhores Experiências Vísuais.</li><li>Total Compatibilidade com este Website e muito mais.</li></ul></div><div id=adeus-ie6-rodape style="margin: 0; padding: 0; padding: 20px 15px 20px 20px; border-top: 1px solid #FFF; color: #FFF"><div id=adeus-ie-botao><a style="margin: 0; padding: 0; background: url(img/ie.png) no-repeat left top; text-indent: -9999em; overflow: hidden;display: block;float: left; height: 80px; margin-left: -3px; margin-top: -5px;width: 260px" href="http://www.microsoft.com/downloads/details.aspx?familyid=341c2ad5-8c3d-4347-8c03-08cdecd8852b&displaylang=pt-br" title="Atualize já seu Internet Explorer para uma versão mais recente!!!">Atualizar Navegador</a></div><div id=adeus-ie6-outros style="margin: 0; padding: 0; font-size: 12px; float: right;width: 235px; display: block"><span style="margin: 0; padding: 0; margin-bottom: 5px; display: block;line-height: 15px">Use também outros navegadores:</span><a style="margin: 0; padding: 0" href="http://www.google.com/chrome?hl=pt-BR" title="Google Chrome"><img style="margin: 0;padding: 0;border: 0; display: inline" align=left src="img/chrome.png" alt="Google Chrome" title="Google Chrome"></a><a style="margin: 0; padding: 0" href="http://pt-br.www.mozilla.com/pt-BR/" title=Firefox><img style="margin: 0;padding: 0;border: 0; display: inline" align=left src="img/firefox.png" alt=Firefox title=Firefox></a><a style="margin: 0; padding: 0" href="http://www.apple.com/br/safari/download/" title=Safari><img style="margin: 0;padding: 0;border: 0; display: inline" align=left src="img/safari.png" alt=Safari title=Safari></a><a style="margin: 0; padding: 0" href="http://www.opera.com/download/" title=Opera><img style="margin: 0;padding: 0;border: 0; display: inline" align=left src="img/opera.png" alt=Opera title=Opera></a></div></div><div style="clear:both; font-size:12px; margin-left:22px;"><br />Para entrar em contato envie e-mail para: contato@joelgouveia.com.br<br /> ou ligue para: 11 9 9999-9999. Visite-me no LinkedIn</div></div>';
			
			function ajustaPosicaoAdeusIE6(e){

				//Propriedades Window
				var $w = $(window),
					wh = $w.height(),
					ww = $w.width(),
					wst = $w.scrollTop(),
					wsl = $w.scrollLeft(),
				
				//Propriedades Body
					mt = parseFloat($('body').css('margin-top')),
					ml = parseFloat($('body').css('margin-left'));

				$('body').css({
					height: wh - mt - 20,
					width: ww - ml - 20
				});
				
				$('#adeus-ei6-fundo').css({
					height: wh + wst,
					width: ww + wsl
				});

				$('#adeus-ie6').css({
					top: ($('body').height()/2) + mt + wst,
					left: ($('body').width()/2) + ml + wsl
				});
				
			};
			
			$('body').css({
				overflow: 'hidden',
				display: 'block'
			}).append(AdeusIE6);
			
			ajustaPosicaoAdeusIE6();
			
			//Resize
			$(window).resize(ajustaPosicaoAdeusIE6).scroll(ajustaPosicaoAdeusIE6);
			
			$('#adeus-ie6 p span').html($.browser.version);
			
			$('#adeus-ei6-fundo').hide().fadeIn(1000)
			
	});

}(jQuery));
