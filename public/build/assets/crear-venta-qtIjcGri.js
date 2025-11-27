$(document).ready(function(){flatpickr("#fecha",{dateFormat:"Y-m-d",defaultDate:"today",locale:"es"});let a=0;function c(){a++;const t=`
            <tr id="fila-${a}">
                <td>
                    <input type="text" 
                           class="form-control codigo " 
                           name="detalles[${a}][codigo]" 
                           placeholder="Código del producto"
                           required>
                </td>
                <td>
                    <input type="text" 
                           class="form-control nombre readonly" 
                           name="detalles[${a}][nombre]" 
                           placeholder="Nombre del producto"
                           readonly>
                </td>
                <td>
                    <input type="number" 
                           class="form-control cantidad" 
                           name="detalles[${a}][cantidad_vendida]" 
                           min="1" 
                           value="1"
                           required>
                </td>
                <td>
                    <input type="number" 
                           class="form-control precio" 
                           name="detalles[${a}][precio_unitario]" 
                           step="0.01" 
                           min="0" 
                           placeholder="0.00"
                           required>
                </td>
                <td>
                    <input type="text" 
                           class="form-control subtotal" 
                           readonly 
                           value="0.00">
                    <input type="hidden" 
                           class="subtotal-hidden" 
                           name="detalles[${a}][subtotal]" 
                           value="0.00">
                </td>
                <td>
                    <button type="button" 
                            class="btn btn-sm btn-danger btnEliminarFila" 
                            data-fila="${a}">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </td>
            </tr>
        `;$("#tbodyDetalles").append(t)}c(),$("#btnAgregarDetalle").on("click",function(){c()});function s(t){if(!t||t.trim()===""){Swal.fire({icon:"warning",title:"Atención",text:"Por favor ingrese un código",confirmButtonText:"Entendido"});return}Swal.fire({title:"Buscando...",text:"Por favor espere",allowOutsideClick:!1,didOpen:()=>{Swal.showLoading()}}),$.ajax({url:window.buscarProductoUrl,method:"GET",data:{codigo:t.trim()},success:function(o){Swal.close(),o.success&&o.producto?(d(o.producto),$("#codigoBusqueda").val("").focus()):Swal.fire({icon:"error",title:"Producto no encontrado",text:o.message||"No se encontró un producto con ese código",confirmButtonText:"Entendido"})},error:function(o){Swal.close();let r="Error al buscar el producto";o.responseJSON&&o.responseJSON.message&&(r=o.responseJSON.message),Swal.fire({icon:"error",title:"Error",text:r,confirmButtonText:"Aceptar"})}})}function d(t){a++;const o=$("<div>").text(t.codigo||"").html(),e=(parseFloat(t.precio)||0).toFixed(2),n=$("<div>").text(t.nombre||"").html(),i=`
            <tr id="fila-${a}">
                <td>
                    <input type="text" 
                           class="form-control codigo" 
                           name="detalles[${a}][codigo]" 
                           value="${o}"
                           placeholder="Código del producto"
                           required>
                </td>
                 <td>
                    <input type="text" 
                           class="form-control nombre readonly" 
                           name="detalles[${a}][nombre]" 
                           value="${o}"
                           placeholder="Nombre del producto"
                           readonly>
                </td>
                <td>
                    <input type="number" 
                           class="form-control cantidad" 
                           name="detalles[${a}][cantidad_vendida]" 
                           min="1" 
                           value="1"
                           required>
                </td>
                <td>
                    <input type="number" 
                           class="form-control precio" 
                           name="detalles[${a}][precio_unitario]" 
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
                           name="detalles[${a}][subtotal]" 
                           value="${e}">
                </td>
                <td>
                    <button type="button" 
                            class="btn btn-sm btn-danger btnEliminarFila" 
                            data-fila="${a}">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </td>
            </tr>
        `;$("#tbodyDetalles").append(i),l(),Swal.fire({icon:"success",title:"Producto agregado",text:`${n} - ₡${e}`,timer:1500,showConfirmButton:!1})}$("#codigoBusqueda").on("keypress",function(t){if(t.which===13){t.preventDefault();const o=$(this).val();s(o)}}),$("#btnBuscarProducto").on("click",function(){const t=$("#codigoBusqueda").val();s(t)}),$(document).on("click",".btnEliminarFila",function(){const t=$(this).data("fila");$(`#fila-${t}`).remove(),l()});function u(t){const o=parseFloat($(t).find(".cantidad").val())||0,r=parseFloat($(t).find(".precio").val())||0,e=o*r;$(t).find(".subtotal").val(e.toFixed(2)),$(t).find(".subtotal-hidden").val(e.toFixed(2)),l()}function l(){let t=0;$(".subtotal").each(function(){t+=parseFloat($(this).val())||0}),$("#totalVenta").text("₡"+t.toFixed(2))}$(document).on("input",".cantidad, .precio",function(){const t=$(this).closest("tr");u(t)}),$("#formCrearVenta").on("submit",function(t){if(t.preventDefault(),$("#tbodyDetalles tr").length===0){Swal.fire({icon:"warning",title:"Atención",text:"Debe agregar al menos un item a la venta",confirmButtonText:"Entendido"});return}let o=!1;if($("#tbodyDetalles tr").each(function(){const e=$(this).find(".codigo").val(),n=$(this).find(".cantidad").val(),i=$(this).find(".precio").val();if(!e||!n||!i||n<=0||i<=0)return o=!0,!1}),o){Swal.fire({icon:"error",title:"Error de validación",text:"Por favor complete todos los campos de los detalles correctamente",confirmButtonText:"Entendido"});return}Swal.fire({title:"Guardando...",text:"Por favor espere",allowOutsideClick:!1,didOpen:()=>{Swal.showLoading()}});const r=new FormData(this);$.ajax({url:$(this).attr("action"),method:"POST",data:r,processData:!1,contentType:!1,success:function(e){e.success?Swal.fire({icon:"success",title:"¡Éxito!",text:e.message,confirmButtonText:"Aceptar"}).then(n=>{window.location.href='{{route("ventas", ["accion" => "lista"])}}'}):Swal.fire({icon:"error",title:"Error",text:e.message||"Error al guardar la venta",confirmButtonText:"Aceptar"})},error:function(e){let n="Error al guardar la venta";if(e.responseJSON&&e.responseJSON.message)n=e.responseJSON.message;else if(e.responseJSON&&e.responseJSON.errors){let i="";$.each(e.responseJSON.errors,function(p,f){i+=f[0]+`
`}),n=i}Swal.fire({icon:"error",title:"Error",text:n,confirmButtonText:"Aceptar"})}})})});
