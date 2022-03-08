$(document).ready(function(){
    //Declaracion de variables 
    var funcion;
    var edit = false;
    rellenar_areas();
    //bloque de codigo que crea y modifica un usuario FUNCIONANDO PARA AREAS
    $('#crearcargos').submit(e=>{
        let area = $('#area').val();
        let cargo = $('#cargo').val();
        let id_editado = $('#id_cargo').val();
        
        if (edit==false) {
          funcion='crear_area';
        } else {
          funcion='editar_area';
        }
         
        $.post('../Controlador/areaController.php',{area,cargo,id_editado,funcion},(response)=>{
          console.log(response)
          if (response=='add') {              
            $('#add').hide('slow');
            $('#add').show(200);
            $('#add').hide(5000);
            $('#crearcargos').trigger('reset');
            rellenar_areas();
            
          }  if (response=='noadd') {
            $('#noadd').hide('slow');
            $('#noadd').show(200);
            $('#noadd').hide(5000);
            $('#crearcargos').trigger('reset');
          } if (response=='editado') {
            $('#edit-tipo').hide('slow');
            $('#edit-tipo').show(200);
            $('#edit-tipo').hide(5000);
            $('#crearcargos').trigger('reset');
            
            rellenar_areas();
          }
          edit=false;
        });
       e.preventDefault();
    });

    //TESTEO Obtener datos FUNCIONANDO PARA AREAS
    
    function rellenar_areas() {
        funcion="rellenar_areas";
        $.post('../Controlador/areaController.php',{funcion},(response)=>{
            console.log(response);
            const Areas = JSON.parse(response);
            let template='';
            $('#Table > tbody').empty();
            Areas.forEach(areas => {
                template=`
                <tr areaID="${areas.id}" areanombre="${areas.area}" cargonombre="${areas.cargo}">
                    <td>${areas.area}</td>
                    <td>${areas.cargo}</td>
                    <td><button class="actualizar-area btn btn-success btn-lock" title="Editar tipo" data-bs-toggle="modal" data-bs-target="#crearcargos"><i class="fas fa-times-circle"></i></a></td>
                    <td><button class="borrar-area btn btn-danger btn-lock"><i class="fas fa-times-circle"></i></a></td>
                </tr>
                $('#Table > tbody').append(rows);
            `;
            $('#lista-compra').append(template);
            });        
            
        });
    }

    //TESTEO ELIMINAR
    $(document).on('click','.borrar-area',(e)=>{
        funcion ='eliminar_area';
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('areaID');
        const area=$(elemento).attr('areanombre');
        const cargo=$(elemento).attr('cargonombre');
        console.log(id);
        console.log(area);
        console.log(cargo);
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
            title: '¿Eliminar '+cargo+' dependencia de '+area+'?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.post('../Controlador/areaController.php',{id,funcion},(response)=>{ 
                  edit=false;
                    if (response=='borrado') {
                        swalWithBootstrapButtons.fire(
                            'Eliminado!',
                            'Registro eliminado satisfactoriamente.',
                            'success'
                        )
                        rellenar_areas();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'No se pudo eliminar!',
                            'Ha surgido un problema inesperado',
                            'warning'
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

    //TESTEO 08/03/2022
    //Funcion para modificar el tipo de usuario
    $(document).on('click','.actualizar-area',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('areaID');
        const area=$(elemento).attr('areanombre');
        const cargo=$(elemento).attr('cargonombre');
        console.log(id);
        console.log(area);
        console.log(cargo);       
     

      $('#area').val(area);
      $('#cargo').val(cargo);
      $('#id_cargo').val(id);
      edit=true;
      console.log(id, area, cargo, edit);
    })

});