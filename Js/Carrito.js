$(document).ready(function(){
    template='';
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
        template=`
        <tr prodID="${insumos.id}">
            <td>${insumos.id}</td>
            <td>${insumos.nombre}</td>
            <td>${insumos.descripcion}</td>
            <td>${insumos.codigo_prod}</td>                
            <td><button class="borrar-ins btn btn-danger btn-lock"><i class="fas fa-times-circle"></i></a></td>
        </tr>
    `;
    $('#lista').append(template);
    })

    $(document).on('click','.borrar-ins',(e)=>{
        const elemento= $(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('prodID');
        elemento.remove();
        
    })
})
