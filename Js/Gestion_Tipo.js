$(document).ready(function(){
    rellenar_tipos();
    var funcion;
    //bloque de codigo que crea un nuevo usuario
    $('#creartipous').submit(e=>{
        let tipo = $('#tipo').val();
        funcion='crear_tipo';
        $.post('../Controlador/tipoController.php',{tipo,funcion},(response)=>{
          if (response=='add') {              
            $('#add').hide('slow');
            $('#add').show(200);
            $('#add').hide(5000);
            $('#creartipous').trigger('reset');
            buscar_datos();
          } else {
            $('#noadd').hide('slow');
            $('#noadd').show(200);
            $('#noadd').hide(5000);
            $('#creartipous').trigger('reset');
          }
        });
        e.preventDefault();
    });

    //TESTEO

    function rellenar_tipos() {
        funcion="rellenar_tipos";
        $.post('../Controlador/tipoController.php',{funcion},(response)=>{
            console.log(response);
            const Tipos = JSON.parse(response);
            let template='';
            Tipos.forEach(tipos => {
                template=`
                <tr prodID="${tipos.id}">
                    <td>${tipos.id}</td>
                    <td>${tipos.tipo}</td>
                    <td><button class="borrar-producto btn btn-danger btn-lock"><i class="fas fa-times-circle"></i></a></td>
                </tr>
            `;
            console.log(tipos.id);
            $('#lista-compra').append(template);
            });
            
            
        });

    }

});