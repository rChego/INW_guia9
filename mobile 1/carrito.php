<!DOCTYPE html>
<html lang="es">

<head>
    <?php require 'estilos.php'; ?>
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <script type="text/javascript" src="js/jquery.slickforms.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.forms').dcSlickForms();
        });
    </script>

</head>

<body>
    <div data-role="page">
        <div data-role="header" data-theme="b">
            <h1></h1>
            <?php require 'nav.php'; ?>
        </div>
        <div onload="loadProduct()" data-role="main" data-theme="a">                
            <h2>Detalles Producto</h2>
            <form method="post" action="http://pymesv.com/cliente04sw/servicio/controladores/rdetalles.php">
                <table id="datos">
                    <thead>
                        <tr>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Total</th>
                            <th></th><th></th>
                        </tr>
                    </thead>
                    <tbody id="tbody_productos">
                        <?php
                            echo "<input type='hidden' value='".$_SESSION["id_user"]."' name='id_user'>";                        
                        ?>
                    </tbody>
                </table>
            </form>
            <div class="response"div></div>
        </div>
        <div data-role="footer" data-theme="a">
            <div class="iu-content">
                <small>&copy; Rub&eacute;n Echegoy&eacute;n</small>
            </div>
        </div>

        <script>

            function loadProduct (argument) {
                if(localStorage.jsonData){
            
                //Si existe localstorage recuperamos el json
                jsonData = JSON.parse(localStorage.jsonData);

                var suma = 0;
                var cant = 0;
                var cont = 1;

                for (index = 0, len = jsonData.length; index < len; ++index) {
                    console.log(jsonData[index]['id_producto']);

                    var tr = document.createElement("tr");
                    tr.setAttribute("id", "producto" + cont);
                    tr.setAttribute("class", "product_element");

                    var td1 = document.createElement("td");
                    td1.setAttribute('class',"col-sm-7 col-md-7");

                    var media = document.createElement("div");
                    media.setAttribute('class',"media");

                    var img = document.createElement("img");
                    img.setAttribute('class',"media-object");
                    img.setAttribute('src', jsonData[index]['img']);
                    img.setAttribute('style',"width: 72px; height: 72px;");

                    var link = document.createElement("a");
                    link.setAttribute('class',"thumbnail pull-left");
                    link.appendChild(img);

                    var div_media = document.createElement("div");
                    div_media.setAttribute('class',"media-body");

                    var h4 = document.createElement("h4");
                    h4.setAttribute('class',"media-heading");
                    h4.textContent = jsonData[index]['nombre'];

                    var h5 = document.createElement("h5");
                    h5.setAttribute('class',"media-heading");
                    h5.setAttribute('value',"Rotom buy");
                    h5.textContent = "Rotom buy";        
                    
                    div_media.appendChild(h4);
                    div_media.appendChild(h5);

                    media.appendChild(link);
                    media.appendChild(div_media);
                    td1.appendChild(media);
                    
                    var td2 = document.createElement("td");
                    td2.setAttribute('class',"col-sm-1 col-md-1");
                    td2.setAttribute('style',"text-align: center");

                    var td3 = document.createElement("td");
                    td3.setAttribute('class',"col-sm-1 col-md-1");
                    td3.setAttribute('style',"text-align: center");

                    var btn = document.createElement("button");
                    btn.setAttribute('class',"col-sm-1 col-md-1");
                    btn.setAttribute('style',"text-align: center");

                    var td5 = document.createElement("td");
                    td5.setAttribute('class',"col-sm-1 col-md-1");
                    td5.setAttribute('style',"text-align: center");

                    var input_cant = document.createElement("input");
                    input_cant.setAttribute("type","form-control");
                    input_cant.setAttribute("type","number");
                    input_cant.setAttribute("min","1");
                    input_cant.setAttribute("value",jsonData[index]['Cantidad']);
                    input_cant.setAttribute("id","quantity" + cont);
                    input_cant.setAttribute("name","cantidad[]");

                    var input_id = document.createElement("input");
                    input_id.setAttribute("type","hidden");
                    input_id.setAttribute("value",jsonData[index]['id_producto']);
                    input_id.setAttribute("name","id_producto[]");

                    //Cantidad de productos
                    cant += parseInt(jsonData[index]['Cantidad']);

                    td5.appendChild(input_id);
                    td5.appendChild(input_cant);
                    
                    var td6 = document.createElement("td");
                    td6.setAttribute('class',"col-sm-1 col-md-1 text-center");
                    td6.setAttribute('style',"text-align: center");

                    var strong1 = document.createElement("strong");
                    strong1.textContent = '$'+jsonData[index]['precio'];

                    td6.appendChild(strong1);                    

                    var td7 = document.createElement("td");
                    td7.setAttribute('class',"col-sm-1 col-md-1");
                    td7.setAttribute('style',"text-align: center");

                    var strong2 = document.createElement("strong");
                    strong2.textContent = '$'+Math.round((jsonData[index]['precio']*jsonData[index]['Cantidad']) * 100) / 100;

                    suma += jsonData[index]['precio']*jsonData[index]['Cantidad'];

                    td7.appendChild(strong2);

                    var td8 = document.createElement("td");
                    td8.setAttribute('class',"col-sm-1 col-md-1 text-center");

                    var td9 = document.createElement("td");
                    td9.setAttribute('class',"col-sm-1 col-md-1 text-center");

                    var btn2 = document.createElement("button");
                    btn2.setAttribute('class',"btn btn-danger");
                    btn2.setAttribute('onclick',"delete_product('producto"+cont+"', '"+jsonData[index]['id_producto']+"')");
                    btn2.textContent = "Remove ";

                    var btn3 = document.createElement("button");
                    btn3.setAttribute('class',"btn btn-success");
                    btn3.setAttribute('onclick',"update_product('quantity"+cont+"', '"+jsonData[index]['id_producto']+"')");
                    btn3.textContent = "Update ";

                    var span = document.createElement("span");
                    span.setAttribute('class',"glyphicon glyphicon-remove");

                    var span2 = document.createElement("span");
                    span2.setAttribute('class',"glyphicon glyphicon-refresh");

                    btn2.appendChild(span);

                    btn3.appendChild(span2);

                    td8.appendChild(btn3);
                    td9.appendChild(btn2);

                    tr.appendChild(td1);
                    tr.appendChild(td5);
                    tr.appendChild(td6);
                    tr.appendChild(td7);
                    tr.appendChild(td8);
                    tr.appendChild(td9);
                    document.getElementById("tbody_productos").appendChild(tr);
                    //AUMENTAMOS CONTADOR
                    cont++;
                }

                var td_white = document.createElement("td");
                var td_white1 = document.createElement("td");
                var td_white2 = document.createElement("td");
                var td_white3 = document.createElement("td");
                var td_white4 = document.createElement("td");
                var tr = document.createElement("tr");
                tr.setAttribute("class", "product_element");
                var td = document.createElement("td");
                var h5 = document.createElement("h5");
                var h5_2 = document.createElement("h5");
                h5.textContent = "Subtotal: ";
                td_white3.appendChild(h5);
                td.setAttribute("class", "text-right");
                var strong = document.createElement("strong");
                strong.textContent = '$'+Math.round(suma * 100) / 100;
                h5_2.appendChild(strong);
                td.appendChild(h5_2);
                tr.appendChild(td_white);
                tr.appendChild(td_white1);
                tr.appendChild(td_white2);
                tr.appendChild(td_white3);
                tr.appendChild(td_white4);
                tr.appendChild(td);

                document.getElementById("tbody_productos").appendChild(tr);

                var td_white = document.createElement("td");
                var td_white1 = document.createElement("td");
                var td_white2 = document.createElement("td");
                var td_white3 = document.createElement("td");
                var td_white4 = document.createElement("td");
                var tr = document.createElement("tr");
                tr.setAttribute("class", "product_element");
                var td = document.createElement("td");
                var h5 = document.createElement("h5");
                var h5_2 = document.createElement("h5");
                h5.textContent = "Estimado Envío: ";
                td_white3.appendChild(h5);
                td.setAttribute("class", "text-right");
                var strong = document.createElement("strong");
                strong.textContent = '$'+Math.round(cant*1.99 * 100) / 100;
                h5_2.appendChild(strong);
                td.appendChild(h5_2);
                tr.appendChild(td_white);
                tr.appendChild(td_white1);
                tr.appendChild(td_white2);
                tr.appendChild(td_white3);
                tr.appendChild(td_white4);
                tr.appendChild(td);

                document.getElementById("tbody_productos").appendChild(tr);

                var td_white = document.createElement("td");
                var td_white1 = document.createElement("td");
                var td_white2 = document.createElement("td");
                var td_white3 = document.createElement("td");
                var td_white4 = document.createElement("td");
                var tr = document.createElement("tr");
                tr.setAttribute("class", "product_element");
                var td = document.createElement("td");
                var h5 = document.createElement("h3");
                var h5_2 = document.createElement("h3");
                h5.textContent = "Total: ";
                td_white3.appendChild(h5);
                td.setAttribute("class", "text-right");
                var strong = document.createElement("strong");
                strong.textContent = '$'+Math.round((cant + suma) * 100) / 100;
                h5_2.appendChild(strong);
                td.appendChild(h5_2);
                tr.appendChild(td_white);
                tr.appendChild(td_white1);
                tr.appendChild(td_white2);
                tr.appendChild(td_white3);
                tr.appendChild(td_white4);
                tr.appendChild(td);

                document.getElementById("tbody_productos").appendChild(tr);

                var td_white = document.createElement("td");
                var td_white1 = document.createElement("td");
                var td_white2 = document.createElement("td");
                var td_white3 = document.createElement("td");
                var tr = document.createElement("tr");
                tr.setAttribute("class", "product_element");
                var td = document.createElement("td");
                var td_2 = document.createElement("td");

                var a = document.createElement("a");
                a.setAttribute("href","producto.php");

                var btn1 = document.createElement("button");
                btn1.setAttribute("type", "button");
                btn1.setAttribute("class", "btn btn-default");
                btn1.textContent = "Seguir comprando ";

                var span = document.createElement("span");
                span.setAttribute("class", "glyphicon glyphicon-shopping-cart");

                btn1.appendChild(span);
                a.appendChild(btn1);
                td.appendChild(a);

                var btn2 = document.createElement("button");
                btn2.setAttribute("type", "submit");
                btn2.setAttribute("class", "btn btn-success");
                btn2.setAttribute("onclick", "finalizar()");
                btn2.textContent = "Checkout ";

                var span = document.createElement("span");
                span.setAttribute("class", "glyphicon glyphicon-play");

                btn2.appendChild(span);
                td_2.appendChild(btn2);
                tr.appendChild(td_white);
                tr.appendChild(td_white1);
                tr.appendChild(td_white2);
                tr.appendChild(td_white3);
                tr.appendChild(td);
                tr.appendChild(td_2);

                document.getElementById("tbody_productos").appendChild(tr);
            }else{
                alert('No se encontraron artículos');
            }
        }

        function delete_product (id, id_producto) {
            var agree = confirm("¿Desea eliminar el producto?");
        
            if (agree){
                document.getElementById(id).remove();
                var elements = document.getElementsByClassName("product_element");
                while(elements.length > 0){
                    elements[0].parentNode.removeChild(elements[0]);
                }

                var jsonData = [];
                var temp = [];
                //traer json si existe
                if(localStorage.jsonData){
                    //Si existe localstorage recuperamos el json
                    jsonData = JSON.parse(localStorage.jsonData);
                }

                for(i=0; i<jsonData.length; i++){
                    if(jsonData[i]['id_producto'] != id_producto){
                        temp.push({
                            "id_producto": jsonData[i]['id_producto'],
                            "id_categoria": jsonData[i]['id_categoria'],
                            "nombre": jsonData[i]['nombre'],
                            "descripcion": jsonData[i]['descripcion'],
                            "precio": jsonData[i]['precio'],
                            "Cantidad": jsonData[i]['Cantidad'],
                            "img": jsonData[i]['img'],
                        });
                    }
                }

                // ahora intentamos guardar jsonData en localstorage
                localStorage.setItem("jsonData", JSON.stringify(temp));
                loadProduct();
            }else{
                return false;
            }
        }

        function update_product (id, id_producto) {
            var agree=confirm("¿Desea modificar la peticion?");
        
            if (agree){
                var jsonData = [];
                var temp = [];
                //Si existe localstorage recuperamos el json
                jsonData = JSON.parse(localStorage.jsonData);

                for(i=0; i<jsonData.length; i++){
                    if(jsonData[i]['id_producto'] == id_producto){
                        console.log(id);

                        jsonData[i]['Cantidad'] = parseInt(document.getElementById(id).value);
                        localStorage.setItem("jsonData", JSON.stringify(jsonData));
                    }//End if encontrar roducto
                }//End for bucar producto

                var elements = document.getElementsByClassName("product_element");
                while(elements.length > 0){
                    elements[0].parentNode.removeChild(elements[0]);
                }

                // ahora intentamos guardar jsonData en localstorage
                loadProduct();
            }else{
                return false;
            }
        }

        function finalizar () {
            localStorage.removeItem("jsonData");
        }
        </script>
    </div>
</body>
</html>