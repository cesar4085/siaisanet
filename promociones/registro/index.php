<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es" >
<head>
  <meta charset="UTF-8">
  <title>REGISTRO CANDIDATO</title>
  <?php
 
        require_once '../php/Model/CandidatoModel.php'; 
        if(isset($_GET['guid'])){
            $guid=$_GET['guid'];
            $candidatoModel= new CandidatoModel();
            $candidato=$candidatoModel->getInfoByGuid($guid)[0];
            
        }
        
   ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Angular Material style sheet -->
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
</head>
<body ng-app="registroApp" ng-cloak>
 
  <div ng-controller="registroCtrl" layout="column" ng-cloak>
  <md-toolbar md-scroll-shrink ng-if="true">
    <div class="md-toolbar-tools">
      <h3>
          <span style="color: white!important">FINANCIERA AYUDAMOS</span>
      </h3>
    </div>
  </md-toolbar>
  <md-content layout-padding>
      <form name="userForm" method="POST" action="../registro-completo/">
          <h3 class="md-subhead" style="text-align: justify">Gracias <strong><?php echo  isset($candidato)?  $candidato['nombre']:'' ?></strong> por interesarte en tu credito preautorizado</h3>
        <small><i>Por favor ingresa los siguientes datos para ponernos en contacto</i></small>
        <input type="hidden" name="id_candidato" value="<?php echo  isset($candidato)?  $candidato['id_candidato']:''?>"/> 
       <div layout-gt-sm="row">
          <md-input-container class="md-block" flex-gt-sm>
            <label>Nombre completo</label>
            <input name="nombre"  value="<?php echo isset($candidato)?  $candidato['nombre']: ''?>" ng-required="candidato.consentimiento==1"> 
          </md-input-container>
        </div>
        <md-input-container class="md-block">
          <label>Telefono celular</label>
          <input name="tel_movil" solo-numeros type="tel" pattern=".{10,}"   required title="10 caracteres como minimo" maxlength="10" ng-model="candidato.celular" ng-required="candidato.consentimiento==1">
        </md-input-container>
        <md-input-container class="md-block">
          <label>Telefono Adicional</label>
          <input name="tel_opcional" solo-numeros type="tel" pattern=".{10,}"    title="10 caracteres como minimo" maxlength="10" ng-model="candidato.adicional">
        </md-input-container>
          <div  flex>
              <h4 class="md-subhead">
                  <small>
                      Otorgo mi consentimiento a Financiera Ayudamos, S.A. de C.V., SOFOM, ER. para que se traten mis datos personales financieros, en su caso, para identificación, operación, administración, los cuales podrán ser transferidos a terceros solo para estos fines.
                  </small>     
                     
              </h4>
              <input style="display: none" type="text" name="consentimiento" ng-model="candidato.consentimiento"/>
              <md-radio-group  ng-model="candidato.consentimiento" layout="row">
                <md-radio-button name="acepto" value=1 class="md-primary" >ACEPTO</md-radio-button>
                <md-radio-button name="acepto" value=0 class="md-primary">NO ACEPTO</md-radio-button>
              </md-radio-group>
              <br>
              <div layout="column">
                    <md-button type="submit" flex="100" layout-wrap layout-margin layout-align="center" class="md-raised md-primary"  style="color:white!important">ENVIAR SOLICITUD</md-button>
          
              </div>
              
           
          
          </div>
          
 
                   

         
      </form>
  </md-content>
</div>
  <!-- Angular Material requires Angular.js Libraries -->
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

  <!-- Angular Material Library -->
  <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
  
  <!-- Your application bootstrap  -->
  <script type="text/javascript">    
    /**
     * You must include the dependency on 'ngMaterial' 
     */
   var app=angular.module('registroApp', ['ngMaterial']).config(function($mdThemingProvider) {
        $mdThemingProvider.theme('default')
          .primaryPalette('orange')
          .accentPalette('orange');
      });
      
    app.directive('soloNumeros', function () {
       return {
           require: 'ngModel',
           link: function (scope, element, attr, ngModelCtrl) {
               function fromUser(text) {
                   if (text) {
                       var transformedInput = text.replace(/[^0-9]/g, '');

                       if (transformedInput !== text) {
                           ngModelCtrl.$setViewValue(transformedInput);
                           ngModelCtrl.$render();
                       }
                       return transformedInput;
                   }
                   return undefined;
               }            
               ngModelCtrl.$parsers.push(fromUser);
           }
       };
   });
   app.controller("registroCtrl",function($scope){
      
   });
  </script>
  
</body>
</html>

