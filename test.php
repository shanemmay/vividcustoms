<?php
   include('session.php');
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sign-Up/Login Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<title>Formulario con JavaScript</title>
    
    <!--lee codigo javascript-->
    <script type="text/javascript" src="js/javascript.js"></script>    
    <!--lee codigo css-->
    <link type="text/css" href="css/style.css" rel="stylesheet" media="screen"/>
    <style type="text/css">
      ﻿/*Fichero de estilos para pantallas de ordenador*/
  body {background: #000;color:white;font-size:14px;font-family:comic sans ms;}

* {
  margin: 0px;
  padding: 0px;
}

/*CSS DE LOS PRODUCTOS*/
  img.imagen {
    margin-left:auto;
    margin-right:auto;
    display:block;
    padding-top:5px;
  }

  div.etiquetas {
    color:black;
    text-align:center;
    width:222px;
    height:22px;
  }

  div.stock {padding-left:0px;}

  input.uniBien {
    position:relative;
    margin-left:45px;


    background:white;
  }
  input.uniMal {
    margin-left:52px;
    background:red;
  }

  div.divsNo {display:none;}
  div.divsSi {display:yes;}

  #todo{
    position:relative;
    top:0px;
    margin-left:auto;
    margin-right:auto;
    display:block;
    width:1000px;
    background: #000 url("../img/otros/plantilla.jpg") no-repeat;
}
  div.todoNo{height:805px;}
  div.todoSi{height:1070px;}


  #menu{
    position:absolute;
    top:26px;
    left:143px;
    width:715px;
}
  div.menuNo{height:775px;}
  div.menuSi{height:1040px;}

/*Divs para colocar cada producto en su sitio*/
  #div1{
    position:absolute;
    top:38px;
    left:12px;
    width:221px;
    height:217px;
  }

  #div2{
    position:absolute;
    top:38px;
    left:246px;
    width:221px;
    height:217px;
  }

  #div3{
    position:absolute;
    top:38px;
    left:480px;
    width:221px;
    height:217px;
  }

  #div4{
    position:absolute;
    top:271px;
    left:12px;
    width:221px;
    height:217px;
  }

  #div5{
    position:absolute;
    top:271px;
    left:246px;
    width:221px;
    height:217px;
  }

  #div6{
    position:absolute;
    top:271px;
    left:480px;
    width:221px;
    height:217px;
  }

  #div7{
    position:absolute;
    top:504px;
    left:12px;
    width:221px;
    height:217px;
  }

  #div8{
    position:absolute;
    top:504px;
    left:246px;
    width:221px;
    height:217px;
  }

  #div9{
    position:absolute;
    top:504px;
    left:480px;
    width:221px;
    height:217px;
  }



/*CSS DEL CARRITO DE LA COMPRA*/
  /*Div para los botones*/
  #divbotones{
    position:relative;
    top:742px;
    left:11px;
    width:440px;
    height:23px;
  }

  #tablaTotal {
    margin: 0px 0px 0px 0px;
  }
  td.pro {
    width:300px;
    text-align:center;
    background:#1a6c68;
  }
  td.uni {
    width:150px;
    text-align:center;
    background:#1a6c68;
  }
  td.preUni {
    width:150px;
    text-align:center;
    background:#1a6c68;
  }
  td.preTotal {
    width:150px;
    text-align:center;
    background:#1a6c68;
  }
  tr.proCarrito {
    text-align:center;
  }

  /*Divs para la zona de compras*/
  div.divZonaCompraSi{
    position:relative;
    top:742px;
    padding:0px 11px 20px 11px;
    display:yes;
    width:693px;
    height:auto;

    background:#3c8c89;
  }
  div.divZonaCompraNo{
    position:relative;
    top:742px;
    padding:0px 11px 20px 11px;
    display:none;
    width:693px;
    height:385px;

    background:#3c8c89;
  }

  /*Divs del carrito y formularios*/
  #divTotal{
    background:#378582;
  }
  #divDatos{
    background:#378582;
  }

  #divPago{
    height: 150px;
    padding-left:10px;
    background:#378582;
  }
  
  #divDatosPersonales0 {
    position:relative;
    left:0px;
    padding:0px 0px 0px 10px;
    width:440px;
    height:140px;
  }

  #divDatosPersonales1 {
    position:relative;
    width:230px;
    height:130px;
  }

  #divDatosPersonales2 {
    position:relative;
    top:-130px;
    left:260px;
    width:200px;
    height:130px;
  }

  #divDomicilio{
    padding:0px 0px 0px 10px;
  }


  
  
  
/*CSS VALIDACION*/  
  input.textBien {background:#d1fbe1;}
  input.textMal {background:pink;}
  select.textBien {background:#d1fbe1;}
  select.textMal {background:pink;} 
  span.alertTipoDeTarjeta {color:red;}

  
  
/*Metodos de pago*/ 
#metodosDePago{
  position:relative;
  top:8px;
  width:128px;
  height:60px;
}

#divNumeroTarjeta{
  position:relative;
  top:-52px;
  left:140px;
  width:180px;
  height:70px;
}

input.logoTarjetas { 
  bottom:6px;
  position: relative;
} 

  
  
/*Pie de pagina */
p.pie {
  text-align:center;
}
a:link {
  color:white;
} 
    </style>
  <script type="text/javascript">
﻿// Hacer tienda online de informatica usando: HTML, CSS, JS
//  En el codigo javascript hay que hacer la base de datos de los productos con un vector por ejemplo...




//BASE DE DATOS
  var productos = ["Antivirus", "Grafica", "Disco duro", "Ordenador", "Bolso portatil", "Portatil", "Memoria RAM", "Router Linux", "Sintonizadora TV"];
  var imgGrandes = ["img/productos/1.jpg", "img/productos/2.jpg", "img/productos/3.jpg", "img/productos/4.jpg", "img/productos/5.jpg", "img/productos/6.jpg", "img/productos/7.jpg", "img/productos/8.jpg", "img/productos/9.jpg"];
  var imgPeque = ["img/productos/1m.jpg", "img/productos/2m.jpg", "img/productos/3m.jpg", "img/productos/4m.jpg", "img/productos/5m.jpg", "img/productos/6m.jpg", "img/productos/7m.jpg", "img/productos/8m.jpg", "img/productos/9m.jpg"];
  var precios = [33, 169, 36, 360, 11, 540, 21, 66, 25];
  var stock = [5, 2, 8, 3, 10, 4, 3, 1, 2];
  var precioTransporte = [6, 12, 20, "gratis"];
  var IVA = 0.18;
  var uniUser;
  
  
  
//JAVASCRIPT A EJECUTARSE UNA VEZ CARGADA LA PAGINA:  
  window.onload = function(){

  
    //Se cargan los productos dentro del HTML de forna dinamica haciendo uso de los datos de la base de datos, como si de un PHP se tratase:
    var DIVS = document.getElementsByName("DIVS");
    for (i in productos){
      DIVS[i].innerHTML = '<a id="imgG'+i+'" href="' +imgGrandes[i]+ '"><img id="imgP'+i+'" class="imagen" src="' +imgPeque[i]+ '"></a><div class="etiquetas"><b><span id="pro'+i+'">' +productos[i]+ '</span>: <span id="pre'+i+'">' +precios[i]+ '€</span></b></div><div class="stock">Hay en stock <span id="uni'+i+'">' +stock[i]+ '</span> unidades,<br/>¿Cuantas quiere?: <input class="uniBien" type="number" id="uniUser'+i+'" name="uniUser" value="0" size="4" /></div>';
    }
  
  
    //Rellena el campo dia y año, de la fecha de nacimiento y tarjeta de credito:
    //Mas info en: http://www.tallerwebmaster.com/tutorial/mostrar-fecha-actual-con-javascrip/58/
    //Fecha de nacimiento
    var fecha = new Date();
    var anio = fecha.getFullYear();
        
    for (var i=1;i<=31;i++){
      document.getElementById("fechaNacimientoDia").innerHTML = document.getElementById("fechaNacimientoDia").innerHTML + '<option value="' +i+ '">' +i+ '</option>';
    }
        
    for (var i=anio;i>=(anio-110);i--){
      document.getElementById("fechaNacimientoAnio").innerHTML = document.getElementById("fechaNacimientoAnio").innerHTML + '<option value="' +i+ '">' +i+ '</option>';
    }

    //Tarjeta de credito:
    for (var i=1;i<=12;i++){
      document.getElementById("mesTarjeta").innerHTML = document.getElementById("mesTarjeta").innerHTML + '<option value="' +i+ '">' +i+ '</option>';
    }

    for (var i=anio;i<=(anio+21);i++){
      document.getElementById("anioTarjeta").innerHTML = document.getElementById("anioTarjeta").innerHTML + '<option value="' +i+ '">' +i+ '</option>';
    }

    
  
    //Botones que llevaran a cabo la ejecucion de determinadas secuencias de codigo JavaScript:
    document.getElementById("botonTotal").onclick = validaLasUnidades;
    document.getElementById("botonDatos").onclick = pideDatos;
    document.getElementById("botonPago").onclick = validaDatosPersonales;
    document.getElementById("botonConfirmar").onclick = validaDatosPago;
  }

  
  
  
  /*-------------------COMIENZAN LAS FUNCIONES-------------------*/




//FUNCION DE VALIDACION DE UNIDADES:
  function validaLasUnidades(elEvento) {
    
    var todoBien = true;
    uniUser = document.getElementsByName("uniUser");
    
    
    for (i in productos){
    
      if ( uniUser[i].value == "" || uniUser[i].value > stock[i] || uniUser[i].value < 0 ){
        
        todoBien = false;
        uniUser[i].className = "uniMal";
                
        //Modifica el css para quitar los formularios:
        document.getElementById("todo").className = "todoNo";
        document.getElementById("menu").className = "menuNo";
        document.getElementById("divZonaCompra").className = "divZonaCompraNo";
        document.getElementById("divTotal").className = "divsNo";
/**/      document.getElementById("divDatos").className = "divsNo";
/**/      document.getElementById("divPago").className = "divsNo";        
        
        //Deshabilita el boton de datos personales:
        document.getElementById("botonDatos").disabled = true;
/**/      document.getElementById("botonDatos").disabled = true;
/**/      document.getElementById("botonDatos").disabled = true;        
        
        //Con solo un error se para la validacion de unidades:
        return;
      }
      else{
        todoBien = true;
        uniUser[i].className = "uniBien";
      }
    }

    //Si no ha habido ni un solo error, se ejecuta la siguiente funcion que se encarga de cargar el carro de la compra:
    if (todoBien){
      calculaElTotal();
    }
  }

  

  
//FUNCION QUE MUSTRA EL CARRO DE LA COMPRA:
  function calculaElTotal(elEvento) {

  
    //Añade el encabezado de la tabla
    document.getElementById("tablaTotal").innerHTML = '<tr><td class="pro"><b>Producto</b></td><td class="uni"><b>Unidades</b></td><td class="preUni"><b>Precio Unidad</b></td><td class="preTotal"><b>Precio Total</b></td></tr>';
  
  
    //Inicializacion de las variables para esta funcion:
    var carroTotal = 0;
    var numProductos = 0;
    
    
    //Muestra el carrito de la compra
    for (i in productos){

      var tablaTotal = document.getElementById("tablaTotal").innerHTML;
      var preTotal = 0;
    
      
      //Cuenta el numero de productos para saber cuanto costara el transporte
      if (uniUser[i].value != 0){
        numProductos++;
      }
      
      
      if (uniUser[i].value != 0){
      
        //Modifica el css para hacer hueco a los formularios
        document.getElementById("todo").className = "todoSi";
        document.getElementById("menu").className = "menuSi";
        document.getElementById("divZonaCompra").className = "divZonaCompraSi";
        document.getElementById("divTotal").className = "divsSi";
/**/      document.getElementById("divDatos").className = "divsNo";
/**/      document.getElementById("divPago").className = "divsNo";        
        
        //Habilita el boton de datos personales
        document.getElementById("botonDatos").disabled = false;
        
        //Calcula el totalUnidades y rellena el carro de la compra
        preTotal = precios[i] * uniUser[i].value;
        carroTotal = carroTotal + preTotal;
        document.getElementById("tablaTotal").innerHTML = tablaTotal + '<tr class="proCarrito"><td>' +productos[i]+ '</td><td>' +uniUser[i].value+ '</td><td>' +precios[i]+ '</td><td id="preTotal' +i+'" name="preTotal">' +preTotal+ '</td></tr>';
      }
    }
    

    //Se calcula el transporte a pagar segun la cantidad de productos comprados:
    var precioTransporteAPagar;
    if (numProductos <= 2){
      precioTransporteAPagar = precioTransporte[0];
    }
    else if (numProductos <= 3){
      precioTransporteAPagar = precioTransporte[1];
    }
    else if (numProductos <= 4){
      precioTransporteAPagar = precioTransporte[2];
    }
    else if (numProductos >= 5){
      precioTransporteAPagar = precioTransporte[3];
    }

    //Se sacan las cuentas del transporte (si lo hubiese), del iva y el total:
    var totalTransporte = precioTransporteAPagar;
    if(totalTransporte == "gratis"){
      var totalIVA = (carroTotal * IVA);
      var totalAPagar = carroTotal + totalIVA;
    }
    else{
      var totalIVA = ((carroTotal + totalTransporte) * IVA);
      var totalAPagar = carroTotal + totalTransporte + totalIVA;
    }

    
    //Limitar a 2 los decimales a mostrar del IVA:
    totalIVA=totalIVA*100;
    totalIVA=Math.floor(totalIVA);
    totalIVA=totalIVA/100;
    //Limitar a 2 los decimales a mostrar del TOTAL A PAGAR:
    totalAPagar=totalAPagar*100;
    totalAPagar=Math.floor(totalAPagar);
    totalAPagar=totalAPagar/100;    
    
    //Se añade a la tabla el TOTAL que suma el carrito:
    tablaTotal = document.getElementById("tablaTotal").innerHTML;
    document.getElementById("tablaTotal").innerHTML = tablaTotal + '<tr><td> </td> <td></td><td class="preUni"><b>Transporte: </b></td><td class="preTotal"><b>' +totalTransporte+ '</b></td></tr>' + '<tr><td> </td> <td></td><td class="preUni"><b>IVA ('+(IVA*100)+'%): </b></td><td class="preTotal"><b>' +totalIVA+ '</b></td></tr>' + '<tr><td> </td> <td></td><td class="preUni"><b>Total: </b></td><td class="preTotal" id="totalAPagar"><b>' +totalAPagar+ ' €</b></td></tr>';
  } 
  
  
  
  
//FUNCION DE PEDIR DATOS
  function pideDatos(elEvento) {
    document.getElementById("divDatos").className = "divsSi";
/**/  document.getElementById("divTotal").className = "divsNo";
/**/  document.getElementById("divPago").className = "divsNo";    
    document.getElementById("botonPago").disabled = false;
  } 

  

  
//FUNCION DE VALIDACION DE DATOS PERSONALES:
  function validaDatosPersonales(elEvento) {

    var todoBien = true;
  
  
     //Nombre:
      var vNombre = document.getElementById("nombre").value;
      if( vNombre == null || vNombre.length == 0 || /^\s+$/.test(vNombre) || !isNaN(vNombre)) {
        todoBien=false;
        document.getElementById("nombre").className = "textMal";
      }
      else{
        document.getElementById("nombre").className = "textBien";
      } 
  
  
    //DNI:  
      var vDNI = document.getElementById("dni").value;
      var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N',
      'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];
      
      if( !(/^\d{8}[A-Z]$/.test(vDNI)) ) {
        todoBien=false;
        document.getElementById("dni").className = "textMal";
      }
      else{
        document.getElementById("dni").className = "textBien";
      }
      
      if(vDNI.charAt(8) != letras[(vDNI.substring(0, 8))%23]) {
        todoBien=false;
        document.getElementById("dni").className = "textMal";
      } 
      else{
        document.getElementById("dni").className = "textBien";
      } 
  
  
    //Fecha de nacimiento DIA:
      var vFechaNacimientoDia = document.getElementById("fechaNacimientoDia").selectedIndex;
      if( vFechaNacimientoDia == null || vFechaNacimientoDia == 0 ) {
        todoBien=false;
        document.getElementById("fechaNacimientoDia").className = "textMal";
      }
      else{
        document.getElementById("fechaNacimientoDia").className = "textBien";
      }
    //Fecha de nacimiento MES:
      var vFechaNacimientoMes = document.getElementById("fechaNacimientoMes").selectedIndex;
      if( vFechaNacimientoMes == null || vFechaNacimientoMes == 0 ) {
        todoBien=false;
        document.getElementById("fechaNacimientoMes").className = "textMal";
      }
      else{
        document.getElementById("fechaNacimientoMes").className = "textBien";
      } 
    //Fecha de nacimiento AÑO:
      var vFechaNacimientoAnio = document.getElementById("fechaNacimientoAnio").selectedIndex;
      if( vFechaNacimientoAnio == null || vFechaNacimientoAnio == 0 ) {
        todoBien=false;
        document.getElementById("fechaNacimientoAnio").className = "textMal";
      }
      else{
        document.getElementById("fechaNacimientoAnio").className = "textBien";
      } 
  
  
    //Telefono:
      var vMovil = document.getElementById("movil").value;
      if( !(/^\d{9}$/.test(vMovil))  ) {
        todoBien=false;
        document.getElementById("movil").className = "textMal";
      }
      else{
        document.getElementById("movil").className = "textBien";
      } 
  
  
    //email:
      var vEmail1 = document.getElementById("email1").value;
      var vEmail2 = document.getElementById("email2").value;

      //email 1
      if( !(/^\w+([-.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(vEmail1)) ) {
        todoBien=false;
        document.getElementById("email1").className = "textMal";
      }
      else{
        document.getElementById("email1").className = "textBien";
      }
      
      //email 2
      if( !(/^\w+([-.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(vEmail2)) ) {
        todoBien=false;
        document.getElementById("email2").className = "textMal";
      }
      else{
        document.getElementById("email2").className = "textBien";
      }

      //Comparacion email 1 y 2
      if (vEmail1 != vEmail2){
        todoBien=false;
        document.getElementById("email2").className = "textMal";
      }

      
     //Nombre Via:
      var vViaNombre = document.getElementById("viaNombre").value;
      if( vViaNombre == null || vViaNombre.length == 0 || /^\s+$/.test(vViaNombre) || !isNaN(vViaNombre)) {
        todoBien=false;
        document.getElementById("viaNombre").className = "textMal";
      }
      else{
        document.getElementById("viaNombre").className = "textBien";
      }       

      
    //Via Numero: 
      var vViaNumero = document.getElementById("viaNumero").value;
      if( vViaNumero=="" || isNaN(vViaNumero) ) {
        todoBien=false;
        document.getElementById("viaNumero").className = "textMal";
      } 
      else{
        document.getElementById("viaNumero").className = "textBien";
      } 

      
     //Localidad:
      var vLocalidad = document.getElementById("localidad").value;
      if( vLocalidad == null || vLocalidad.length == 0 || /^\s+$/.test(vLocalidad) || !isNaN(vLocalidad)) {
        todoBien=false;
        document.getElementById("localidad").className = "textMal";
      }
      else{
        document.getElementById("localidad").className = "textBien";
      }         

      
    //Codigo Postal:  
      var vCodigoPostal = document.getElementById("codigoPostal").value;
      if( vCodigoPostal.length!=5 || vCodigoPostal=="" || isNaN(vCodigoPostal) ) {
        todoBien=false;
        document.getElementById("codigoPostal").className = "textMal";
      } 
      else{
        document.getElementById("codigoPostal").className = "textBien";
      } 
  
  
    //Provincia:
      var vProvincia = document.getElementById("provincia").selectedIndex;
      if( vProvincia == null || vProvincia == 0 ) {
        todoBien=false;
        document.getElementById("provincia").className = "textMal";
      }
      else{
        document.getElementById("provincia").className = "textBien";
      } 
  
  
    //Si no ha habido ni un solo error, se ejecuta la siguiente funcion que se encarga de mostrar el formulario de los datos personales:
    if (todoBien){
      pideDatosPago();
    }
    else{
      document.getElementById("botonConfirmar").disabled = true;
    }
  }

  
  
  
//FUNCION DE VALIDAR DATOS y PEDIR DATOS PAGO
  function pideDatosPago(elEvento) {
/**/  document.getElementById("divTotal").className = "divsNo";
/**/  document.getElementById("divDatos").className = "divsNo";
    document.getElementById("divPago").className = "divsSi";
    document.getElementById("botonConfirmar").disabled = false;
  }
  
  

  
//FUNCION DE VALIDACION DE DATOS PAGO:
  function validaDatosPago(elEvento) {

    var todoBien = true;
    
    //Titular de la cuenta:
    var vTitular = document.getElementById("titular").value;
    if( vTitular == null || vTitular.length == 0 || /^\s+$/.test(vTitular) || !isNaN(vTitular)) {
      todoBien=false;
      document.getElementById("titular").className = "textMal";
    }
    else{
      document.getElementById("titular").className = "textBien";
    }     
  
  
    //Tipo de tarjeta:
    var vTarjetas = document.getElementsByName("tarjetas");
    var seleccionado = false;
    for(var i=0; i<vTarjetas.length; i++) {
      if(vTarjetas[i].checked) {
        seleccionado = true;
        //break;
      }
    }
    if(!seleccionado) {
      todoBien=false;
      document.getElementById("alertTipoDeTarjeta").className = "alertTipoDeTarjeta";
    }
    else{
      document.getElementById("alertTipoDeTarjeta").className = "";
    }   
  
  
    //Numero de tarjeta:  
    var vNumeroTarjeta = document.getElementById("numeroTarjeta").value;
    if( vNumeroTarjeta.length!=16 || vNumeroTarjeta=="" || isNaN(vNumeroTarjeta) ) {
      todoBien=false;
      document.getElementById("numeroTarjeta").className = "textMal";
    } 
    else{
      document.getElementById("numeroTarjeta").className = "textBien";
    }   

    
    //CVC de la tarjeta:  
    var vCvcTarjeta = document.getElementById("cvcTarjeta").value;
    if( vCvcTarjeta.length!=3 || vCvcTarjeta=="" || isNaN(vCvcTarjeta) ) {
      todoBien=false;
      document.getElementById("cvcTarjeta").className = "textMal";
    } 
    else{
      document.getElementById("cvcTarjeta").className = "textBien";
    } 

    
    //Fecha de tarjeta MES:
    var vMesTarjeta = document.getElementById("mesTarjeta").selectedIndex;
    if( vMesTarjeta == null || vMesTarjeta == 0 ) {
      todoBien=false;
      document.getElementById("mesTarjeta").className = "textMal";
    }
    else{
      document.getElementById("mesTarjeta").className = "textBien";
    } 
    //Fecha de tarjeta AÑO:
    var vAnioTarjeta = document.getElementById("anioTarjeta").selectedIndex;
    if( vAnioTarjeta == null || vAnioTarjeta == 0 ) {
      todoBien=false;
      document.getElementById("anioTarjeta").className = "textMal";
    }
    else{
      document.getElementById("anioTarjeta").className = "textBien";
    }       


    //Si no ha habido ni un solo error, se ejecuta la siguiente funcion que se encarga de enviar los datos:
    if (todoBien){
      validaDatosPagoYEnviaCarro();
    }
  }

  


//FUNCION DE VALIDAR DATOS PAGO y ENVIAR DATOS
  function validaDatosPagoYEnviaCarro(elEvento) {
    alert("Gracias por su compra, en 24 horas recivira su pedido\nAhora sera redirigido a la pagina de inicio.");
    window.location.reload()
  }
  </script>

</head>

<body>
<div id="todo" class="todoNo">
      <div id="menu" class="menuNo">
        
        
        <!--Producto del 1 al 9-->
        <div id="div1" name="DIVS"></div>
        <div id="div2" name="DIVS"></div>
        <div id="div3" name="DIVS"></div>
        <div id="div4" name="DIVS"></div>
        <div id="div5" name="DIVS"></div>
        <div id="div6" name="DIVS"></div>
        <div id="div7" name="DIVS"></div>
        <div id="div8" name="DIVS"></div>
        <div id="div9" name="DIVS"></div>
    
        
        <!--Botones de compra-->
        <div id="divbotones">
          <input type="button" id="botonTotal" value="Calcular total"/>
          <input type="button" id="botonDatos" value="Datos personales" disabled="disabled"/>
          <input type="button" id="botonPago" value="Pago" disabled="disabled"/>
          <input type="button" id="botonConfirmar" value="Confirmar pedido" disabled="disabled"/>
         </div>

        
        <!--zona de compra, tablas, formularios, etc.-->
        <div id="divZonaCompra" class="divZonaCompraNo">

        
          <!--Carrito de la compra-->
          <div id="divTotal" class="divsNo">
            <p><b>Carrito de la compra, si quiere hacer alguna modificacion aun esta a tiempo:</b></p>
            <table id="tablaTotal"></table>
          </div>
        
        
          <!--Datos personales-->       
          <div id="divDatos" class="divsNo">
            <p><b>Introduzca sus datos personales:</b></p>

              <div id="divDatosPersonales0">
                <div id="divDatosPersonales1">
                  <label>Nombre completo:</label><br/>
                  <input type="text" id="nombre" value="" size="26" /><br/>
                  
                  
                  <label>DNI:</label><br/>
                  <input type="text" id="dni" value="" size="8" maxlength="9" /><br/>
                  
                  
                  <label>Fecha de nacimiento:</label><br/>
                  <select id="fechaNacimientoDia">
                    <option value=""> dia </option>
                  </select>
                  <select id="fechaNacimientoMes">
                    <option value="">      mes</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                  </select>     
                  <select id="fechaNacimientoAnio">
                    <option value="">  año </option>
                  </select><br/>
                </div>
                
                <div id="divDatosPersonales2">
                  <label>Telefono movil:</label><br/>
                  <input type="text" id="movil" value="" size="8" maxlength="9"/><br/>

                  <label>Email:</label><br/>
                  <input type="text" id="email1" value="" size="25" /><br/>
                  
                  <label>Repita el email:</label><br/>
                  <input type="text" id="email2" value="" size="25" />              
                </div>
              </div>

              
            <div id="divDomicilio">
              <label>Tipo de via:</label>
              <select id="tipoDeVia">
                <option value="Avenida">Avenida</option>
                <option value="Calle"selected="selected">Calle</option>
                <option value="Camino">Camino</option>
                <option value="Carretera">Carretera</option>
                <option value="Pasaje">Pasaje</option>
                <option value="Plaza">Plaza</option>
                <option value="Residencia">Residencia</option>
                <option value="Ronda">Ronda</option>
                <option value="Travesia">Travesia</option>
                <option value="Urbanizacion">Urbanizacion</option>
              </select>     
              
              <label>Nombre via:</label>
              <input type="text" id="viaNombre" value="" size="20" /><br/>
              
              <label>Nº/km:</label>
              <input type="text" id="viaNumero" value="" size="2" />  
                
              <label>Bloque:</label>
              <input type="text" id="viaBloque" value="" size="2" />         

              <label>Escalera:</label>
              <input type="text" id="viaEscalera" value="" size="2" />  
                
              <label>Piso:</label>
              <input type="text" id="viaPiso" value="" size="2" /><br/>
              
              
              <label>Localidad:</label>
              <input type="text" id="localidad" value="" size="13"/>  
              
              <label>Codigo Postal:</label>
              <input type="text" id="codigoPostal" value="" size="5" maxlength="5"/>  
              
              <label>Provincia:</label>
              <select id="provincia">
                <option value="">          provincia</option>
                <option value="15">A coruña</option>
                <option value="1">Álava</option>
                <option value="2">Albacete</option>
                <option value="3">Alicante</option>
                <option value="4">Almería</option>
                <option value="33">Asturias</option>
                <option value="5">Ávila</option>
                <option value="6">Badajoz</option>
                <option value="7">Baleares</option>
                <option value="8">Barcelona</option>
                <option value="9">Burgos</option>
                <option value="10">Cáceres</option>
                <option value="11">Cádiz</option>
                <option value="39">Cantabria</option>
                <option value="12">Castellón</option>
                <option value="51">Ceuta</option>
                <option value="13">Ciudad Real</option>
                <option value="14">Córdoba</option>
                <option value="16">Cuenca</option>
                <option value="99">Extranjero</option>
                <option value="17">Girona</option>
                <option value="18">Granada</option>
                <option value="19">Guadalajara</option>
                <option value="20">Guipúzcoa</option>
                <option value="21">Huelva</option>
                <option value="22">Huesca</option>
                <option value="23">Jaén</option>
                <option value="26">La rioja</option>
                <option value="35">Las palmas</option>
                <option value="24">León</option>
                <option value="25">Lleida</option>
                <option value="27">Lugo</option>
                <option value="28">Madrid</option>
                <option value="29">Málaga</option>
                <option value="52">Melilla</option>
                <option value="30">Murcia</option>
                <option value="31">Navarra</option>
                <option value="32">Ourense</option>
                <option value="34">Palencia</option>
                <option value="36">Pontevedra</option>
                <option value="37">Salamanca</option>
                <option value="38">Santa cruz de tenerife</option>
                <option value="40">Segovia</option>
                <option value="41">Sevilla</option>
                <option value="42">Soria</option>
                <option value="43">Tarragona</option>
                <option value="44">Teruel</option>
                <option value="45">Toledo</option>
                <option value="46">Valencia</option>
                <option value="47">Valladolid</option>
                <option value="48">Vizcaya</option>
                <option value="49">Zamora</option>
                <option value="50">Zaragoza</option>
              </select>
            </div>                
          </div>          
          
          
          <!--Datos de pago-->
          <div id="divPago" class="divsNo">
            <p><b>Introduzca los datos de la tarjeta de credito/debito donde se cargara el cobro:</b></p>

            
            <label>Titular de la tarjeta:</label><br/>
            <input type="text" id="titular" value="" size="26" /><br/>

            
            <div id="metodosDePago">
              <label><span  id="alertTipoDeTarjeta">Tipo de tarjeta:</span></label><br/>
              <label for="visa">
                <input type="radio" id="visa" name="tarjetas" class="logoTarjetas" value="Visa">
                <img src="img/pago/visa.gif"></img>
              </label>
                
              <label for="masterCard">
                <input type="radio" id="masterCard" name="tarjetas" class="logoTarjetas" value="MasterCard">
                <img src="img/pago/mastercard.gif"></img>
              </label>
                
              <label for="amex">
                <input type="radio" id="amex" name="tarjetas" class="logoTarjetas" value="American Express">
                <img src="img/pago/amex.gif"></img>
              </label>
                
              <label for="aurora">
                <input type="radio" id="aurora" name="tarjetas" class="logoTarjetas" value="Aurora">
                <img src="img/pago/aurora.gif"></img>
              </label>
          
            </div>
            
            
            <div id="divNumeroTarjeta">
              <label>Número tarjeta y CVC:</label><br/>
              <input type="text" id="numeroTarjeta" value="" size="15" maxlength="16" />
              <input type="text" id="cvcTarjeta" value="" size="2" maxlength="3" /><br/>
              
              
              <select id="mesTarjeta">
                <option value="">  mes </option>
              </select>

              <select id="anioTarjeta">
                <option value="">  año </option>
              </select>
            </div>
          </div>            
        </div>
      </div>  
    </div>
    <p class="pie">Imagen de fondo propiedad de <a href="http://www.appinformatica.com/" target="_black">appinformatica</a></p>
  

</body>
</html>
