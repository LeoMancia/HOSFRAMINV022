$(document).ready(function(){
    Contar_productos();
    
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
        
        edit=true;

        const insumos={
            id: id,
            nombre: nombreinsumo,
            descripcion: desinsumo,
            codigo_prod:codigo,
            cantidad:1
        
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
        AgregarLS(insumos);
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



       //Testeo de funcion para generar codigos aleatorios para id de insumos
       var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
       var serial='';
       function getARandomOneInRange() {
         return possible.charAt(Math.floor(Math.random() * possible.length));
       }
     
       function getRandomFour() {
         return getARandomOneInRange() + getARandomOneInRange() + getARandomOneInRange() ;
       }
     
       $('#btnSerial').click(function() {
         var serial = `${getRandomFour()}-${getRandomFour()}-${getRandomFour()}-${getRandomFour()}`;
         $('#txtSerial').val(serial);
       });
        console.log(serial);
    
})
