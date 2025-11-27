$(document).ready(function(){flatpickr("#fecha",{dateFormat:"Y-m-d",defaultDate:"today",locale:"es"});let i=0;const c=$("#selectorProducto");c.length&&(c.select2({width:"100%",placeholder:"Busca por nombre o código",allowClear:!0,minimumInputLength:2,language:{inputTooShort:()=>"Ingrese al menos 2 caracteres",noResults:()=>"Sin resultados",searching:()=>"Buscando..."},ajax:{url:window.buscarProductoUrl,dataType:"json",delay:300,data:function(t){return{term:t.term||""}},processResults:function(t){return!t.success||!Array.isArray(t.productos)?{results:[]}:{results:t.productos.map(function(r){return{id:r.codigo,text:r.etiqueta||`${r.nombre} - ${r.codigo}`,producto:r}})}},error:function(){Swal.fire({icon:"error",title:"Error",text:"No se pudo cargar el listado de productos",confirmButtonText:"Aceptar"})}}}),c.on("select2:select",function(t){const a=t.params.data;a&&a.producto&&(m(a.producto),c.val(null).trigger("change"))}));function m(t){const a=$("<div>").text(t.codigo||"").html(),e=(parseFloat(t.precio)||0).toFixed(2),o=$("<div>").text(t.nombre||"").html();let n=null;if($("#tbodyDetalles tr").each(function(){if($(this).find(".codigo").val()===t.codigo)return n=$(this),!1}),n&&n.length>0){const l=n.find(".cantidad"),f=(parseInt(l.val())||0)+1;l.val(f),d(n),Swal.fire({icon:"success",title:"Cantidad actualizada",text:`${o} - Cantidad: ${f}`,timer:1500,showConfirmButton:!1});return}i++;const u=`
            <tr id="fila-${i}">
                <td>
                    <input type="text" 
                           class="form-control codigo" 
                           name="detalles[${i}][codigo]" 
                           value="${a}"
                           placeholder="Código del producto"
                           required>
                </td>
                <td>
                    <input type="text" 
                           class="form-control nombre readonly" 
                           name="detalles[${i}][nombre]" 
                           value="${o}"
                           placeholder="Nombre del producto" readonly>
                </td>
                <td>
                    <input type="number" 
                           class="form-control cantidad" 
                           name="detalles[${i}][cantidad_vendida]" 
                           min="1" 
                           value="1"
                           required>
                </td>
                <td>
                    <input type="number" 
                           class="form-control precio" 
                           name="detalles[${i}][precio_unitario]" 
                           step="0.01" 
                           min="0" 
                           value="${e}"
                           placeholder="0.00"
                           required>
                </td>
                <td>
                    <input type="text" 
                           class="form-control subtotal" 
                           readonly 
                           value="${e}">
                    <input type="hidden" 
                           class="subtotal-hidden" 
                           name="detalles[${i}][subtotal]" 
                           value="${e}">
                </td>
                <td>
                    <button type="button" 
                            class="btn btn-sm btn-danger btnEliminarFila" 
                            data-fila="${i}">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </td>
            </tr>
        `;$("#tbodyDetalles").append(u),s(),Swal.fire({icon:"success",title:"Producto agregado",text:`${o} - ₡${e}`,timer:1500,showConfirmButton:!1})}$(document).on("click",".btnEliminarFila",function(){const t=$(this).data("fila");$(`#fila-${t}`).remove(),s()});function d(t){const a=parseFloat($(t).find(".cantidad").val())||0,r=parseFloat($(t).find(".precio").val())||0,e=a*r;$(t).find(".subtotal").val(e.toFixed(2)),$(t).find(".subtotal-hidden").val(e.toFixed(2)),s()}function s(){let t=0;$(".subtotal").each(function(){t+=parseFloat($(this).val())||0}),$("#totalVenta").text("₡"+t.toFixed(2))}$(document).on("input",".cantidad, .precio",function(){const t=$(this).closest("tr");d(t)}),$("#formCrearVenta").on("submit",function(t){if(t.preventDefault(),$("#tbodyDetalles tr").length===0){Swal.fire({icon:"warning",title:"Atención",text:"Debe agregar al menos un item a la venta",confirmButtonText:"Entendido"});return}let a=!1;if($("#tbodyDetalles tr").each(function(){const e=$(this).find(".codigo").val(),o=$(this).find(".cantidad").val(),n=$(this).find(".precio").val();if(!e||!o||!n||o<=0||n<=0)return a=!0,!1}),a){Swal.fire({icon:"error",title:"Error de validación",text:"Por favor complete todos los campos de los detalles correctamente",confirmButtonText:"Entendido"});return}Swal.fire({title:"Guardando...",text:"Por favor espere",allowOutsideClick:!1,didOpen:()=>{Swal.showLoading()}});const r=new FormData(this);$.ajax({url:$(this).attr("action"),method:"POST",data:r,processData:!1,contentType:!1,success:function(e){e.success?Swal.fire({icon:"success",title:"¡Éxito!",text:e.message,confirmButtonText:"Aceptar"}).then(o=>{window.location.href='{{route("ventas", ["accion" => "lista"])}}'}):Swal.fire({icon:"error",title:"Error",text:e.message||"Error al guardar la venta",confirmButtonText:"Aceptar"})},error:function(e){let o="Error al guardar la venta";if(e.responseJSON&&e.responseJSON.message)o=e.responseJSON.message;else if(e.responseJSON&&e.responseJSON.errors){let n="";$.each(e.responseJSON.errors,function(u,l){n+=l[0]+`
`}),o=n}Swal.fire({icon:"error",title:"Error",text:o,confirmButtonText:"Aceptar"})}})})});
