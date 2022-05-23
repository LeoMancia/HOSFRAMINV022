$(document).ready(function(){
//Declaracion de variables 
$('.select2').select2({
    dropdownParent: $('#crearusuarios .modal-content')
  });
  
  var funcion;
  let vista = $('#rol').val();    
  peticiones();

  if (vista==1  || vista==3) {
    template2=`
    <tr>
    <th scope="col">Codigo de Petición</th>
    <th scope="col">Nombre Insumo</th>
    <th scope="col">Area</th>
    <th scope="col">Fecha de peticion</th>
    <th scope="col">Cantidad Solicitada</th>
    <th scope="col">Imprimir Vale</th>
    <th scope="col">Marcar como entregado</th>
    </tr>
    $('#Table > thead').append(rows);
`;
$('#encabezado').append(template2);
  } else {
    template2=`
    <tr>
    <th scope="col">Codigo de Petición</th>
    <th scope="col">Nombre Insumo</th>
    <th scope="col">Area</th>
    <th scope="col">Fecha de peticion</th>
    <th scope="col">Cantidad Solicitada</th>
    <th scope="col">Imprimir Vale</th>
    </tr>
    $('#Table > thead').append(rows);
`;
$('#encabezado').append(template2);
  }
  //Funcion Get a tabla Vale salida, para llenar la tabla en la vista peticionesxpersonas
  function peticiones(consulta) {
      funcion = "obtener_peticiones";
      $.post('../Controlador/peticionController.php',{consulta,funcion},(response)=>{
        const Peticiones = JSON.parse(response);
        //console.log(response);
        let template='';
        $('#Table > tbody').empty();
       //verificar el rol del usuario
       if (vista==1 || vista==3) {
      
        Peticiones.forEach(peticion => {
           template=`
            <tr peticionID="${peticion.CodigoPeticion}" fecha="${peticion.Fecha}" nombreinsumo="${peticion.nombre_insumo}" desinsumo="${peticion.descripcion}" precioinsumo="${peticion.precio}" exisinsumo="${peticion.existencia}" estinsumo="${peticion.estado}" prodcant="${peticion.existencia}" id_insumo="${peticion.id_insumo}" IdUnico="${peticion.IDPeticion}">
                <td style="text-align: center">${peticion.CodigoPeticion}</td>
                <td style="text-align: center">${peticion.NombreProd}</td>
                <td style="text-align: center">${peticion.AreaPeticion}</td>       
                <td style="text-align: center">${peticion.Fecha}</td>
                <td style="text-align: center">${peticion.cantSolicitada}</td>
                        
                <td style="text-align: center"><button class="imprimir_peticion btn btn-success btn-lock" title="Imprimir vale"></a></td>
                <td style="text-align: center"><button class="cambiar_estado btn btn-danger btn-lock" title="Imprimir vale"></a></td>
            </tr>
            $('#Table > tbody').append(rows);
        `;
        $('#lista-compra').append(template);
        });
       } else {
        Peticiones.forEach(peticion => {
            template=`
                <tr peticionID="${peticion.CodigoPeticion}" fecha="${peticion.Fecha}" nombreinsumo="${peticion.nombre_insumo}" desinsumo="${peticion.descripcion}" precioinsumo="${peticion.precio}" exisinsumo="${peticion.existencia}" estinsumo="${peticion.estado}" prodcant="${peticion.existencia}" id_insumo="${peticion.id_insumo}" IdUnico="${peticion.IDPeticion}">
                <td style="text-align: center">${peticion.CodigoPeticion}</td>
                <td style="text-align: center">${peticion.NombreProd}</td>
                <td style="text-align: center">${peticion.AreaPeticion}</td>       
                <td style="text-align: center">${peticion.Fecha}</td>
                <td style="text-align: center">${peticion.cantSolicitada}</td>                        
                <td><button class="imprimir_peticion btn btn-success btn-lock" title="Imprimir vale"></a></td>
            </tr>
            $('#Table > tbody').append(rows);
        `;
        $('#lista-compra').append(template);
        });
       }
      });
  }

     //Metodo para para cambiar el estado de la peticion de Pendiente a Despachado
  $(document).on('click','.cambiar_estado',(e)=>{
    const elemento= $(this)[0].activeElement.parentElement.parentElement;
    var Id=$(elemento).attr('IdUnico');
    funcion = "cambiar_estado";
    Swal.fire({
        title: '¿Quiere marcar esta peticion como entregada?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar!'
      }).then((result) => {
        if (result.isConfirmed) {
            
            $.post('../Controlador/peticionController.php',{Id,funcion},(response)=>{
                console.log(response);
                if (response=='editado') {
                    Swal.fire(
                        'Estado de la operación',
                        'Completado exitosamente'
                      )
                    peticiones();
                } 
            }); 
s        }
      })
    })

  //Metodo para imprimir el vale de peticiones 
  $(document).on('click','.imprimir_peticion',(e)=>{
      //funcion = "imprimir_vale";
      const elemento= $(this)[0].activeElement.parentElement.parentElement;
      var Id=$(elemento).attr('peticionID');
      $.post('../Vistas/reporte.php',{Id:Id,btnPDF:"btnPDF"},function () {
          window.open('../Vistas/reporte.php');
      })
  })

  //bloque de codigo que captura lo que se escribe en el teclado
    //y lo manda a la funcion obtener_peticiones
    $(document).on('keyup','#buscar-peticion',function(){
        let valor = $(this).val();
        if (valor !="") {
            peticiones(valor);
            //console.log(valor)
        } else {
            peticiones();
        }
    }); 

})