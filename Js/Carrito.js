$(document).ready(function(){
    Contar_productos();
    RecuperarLS_carrito_compra();
    RecuperarLS_carrito();
    
    $(document).on('click','.agregar_peticion',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('insumoID');
        const nombreinsumo=$(elemento).attr('nombreinsumo');
        const desinsumo=$(elemento).attr('desinsumo');
        const precio=$(elemento).attr('precioinsumo');
        const cantidad=$(elemento).attr('exisinsumo');
        const estado=$(elemento).attr('estinsumo');
        const codigo=$(elemento).attr('id_insumo');
        const fecha=$(elemento).attr('fecha');     
        const stock=$(elemento).attr('prodcant');     
        edit=true;

        const insumos={
            
            id: id,
            nombre: nombreinsumo,
            descripcion: desinsumo,
            codigo_prod:codigo,
            cantidad:1,
            precio: precio,
            fecha:fecha,
            estado:estado,
            stock:stock                 
        }
        
        let id_insumo;
        let INSUMO;
        INSUMO = RecuperarLS();
        INSUMO.forEach(prod => {
            if (prod.id===insumos.id) {
                id_insumo=prod.id;
            }
        });
        if (id_insumo === insumos.id) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El Insumo ya está agregado en la peticion!',
                footer: '<a>Peticion de Insumos</a>'
            })
        }else{
            template=`
            <tr prodID="${insumos.id}">
            <td>${insumos.codigo_prod}</td> 
                <td>${insumos.nombre}</td>
                <td>${insumos.descripcion}</td>                           
                <td><button class="borrar-ins btn btn-danger btn-lock"><i class="fas fa-times-circle"></i></a></td>
            </tr>
        `;
            $('#lista').append(template);
            AgregarLS(insumos);
            let contador;
            Contar_productos();
            
        }
    })

    $(document).on('click','.borrar-ins',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('prodID');
        Eliminar_producto_LS(id);
        Contar_productos();
        elemento.remove();
        Contar_productos();
    })

    $(document).on('click','#vaciar-carrito ',(e)=>{
       $('#lista').empty();     
       EliminarLS();
       Contar_productos();
       
    })


    //Bloque de codigo que recupera el local storage para verificar que hayan registros en él
    function RecuperarLS() {
        let Insumos;
        if (localStorage.getItem('Insumos')===null) {
            Insumos=[];
        }else{
            Insumos= JSON.parse(localStorage.getItem('Insumos'))
        }
        return Insumos
    }

    //Bloque de codigo que almacena en el local storage los insumos escogidos, para evitar perderlos
    function AgregarLS(insumos){
        let Insumos;
        Insumos = RecuperarLS();
        Insumos.push(insumos)
        localStorage.setItem('Insumos', JSON.stringify(Insumos))
    }
    
    //Bloque de codigo que pinta los productos del local storage en el carrito de insumos
    function RecuperarLS_carrito() {
        let Insumos;
        Insumos = RecuperarLS();
        Insumos.forEach(insumos => {
            template=`
            <tr prodID="${insumos.id}">
            <td>${insumos.codigo_prod}</td> 
            <td>${insumos.nombre}</td>
            <td>${insumos.descripcion}</td>                           
            W<td><button class="borrar-ins btn btn-danger btn-lock"><i class="fas fa-times-circle"></i></a></td>
        </tr>
    `;
        $('#lista').append(template);
        });
    }

    //Elimina el Local Storage
    function EliminarLS() {
        localStorage.clear();
    }


    //Elimina productos individuales del Local Storage
    function Eliminar_producto_LS(id) {
        let Insumos;
        Insumos = RecuperarLS();
        Insumos.forEach(function(Insumo,indice) {
            if (Insumo.id===id) {
                Insumos.splice(indice,1);     
            }
        });
        localStorage.setItem('Insumos',JSON.stringify(Insumos))
    }

    //Contador de peticiones 
    function Contar_productos() {
        let Insumos;
        let contador=0;
        Insumos=RecuperarLS();
        Insumos.forEach(insumo=>{
            contador++;            
        })
        $('#contador').html(contador);
       }

   //Funciones Js para el procesamiento de pedidos de insumos
   //Almacena id de pedido en ls********************************************//
  $(document).on('click', '#procesarPedido',(e=>{
    Procesar_Pedido();    
    prueba = Procesar_Pedido();
    console.log(prueba)
}))

    $(document).on('click', '#procesar-peticion-final',(e=>{
        Procesar_Peticion_Final();
    }))

    
    //Bloque de codigo que verifica si hay un id en ls 
    function RecuperarLSPeticion() {
        let Peticion;
        if (localStorage.getItem('Peticion')===null) {
            Peticion=[];
        }else{
            Peticion= JSON.parse(localStorage.getItem('Peticion'))
        }
        return Peticion
    }

    //Bloque de codido que agrega al ls el id de la peticion
    function AgregarLSPeticion(idpeticion){
        let Peticion;
        Peticion = RecuperarLSPeticion();
        Peticion.push(idpeticion);
        localStorage.setItem('Peticion', JSON.stringify(idpeticion))
    }
 
 
   //Elimina el contenido del ls donde se almacena el id de la peticion************
    $(document).on('click','.añadir',(e)=>{
        //EliminarLSPeticion();
    })

    function EliminarLSPeticion() {
        localStorage.removeItem('Peticion');
    }
    //Fin de codigo de eliminacion *******************************


    //Codigo pa procesar el pedido
        function Procesar_Pedido() {
            let productos;
            productos= RecuperarLS();
            idPeticion= RecuperarLSPeticion();
            if (productos.length === 0 ) {
             Swal.fire({
                 icon: 'warning',
                 title: 'Oops...',
                 text: '¡No ha agregado insumos a la petición aun!',
                 footer: '<a>Petición de insumos</a>'
             })
            }
            else{
                if (idPeticion.length === 0) {
                     //Genera un codigo por peticion
                    const serialid=serialnumberpet();
                    const idpeticion={            
                        IDpeticion:serialid             
                    }
                    AgregarLSPeticion(idpeticion);                    
                    location.href = '../Vistas/peticiones.php';
                } else {
                    location.href = '../Vistas/peticiones.php';
                }
            }
        }

     function serialnumberpet(){
        //Testeo de funcion para generar codigos aleatorios para id de insumos
       var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
       var serial='';
       function getARandomOneInRange() {
         return possible.charAt(Math.floor(Math.random() * possible.length));
       }
     
       function getRandomFour() {
         return getARandomOneInRange() + getARandomOneInRange() + getARandomOneInRange() ;
       }
        var serial = `${getRandomFour()}-${getRandomFour()}-${getRandomFour()}-${getRandomFour()}`;
        return serial;
     }
        //LLENA TABLA DE INSUMOS A PEDIR
        function RecuperarLS_carrito_compra() {
            //Obtener fecha para ingreso de peticiones
            let date = new Date();
            let fecha = date.toISOString().split('T')[0];
            //codigo que obtiene el dato del area del usuario
            let area = $('#unidad').val();            
            let Serialid;
            Serialid =RecuperarLSPeticion();
            //console.log(Serialid);
            let insumos;
            insumos = RecuperarLS();
            insumos.forEach(insumo => {
                template=`
                <tr prodID="${insumo.id}">
                    <td>${insumo.id}</td>
                    <td>${insumo.nombre}</td>
                    <td>${area}</td>
                    <td>${fecha}</td>
                   <td>
                        <input type="number" min="1" class="form-control cantidad_producto" value="${insumo.cantidad}">
                    </td>      
                         
                    <td><button class="borrar-producto btn btn-danger btn-lock"><i class="fas fa-times-circle"></i></a></td>
                </tr>
            `;
            $('#lista-compra').append(template);
               
            });
            }

            //obtiene la cantidad de insumos requeridos por el personal
            $('#cp').keyup((e)=>{
                let cantidad,insumo,Insumos,montos;
                insumo = $(this)[0].activeElement.parentElement.parentElement;
                id = $(insumo).attr('prodID');
                cantidad = insumo.querySelector('input').value;
                Insumos = RecuperarLS();
                Insumos.forEach(function(prod, indice) {
                    if (prod.id === id) {
                        prod.cantidad = cantidad;
                    }
                });
                localStorage.setItem('Insumos', JSON.stringify(Insumos))
                
            })


            //codigo que borra el producto en la vista final de la peticion
            $(document).on('click','.borrar-producto',(e)=>{
                const elemento = $(this)[0].activeElement.parentElement.parentElement;
                const id = $(elemento).attr('prodID');
                elemento.remove();       
                Eliminar_producto_LS(id)
            })

            //Finaliza la peticion para almacenarla
            function Procesar_Peticion_Final(){
                //Validacion que se encarga de ver si hay insumos en el Local Storage
                if (RecuperarLS().length == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: '¡No ha agregado insumos a la petición aun!',
                        footer: '<a>Petición de insumos</a>'
                    }).then(function(){
                        location.href = '../Vistas/Vista_principal_admin.php'
                    })
                } else {
                    Verificar_Stock().then(error=>{
                        //console.log(error)
                        if (error==="") {
                            Registrar_peticion();
                            Swal.fire({
                                position: 'center', 
                                icon: 'success',
                                title: 'La peticion ha sido creada',
                                showConfirmButton: false,
                                timer: 1500
                              })
                              EliminarLS();                              
                             
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'El insumo: '+ error + ' no cuenta con la cantidad requerida',
                                showConfirmButton: false,
                                timer: 1800
                              })
                        }
                    });
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'La peticion ha sido creada',
                        showConfirmButton: false,
                        timer: 2500
                      });                    
                }

            }

    async function Verificar_Stock() {
        let insumos;
        funcion='verificar_stock';
        insumos = RecuperarLS();
        //console.log(insumos)
        const response = await fetch('../Controlador/insumoController.php',{
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body:'funcion='+funcion+'&&insumos='+JSON.stringify(insumos)
        })
        //console.log(response)
        let error = await response.text();
        return error;
       
        
    }                        

    function Registrar_peticion(){
        funcion = 'registrar_peticion';
        let insumos = RecuperarLS();
        let json = JSON.stringify(insumos)
        let idpeticion2 = RecuperarLSPeticion();
        let idpeticion = idpeticion2.IDpeticion
        //console.log(idpeticion);
        insumos.forEach(objeto => {
            let idpeticiones = idpeticion;
            let nombre = objeto.nombre;
            let descripcion =objeto.descripcion;
            let cant_solici = objeto.cantidad;
            let id = objeto.id;
            let cod_producto = objeto.codigo_prod;
            $.post('../Controlador/peticionController.php',{funcion,json,idpeticiones,nombre,descripcion,cant_solici,cod_producto,id}, (response)=>{
                setTimeout(function(){
                   Swal.fire({
                        title: 'Su codigo de peticion es: '+ '</br>'+ response,
                        showClass: {
                          popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                          popup: 'animate__animated animate__fadeOutUp'
                        }
                      })
                }, 1500);
                setTimeout(function(){
                    location.href = '../Vistas/Vista_principal_admin.php'
                }, 7500);
              
            })
           
        });
        
       
    }            
})
