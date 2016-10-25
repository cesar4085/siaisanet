<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailModel
 *
 * @author Victor Ortiz
*/
include_once(__DIR__ . '/Conexion.php');
require_once '../vendor/autoload.php';
use Mailgun\Mailgun;
class EmailModel {
    
     public  function agregarSusbscriptores($no_contrato,$nombre,$email,$count){
         $conexion = new Conexion();
         $conn=$conexion->getConexionEmail();
         $query=$conn->prepare("INSERT INTO subscriptores(no_contrato,nombre,email) VALUES (:no_contrato,:nombre,:email)");
         $query->bindParam(":no_contrato",$no_contrato);
         $query->bindParam(":nombre",$nombre);
         $query->bindParam(":email",$email);
         $query->execute();
        
         
     }
     
     public  function getSubscriptores(){
         $conexion = new Conexion();
         $conn=$conexion->getConexionEmail();
         $query=$conn->prepare("SELECT* FROM subscriptores");
         $query->execute();
         $res=$query->fetchAll(PDO::FETCH_ASSOC);
         return $res;
     }
     
     public  function getCustomHtml($nombre,$monto){
            $html='';
            $html.= "<html xmlns=\"http://www.w3.org/1999/xhtml\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"><meta name=\"viewport\" content=\"initial-scale=1.0\"><meta name=\"format-detection\" content=\"telephone=no\"><title>MOSAICO Responsive Email Designer</title><style type=\"text/css\">table.vb-row.fullwidth {border-spacing: 0;padding: 0;}\n"; 
            $html.= "table.vb-container.fullwidth {padding-left: 0;padding-right: 0;}</style><style type=\"text/css\">\n"; 
            $html.= "    /* yahoo, hotmail */\n"; 
            $html.= "    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{ line-height: 100%; }\n"; 
            $html.= "    .yshortcuts a{ border-bottom: none !important; }\n"; 
            $html.= "    .vb-outer{ min-width: 0 !important; }\n"; 
            $html.= "    .RMsgBdy, .ExternalClass{\n"; 
            $html.= "      width: 100%;\n"; 
            $html.= "      background-color: #3f3f3f;\n"; 
            $html.= "      background-color: #3f3f3f}\n"; 
            $html.= "\n"; 
            $html.= "    /* outlook */\n"; 
            $html.= "    table{ mso-table-rspace: 0pt; mso-table-lspace: 0pt; }\n"; 
            $html.= "    #outlook a{ padding: 0; }\n"; 
            $html.= "    img{ outline: none; text-decoration: none; border: none; -ms-interpolation-mode: bicubic; }\n"; 
            $html.= "    a img{ border: none; }\n"; 
            $html.= "\n"; 
            $html.= "    @media screen and (max-device-width: 600px), screen and (max-width: 600px) {\n"; 
            $html.= "      table.vb-container, table.vb-row{\n"; 
            $html.= "        width: 95% !important;\n"; 
            $html.= "      }\n"; 
            $html.= "\n"; 
            $html.= "      .mobile-hide{ display: none !important; }\n"; 
            $html.= "      .mobile-textcenter{ text-align: center !important; }\n"; 
            $html.= "\n"; 
            $html.= "      .mobile-full{\n"; 
            $html.= "        float: none !important;\n"; 
            $html.= "        width: 100% !important;\n"; 
            $html.= "        max-width: none !important;\n"; 
            $html.= "        padding-right: 0 !important;\n"; 
            $html.= "        padding-left: 0 !important;\n"; 
            $html.= "      }\n"; 
            $html.= "      img.mobile-full{\n"; 
            $html.= "        width: 100% !important;\n"; 
            $html.= "        max-width: none !important;\n"; 
            $html.= "        height: auto !important;\n"; 
            $html.= "      }   \n"; 
            $html.= "    }\n"; 
            $html.= "  </style><style type=\"text/css\">#ko_singleArticleBlock_16 .links-color a, #ko_singleArticleBlock_16 .links-color a:link, #ko_singleArticleBlock_16 .links-color a:visited, #ko_singleArticleBlock_16 .links-color a:hover {color: #3f3f3f;color: #3f3f3f;text-decoration: underline;}\n"; 
            $html.= "#ko_singleArticleBlock_16 .long-text p {margin: 1em 0px;}\n"; 
            $html.= "#ko_singleArticleBlock_16 .long-text p:last-child {margin-bottom: 0px;}\n"; 
            $html.= "#ko_singleArticleBlock_16 .long-text p:first-child {margin-top: 0px;}\n"; 
            $html.= "#ko_textBlock_19 .links-color a, #ko_textBlock_19 .links-color a:link, #ko_textBlock_19 .links-color a:visited, #ko_textBlock_19 .links-color a:hover {color: #3f3f3f;color: #3f3f3f;text-decoration: underline;}\n"; 
            $html.= "#ko_textBlock_20 .links-color a, #ko_textBlock_20 .links-color a:link, #ko_textBlock_20 .links-color a:visited, #ko_textBlock_20 .links-color a:hover {color: #3f3f3f;color: #3f3f3f;text-decoration: underline;}\n"; 
            $html.= "#ko_textBlock_19 .long-text p:last-child {margin-bottom: 0px;}\n"; 
            $html.= "#ko_socialBlock_13 .links-color a:visited, #ko_socialBlock_13 .links-color a:hover {color: #ccc;color: #ccc;text-decoration: underline;}\n"; 
            $html.= "#ko_footerBlock_2 .links-color a, #ko_footerBlock_2 .links-color a:link, #ko_footerBlock_2 .links-color a:visited, #ko_footerBlock_2 .links-color a:hover {color: #ccc;color: #ccc;text-decoration: underline;}</style></head><body bgcolor=\"#3f3f3f\" text=\"#919191\" alink=\"#cccccc\" vlink=\"#cccccc\" style=\"margin: 0;padding: 0;background-color: #3f3f3f;color: #919191;\">\n"; 
            $html.= "\n"; 
            $html.= "  <center>\n"; 
            $html.= "\n"; 
            $html.= "  <!-- preheaderBlock -->\n"; 
            $html.= "  \n"; 
            $html.= "\n"; 
            $html.= "  <table class=\"vb-outer\" width=\"100%\" cellpadding=\"0\" border=\"0\" cellspacing=\"0\" bgcolor=\"#3f3f3f\" style=\"background-color: #3f3f3f;\" id=\"ko_preheaderBlock_1\"><tbody><tr><td class=\"vb-outer\" align=\"center\" valign=\"top\" bgcolor=\"#3f3f3f\" style=\"padding-left: 9px;padding-right: 9px;background-color: #3f3f3f;\">\n"; 
            $html.= "        <div style=\"display: none; font-size: 1px; color: #333333; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;\"></div>\n"; 
            $html.= "\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->\n"; 
            $html.= "        <div class=\"oldwebkit\" style=\"max-width: 570px;\">\n"; 
            $html.= "        <table width=\"570\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"vb-row halfpad\" bgcolor=\"#3f3f3f\" style=\"border-collapse: separate;border-spacing: 0;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 570px;background-color: #3f3f3f;\"><tbody><tr><td align=\"center\" valign=\"top\" bgcolor=\"#3f3f3f\" style=\"font-size: 0; background-color: #3f3f3f;\">\n"; 
            $html.= "\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"552\"><tr><![endif]-->\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]><td align=\"left\" valign=\"top\" width=\"276\"><![endif]--> \n"; 
            $html.= "<div style=\"display: inline-block; max-width: 276px; vertical-align: top; width: 100%;\" class=\"mobile-full\"> \n"; 
            $html.= "                    </div><!--[if (gte mso 9)|(lte ie 8)]>\n"; 
            $html.= "</td><td align=\"left\" valign=\"top\" width=\"276\">\n"; 
            $html.= "<![endif]--><div style=\"display: inline-block; max-width: 276px; vertical-align: top; width: 100%;\" class=\"mobile-full mobile-hide\"> \n"; 
            $html.= "\n"; 
            $html.= "                    <table class=\"vb-content\" border=\"0\" cellspacing=\"9\" cellpadding=\"0\" width=\"276\" style=\"border-collapse: separate;width: 100%;text-align: right;\" align=\"left\"><tbody><tr><td width=\"100%\" valign=\"top\" style=\"font-weight: normal; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #ffffff;\">\n"; 
            $html.= "                      <span style=\"color: #ffffff; text-decoration: underline;\">\n"; 
            $html.= "                          <a href=\"%5Bshow_link%5D\" style=\"text-decoration: underline; color: #ffffff;\" target=\"_new\">View in your browser</a>\n"; 
            $html.= "                         </span>\n"; 
            $html.= "                       </td>\n"; 
            $html.= "                      </tr></tbody></table></div><!--[if (gte mso 9)|(lte ie 8)]>\n"; 
            $html.= "</td></tr></table><![endif]-->\n"; 
            $html.= "\n"; 
            $html.= "            </td>\n"; 
            $html.= "          </tr></tbody></table></div>\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->\n"; 
            $html.= "      </td>\n"; 
            $html.= "    </tr></tbody></table><!-- /preheaderBlock --><table class=\"vb-outer\" width=\"100%\" cellpadding=\"0\" border=\"0\" cellspacing=\"0\" bgcolor=\"#eeece1\" style=\"background-color: #eeece1;\" id=\"ko_singleArticleBlock_16\"><tbody><tr><td class=\"vb-outer\" align=\"center\" valign=\"top\" bgcolor=\"#eeece1\" style=\"padding-left: 9px;padding-right: 9px;background-color: #eeece1;\">\n"; 
            $html.= "\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->\n"; 
            $html.= "        <div class=\"oldwebkit\" style=\"max-width: 570px;\">\n"; 
            $html.= "        <table width=\"570\" border=\"0\" cellpadding=\"0\" cellspacing=\"18\" class=\"vb-container fullpad\" bgcolor=\"#ffffff\" style=\"border-collapse: separate;border-spacing: 18px;padding-left: 0;padding-right: 0;width: 100%;max-width: 570px;background-color: #fff;\"><tbody><tr><td width=\"100%\" valign=\"top\" align=\"left\" class=\"links-color\">\n"; 
            $html.= "              \n"; 
            $html.= "                <img border=\"0\" hspace=\"0\" vspace=\"0\" width=\"534\" class=\"mobile-full\" alt=\"\" style=\"border: 0px;display: block;vertical-align: top;max-width: 534px;width: 100%;height: auto;\" src=\"https://mosaico.io/srv/f-3v0jtpx/img?src=https%3A%2F%2Fmosaico.io%2Ffiles%2F3v0jtpx%2Fbanner-promociones.jpg&amp;method=resize&amp;params=534%2Cnull\"></td>\n"; 
            $html.= "          </tr><tr><td><table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"><tbody><tr><td style=\"font-size: 18px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f; text-align: left;\">\n"; 
            $html.= "                <span style=\"color: #3f3f3f;\">Estimad@ $nombre </span>\n"; 
            $html.= "              </td>\n"; 
            $html.= "            </tr><tr><td height=\"9\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>\n"; 
            $html.= "            </tr><tr><td align=\"left\" class=\"long-text links-color\" style=\"text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;\"><h4>USTED TIENE UN CRÉDITO &nbsp;PREAPROBADO POR<span style=\"color: #f70505;\" data-mce-style=\"color: #f70505;\"><strong> $monto &nbsp;</strong></span></h4></td>\n"; 
            $html.= "            </tr><tr><td height=\"13\" style=\"font-size: 1px; line-height: 1px;\">&nbsp;</td>\n"; 
            $html.= "            </tr><tr><td valign=\"top\">\n"; 
            $html.= "                <table cellpadding=\"0\" border=\"0\" align=\"left\" cellspacing=\"0\" class=\"mobile-full\"><tbody><tr><td width=\"auto\" valign=\"middle\" bgcolor=\"#f79646\" align=\"center\" height=\"26\" style=\"font-size: 13px; font-family: Arial, Helvetica, sans-serif; text-align: center; color: #ffffff; font-weight: normal; padding-left: 18px; padding-right: 18px; background-color: #f79646; border-radius: 4px;\">\n"; 
            $html.= "                      \n"; 
            $html.= "\n"; 
            $html.= "<a style=\"text-decoration: none; color: #ffffff; font-weight: normal;\" target=\"_new\" href=\"\">ME INTERESA</a>\n"; 
            $html.= "                    </td>\n"; 
            $html.= "\n"; 
            $html.= "<td width=\"auto\" valign=\"middle\" bgcolor=\"#f79646\" align=\"center\" height=\"26\" style=\"font-size: 13px;font-family: Arial, Helvetica, sans-serif;text-align: center;color: #ffffff;font-weight: normal;padding-left: 18px;padding-right: 18px;background-color: #f79646;border-radius: 4px;/* margin-left: -100px; *//* margin: 3px; */\">\n"; 
            $html.= "                      \n"; 
            $html.= "\n"; 
            $html.= "<a style=\"text-decoration: none; color: #ffffff; font-weight: normal;\" target=\"_new\" href=\"\">NO ME INTERESA</a>\n"; 
            $html.= "                    </td>\n"; 
            $html.= "                  </tr></tbody></table></td>\n"; 
            $html.= "            </tr></tbody></table></td></tr></tbody></table></div>\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->\n"; 
            $html.= "      </td>\n"; 
            $html.= "    </tr></tbody></table><table class=\"vb-outer\" width=\"100%\" cellpadding=\"0\" border=\"0\" cellspacing=\"0\" bgcolor=\"#eeece1\" style=\"background-color: #eeece1;\" id=\"ko_textBlock_19\"><tbody><tr><td class=\"vb-outer\" align=\"center\" valign=\"top\" bgcolor=\"#eeece1\" style=\"padding-left: 9px;padding-right: 9px;background-color: #eeece1;\">\n"; 
            $html.= "\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->\n"; 
            $html.= "        <div class=\"oldwebkit\" style=\"max-width: 570px;\">\n"; 
            $html.= "        <table width=\"570\" border=\"0\" cellpadding=\"0\" cellspacing=\"18\" class=\"vb-container fullpad\" bgcolor=\"#ffffff\" style=\"border-collapse: separate;border-spacing: 18px;padding-left: 0;padding-right: 0;width: 100%;max-width: 570px;background-color: #fff;\"><tbody><tr><td align=\"left\" class=\"long-text links-color\" style=\"text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;\"><p style=\"margin: 1em 0px;margin-top: 0px;\">También tienes la opción de acudir a la siguiente sucursal &nbsp;con el número de folio <strong><span style=\"color: #ff0000;\" data-mce-style=\"color: #ff0000;\">1450</span></strong></p><ul><li><strong>SUCURSAL: <span style=\"color: rgb(252, 105, 0);\" data-mce-style=\"color: #fc6900;\">ALGUNA SUCURSAL</span></strong></li><li><strong>DIRECCIÓN: <span style=\"color: rgb(252, 105, 0);\" data-mce-style=\"color: #fc6900;\">ALGUNA DIRECCIÓN</span></strong></li><li><strong>TELÉFONO: <span style=\"color: rgb(252, 105, 0);\" data-mce-style=\"color: #fc6900;\">5525051392</span></strong></li></ul></td>\n"; 
            $html.= "          </tr></tbody></table></div>\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->\n"; 
            $html.= "      </td>\n"; 
            $html.= "    </tr></tbody></table><table class=\"vb-outer\" width=\"100%\" cellpadding=\"0\" border=\"0\" cellspacing=\"0\" bgcolor=\"#eeece1\" style=\"background-color: #eeece1;\" id=\"ko_textBlock_20\"><tbody><tr><td class=\"vb-outer\" align=\"center\" valign=\"top\" bgcolor=\"#eeece1\" style=\"padding-left: 9px;padding-right: 9px;background-color: #eeece1;\">\n"; 
            $html.= "\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->\n"; 
            $html.= "        <div class=\"oldwebkit\" style=\"max-width: 570px;\">\n"; 
            $html.= "        <table width=\"570\" border=\"0\" cellpadding=\"0\" cellspacing=\"18\" class=\"vb-container fullpad\" bgcolor=\"#ffffff\" style=\"border-collapse: separate;border-spacing: 18px;padding-left: 0;padding-right: 0;width: 100%;max-width: 570px;background-color: #fff;\"><tbody><tr><td align=\"left\" class=\"long-text links-color\" style=\"text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;\"><p style=\"margin: 1em 0px;margin-bottom: 0px;margin-top: 0px;text-align: center;\" data-mce-style=\"text-align: center;\">Vigencia para contratar el crédito del 24 de abril de 2015 al 05 de junio de 2015 Comisión por apertura: 9% (nueve por ciento) Tasa fija: 49.2% anual (cuarenta y nueve punto dos por ciento) Moneda Nacional ( Pesos mexicanos) * Aplican restricciones. Sujeto a buen historial crediticio y a capacidad de pago. <br>CAT: 124.71%<br>Sin IVA. Informativo. Fecha de cálculo: 23 de abril del 2015<br></p></td>\n"; 
            $html.= "          </tr></tbody></table></div>\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->\n"; 
            $html.= "      </td>\n"; 
            $html.= "    </tr></tbody></table><table width=\"100%\" cellpadding=\"0\" border=\"0\" cellspacing=\"0\" bgcolor=\"#3f3f3f\" style=\"background-color: #3f3f3f;\" id=\"ko_socialBlock_13\"><tbody><tr><td align=\"center\" valign=\"top\" bgcolor=\"#3f3f3f\" style=\"background-color: #3f3f3f;\">\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->\n"; 
            $html.= "        <div class=\"oldwebkit\" style=\"max-width: 570px;\">\n"; 
            $html.= "        <table width=\"570\" style=\"border-collapse: separate;border-spacing: 9px;width: 100%;max-width: 570px;\" border=\"0\" cellpadding=\"0\" cellspacing=\"9\" class=\"vb-row fullpad\" align=\"center\"><tbody><tr><td valign=\"top\" align=\"center\" style=\"font-size: 0;\">\n"; 
            $html.= "\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"552\"><tr><![endif]-->\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]><td align=\"left\" valign=\"top\" width=\"276\"><![endif]--> \n"; 
            $html.= "<div style=\"display: inline-block; max-width: 276px; vertical-align: top; width: 100%;\" class=\"mobile-full\"> \n"; 
            $html.= "\n"; 
            $html.= "                    <table class=\"vb-content\" border=\"0\" cellspacing=\"9\" cellpadding=\"0\" width=\"276\" style=\"border-collapse: separate;width: 100%;\" align=\"left\"><tbody><tr><td valign=\"middle\" align=\"left\" class=\"long-text links-color mobile-textcenter\" style=\"font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #919191; text-align: left;\">\n"; 
            $html.= "                          <p style=\"margin: 1em 0px;margin-bottom: 0px;margin-top: 0px;\">Address and <a href=\"\" style=\"color: #ccc;text-decoration: underline;\">Contacts</a></p>\n"; 
            $html.= "                        </td>\n"; 
            $html.= "                      </tr></tbody></table></div><!--[if (gte mso 9)|(lte ie 8)]></td>\n"; 
            $html.= "<td align=\"left\" valign=\"top\" width=\"276\">\n"; 
            $html.= "<![endif]--><div style=\"display: inline-block; max-width: 276px; vertical-align: top; width: 100%;\" class=\"mobile-full\"> \n"; 
            $html.= "\n"; 
            $html.= "                    <table class=\"vb-content\" border=\"0\" cellspacing=\"9\" cellpadding=\"0\" width=\"276\" style=\"border-collapse: separate;width: 100%;\" align=\"right\"><tbody><tr><td align=\"right\" valign=\"middle\" class=\"links-color socialLinks mobile-textcenter\" style=\"font-size: 6px;\">\n"; 
            $html.= "                          &nbsp;\n"; 
            $html.= "                          <a target=\"_new\" href=\"\" style=\"display: inline-block;color: #ccc;text-decoration: underline;\">\n"; 
            $html.= "                            <img src=\"https://mosaico.io/templates/versafix-1/img/social_def/facebook_ok.png\" alt=\"Facebook\" border=\"0\" class=\"socialIcon\" style=\"border: 0px;border-radius: 100%;display: inline-block;vertical-align: top;padding-bottom: 0px;\"></a>\n"; 
            $html.= "                          &nbsp;\n"; 
            $html.= "                          <a target=\"_new\" href=\"\" style=\"display: inline-block;color: #ccc;text-decoration: underline;\">\n"; 
            $html.= "                            <img src=\"https://mosaico.io/templates/versafix-1/img/social_def/twitter_ok.png\" alt=\"Twitter\" border=\"0\" class=\"socialIcon\" style=\"border: 0px;border-radius: 100%;display: inline-block;vertical-align: top;padding-bottom: 0px;\"></a>\n"; 
            $html.= "                          &nbsp;\n"; 
            $html.= "                          <a target=\"_new\" href=\"\" style=\"display: inline-block;color: #ccc;text-decoration: underline;\">\n"; 
            $html.= "                            <img src=\"https://mosaico.io/templates/versafix-1/img/social_def/google+_ok.png\" alt=\"Google+\" border=\"0\" class=\"socialIcon\" style=\"border: 0px;border-radius: 100%;display: inline-block;vertical-align: top;padding-bottom: 0px;\"></a>\n"; 
            $html.= "                          \n"; 
            $html.= "                          \n"; 
            $html.= "                          \n"; 
            $html.= "                          \n"; 
            $html.= "                          \n"; 
            $html.= "                          \n"; 
            $html.= "                          \n"; 
            $html.= "                          \n"; 
            $html.= "                          \n"; 
            $html.= "                          \n"; 
            $html.= "                          \n"; 
            $html.= "                          \n"; 
            $html.= "                        </td>\n"; 
            $html.= "                        \n"; 
            $html.= "                      </tr></tbody></table></div>\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]></td><![endif]-->\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]></tr></table><![endif]-->\n"; 
            $html.= "\n"; 
            $html.= "            </td>\n"; 
            $html.= "          </tr></tbody></table></div>\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->\n"; 
            $html.= "      </td>\n"; 
            $html.= "    </tr></tbody></table><!-- footerBlock --><table width=\"100%\" cellpadding=\"0\" border=\"0\" cellspacing=\"0\" bgcolor=\"#3f3f3f\" style=\"background-color: #3f3f3f;\" id=\"ko_footerBlock_2\"><tbody><tr><td align=\"center\" valign=\"top\" bgcolor=\"#3f3f3f\" style=\"background-color: #3f3f3f;\">\n"; 
            $html.= "\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]><table align=\"center\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"570\"><tr><td align=\"center\" valign=\"top\"><![endif]-->\n"; 
            $html.= "        <div class=\"oldwebkit\" style=\"max-width: 570px;\">\n"; 
            $html.= "        <table width=\"570\" style=\"border-collapse: separate;border-spacing: 9px;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 570px;\" border=\"0\" cellpadding=\"0\" cellspacing=\"9\" class=\"vb-container halfpad\" align=\"center\"><tbody><tr><td class=\"long-text links-color\" style=\"text-align: center; font-size: 13px; color: #919191; font-weight: normal; text-align: center; font-family: Arial, Helvetica, sans-serif;\"><p style=\"margin: 1em 0px;margin-bottom: 0px;margin-top: 0px;\">Financiera Ayudamos, S.A. de C.V. SOFOM ER, Av. Canal de Miramontes 2600, Colonia Avante, Delegación Coyoacán, 04460, DF, recaba sus datos para verificar su identidad. El Aviso de Privacidad Integral actualizado se encuentra a su disposición en cualquiera de nuestras sucursales y en la página http://www.financiera-ayudamos.mx Consulta los requisitos de contratación, términos y condiciones en: http://www.financiera-ayudamos.mx </p></td>\n"; 
            $html.= "          </tr><tr><td style=\"text-align: center;\">\n"; 
            $html.= "              <a href=\"%5Bunsubscribe_link%5D\" style=\"text-decoration: underline; color: #ffffff; text-align: center; font-size: 13px; font-weight: normal; font-family: Arial, Helvetica, sans-serif;\" target=\"_new\"><span>Unsubscribe</span></a>\n"; 
            $html.= "            </td>\n"; 
            $html.= "          </tr></tbody></table></div>\n"; 
            $html.= "<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->\n"; 
            $html.= "      </td>\n"; 
            $html.= "    </tr></tbody></table><!-- /footerBlock --></center>\n"; 
            $html.= "\n"; 
            $html.= "\n"; 
            $html.= "</body></html>\n";

            return $html;

     }
     
     public  function enviarEmail($email,$nombre,$monto){
              
          
                $mgClient = new Mailgun('key-808f9ab34c5d9aaa02d8acd1dd472a64');
                $domain = "sistema-siaisa.net";
                $html= $this->getCustomHtml($nombre,$monto);
              
                $result = $mgClient->sendMessage($domain, array(
                    'from'           => 'Financiera ayudamos <financiera-ayudamos@sistema-siaisa.net>',
                    'to'             => $email,
                    'subject'        => 'TIENE UN CREDITO PREAUTORIZADO',
                    'text'           => 'TIENE UN CREDITO PREAUTORIZADO',
                    'html'           => $html
                  
                ));
             return $html;
     }
     
     
}
