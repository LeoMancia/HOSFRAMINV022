$(document).ready(function(){
    //Declaracion de variables 
    var funcion;
    var edit = false;
    let vista = $('#vist').val();    
    //Obtener fecha para ingreso de insumos
    let date = new Date();
    rellenar_insumos();

    //Bloque que limpia los formularios del modal
    function limpiarforms(){
      $('#codigo').val('');
      $('#nominsumo').val('');
      $('#desinsumo').val('');
      $('#precio').val('');
      $('#cantidad').val('');
    }
    //bloque de codigo que crea y modifica un usuario FUNCIONANDO PARA AREAS
    $('#crearinsumos').submit(e=>{
        let codigo = $('#codigo').val();
        let nominsumo = $('#nominsumo').val();
        let desinsumo = $('#desinsumo').val();
        let precio = $('#precio').val();
        let cantidad = $('#cantidad').val();
        let estado = 1;
        let id_editado = $('#id_insumo').val();
        let fecha = date.toISOString().split('T')[0];
        
        
        if (edit==false) {
          funcion='crear_insumo';
        } else {
          funcion='editar_insumo';
        }
         
        $.post('../Controlador/insumoController.php',{codigo,nominsumo,desinsumo,precio,cantidad,estado,fecha,id_editado,funcion},(response)=>{
          console.log(response)
          if (response=='add') {              
            $('#add').hide('slow');
            $('#add').show(200);
            $('#add').hide(5000);
            limpiarforms();
            rellenar_insumos();
            $('#crearinsumos').modal('hide');
          }  if (response=='noadd') {
            $('#noadd').hide('slow');
            $('#noadd').show(200);
            $('#noadd').hide(5000);
            limpiarforms();
            //$('#crearinsumos').modal('hide');
          } if (response=='editado') {
            $('#edit-tipo').hide('slow');
            $('#edit-tipo').show(200);
            $('#edit-tipo').hide(5000);
            limpiarforms();            
            rellenar_insumos();
            //$('#crearinsumos').modal('toggle');
          }
          edit=false;
        });
       e.preventDefault();
    });


    //TESTEO Obtener datos FUNCIONANDO PARA INSUMOS
    function rellenar_insumos() {
        funcion="rellenar_insumo";
        $.post('../Controlador/insumoController.php',{funcion},(response)=>{
            const Insumos = JSON.parse(response);            
            let template='';
            $('#Table > tbody').empty();
            //Verificar la ubicacion del usuario para mostrar un tipo especifico de HTML de Insumos
            if (vista=="vpi") {
              Insumos.forEach(insumo => {
                template=`
                <tr insumoID="${insumo.id}" fecha="${insumo.Fecha}" nombreinsumo="${insumo.nombre_insumo}" desinsumo="${insumo.descripcion}" precioinsumo="${insumo.precio}" exisinsumo="${insumo.existencia}" estinsumo="${insumo.estado}" id_insumo="${insumo.id_insumo}">
                    <td>${insumo.id_insumo}</td>
                    <td>${insumo.nombre_insumo}</td>
                    <td>${insumo.descripcion}</td>
                    <td>${insumo.estado}</td>       
                    <!--Button agregar(  data-bs-toggle="modal" data-bs-target="#crearpeticion")-->             
                    <td><button class="agregar_peticion btn btn-success btn-lock" title="Agregar a peticion"></a></td>
                </tr>
                $('#Table > tbody').append(rows);
            `;
            $('#lista-compra').append(template);
            });
            } else {
              Insumos.forEach(insumo => {
                template=`
                <tr insumoID="${insumo.id}" fecha="${insumo.Fecha}" nombreinsumo="${insumo.nombre_insumo}" desinsumo="${insumo.descripcion}" precioinsumo="${insumo.precio}" exisinsumo="${insumo.existencia}" estinsumo="${insumo.estado}" id_insumo="${insumo.id_insumo}">
                    <td>${insumo.id_insumo}</td>
                    <td>${insumo.nombre_insumo}</td>
                    <td>${insumo.descripcion}</td>
                    <td>${insumo.precio}</td>
                    <td>${insumo.existencia}</td>
                    <td>${insumo.estado}</td>                    
                    <td><button class="actualizar-insumo btn btn-success btn-lock" title="Editar tipo" data-bs-toggle="modal" data-bs-target="#crearinsumos"><i class="fas fa-times-circle"></i></a></td>
                    <td><button class="borrar-insumo btn btn-danger btn-lock"><i class="fas fa-times-circle"></i></a></td>
                </tr>
                $('#Table > tbody').append(rows);
            `;
            $('#lista-compra').append(template);
            });
             }
              //Fin de la verificacion
        });
    }

    //TESTEO ELIMINAR
    $(document).on('click','.borrar-insumo',(e)=>{
        funcion ='eliminar_insumo';
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('insumoID');
        const nombreinsumo=$(elemento).attr('nombreinsumo');
        console.log(id);
       
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
            title: '¿Eliminar '+nombreinsumo+'?',
            text: "Esta accion no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.post('../Controlador/insumoController.php',{id,funcion},(response)=>{ 
                  console.log(response);
                  edit=false;
                    if (response=='borrado') {
                        swalWithBootstrapButtons.fire(
                            'Eliminado!',
                            'Registro eliminado satisfactoriamente.',
                            'success'
                        )
                        rellenar_insumos();
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
    //TESTEO 15/03/2022
    //Funcion para modificar el Insumo
    $(document).on('click','.actualizar-insumo',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('insumoID');
        const nombreinsumo=$(elemento).attr('nombreinsumo');
        const desinsumo=$(elemento).attr('desinsumo');
        const precio=$(elemento).attr('precioinsumo');
        const cantidad=$(elemento).attr('exisinsumo');
        const estado=$(elemento).attr('estinsumo');
        const codigo=$(elemento).attr('id_insumo');
        const fecha=$(elemento).attr('fecha');     
        $('#id_insumo').val(id);
        $('#codigo').val(codigo);
        $('#nominsumo').val(nombreinsumo);
        $('#desinsumo').val(desinsumo);
        $('#precio').val(precio);
        $('#cantidad').val(cantidad);  
        edit=true;
        console.log(id,nombreinsumo,desinsumo,precio,cantidad,estado,codigo,fecha);
    })

});

