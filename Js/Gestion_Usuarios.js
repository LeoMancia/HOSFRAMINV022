$(document).ready(function(){
  //Declaracion de variables 
  $('.select2').select2({
    dropdownParent: $('#crearusuarios .modal-content')
  });
  
  var funcion;
  var edit = false;
  var edit = false;
    areas();
    tipos();
    rellenar_usuario();
    //Bloque que limpia los formularios del modal
    function limpiarforms(){
      $('#id_usuario').val('');
      $('#nombreusuario').val('');
      $('#apellidousuario').val('');
      $('#username').val('');
      $('#password').val('');
    }
    //console.log()

   //Funcion para llenar combo de areas
   function areas() {
    funcion="rellenar_areas";
    $.post('../Controlador/areaController.php',{funcion},(response)=>{
        const Areas = JSON.parse(response);
        let template='';
        Areas.forEach(areas => {
            
            template+=`
            <option value="${areas.id}">${areas.area}</option>
            `;
        });
        $('#area').html(template);
    })
}
function tipos() {
  funcion="rellenar_tipos";
  $.post('../Controlador/tipoController.php',{funcion},(response)=>{
      const Tipos = JSON.parse(response);
      let template='';
      Tipos.forEach(tipos => {
          template+=`
          <option value="${tipos.id}">${tipos.tipo}</option>
          `;
      });
      $('#tipos').html(template);
  })
}
  //bloque de codigo que crea y modifica un usuario FUNCIONANDO PARA AREAS
  $('#crearusuarios').submit(e=>{
      let nombre = $('#nombreusuario').val();
      let apellido = $('#apellidousuario').val();
      let username = $('#username').val();
      let password = $('#password').val();
      let area = $('#area').val();
      let tipo = $('#tipos').val();
      let id_editado = $('#id_usuario').val();
      let expresiontextos =/^[A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙ\s]+$/;
      let expresiontextos1 =/^[A-Za-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙ\s]+$/;
      let expresionuser =/^[A-Za-z\d]+$/;
      let expresionpass =/^[A-Z-a-z\d]{4,10}$/;
      var OK = expresionpass.exec(password);
      var OKtext = expresiontextos.exec(nombre);
      var OKtexts = expresiontextos1.exec(apellido);
      var OKuser = expresionuser.exec(username);
      if (!OKtext) {
        let input = "Nombre";
        error(input);
        $('#nombreusuario').focus();
        $('#nombreusuario').val('');
      } else {
        if (!OKtexts) {
          let input = "Apellido";
          error(input);
          $('#apellidousuario').focus();
          $('#apellidousuario').val('');
        } else {
          if (!OKuser) {
            let input = "UserName";
            error(input);
            $('#username').focus();
            $('#username').val('');
          } else {
           if (!OK) {
            let input = "Contraseña";
            error(input);
            $('#password').focus();
            $('#password').val('');
           } else {
            if (edit==false) {
              funcion='crear_usuario';
            } else {
              funcion='editar_usuario';
            }
            //console.log(nombre,apellido,username,password,area,tipo,id_editado,funcion);
            $.post('../Controlador/usuarioController.php',{nombre,apellido,username,password,area,tipo,id_editado,funcion},(response)=>{
              //console.log(response);
              if (response=='add') {              
                $('#add').hide('slow');
                $('#add').show(200);
                $('#add').hide(5000);
                limpiarforms();
                rellenar_usuario();
              }  if (response=='noadd') {
                $('#noadd').hide('slow');
                $('#noadd').show(200);
                $('#noadd').hide(5000);
                limpiarforms();
              } if (response=='editado') {
                $('#edit-user').hide('slow');
                $('#edit-user').show(200);
                $('#edit-user').hide(5000);
                limpiarforms();            
                rellenar_usuario();
              }
              edit=false;
            });
           }
          }
        }
      }
      e.preventDefault();
  });

  //Funcion que valida cada campo del modal de ingresar nuevo insumo
  function error(input) {
    switch (input) {

        case "Nombre":
          var error1 = '<b> - Solamente letras</b>,</br>';
          var error2 = '<b> - Minusculas y Mayusculas.</b></br>';
          var error3 = '';
          var error4 = '';
        break;
        case "Apellido":
          var error1 =  '<b> - Solamente letras</b>,</br>';
          var error2 = '<b> - Minusculas y Mayusculas.</b>,</br>';
          var error3 = '';
          var error4 = '';
        break;
        case "UserName":
          var error1 = '<b> - Solamente letras</b>,</br>';
          var error2 = '<b> - Puede contener numeros.</b>,</br>';
          var error3 = '';
          var error4 = '';
        break;
        case "Contraseña":

          var error1 = '<b> - 4-8 caracteres</b>,</br> ';
          var error2 = '<b> - Incluir mayusculas</b>,</br>';
          var error3 = '<b> - Minusculas</b>,</br>';
          var error4 = '<b> - Un numero.</b>';
        break;
    
      default:
        break;
    }
    Swal.fire({
      title: '¡Error!',
      html:
      'El campo: '+ '<b>' + input + '</b>' +' debe contener: </br>' +
        error1+
        error2+
        error3+
        error4,
      showClass: {
        popup: 'animate__animated animate__fadeInDown'
      },
      hideClass: {
        popup: 'animate__animated animate__fadeOutUp'
      }
    });
  }

  //TESTEO Obtener datos FUNCIONANDO PARA Usuarios
  function rellenar_usuario(consulta) {
      funcion="rellenar_usuario";
      $.post('../Controlador/usuarioController.php',{consulta,funcion},(response)=>{
          const Usuarios = JSON.parse(response);            
          let template='';
          $('#Table > tbody').empty();
          Usuarios.forEach(usuario => {
              template=`
              <tr usuarioID="${usuario.id}" password="${usuario.password}" nombreus="${usuario.nombre}" apellidous="${usuario.apellido}" username="${usuario.username}" areaus="${usuario.areaID}" tipous="${usuario.tipoID}">
                  <td>${usuario.nombre}</td>
                  <td>${usuario.apellido}</td>
                  <td>${usuario.username}</td>
                  <td>${usuario.area}</td>                    
                  <td>${usuario.tipo}</td>
                  <td><button class="actualizar-usuario btn btn-success btn-lock" title="Editar tipo" data-bs-toggle="modal" data-bs-target="#crearusuarios"><i class="fas fa-times-circle"></i></a></td>
                  <td><button class="borrar-usuario btn btn-danger btn-lock"><i class="fas fa-times-circle"></i></a></td>
              </tr>
              $('#Table > tbody').append(rows);
          `;
          $('#lista-compra').append(template);
          });
           
            //Fin de la verificacion
      });
  }

  //TESTEO ELIMINAR
  $(document).on('click','.borrar-usuario',(e)=>{
      funcion ='eliminar_usuario';
      const elemento= $(this)[0].activeElement.parentElement.parentElement;
      const id=$(elemento).attr('usuarioID');
      const nombreinsumo=$(elemento).attr('nombreus');
      //console.log(id);     
      //console.log(funcion);
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
              $.post('../Controlador/usuarioController.php',{id,funcion},(response)=>{ 
                //console.log(response);
                edit=false;
                  if (response=='borrado') {
                      swalWithBootstrapButtons.fire(
                          'Eliminado!',
                          'Registro eliminado satisfactoriamente.',
                          'success'
                      )
                      rellenar_usuario();
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
  //Funcion para modificar el Insumo
  $(document).on('click','.actualizar-usuario',(e)=>{
      const elemento= $(this)[0].activeElement.parentElement.parentElement;
      const id=$(elemento).attr('usuarioID');
      const nombre=$(elemento).attr('nombreus');
      const apellido=$(elemento).attr('apellidous');
      const username=$(elemento).attr('username');
      const area=$(elemento).attr('areaus');
      const password=$(elemento).attr('password');
      const tipo=$(elemento).attr('tipous');
         
      $('#nombreusuario').val(nombre);
      $('#apellidousuario').val(apellido);
      $('#username').val(username);
      $('#area').val(area);
      $('#tipos').val(tipo);
      $('#password').val(password);
      $('#id_usuario').val(id);
      
      edit=true;
      //console.log(id,nombre,apellido,username,password,area,tipo, edit);
  })


   //Bloque de codigo que captura lo que se escribe en el teclado
  //y lo manda a la funcion que hace metodo Get de la tabla usuarios
    $(document).on('keyup','#buscar-usuario',function(){
      let valor = $(this).val();
      if (valor !="") {
        rellenar_usuario(valor);
          //console.log(valor)
      } else {
        rellenar_usuario();
      }
  }); 
});

