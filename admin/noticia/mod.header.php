<?php
## NOTA: CASO EM NENHUM OUTRO MODULO SEJA DEFINIDO O ARQUIVO HEADER, ESSE SERA O ARQUIVO PADRAO


# CSS INCLUIDO NO inc.header.php
//<link href="css/reset.css" rel="stylesheet" />
$include_css = <<<end
     <link rel="stylesheet" type="text/css" href="${rp}js/jGrowl-1.2.4/jquery.jgrowl.css"/>
     <link rel="stylesheet" href="${rp}js/bettertip/jquery.bettertip.css" type="text/css" />
     <link href="${rp}js/date-picker/css/datepicker.css" rel="stylesheet" type="text/css" />
     <style>
       div.growlUI { 
	background: url(${rp}images/warning.png) no-repeat;
	height:50px;
       } div.growlUI h1, div.growlUI h2 {
	color: white;
	padding: 5px 5px 5px 60px;
	text-align: left;
	font-family:'Tahoma';
       } td.showDragHandle {
	background-image: url(${rp}images/drag.gif);
	background-repeat: no-repeat;
	background-position: center center;
	cursor: move;

      }.tDnD_whileDrag {
	background-color: #eee;
      }
     </style>
end;


# JS INCLUIDO NO inc.header.php, também pode conter codigo js <script>alert();</script>
/*
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.tipTip.js"></script>
*/

   $send_adm_id = '';
   if($act=='insert') {

     $radio_checkbox = "$('.radio').hide().removeClass('required').attr('disabled','disabled');";
    
   } else {

     if($val['enviar_para']=='para todos') {

		$radio_checkbox = "$('.checkbox').show();\n\t$('.radio').hide().attr('disabled','disabled');";

      } else {

	    $radio_checkbox = " $('.checkbox').hide().attr('disabled','disabled');\n\t$('.radio').show();";
	    $send_adm_id = ", 'send_adm_id': $('#send_adm_id').val()";

      }


   }






$include_js = <<<end
    <script type="text/javascript" src="${rp}js/bettertip/jquery.bettertip.js"></script>
    <script type="text/javascript" src="${rp}js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="${rp}js/jGrowl-1.2.4/jquery.jgrowl.js"></script>
    <script type="text/javascript" src="${rp}js/jquery.tablednd.js"></script>
    <script type="text/javascript" src="${rp}js/jquery.maskedinput-1.2.2.min.js"></script>
    <script type="text/javascript" src="${rp}js/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript" src="${rp}js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="${rp}js/date-picker/js/datepicker.js"></script>
    
    

<script>
  $(function(){
      // validação do formulario, todos os campos com a classe
      // class="required" serao validados
	var container = $('div.container-error');
	// validate the form when it is submitted
	var validator = $(".form").validate({
		errorContainer: container,
		errorClass: 'error-validate',
		errorLabelContainer: $("ol", container),
		wrapper: 'li',
		meta: "validate"
	});
      

      // mascara para data
      $('#data').mask('99/99/9999');

      // tinymce, add bbcode no textarea texto
      $('textarea#texto').tinymce({ $TinyMCE });


      // adiciona mais um campo file a cada vez que é clicado no elemento
      // com a classe class="addImagem"
      $('.addImagem').click(function(){
       var i = parseInt($('.imagem:last').attr('alt'));

        $('.divImagem:first').clone().insertAfter('.divImagem:last');
        $('.divImagem:last > .imagem').attr('name','imagem'+(i+1)).attr('alt',(i+1)).val('');
      });


    // ao arrastar alguma linha altera a posição dos elementos
    // e altera na banco
    $('#posImagem').tableDnD({
        onDrop: function(table, row) {

	      $.ajax({
		 type: "POST",
		 url: "$p/inc.imagem.pos.php",
		 data: $.tableDnD.serialize()
	      });

        }
    });

    // al passar o mouse sobre a linha add a classe para mostrar a imagem de +
    $("#posImagem tr").hover(function() {
       $(this.cells[0]).addClass('showDragHandle');
    }, function() {
        $(this.cells[0]).removeClass('showDragHandle');
    });




    /*
     *ao alterar o radio de para quem enviar executa acao
     */
    $('[name="to_all"]').change(function(){

	if($(this).val()==0) {
	   $('.checkbox').hide().removeClass('required').attr('disabled','disabled');
	   $('.radio').show().addClass('required').removeAttr('disabled');
	   $('#user_especifico').show();

	} else {
	   $('.checkbox').show().addClass('required').removeAttr('disabled');
	   $('.radio').hide().removeClass('required').attr('disabled','disabled');
	   $('#user_especifico option:selected').val('0')
	   $('#user_especifico').hide()

	}

    });


    $radio_checkbox




    /*
     *se a a noticia for direcionada a um usuario especifico
	 *e for update, vai pegar o que tiver checado
     */
    $('.radio').each(function(){

       $('#user_id').removeClass('required');
       if($(this).attr('checked')==true && $(this).attr('disabled')!=true) {
        $('#user_especifico').load('${ap}inc.user_especifico.php',{ 'cat_id': $(this).val() $send_adm_id });
	$('#user_id').addClass('required');

       } 

    });


    /*
	 *caso haja alteração do campo  
     */
    $('.radio').change(function(){

       $('#user_id').removeClass('required');
       if($(this).attr('checked')==true && $(this).attr('disabled')!=true) {
        $('#user_especifico').load('${ap}inc.user_especifico.php',{ 'cat_id': $(this).val() });
	$('#user_id').addClass('required');

  	}
    });








	/* APAGA IMAGEM/ARQUIVO
	************************************/
	$(".trash-imagem").click(function(event){
	 event.preventDefault();
  	 var id_trash = $(this).attr('id');
  	 var href_trash = $(this).attr('href');

	  $.blockUI({
	   message: "<p>Tem certeza que deseja remover?</p><br><input type='submit' value='sim' id='trash-imagem-sim'> <input type='button' value='não' id='trash-imagem-nao'>"
	  });

	// ACAO AO CLICAR EM NaO
	     $("#trash-imagem-nao").click(function(){
	      $.unblockUI();
	      return false;
	     });


	// ACAO AO CLICAR EM SIM
	     $("#trash-imagem-sim").click(function(){

		// BOX DE CARREGAMENTO
		$.blockUI({
		 message: "<img src='images/loading.gif'>",
		 css: { 
                   top:  ($(window).height()-32)/2+'px', 
                   left: ($(window).width()-32)/2+'px', 
		   width: '32px' 
            	 } 
		});

		$.ajax({
			type: "POST",
			url: href_trash,
			success: function(data){
			 $.unblockUI();
			 $.growlUI('Remoção',data);  
			 $('#tr'+id_trash).hide();
			}
		});

	     });



	});
	/* FIM: APAGA*/





   /* LISTAGEM */


	/* APAGA 
	************************************/
	$(".trash").click(function(event){
	 event.preventDefault();
  	 var id_trash = $(this).attr('id');
  	 var href_trash = $(this).attr('href');
  	 var nome_trash = $(this).attr('name');

	  $.blockUI({
	   message: "<p>Tem certeza que deseja remover <b>"+nome_trash+"</b>?</p><br><input type='submit' value='sim' id='trash-sim'> <input type='button' value='não' id='trash-nao'>"
	  });

	// ACAO AO CLICAR EM NaO
	     $("#trash-nao").click(function(){
	      $.unblockUI();
	      return false;
	     });


	// ACAO AO CLICAR EM SIM
	     $("#trash-sim").click(function(){

		// BOX DE CARREGAMENTO
		$.blockUI({
		 message: "<img src='images/loading.gif'>",
		 css: { 
                   top:  ($(window).height()-32)/2+'px', 
                   left: ($(window).width()-32)/2+'px', 
		   width: '32px' 
            	 } 
		});

		$.ajax({
			type: "POST",
			url: href_trash,
			success: function(data){
			 $.unblockUI();
			 $.growlUI('Remoção',data);  
			 $('#tr'+id_trash).hide();
			}
		});

	     });



	});
	/* FIM: APAGA*/


	/* STATUS 
	************************************/
	$(".status").click(function(event){
	 event.preventDefault();
  	 var id_status = $(this).attr('id');
  	 var texto_status = $(this).text();
  	 var href_status  = $(this).attr('href');
  	 var nome_status  = $(this).attr('name');

		// BOX DE CARREGAMENTO
		$.blockUI({
		 message: "<img src='images/loading.gif'>",
		 css: { 
                   top:  ($(window).height()-32)/2+'px', 
                   left: ($(window).width()-32)/2+'px', 
		   width: '32px' 
            	 } 
		});

		$.ajax({
			type: "POST",
			url: href_status,
			success: function(data){
			 $.unblockUI();
			 $.growlUI('Status',data);  

			 if(texto_status=='Ativo')
			   $('.status'+id_status).html('<font color="#999999">Pendente</font>');

			   else
			    $('.status'+id_status).html('<font color="#000000">Ativo</font>');
			}
		});


	});
	/* FIM: STATUS*/



	/* MOSTRA AS ACOES AO PASSAR O MOUSE SOBRE A TR DO ÍTEM DA TABELA*/
	$('.list tr').bind('mouseenter',function(){
	 $(this).find('.row-actions').css('visibility','visible');
	}).bind('mouseleave',function(){
	 $(this).find('.row-actions').css('visibility','hidden');
	});
  });
</script>
end;

?>
