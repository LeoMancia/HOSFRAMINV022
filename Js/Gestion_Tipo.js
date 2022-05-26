$(document).ready(function(){
    //Declaracion de variables 
    var funcion;
    var edit = false;
    rellenar_tipos();
    //Bloque que limpia los formularios del modal
    function limpiarforms(){
      $('#tipo').val('');
      $('#id_editar_tipo').val('');
    }
    //bloque de codigo que crea y modifica un usuario
    $('#creartipous').submit(e=>{
        let tipo = $('#tipo').val();
        let id_editado = $('#id_editar_tipo').val();
        let expresiontipo =/^[A-Za-z\s]+$/g;
        var OK = expresiontipo.exec(tipo);
        if (!OK) {
          Swal.fire({
            title: '¡Error!',
            html:
            'Las tipo de usuario debe contener:</br> ' +
            '<b> - Solamente letras</b>,</br>' +
            '<b> - Minusculas y Mayusculas</b>,</br>',
            showClass: {
              popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
              popup: 'animate__animated animate__fadeOutUp'
            }
          })
          $('#tipo').focus();
          $('#tipo').val('');
        } else {
          if (edit==false) {
          funcion='crear_tipo';
        } else {
          funcion='editar_tipo';
        }
         
        $.post('../Controlador/tipoController.php',{tipo,id_editado,funcion},(response)=>{
          console.log(response)
          if (response=='add') {              
            $('#add').hide('slow');
            $('#add').show(200);
            $('#add').hide(5000);
            $('#creartipous').trigger('reset');
            rellenar_tipos();
            limpiarforms();
          }  if (response=='noadd') {
            $('#noadd').hide('slow');
            $('#noadd').show(200);
            $('#noadd').hide(5000);
            limpiarforms();
          } if (response=='editado') {
            $('#edit-tipo').hide('slow');
            $('#edit-tipo').show(200);
            $('#edit-tipo').hide(5000);
            limpiarforms();            
            rellenar_tipos();
          }
          edit=false;
        });
        }
       e.preventDefault();
    });

    //TESTEO Obtener datos
    
    function rellenar_tipos() {
        funcion="rellenar_tipos";
        $.post('../Controlador/tipoController.php',{funcion},(response)=>{
            console.log(response);
            const Tipos = JSON.parse(response);
            let template='';
            $('#Table > tbody').empty();
            Tipos.forEach(tipos => {
                template=`
                <tr tipoID="${tipos.id}" tiponombre="${tipos.tipo}">
                    <td>${tipos.tipo}</td>
                    <td><button class="actualizar-tipo btn btn-success btn-lock" title="Editar tipo" data-bs-toggle="modal" data-bs-target="#creartipous"><i class="fas fa-times-circle"></i></a></td>
                    <td><button class="borrar-tipo btn btn-danger btn-lock"><i class="fas fa-times-circle"></i></a></td>
                </tr>
                $('#Table > tbody').append(rows);
            `;
            $('#lista-compra').append(template);
            });        
            
        });
    }

    //TESTEO ELIMINAR
    $(document).on('click','.borrar-tipo',(e)=>{
        funcion ='eliminar_tipo';
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('tipoID');
        const nombre=$(elemento).attr('tiponombre');
        console.log(id);
        console.log(nombre);
       
        console.log(funcion);
        $('#id').val(id);
        $('#funcion').val(funcion);
       const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success ml-1',
              cancelButton: 'btn btn-danger mt-10'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: '¿Eliminar '+nombre+'?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.post('../Controlador/tipoController.php',{id,funcion},(response)=>{ 
                  edit=false;
                    if (response=='borrado') {
                        swalWithBootstrapButtons.fire(
                            'Eliminado!',
                            'Registro eliminado satisfactoriamente.',
                            'success'
                        )
                        rellenar_tipos();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'No se pudo eliminar!',
                            'Ha surgido un problema inesperado',
                            'success'
                        )
                    }
                    
                }) 
              
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'NO se han realizado cambios',
                'error'
              )
            }
          })

    })  

    //TESTEO 07/03/2022
    //Funcion para modificar el tipo de usuario
    $(document).on('click','.actualizar-tipo',(e)=>{
      const elemento= $(this)[0].activeElement.parentElement.parentElement;
      const id=$(elemento).attr('tipoID');
      const nombre=$(elemento).attr('tiponombre');
      $('#id_editar_tipo').val(id);
      $('#tipo').val(nombre);
      edit=true;
      console.log(id, nombre, edit);
    })

});