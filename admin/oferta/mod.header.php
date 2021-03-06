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




//para o select de estado/cidade
$sltCidade = isset($val['cidade']) && !empty($val['cidade']) ? ', cidade:'.$val['cidade'] :'';

//variavel de paginacao
$pag = isset($_GET['pg'])?'&pg='.$_GET['pg']:'';

$include_js = <<<end
    <script type="text/javascript" src="${rp}js/bettertip/jquery.bettertip.js"></script>
    <script type="text/javascript" src="${rp}js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="${rp}js/jGrowl-1.2.4/jquery.jgrowl.js"></script>
    <script type="text/javascript" src="${rp}js/jquery.tablednd.js"></script>
    <script type="text/javascript" src="${rp}js/jquery.maskedinput-1.2.2.min.js"></script>
    <script type="text/javascript" src="${rp}js/tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>
    <script type="text/javascript" src="${rp}js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="${rp}js/date-picker/js/datepicker.js"></script>
    <script type="text/javascript" src="${rp}js/jquery.price_format.js"></script>
    <script type="text/javascript" src="${rp}js/jquery.query.js"></script>

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



   var num_total = $('#num_total').text();
   num_total = parseInt(num_total);



  /*
	 *CHECK-ALL
   **************************/
	$('[name="check-all"]').click(function(){

	  if($(this).attr('checked')==true)
	   $('.check').attr('checked',true);

	   else $('.check').attr('checked',false);

	});


   /*
    *ordernação da listagem
    */
   $('#orderby').change(function(){
    window.location.href='?p=oferta${pag}&orderby='+$(this).val();
   });



  /*
   *select de ações
   */
	$('select[name=actions]').change(function() {
       var acao = $(this).val();
       var nChecked = $('.check:checked').length;


            if(acao=='delete' && nChecked>0) {
            $LOADING

                $.ajax({
                 type:'POST',
                 data:$('.check:checked').serialize(),
                 url: '${rp}?p=$p&delete&noVisual',

                 error:function() {
                    $.unblockUI();
                    $.growlUI('ERRO:','Erro inesperado!');
                 },

                 success:function(data) {
                    $.unblockUI();
                    $.growlUI('Resposta:',data);

                      $('.check:checked').each(function(i) {
                       $('#tr'+$(this).val()).hide();
                       $('#num_total').text(num_total-(i+1));
                      });

                    $('.check').attr('checked',false);
                 }

                });


            }


            if(acao=='ativar' && nChecked>0 || acao=='banir' && nChecked>0) {
            $LOADING

                $.ajax({
                 type:'POST',
                 data:$('.check:checked').serialize()+'&acao='+acao,
                 url: '${rp}?p=$p&status&noVisual',

                 error:function() {
                    $.unblockUI();
                    $.growlUI('ERRO:','Erro inesperado!');
                 },

                 success:function(data) {
                    $.unblockUI();
                    $.growlUI('Resposta:',data);

                       if(acao=='ativar') {

                          $('.check:checked').each(function(i) {
                           $('.status'+$(this).val()).html('<font class="red">Banir</font>');
                           $('#status'+$(this).val()).html('<font class="green">Ativo</font>');
                          });

                       } else {

                          $('.check:checked').each(function(i) {
                           $('.status'+$(this).val()).html('<font class="green">Re-ativar</font>');
                           $('#status'+$(this).val()).html('<font class="red">Banido</font>');
                          });

                       }


                    $('.check').attr('checked',false);

                 }

                });


            }
         $.unblockUI();

	});





      // mascaras
      $('.data').mask('99/99/9999');
      $('.cep').mask('99.999-999');
      $('#valor_normal').priceFormat({
          prefix: 'R$ ',
          centsSeparator: ',',
          thousandsSeparator: '.'
      });


      // tinymce, add bbcode no textarea texto
      $('.tinymce').tinymce({ $TinyMCE });




      /*
       *funcao que retorna as cidades de acordo com o estado selecionado
       */
      function sltCidade (This) {

        $('#cidade').html('<option value="">aguarde...</option>');
        $LOADING

        $.post("${rp}_inc/inc.cidade_uf.php", { estado:This$sltCidade },
          function(data){
          $.unblockUI(); 
          $('#cidade').html(data);
        });	

      }

      $("#estado").change(function(){
       sltCidade($(this).val());
      });



      $.each($.query.get(), function(key, value) {


        if(key=='insert' || key=='update') {

          var estado_valor = $('#estado').val();
          if(estado_valor!='')
           sltCidade(estado_valor);

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

          $LOADING
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

          $LOADING
          $.ajax({
            type: "POST",
            url: href_trash,
            data: 'item='+id_trash,
            success: function(data){
             $.unblockUI();
             $.growlUI('Remoção',data);
             $('#tr'+id_trash).hide();
             $('#num_total').text(num_total-1);
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

    $LOADING
		$.ajax({
			type: "POST",
			url: href_status,
      data: 'item='+id_status,
			success: function(data){
			 $.unblockUI();
			 $.growlUI('Status',data);  

			 if(texto_status=='Pendente') {
			   $('.status'+id_status).html('<font class="green">Ativo</font>');

         } else {
			    $('.status'+id_status).html('<font color="#999999">Pendente</font>');
         }
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
