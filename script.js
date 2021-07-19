function excluir(id){
    Swal.fire({
     title: 'Tem certeza que deseja deletar o cadastro?',
     text: "Esta operação não pode ser revertida!",
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#d33',
     cancelButtonColor: '#3085d6',
     confirmButtonText: 'SIM, delete!',
     cancelButtonText: 'CANCELA',
     }).then((result) => {
         if (result.value) {
             Swal.fire({
                type: 'success',
                title: 'Cadastro EXCLUÍDO com sucesso!',
                showConfirmButton: false,
                timer: 2000
            }); setTimeout(function(){
             window.location.href = "excluir.php?id="+id+""                        
            },2500);
         } 
     })
 }

 //função ajax para atualizar o status do ADM no DB
 $(document).ready(function(){
    $('.onoffswitch').click(function(){
        var hiddenValueID = $(this).children('#usrid').val();
        if ($(this).children('#check').val() == '1')
        {
            $(this).closest(".tb-row").removeClass('bg-color')
            $(this).children('#check').val('0')
            var valueData = '0';
        }
        else
        {
            $(this).closest(".tb-row").addClass('bg-color')
            $(this).children('#check').val('1')
            var valueData = '1';
        }

        $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {value: valueData, id: hiddenValueID} ,
            done: function(html){
                $.html(html).show();
            }
        });

    });
});