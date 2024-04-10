<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;
use \App\Models\Usuario;



use \App\Models\Log;

use \App\Models\Roleusuario;
use \App\Models\Permission;
use \App\Models\Permissionsrole;

use DateTime;

class Functions {
    
     
    /**
     * RETORNA A MENSAGEM EM UM ARRAY PARA QUE O JQUERY CONSIGA TRATAR
     * @param unknown $text
     * @return unknown
     */
    public static function getMessageJquery($text,$jsonEncode = ""){
        if ($jsonEncode == "S"){
            $message[] = $text;
            return json_encode($message);
        } else {
            return $message[] = $text; 
        }
    }
        
    /**
     * 
     * @param unknown $date
     * @return string
     */
    public static function formatDate($date, $tipo, $formate = "dd/mm/yyyy"){
        if ($tipo == "I"){
            $date_hora = "";
            if ($date){
                if (stripos($date, " ")){
                    $date_hora = explode(" ",$date);
                }
                if (!empty($date_hora) && (sizeof($date_hora) <= 1)){
                    $_date = explode("/",$date);
                    $date_return =  $_date[2]."-".$_date[1]."-".$_date[0];
                    return $date_return;
                } else {
                    $_date = explode("/",$date_hora[0]);
                    $date_return = $_date[2]."-".$_date[1]."-".$_date[0];
                    return $date_return." ".$date_hora[1];
                }
            }
        } else if ($tipo == "F"){
            if ($date){
                $date_hora = $date;
                if (stripos($date, " ")){
                    $date_hora = explode(" ",$date);
                    $dt = explode("-",$date_hora[0]);
                } else {
                    $dt = explode("-",$date_hora);
                }
                $ret = "";
                if (strtoupper($formate) == "DD/MM/YYYY"){
                    $ret = $dt[2]."/".$dt[1]."/".$dt[0];
                    if ($ret == "00/00/0000"){
                        return "";
                    } else {
                        return $ret;
                    }
                } else if (strtoupper($formate) == "YYYY-MM-DD"){
                    $ret = $dt[0]."-".$dt[1]."-".$dt[2];
                    if ($ret == "00/00/0000"){
                        return "";
                    } else {
                        return $ret;
                    }
                } else if (strtoupper($formate) == "DD.MM.YYYY"){
                    $ret = $dt[2].".".$dt[1].".".$dt[0];
                    if ($ret == "00.00.0000"){
                        return "";
                    } else {
                        return $ret;
                    }
                } else {
                    $ret = $dt[2]."-".$dt[1]."-".$dt[0];
                    if ($ret == "00-00-0000"){
                        return "";
                    } else {
                        return $ret;
                    }
                }
            } else {
                return $date;
            }
            
        } else if ($tipo == "R"){
            return $date;
        }
        
        return $date;

    }
    
    
    /**
     * SUBSTITUI O CARACTER POR VAZIO
     * @param unknown $string
     * @param unknown $char
     * @return mixed
     */
    public static function removeCaracter($string, $char){
        $str = "";
        $str = str_ireplace($char, "", $string);
        return $str;
    }
    
    /**
     * 
     * @param unknown $role
     * @return string
     */
    public static function getRole($role){
        
        if (strtoupper($role) == "ADMIN"){
            return "Administrador";
        } else if (strtoupper($role) == "EMPRESA"){
            return "Empresa Administradora";
        } else if (strtoupper($role) == "PRODUTOR"){
            return "Acesso Produtor";
        } else if (strtoupper($role) == "USUARIO"){
            return "Operador";
        } else {
            return "Não Informado";
        }
        
    }
    
    
    /**
     * RETURNA CARACTERES BETWEEN TO OTHERS VALUES
     * @param String $string
     * @param String $charI
     * @param String $charE
     */
    public static function getValuesCaracter($string, $charI, $charE){

        if ($string){
            if ($charI && $charE){
                $ini = stripos($string, $charI);
                $tm_ini1 = strlen($charI);
                $_pos = ($ini+($tm_ini1));
                $strSplit = substr($string, $_pos, strlen($string));
                $end = stripos($strSplit,$charE);
                //$str = substr($string, ($ini+1), ($ini+$end));
                $strReturn = "";
                $_tm_max = $_pos+($end-1);
                for ($i=$_pos;$i<=$_tm_max;$i++){
                    $strReturn .= $string[$i];
                }
                return $strReturn;
            }
        }
        return $string;
    }

    /**
     * RETORNA O NOME DA CLASSE QUE SERÁ GERADA PARA AS ENTITIES
     * EX: empresas = Empresa
     * @param unknown $name
     * @return string
     */
    public static function getNameClass($name, $fullname = "N"){
        if (($name) && ($fullname == "N")){
            $tm = strlen($name);
            if (strtoupper($name[($tm-1)]) == "S"){
                $name = substr($name,0,($tm-1));
            }
            return strtoupper(substr($name,0,1))."".strtolower(substr($name,1,$tm));
        } else {
            $tm = strlen($name);
            return strtoupper(substr($name,0,1))."".strtolower(substr($name,1,$tm));
        }
    }
    
    /**
     * RETORNA O NOME DA CLASSE QUE SERÁ GERADA PARA AS ENTITIES
     * EX: empresas = Empresa
     * @param unknown $name
     * @return string
     */
    public static function getStringFirstUpper($name){
        if ($name){
            $tm = strlen($name);
            return strtoupper(substr($name,0,1))."".strtolower(substr($name,1,$tm));
        } else {
            return $name;
        }
    }
    
    
    /**
     * RETORNA O NOME DA CLASSE QUE SERÁ GERADA PARA AS ENTITIES
     * EX: empresas = Empresa
     * @param unknown $name
     * @return string
     */
    public static function getNameClassFirstUpperCase($name){
        if ($name){    
            $tm = strlen($name);
            return strtoupper(substr($name,0,1))."".strtolower(substr($name,1,$tm));
        } else {
            return $name;
        }
    }
    
    /**
     * VERIFICA SE UM ARQUIVO QUE CONTENHA TAL NOME EXISTE NO DIRETORIO INFORMADO
     * @param String $dir
     * @param String $filename
     */
    public static function fileExistsContent($dir, $filename){

        $find = false;
        $diretorio = dir($dir); 
        while($arquivo = $diretorio -> read()){
            if (stripos($arquivo, $filename)){
                $find = true;
                break;
            }  
        } 
        $diretorio -> close();
        return $find;
    }
    
    /**
     * FRASE A SER CRIPTOGRAFADA
     * 
     * A MESMA CHAVE DEVE SER USADA TANTO PARA DESCRIPTIGRAFAR QUANTO CRIPTOGRAFAR
     * 
     * CRYPT PASSADO COMO FALSE DESCRIPTOGRAFA, TRUE CRIPTOGRAFA
     * 
     * @param String $frase
     * @param String $chave
     * @param String $crypt
     * @return string
     */
    public static function encrypt ($frase, $crypt)
    {
        $retorno = "";
        $chave = env("APP_ENC");
        if ($chave == ""){
            $chave = "87589347593857395";
        }
        
        if ($frase == ''){
            return '';
        } else {
            if ($crypt){
                $frase = date('dmY')."|".$frase;
            }
        }
    
        if ($crypt) {
            $string = $frase;
            $i = strlen($string) - 1;
            $j = strlen($chave);
            do {
                $retorno .= ($string[$i] ^ $chave[$i % $j]);
            } while ($i --);
    
            $retorno = strrev($retorno);
            $retorno = base64_encode($retorno);
        } else {
            $string = base64_decode($frase);
            $i = strlen($string) - 1;
            $j = strlen($chave);
    
            do {
                $retorno .= ($string[$i] ^ $chave[$i % $j]);
            } while ($i --);
            $retorno = strrev($retorno);
        }
        return $retorno;
    }
    
    public static function getPermission($form, $op){
        $user = Auth::user();
        return true;
    }
    
    
    public static function validaId($id){
        
        if ($id){
            
            $des = self::encrypt($id, false);
            $explode = explode("|",$des);
            if ($explode[0] == date('dmY')){
                return true;
            } else {
                return false;
            }
            
        } else {
            return false;
        }
        
    }
    
    
    public static function getId($id){
    
        if ($id){
            $des = self::encrypt($id, false);
            $explode = explode("|",$des);
            if ($explode[0] == date('dmY')){
                return $explode[1];
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    
    }
    
    
    /**
     * GRAVA LOGS NA BASE DE DADOS DOS PROCESSOS E AÇÕES REALIZADAS
     * @param String $type
     * @param String $operacao
     * @param String $processo
     * @param String $descricao
     * @param String $object
     * @param array $request
     */
    public static function log($operacao, $tabela, $original, $novo, $usuarios_id){
        
        $user = Auth::user();
        
        $log = new Log();
        $log->operacao = $operacao; 
        $log->tabela = $tabela;
        $log->original = $original;
        $log->novo = $novo; 
        $log->usuarios_id = $usuarios_id;
        $log->save();
        
    }
    
    public static function copyDirectory ($source, $dest)
    {
        // COPIA UM ARQUIVO
        if (is_file($source)) {
            return copy($source, $dest);
        }
    
        // CRIA O DIRETÓRIO DE DESTINO
        if (! is_dir($dest)) {
            mkdir($dest);
            echo "DIRET&Oacute;RIO $dest CRIADO<br />";
        }
    
        // FAZ LOOP DENTRO DA PASTA
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // PULA "." e ".."
            if ($entry == '.' || $entry == '..') {
                continue;
            }
    
            // COPIA TUDO DENTRO DOS DIRETÓRIOS
            if ($dest !== "$source/$entry") {
                copyr("$source/$entry", "$dest/$entry");
            }
        }
    
        $dir->close();
        return true;
        }
    
        /**
         * RETORNA OS TIPO DE MASCARAS DISPONIVEIS PARA OS CAMPOS
         * @param String $type
         * @return String;
         */
        public static function getMask($type){

            //create mask for input never used

        }

        /**
        * RETORNA O USUARIO DESEJADO
        */
        public static function getFieldUser($id, $field){
            if ($id){
                $usuario = Usuario::find($id);
                $command = "\$return = \$usuario->".$field.";";
                eval($command);
                return $return;
            }
            return "";
        }

    

    
        /**
    * RETORNA O ESTILO A SER USADO NA TIMELINE, ICONES E CORES
    */
    public static function getStyleTimeLine($tipo, $op){

        if ($tipo == "PHO"){
          if (strtoupper($op) == "ICON"){
            return "fa-phone bg-yellow";
          }
        } else if ($tipo == "CEL") {
          if (strtoupper($op) == "ICON"){
            return "fa-mobile-phone bg-blue";
          }
        } else if ($tipo == "WHA"){
          if (strtoupper($op) == "ICON"){
            return "fa-whatsapp bg-green";
          }
        } else if ($tipo == "EME"){
          if (strtoupper($op) == "ICON"){
            return "fa-envelope";
          }
        } else if ($tipo == "EMR"){
          if (strtoupper($op) == "ICON"){
            return "fa-envelope-square";
          }
        } else if ($tipo == "SKY"){
          if (strtoupper($op) == "ICON"){
            return "fa-skype bg-aqua";
          }
        } else if ($tipo == "SIT"){
          if (strtoupper($op) == "ICON"){
            return "fa-meh-o";
          }
        } else {
          if (strtoupper($op) == "ICON"){
            return "fa-circle-o";
          }
        }
      }

/**
* RETORNA O NOME DAS PASTAS VINDAS DO IMAP
*/
public static function getNameFolderEmail($folder){

    if (trim($folder) != ""){
        $name = explode(".",$folder);
        $tm = sizeof($name);
        return $name[$tm-1];
    }
    return "INBOX";
  
  }
  
  /*
* CALCULA A CAPACIDADE DA CAIXA E O USUADO DO EMAIL
*/
public static function calcSizeFolderEmail($size,$tipo){

    if ($tipo == 'C'){
       $tb = ((($size/1024)/1024)/1024);
       $gb = (($size/1024)/1024);
       $mb = ($size/1024);
       $kb = $size;
       $bt = ($size*1024);
  
       if (round($tb) > 0){
         return $tb." Tb";
       } else if (round($gb) > 0){
         return $gb. " Gb";
       } else if (round($mb) > 0){
         return $mb. " Mb";
       } else if (round($kb) > 0){
         return $kb. " Kb";
       } else if (round($bt) > 0){
         return $bt. " bt";
       }
    } else {
      $calc = @($tipo/$size);
      return ($calc < 1) ? 1 : $calc;
    }

  }

  /**
*  GET NAME FILE
*/
public static function getNameFile($name){

    $replace = array(
            '/\s/' => '_',
            '/[^0-9a-zа-яіїє_\.]/iu' => '',
            '/_+/' => '_',
            '/(^_)|(_$)/' => ''
    );
    $fileSysName = preg_replace('~[\\\\/]~', '',preg_replace(array_keys($replace), $replace, $name));
    return $fileSysName;
  
  }

    /**
    *  SHOW BUTTON VIEW IN EMAIL
    */
    public static function getView($ext){
        $array = array('pdf','doc','jpg','gif','bmp','png','xls','docx','jpeg');
        if (in_array($ext,$array)){
        return true;
        }
        return false;
    }

    public static function getMimeType($ext){

        if ($ext != ""){
    
          if (substr($ext,0,1) != "."){
            $ext = ".".$ext;
          }
    
          $mime_types = array(
              '.3dm' => 'x-world/x-3dmf',
              '.3dmf' => 'x-world/x-3dmf',
              '.a' => 'application/octet-stream',
              '.aab' => 'application/x-authorware-bin',
              '.aam' => 'application/x-authorware-map',
              '.aas' => 'application/x-authorware-seg',
              '.abc' => 'text/vnd.abc',
              '.acgi' => 'text/html',
              '.afl' => 'video/animaflex',
              '.ai' => 'application/postscript',
              '.aif' => 'audio/aiff',
              '.aif' => 'audio/x-aiff',
              '.aifc' => 'audio/aiff',
              '.aifc' => 'audio/x-aiff',
              '.aiff' => 'audio/aiff',
              '.aiff' => 'audio/x-aiff',
              '.aim' => 'application/x-aim',
              '.aip' => 'text/x-audiosoft-intra',
              '.ani' => 'application/x-navi-animation',
              '.aos' => 'application/x-nokia-9000-communicator-add-on-software',
              '.aps' => 'application/mime',
              '.arc' => 'application/octet-stream',
              '.arj' => 'application/arj',
              '.arj' => 'application/octet-stream',
              '.art' => 'image/x-jg',
              '.asf' => 'video/x-ms-asf',
              '.asm' => 'text/x-asm',
              '.asp' => 'text/asp',
              '.asx' => 'application/x-mplayer2',
              '.asx' => 'video/x-ms-asf',
              '.asx' => 'video/x-ms-asf-plugin',
              '.au' => 'audio/basic',
              '.au' => 'audio/x-au',
              '.avi' => 'application/x-troff-msvideo',
              '.avi' => 'video/avi',
              '.avi' => 'video/msvideo',
              '.avi' => 'video/x-msvideo',
              '.avs' => 'video/avs-video',
              '.bcpio' => 'application/x-bcpio',
              '.bin' => 'application/mac-binary',
              '.bin' => 'application/macbinary',
              '.bin' => 'application/octet-stream',
              '.bin' => 'application/x-binary',
              '.bin' => 'application/x-macbinary',
              '.bm' => 'image/bmp',
              '.bmp' => 'image/bmp',
              '.bmp' => 'image/x-windows-bmp',
              '.boo' => 'application/book',
              '.book' => 'application/book',
              '.boz' => 'application/x-bzip2',
              '.bsh' => 'application/x-bsh',
              '.bz' => 'application/x-bzip',
              '.bz2' => 'application/x-bzip2',
              '.c' => 'text/plain',
              '.c++' => 'text/plain',
              '.cat' => 'application/vnd.ms-pki.seccat',
              '.cc' => 'text/plain',
              '.cc' => 'text/x-c',
              '.ccad' => 'application/clariscad',
              '.cco' => 'application/x-cocoa',
              '.cdf' => 'application/cdf',
              '.cdf' => 'application/x-cdf',
              '.cdf' => 'application/x-netcdf',
              '.cer' => 'application/pkix-cert',
              '.cer' => 'application/x-x509-ca-cert',
              '.cha' => 'application/x-chat',
              '.chat' => 'application/x-chat',
              '.class' => 'application/java',
              '.class' => 'application/java-byte-code',
              '.class' => 'application/x-java-class',
              '.com' => 'application/octet-stream',
              '.com' => 'text/plain',
              '.conf' => 'text/plain',
              '.cpio' => 'application/x-cpio',
              '.cpp' => 'text/x-c',
              '.cpt' => 'application/mac-compactpro',
              '.cpt' => 'application/x-compactpro',
              '.cpt' => 'application/x-cpt',
              '.crl' => 'application/pkcs-crl',
              '.crl' => 'application/pkix-crl',
              '.crt' => 'application/pkix-cert',
              '.crt' => 'application/x-x509-ca-cert',
              '.crt' => 'application/x-x509-user-cert',
              '.csh' => 'application/x-csh',
              '.csh' => 'text/x-script.csh',
              '.css' => 'application/x-pointplus',
              '.css' => 'text/css',
              '.cxx' => 'text/plain',
              '.dcr' => 'application/x-director',
              '.deepv' => 'application/x-deepv',
              '.def' => 'text/plain',
              '.der' => 'application/x-x509-ca-cert',
              '.dif' => 'video/x-dv',
              '.dir' => 'application/x-director',
              '.dl' => 'video/dl',
              '.dl' => 'video/x-dl',
              '.doc' => 'application/msword',
              '.dot' => 'application/msword',
              '.dp' => 'application/commonground',
              '.drw' => 'application/drafting',
              '.dump' => 'application/octet-stream',
              '.dv' => 'video/x-dv',
              '.dvi' => 'application/x-dvi',
              '.dwf' => 'drawing/x-dwf (old)',
              '.dwf' => 'model/vnd.dwf',
              '.dwg' => 'application/acad',
              '.dwg' => 'image/vnd.dwg',
              '.dwg' => 'image/x-dwg',
              '.dxf' => 'application/dxf',
              '.dxf' => 'image/vnd.dwg',
              '.dxf' => 'image/x-dwg',
              '.dxr' => 'application/x-director',
              '.el' => 'text/x-script.elisp',
              '.elc' => 'application/x-bytecode.elisp (compiled elisp)',
              '.elc' => 'application/x-elc',
              '.env' => 'application/x-envoy',
              '.eps' => 'application/postscript',
              '.es' => 'application/x-esrehber',
              '.etx' => 'text/x-setext',
              '.evy' => 'application/envoy',
              '.evy' => 'application/x-envoy',
              '.exe' => 'application/octet-stream',
              '.f' => 'text/plain',
              '.f' => 'text/x-fortran',
              '.f77' => 'text/x-fortran',
              '.f90' => 'text/plain',
              '.f90' => 'text/x-fortran',
              '.fdf' => 'application/vnd.fdf',
              '.fif' => 'application/fractals',
              '.fif' => 'image/fif',
              '.fli' => 'video/fli',
              '.fli' => 'video/x-fli',
              '.flo' => 'image/florian',
              '.flx' => 'text/vnd.fmi.flexstor',
              '.fmf' => 'video/x-atomic3d-feature',
              '.for' => 'text/plain',
              '.for' => 'text/x-fortran',
              '.fpx' => 'image/vnd.fpx',
              '.fpx' => 'image/vnd.net-fpx',
              '.frl' => 'application/freeloader',
              '.funk' => 'audio/make',
              '.g' => 'text/plain',
              '.g3' => 'image/g3fax',
              '.gif' => 'image/gif',
              '.gl' => 'video/gl',
              '.gl' => 'video/x-gl',
              '.gsd' => 'audio/x-gsm',
              '.gsm' => 'audio/x-gsm',
              '.gsp' => 'application/x-gsp',
              '.gss' => 'application/x-gss',
              '.gtar' => 'application/x-gtar',
              '.gz' => 'application/x-compressed',
              '.gz' => 'application/x-gzip',
              '.gzip' => 'application/x-gzip',
              '.gzip' => 'multipart/x-gzip',
              '.h' => 'text/plain',
              '.h' => 'text/x-h',
              '.hdf' => 'application/x-hdf',
              '.help' => 'application/x-helpfile',
              '.hgl' => 'application/vnd.hp-hpgl',
              '.hh' => 'text/plain',
              '.hh' => 'text/x-h',
              '.hlb' => 'text/x-script',
              '.hlp' => 'application/hlp',
              '.hlp' => 'application/x-helpfile',
              '.hlp' => 'application/x-winhelp',
              '.hpg' => 'application/vnd.hp-hpgl',
              '.hpgl' => 'application/vnd.hp-hpgl',
              '.hqx' => 'application/binhex',
              '.hqx' => 'application/binhex4',
              '.hqx' => 'application/mac-binhex',
              '.hqx' => 'application/mac-binhex40',
              '.hqx' => 'application/x-binhex40',
              '.hqx' => 'application/x-mac-binhex40',
              '.hta' => 'application/hta',
              '.htc' => 'text/x-component',
              '.htm' => 'text/html',
              '.html' => 'text/html',
              '.htmls' => 'text/html',
              '.htt' => 'text/webviewhtml',
              '.htx' => 'text/html',
              '.ice' => 'x-conference/x-cooltalk',
              '.ico' => 'image/x-icon',
              '.idc' => 'text/plain',
              '.ief' => 'image/ief',
              '.iefs' => 'image/ief',
              '.iges' => 'application/iges',
              '.iges' => 'model/iges',
              '.igs' => 'application/iges',
              '.igs' => 'model/iges',
              '.ima' => 'application/x-ima',
              '.imap' => 'application/x-httpd-imap',
              '.inf' => 'application/inf',
              '.ins' => 'application/x-internett-signup',
              '.ip' => 'application/x-ip2',
              '.isu' => 'video/x-isvideo',
              '.it' => 'audio/it',
              '.iv' => 'application/x-inventor',
              '.ivr' => 'i-world/i-vrml',
              '.ivy' => 'application/x-livescreen',
              '.jam' => 'audio/x-jam',
              '.jav' => 'text/plain',
              '.jav' => 'text/x-java-source',
              '.java' => 'text/plain',
              '.java' => 'text/x-java-source',
              '.jcm' => 'application/x-java-commerce',
              '.jfif' => 'image/jpeg',
              '.jfif' => 'image/pjpeg',
              '.jfif-tbnl' => 'image/jpeg',
              '.jpe' => 'image/jpeg',
              '.jpe' => 'image/pjpeg',
              '.jpeg' => 'image/jpeg',
              '.jpeg' => 'image/pjpeg',
              '.jpg' => 'image/jpeg',
              '.jpg' => 'image/pjpeg',
              '.jps' => 'image/x-jps',
              '.js' => 'application/x-javascript',
              '.jut' => 'image/jutvision',
              '.kar' => 'audio/midi',
              '.kar' => 'music/x-karaoke',
              '.ksh' => 'application/x-ksh',
              '.ksh' => 'text/x-script.ksh',
              '.la' => 'audio/nspaudio',
              '.la' => 'audio/x-nspaudio',
              '.lam' => 'audio/x-liveaudio',
              '.latex' => 'application/x-latex',
              '.lha' => 'application/lha',
              '.lha' => 'application/octet-stream',
              '.lha' => 'application/x-lha',
              '.lhx' => 'application/octet-stream',
              '.list' => 'text/plain',
              '.lma' => 'audio/nspaudio',
              '.lma' => 'audio/x-nspaudio',
              '.log' => 'text/plain',
              '.lsp' => 'application/x-lisp',
              '.lsp' => 'text/x-script.lisp',
              '.lst' => 'text/plain',
              '.lsx' => 'text/x-la-asf',
              '.ltx' => 'application/x-latex',
              '.lzh' => 'application/octet-stream',
              '.lzh' => 'application/x-lzh',
              '.lzx' => 'application/lzx',
              '.lzx' => 'application/octet-stream',
              '.lzx' => 'application/x-lzx',
              '.m' => 'text/plain',
              '.m' => 'text/x-m',
              '.m1v' => 'video/mpeg',
              '.m2a' => 'audio/mpeg',
              '.m2v' => 'video/mpeg',
              '.m3u' => 'audio/x-mpequrl',
              '.man' => 'application/x-troff-man',
              '.map' => 'application/x-navimap',
              '.mar' => 'text/plain',
              '.mbd' => 'application/mbedlet',
              '.mc' => 'application/x-magic-cap-package-1.0',
              '.mcd' => 'application/mcad',
              '.mcd' => 'application/x-mathcad',
              '.mcf' => 'image/vasa',
              '.mcf' => 'text/mcf',
              '.mcp' => 'application/netmc',
              '.me' => 'application/x-troff-me',
              '.mht' => 'message/rfc822',
              '.mhtml' => 'message/rfc822',
              '.mid' => 'application/x-midi',
              '.mid' => 'audio/midi',
              '.mid' => 'audio/x-mid',
              '.mid' => 'audio/x-midi',
              '.mid' => 'music/crescendo',
              '.mid' => 'x-music/x-midi',
              '.midi' => 'application/x-midi',
              '.midi' => 'audio/midi',
              '.midi' => 'audio/x-mid',
              '.midi' => 'audio/x-midi',
              '.midi' => 'music/crescendo',
              '.midi' => 'x-music/x-midi',
              '.mif' => 'application/x-frame',
              '.mif' => 'application/x-mif',
              '.mime' => 'message/rfc822',
              '.mime' => 'www/mime',
              '.mjf' => 'audio/x-vnd.audioexplosion.mjuicemediafile',
              '.mjpg' => 'video/x-motion-jpeg',
              '.mm' => 'application/base64',
              '.mm' => 'application/x-meme',
              '.mme' => 'application/base64',
              '.mod' => 'audio/mod',
              '.mod' => 'audio/x-mod',
              '.moov' => 'video/quicktime',
              '.mov' => 'video/quicktime',
              '.movie' => 'video/x-sgi-movie',
              '.mp2' => 'audio/mpeg',
              '.mp2' => 'audio/x-mpeg',
              '.mp2' => 'video/mpeg',
              '.mp2' => 'video/x-mpeg',
              '.mp2' => 'video/x-mpeq2a',
              '.mp3' => 'audio/mpeg3',
              '.mp3' => 'audio/x-mpeg-3',
              '.mp3' => 'video/mpeg',
              '.mp3' => 'video/x-mpeg',
              '.mpa' => 'audio/mpeg',
              '.mpa' => 'video/mpeg',
              '.mpc' => 'application/x-project',
              '.mpe' => 'video/mpeg',
              '.mpeg' => 'video/mpeg',
              '.mpg' => 'audio/mpeg',
              '.mpg' => 'video/mpeg',
              '.mpga' => 'audio/mpeg',
              '.mpp' => 'application/vnd.ms-project',
              '.mpt' => 'application/x-project',
              '.mpv' => 'application/x-project',
              '.mpx' => 'application/x-project',
              '.mrc' => 'application/marc',
              '.ms' => 'application/x-troff-ms',
              '.mv' => 'video/x-sgi-movie',
              '.my' => 'audio/make',
              '.mzz' => 'application/x-vnd.audioexplosion.mzz',
              '.nap' => 'image/naplps',
              '.naplps' => 'image/naplps',
              '.nc' => 'application/x-netcdf',
              '.ncm' => 'application/vnd.nokia.configuration-message',
              '.nif' => 'image/x-niff',
              '.niff' => 'image/x-niff',
              '.nix' => 'application/x-mix-transfer',
              '.nsc' => 'application/x-conference',
              '.nvd' => 'application/x-navidoc',
              '.o' => 'application/octet-stream',
              '.oda' => 'application/oda',
              '.omc' => 'application/x-omc',
              '.omcd' => 'application/x-omcdatamaker',
              '.omcr' => 'application/x-omcregerator',
              '.p' => 'text/x-pascal',
              '.p10' => 'application/pkcs10',
              '.p10' => 'application/x-pkcs10',
              '.p12' => 'application/pkcs-12',
              '.p12' => 'application/x-pkcs12',
              '.p7a' => 'application/x-pkcs7-signature',
              '.p7c' => 'application/pkcs7-mime',
              '.p7c' => 'application/x-pkcs7-mime',
              '.p7m' => 'application/pkcs7-mime',
              '.p7m' => 'application/x-pkcs7-mime',
              '.p7r' => 'application/x-pkcs7-certreqresp',
              '.p7s' => 'application/pkcs7-signature',
              '.part' => 'application/pro_eng',
              '.pas' => 'text/pascal',
              '.pbm' => 'image/x-portable-bitmap',
              '.pcl' => 'application/vnd.hp-pcl',
              '.pcl' => 'application/x-pcl',
              '.pct' => 'image/x-pict',
              '.pcx' => 'image/x-pcx',
              '.pdb' => 'chemical/x-pdb',
              '.pdf' => 'application/pdf',
              '.pfunk' => 'audio/make',
              '.pgm' => 'image/x-portable-greymap',
              '.pic' => 'image/pict',
              '.pict' => 'image/pict',
              '.pkg' => 'application/x-newton-compatible-pkg',
              '.pko' => 'application/vnd.ms-pki.pko',
              '.pl' => 'text/plain',
              '.pl' => 'text/x-script.perl',
              '.plx' => 'application/x-pixclscript',
              '.pm' => 'image/x-xpixmap',
              '.pm' => 'text/x-script.perl-module',
              '.pm4' => 'application/x-pagemaker',
              '.pm5' => 'application/x-pagemaker',
              '.png' => 'image/png',
              '.pnm' => 'application/x-portable-anymap',
              '.pnm' => 'image/x-portable-anymap',
              '.pot' => 'application/mspowerpoint',
              '.pot' => 'application/vnd.ms-powerpoint',
              '.pov' => 'model/x-pov',
              '.ppa' => 'application/vnd.ms-powerpoint',
              '.ppm' => 'image/x-portable-pixmap',
              '.pps' => 'application/mspowerpoint',
              '.pps' => 'application/vnd.ms-powerpoint',
              '.ppt' => 'application/mspowerpoint',
              '.ppt' => 'application/powerpoint',
              '.ppt' => 'application/vnd.ms-powerpoint',
              '.ppt' => 'application/x-mspowerpoint',
              '.ppz' => 'application/mspowerpoint',
              '.pre' => 'application/x-freelance',
              '.prt' => 'application/pro_eng',
              '.ps' => 'application/postscript',
              '.psd' => 'application/octet-stream',
              '.pvu' => 'paleovu/x-pv',
              '.pwz' => 'application/vnd.ms-powerpoint',
              '.py' => 'text/x-script.phyton',
              '.pyc' => 'applicaiton/x-bytecode.python',
              '.qcp' => 'audio/vnd.qcelp',
              '.qd3' => 'x-world/x-3dmf',
              '.qd3d' => 'x-world/x-3dmf',
              '.qif' => 'image/x-quicktime',
              '.qt' => 'video/quicktime',
              '.qtc' => 'video/x-qtc',
              '.qti' => 'image/x-quicktime',
              '.qtif' => 'image/x-quicktime',
              '.ra' => 'audio/x-pn-realaudio',
              '.ra' => 'audio/x-pn-realaudio-plugin',
              '.ra' => 'audio/x-realaudio',
              '.ram' => 'audio/x-pn-realaudio',
              '.ras' => 'application/x-cmu-raster',
              '.ras' => 'image/cmu-raster',
              '.ras' => 'image/x-cmu-raster',
              '.rast' => 'image/cmu-raster',
              '.rexx' => 'text/x-script.rexx',
              '.rf' => 'image/vnd.rn-realflash',
              '.rgb' => 'image/x-rgb',
              '.rm' => 'application/vnd.rn-realmedia',
              '.rm' => 'audio/x-pn-realaudio',
              '.rmi' => 'audio/mid',
              '.rmm' => 'audio/x-pn-realaudio',
              '.rmp' => 'audio/x-pn-realaudio',
              '.rmp' => 'audio/x-pn-realaudio-plugin',
              '.rng' => 'application/ringing-tones',
              '.rng' => 'application/vnd.nokia.ringing-tone',
              '.rnx' => 'application/vnd.rn-realplayer',
              '.roff' => 'application/x-troff',
              '.rp' => 'image/vnd.rn-realpix',
              '.rpm' => 'audio/x-pn-realaudio-plugin',
              '.rt' => 'text/richtext',
              '.rt' => 'text/vnd.rn-realtext',
              '.rtf' => 'application/rtf',
              '.rtf' => 'application/x-rtf',
              '.rtf' => 'text/richtext',
              '.rtx' => 'application/rtf',
              '.rtx' => 'text/richtext',
              '.rv' => 'video/vnd.rn-realvideo',
              '.s' => 'text/x-asm',
              '.s3m' => 'audio/s3m',
              '.saveme' => 'aapplication/octet-stream',
              '.sbk' => 'application/x-tbook',
              '.scm' => 'application/x-lotusscreencam',
              '.scm' => 'text/x-script.guile',
              '.scm' => 'text/x-script.scheme',
              '.scm' => 'video/x-scm',
              '.sdml' => 'text/plain',
              '.sdp' => 'application/sdp',
              '.sdp' => 'application/x-sdp',
              '.sdr' => 'application/sounder',
              '.sea' => 'application/sea',
              '.sea' => 'application/x-sea',
              '.set' => 'application/set',
              '.sgm' => 'text/sgml',
              '.sgm' => 'text/x-sgml',
              '.sgml' => 'text/sgml',
              '.sgml' => 'text/x-sgml',
              '.sh' => 'application/x-bsh',
              '.sh' => 'application/x-sh',
              '.sh' => 'application/x-shar',
              '.sh' => 'text/x-script.sh',
              '.shar' => 'application/x-bsh',
              '.shar' => 'application/x-shar',
              '.shtml' => 'text/html',
              '.shtml' => 'text/x-server-parsed-html',
              '.sid' => 'audio/x-psid',
              '.sit' => 'application/x-sit',
              '.sit' => 'application/x-stuffit',
              '.skd' => 'application/x-koan',
              '.skm' => 'application/x-koan',
              '.skp' => 'application/x-koan',
              '.skt' => 'application/x-koan',
              '.sl' => 'application/x-seelogo',
              '.smi' => 'application/smil',
              '.smil' => 'application/smil',
              '.snd' => 'audio/basic',
              '.snd' => 'audio/x-adpcm',
              '.sol' => 'application/solids',
              '.spc' => 'application/x-pkcs7-certificates',
              '.spc' => 'text/x-speech',
              '.spl' => 'application/futuresplash',
              '.spr' => 'application/x-sprite',
              '.sprite' => 'application/x-sprite',
              '.src' => 'application/x-wais-source',
              '.ssi' => 'text/x-server-parsed-html',
              '.ssm' => 'application/streamingmedia',
              '.sst' => 'application/vnd.ms-pki.certstore',
              '.step' => 'application/step',
              '.stl' => 'application/sla',
              '.stl' => 'application/vnd.ms-pki.stl',
              '.stl' => 'application/x-navistyle',
              '.stp' => 'application/step',
              '.sv4cpio' =>'application/x-sv4cpio',
              '.sv4crc' => 'application/x-sv4crc',
              '.svf' => 'image/vnd.dwg',
              '.svf' => 'image/x-dwg',
              '.svr' => 'application/x-world',
              '.svr' => 'x-world/x-svr',
              '.swf' => 'application/x-shockwave-flash',
              '.t' => 'application/x-troff',
              '.talk' => 'text/x-speech',
              '.tar' => 'application/x-tar',
              '.tbk' => 'application/toolbook',
              '.tbk' => 'application/x-tbook',
              '.tcl' => 'application/x-tcl',
              '.tcl' => 'text/x-script.tcl',
              '.tcsh' => 'text/x-script.tcsh',
              '.tex' => 'application/x-tex',
              '.texi' => 'application/x-texinfo',
              '.texinfo' =>' lication/x-texinfo',
              '.text' => 'application/plain',
              '.text' => 'text/plain',
              '.tgz' => 'application/gnutar',
              '.tgz' => 'application/x-compressed',
              '.tif' => 'image/tiff',
              '.tif' => 'image/x-tiff',
              '.tiff' => 'image/tiff',
              '.tiff' => 'image/x-tiff',
              '.tr' => 'application/x-troff',
              '.tsi' => 'audio/tsp-audio',
              '.tsp' => 'application/dsptype',
              '.tsp' => 'audio/tsplayer',
              '.tsv' => 'text/tab-separated-values',
              '.turbot' => 'image/florian',
              '.txt' => 'text/plain',
              '.uil' => 'text/x-uil',
              '.uni' => 'text/uri-list',
              '.unis' => 'text/uri-list',
              '.unv' => 'application/i-deas',
              '.uri' => 'text/uri-list',
              '.uris' => 'text/uri-list',
              '.ustar' => 'application/x-ustar',
              '.ustar' => 'multipart/x-ustar',
              '.uu' => 'application/octet-stream',
              '.uu' => 'text/x-uuencode',
              '.uue' => 'text/x-uuencode',
              '.vcd' => 'application/x-cdlink',
              '.vcs' => 'text/x-vcalendar',
              '.vda' => 'application/vda',
              '.vdo' => 'video/vdo',
              '.vew' => 'application/groupwise',
              '.viv' => 'video/vivo',
              '.viv' => 'video/vnd.vivo',
              '.vivo' => 'video/vivo',
              '.vivo' => 'video/vnd.vivo',
              '.vmd' => 'application/vocaltec-media-desc',
              '.vmf' => 'application/vocaltec-media-file',
              '.voc' => 'audio/voc',
              '.voc' => 'audio/x-voc',
              '.vos' => 'video/vosaic',
              '.vox' => 'audio/voxware',
              '.vqe' => 'audio/x-twinvq-plugin',
              '.vqf' => 'audio/x-twinvq',
              '.vql' => 'audio/x-twinvq-plugin',
              '.vrml' => 'application/x-vrml',
              '.vrml' => 'model/vrml',
              '.vrml' => 'x-world/x-vrml',
              '.vrt' => 'x-world/x-vrt',
              '.vsd' => 'application/x-visio',
              '.vst' => 'application/x-visio',
              '.vsw' => 'application/x-visio',
              '.w60' => 'application/wordperfect6.0',
              '.w61' => 'application/wordperfect6.1',
              '.w6w' => 'application/msword',
              '.wav' => 'audio/wav',
              '.wav' => 'audio/x-wav',
              '.wb1' => 'application/x-qpro',
              '.wbmp' => 'image/vnd.wap.wbmp',
              '.web' => 'application/vnd.xara',
              '.wiz' => 'application/msword',
              '.wk1' => 'application/x-123',
              '.wmf' => 'windows/metafile',
              '.wml' => 'text/vnd.wap.wml',
              '.wmlc' => 'application/vnd.wap.wmlc',
              '.wmls' => 'text/vnd.wap.wmlscript',
              '.wmlsc' => 'application/vnd.wap.wmlscriptc',
              '.word' => 'application/msword',
              '.wp' => 'application/wordperfect',
              '.wp5' => 'application/wordperfect',
              '.wp5' => 'application/wordperfect6.0',
              '.wp6' => 'application/wordperfect',
              '.wpd' => 'application/wordperfect',
              '.wpd' => 'application/x-wpwin',
              '.wq1' => 'application/x-lotus',
              '.wri' => 'application/mswrite',
              '.wri' => 'application/x-wri',
              '.wrl' => 'application/x-world',
              '.wrl' => 'model/vrml',
              '.wrl' => 'x-world/x-vrml',
              '.wrz' => 'model/vrml',
              '.wrz' => 'x-world/x-vrml',
              '.wsc' => 'text/scriplet',
              '.wsrc' => 'application/x-wais-source',
              '.wtk' => 'application/x-wintalk',
              '.xbm' => 'image/x-xbitmap',
              '.xbm' => 'image/x-xbm',
              '.xbm' => 'image/xbm',
              '.xdr' => 'video/x-amt-demorun',
              '.xgz' => 'xgl/drawing',
              '.xif' => 'image/vnd.xiff',
              '.xl' => 'application/excel',
              '.xla' => 'application/excel',
              '.xla' => 'application/x-excel',
              '.xla' => 'application/x-msexcel',
              '.xlb' => 'application/excel',
              '.xlb' => 'application/vnd.ms-excel',
              '.xlb' => 'application/x-excel',
              '.xlc' => 'application/excel',
              '.xlc' => 'application/vnd.ms-excel',
              '.xlc' => 'application/x-excel',
              '.xld' => 'application/excel',
              '.xld' => 'application/x-excel',
              '.xlk' => 'application/excel',
              '.xlk' => 'application/x-excel',
              '.xll' => 'application/excel',
              '.xll' => 'application/vnd.ms-excel',
              '.xll' => 'application/x-excel',
              '.xlm' => 'application/excel',
              '.xlm' => 'application/vnd.ms-excel',
              '.xlm' => 'application/x-excel',
              '.xls' => 'application/excel',
              '.xls' => 'application/vnd.ms-excel',
              '.xls' => 'application/x-excel',
              '.xls' => 'application/x-msexcel',
              '.xlt' => 'application/excel',
              '.xlt' => 'application/x-excel',
              '.xlv' => 'application/excel',
              '.xlv' => 'application/x-excel',
              '.xlw' => 'application/excel',
              '.xlw' => 'application/vnd.ms-excel',
              '.xlw' => 'application/x-excel',
              '.xlw' => 'application/x-msexcel',
              '.xm' => 'audio/xm',
              '.xml' => 'application/xml',
              '.xml' => 'text/xml',
              '.xmz' => 'xgl/movie',
              '.xpix' => 'application/x-vnd.ls-xpix',
              '.xpm' => 'image/x-xpixmap',
              '.xpm' => 'image/xpm',
              '.x-png' => 'image/png',
              '.xsr' => 'video/x-amt-showrun',
              '.xwd' => 'image/x-xwd',
              '.xwd' => 'image/x-xwindowdump',
              '.xyz' => 'chemical/x-pdb',
              '.z' => 'application/x-compress',
              '.z' => 'application/x-compressed',
              '.zip' => 'application/x-compressed',
              '.zip' => 'application/x-zip-compressed',
              '.zip' => 'application/zip',
              '.zip' => 'multipart/x-zip',
              '.zoo' => 'application/octet-stream',
              '.zsh' => 'text/x-script.zsh'
          );
    
          if (@$mime_types[$ext] != ""){
              if (in_array($ext, $mime_types)){
                return $mime_types[$ext];
              } else {
                  return "";
              }
          } else {
              return "";
          }
    
        } else {
          return "";
        }
    
    
    }

    public static function getExtMimeType($ext){

        if ($ext != ""){
    
          $mime_types = array(
              '.3dm' => 'x-world/x-3dmf',
              '.3dmf' => 'x-world/x-3dmf',
              '.a' => 'application/octet-stream',
              '.aab' => 'application/x-authorware-bin',
              '.aam' => 'application/x-authorware-map',
              '.aas' => 'application/x-authorware-seg',
              '.abc' => 'text/vnd.abc',
              '.acgi' => 'text/html',
              '.afl' => 'video/animaflex',
              '.ai' => 'application/postscript',
              '.aif' => 'audio/aiff',
              '.aif' => 'audio/x-aiff',
              '.aifc' => 'audio/aiff',
              '.aifc' => 'audio/x-aiff',
              '.aiff' => 'audio/aiff',
              '.aiff' => 'audio/x-aiff',
              '.aim' => 'application/x-aim',
              '.aip' => 'text/x-audiosoft-intra',
              '.ani' => 'application/x-navi-animation',
              '.aos' => 'application/x-nokia-9000-communicator-add-on-software',
              '.aps' => 'application/mime',
              '.arc' => 'application/octet-stream',
              '.arj' => 'application/arj',
              '.arj' => 'application/octet-stream',
              '.art' => 'image/x-jg',
              '.asf' => 'video/x-ms-asf',
              '.asm' => 'text/x-asm',
              '.asp' => 'text/asp',
              '.asx' => 'application/x-mplayer2',
              '.asx' => 'video/x-ms-asf',
              '.asx' => 'video/x-ms-asf-plugin',
              '.au' => 'audio/basic',
              '.au' => 'audio/x-au',
              '.avi' => 'application/x-troff-msvideo',
              '.avi' => 'video/avi',
              '.avi' => 'video/msvideo',
              '.avi' => 'video/x-msvideo',
              '.avs' => 'video/avs-video',
              '.bcpio' => 'application/x-bcpio',
              '.bin' => 'application/mac-binary',
              '.bin' => 'application/macbinary',
              '.bin' => 'application/octet-stream',
              '.bin' => 'application/x-binary',
              '.bin' => 'application/x-macbinary',
              '.bm' => 'image/bmp',
              '.bmp' => 'image/bmp',
              '.bmp' => 'image/x-windows-bmp',
              '.boo' => 'application/book',
              '.book' => 'application/book',
              '.boz' => 'application/x-bzip2',
              '.bsh' => 'application/x-bsh',
              '.bz' => 'application/x-bzip',
              '.bz2' => 'application/x-bzip2',
              '.c' => 'text/plain',
              '.c++' => 'text/plain',
              '.cat' => 'application/vnd.ms-pki.seccat',
              '.cc' => 'text/plain',
              '.cc' => 'text/x-c',
              '.ccad' => 'application/clariscad',
              '.cco' => 'application/x-cocoa',
              '.cdf' => 'application/cdf',
              '.cdf' => 'application/x-cdf',
              '.cdf' => 'application/x-netcdf',
              '.cer' => 'application/pkix-cert',
              '.cer' => 'application/x-x509-ca-cert',
              '.cha' => 'application/x-chat',
              '.chat' => 'application/x-chat',
              '.class' => 'application/java',
              '.class' => 'application/java-byte-code',
              '.class' => 'application/x-java-class',
              '.com' => 'application/octet-stream',
              '.com' => 'text/plain',
              '.conf' => 'text/plain',
              '.cpio' => 'application/x-cpio',
              '.cpp' => 'text/x-c',
              '.cpt' => 'application/mac-compactpro',
              '.cpt' => 'application/x-compactpro',
              '.cpt' => 'application/x-cpt',
              '.crl' => 'application/pkcs-crl',
              '.crl' => 'application/pkix-crl',
              '.crt' => 'application/pkix-cert',
              '.crt' => 'application/x-x509-ca-cert',
              '.crt' => 'application/x-x509-user-cert',
              '.csh' => 'application/x-csh',
              '.csh' => 'text/x-script.csh',
              '.css' => 'application/x-pointplus',
              '.css' => 'text/css',
              '.cxx' => 'text/plain',
              '.dcr' => 'application/x-director',
              '.deepv' => 'application/x-deepv',
              '.def' => 'text/plain',
              '.der' => 'application/x-x509-ca-cert',
              '.dif' => 'video/x-dv',
              '.dir' => 'application/x-director',
              '.dl' => 'video/dl',
              '.dl' => 'video/x-dl',
              '.doc' => 'application/msword',
              '.dot' => 'application/msword',
              '.dp' => 'application/commonground',
              '.drw' => 'application/drafting',
              '.dump' => 'application/octet-stream',
              '.dv' => 'video/x-dv',
              '.dvi' => 'application/x-dvi',
              '.dwf' => 'drawing/x-dwf (old)',
              '.dwf' => 'model/vnd.dwf',
              '.dwg' => 'application/acad',
              '.dwg' => 'image/vnd.dwg',
              '.dwg' => 'image/x-dwg',
              '.dxf' => 'application/dxf',
              '.dxf' => 'image/vnd.dwg',
              '.dxf' => 'image/x-dwg',
              '.dxr' => 'application/x-director',
              '.el' => 'text/x-script.elisp',
              '.elc' => 'application/x-bytecode.elisp (compiled elisp)',
              '.elc' => 'application/x-elc',
              '.env' => 'application/x-envoy',
              '.eps' => 'application/postscript',
              '.es' => 'application/x-esrehber',
              '.etx' => 'text/x-setext',
              '.evy' => 'application/envoy',
              '.evy' => 'application/x-envoy',
              '.exe' => 'application/octet-stream',
              '.f' => 'text/plain',
              '.f' => 'text/x-fortran',
              '.f77' => 'text/x-fortran',
              '.f90' => 'text/plain',
              '.f90' => 'text/x-fortran',
              '.fdf' => 'application/vnd.fdf',
              '.fif' => 'application/fractals',
              '.fif' => 'image/fif',
              '.fli' => 'video/fli',
              '.fli' => 'video/x-fli',
              '.flo' => 'image/florian',
              '.flx' => 'text/vnd.fmi.flexstor',
              '.fmf' => 'video/x-atomic3d-feature',
              '.for' => 'text/plain',
              '.for' => 'text/x-fortran',
              '.fpx' => 'image/vnd.fpx',
              '.fpx' => 'image/vnd.net-fpx',
              '.frl' => 'application/freeloader',
              '.funk' => 'audio/make',
              '.g' => 'text/plain',
              '.g3' => 'image/g3fax',
              '.gif' => 'image/gif',
              '.gl' => 'video/gl',
              '.gl' => 'video/x-gl',
              '.gsd' => 'audio/x-gsm',
              '.gsm' => 'audio/x-gsm',
              '.gsp' => 'application/x-gsp',
              '.gss' => 'application/x-gss',
              '.gtar' => 'application/x-gtar',
              '.gz' => 'application/x-compressed',
              '.gz' => 'application/x-gzip',
              '.gzip' => 'application/x-gzip',
              '.gzip' => 'multipart/x-gzip',
              '.h' => 'text/plain',
              '.h' => 'text/x-h',
              '.hdf' => 'application/x-hdf',
              '.help' => 'application/x-helpfile',
              '.hgl' => 'application/vnd.hp-hpgl',
              '.hh' => 'text/plain',
              '.hh' => 'text/x-h',
              '.hlb' => 'text/x-script',
              '.hlp' => 'application/hlp',
              '.hlp' => 'application/x-helpfile',
              '.hlp' => 'application/x-winhelp',
              '.hpg' => 'application/vnd.hp-hpgl',
              '.hpgl' => 'application/vnd.hp-hpgl',
              '.hqx' => 'application/binhex',
              '.hqx' => 'application/binhex4',
              '.hqx' => 'application/mac-binhex',
              '.hqx' => 'application/mac-binhex40',
              '.hqx' => 'application/x-binhex40',
              '.hqx' => 'application/x-mac-binhex40',
              '.hta' => 'application/hta',
              '.htc' => 'text/x-component',
              '.htm' => 'text/html',
              '.html' => 'text/html',
              '.htmls' => 'text/html',
              '.htt' => 'text/webviewhtml',
              '.htx' => 'text/html',
              '.ice' => 'x-conference/x-cooltalk',
              '.ico' => 'image/x-icon',
              '.idc' => 'text/plain',
              '.ief' => 'image/ief',
              '.iefs' => 'image/ief',
              '.iges' => 'application/iges',
              '.iges' => 'model/iges',
              '.igs' => 'application/iges',
              '.igs' => 'model/iges',
              '.ima' => 'application/x-ima',
              '.imap' => 'application/x-httpd-imap',
              '.inf' => 'application/inf',
              '.ins' => 'application/x-internett-signup',
              '.ip' => 'application/x-ip2',
              '.isu' => 'video/x-isvideo',
              '.it' => 'audio/it',
              '.iv' => 'application/x-inventor',
              '.ivr' => 'i-world/i-vrml',
              '.ivy' => 'application/x-livescreen',
              '.jam' => 'audio/x-jam',
              '.jav' => 'text/plain',
              '.jav' => 'text/x-java-source',
              '.java' => 'text/plain',
              '.java' => 'text/x-java-source',
              '.jcm' => 'application/x-java-commerce',
              '.jfif' => 'image/jpeg',
              '.jfif' => 'image/pjpeg',
              '.jfif-tbnl' => 'image/jpeg',
              '.jpe' => 'image/jpeg',
              '.jpe' => 'image/pjpeg',
              '.jpeg' => 'image/jpeg',
              '.jpeg' => 'image/pjpeg',
              '.jpg' => 'image/jpeg',
              '.jpg' => 'image/pjpeg',
              '.jps' => 'image/x-jps',
              '.js' => 'application/x-javascript',
              '.jut' => 'image/jutvision',
              '.kar' => 'audio/midi',
              '.kar' => 'music/x-karaoke',
              '.ksh' => 'application/x-ksh',
              '.ksh' => 'text/x-script.ksh',
              '.la' => 'audio/nspaudio',
              '.la' => 'audio/x-nspaudio',
              '.lam' => 'audio/x-liveaudio',
              '.latex' => 'application/x-latex',
              '.lha' => 'application/lha',
              '.lha' => 'application/octet-stream',
              '.lha' => 'application/x-lha',
              '.lhx' => 'application/octet-stream',
              '.list' => 'text/plain',
              '.lma' => 'audio/nspaudio',
              '.lma' => 'audio/x-nspaudio',
              '.log' => 'text/plain',
              '.lsp' => 'application/x-lisp',
              '.lsp' => 'text/x-script.lisp',
              '.lst' => 'text/plain',
              '.lsx' => 'text/x-la-asf',
              '.ltx' => 'application/x-latex',
              '.lzh' => 'application/octet-stream',
              '.lzh' => 'application/x-lzh',
              '.lzx' => 'application/lzx',
              '.lzx' => 'application/octet-stream',
              '.lzx' => 'application/x-lzx',
              '.m' => 'text/plain',
              '.m' => 'text/x-m',
              '.m1v' => 'video/mpeg',
              '.m2a' => 'audio/mpeg',
              '.m2v' => 'video/mpeg',
              '.m3u' => 'audio/x-mpequrl',
              '.man' => 'application/x-troff-man',
              '.map' => 'application/x-navimap',
              '.mar' => 'text/plain',
              '.mbd' => 'application/mbedlet',
              '.mc' => 'application/x-magic-cap-package-1.0',
              '.mcd' => 'application/mcad',
              '.mcd' => 'application/x-mathcad',
              '.mcf' => 'image/vasa',
              '.mcf' => 'text/mcf',
              '.mcp' => 'application/netmc',
              '.me' => 'application/x-troff-me',
              '.mht' => 'message/rfc822',
              '.mhtml' => 'message/rfc822',
              '.mid' => 'application/x-midi',
              '.mid' => 'audio/midi',
              '.mid' => 'audio/x-mid',
              '.mid' => 'audio/x-midi',
              '.mid' => 'music/crescendo',
              '.mid' => 'x-music/x-midi',
              '.midi' => 'application/x-midi',
              '.midi' => 'audio/midi',
              '.midi' => 'audio/x-mid',
              '.midi' => 'audio/x-midi',
              '.midi' => 'music/crescendo',
              '.midi' => 'x-music/x-midi',
              '.mif' => 'application/x-frame',
              '.mif' => 'application/x-mif',
              '.mime' => 'message/rfc822',
              '.mime' => 'www/mime',
              '.mjf' => 'audio/x-vnd.audioexplosion.mjuicemediafile',
              '.mjpg' => 'video/x-motion-jpeg',
              '.mm' => 'application/base64',
              '.mm' => 'application/x-meme',
              '.mme' => 'application/base64',
              '.mod' => 'audio/mod',
              '.mod' => 'audio/x-mod',
              '.moov' => 'video/quicktime',
              '.mov' => 'video/quicktime',
              '.movie' => 'video/x-sgi-movie',
              '.mp2' => 'audio/mpeg',
              '.mp2' => 'audio/x-mpeg',
              '.mp2' => 'video/mpeg',
              '.mp2' => 'video/x-mpeg',
              '.mp2' => 'video/x-mpeq2a',
              '.mp3' => 'audio/mpeg3',
              '.mp3' => 'audio/x-mpeg-3',
              '.mp3' => 'video/mpeg',
              '.mp3' => 'video/x-mpeg',
              '.mpa' => 'audio/mpeg',
              '.mpa' => 'video/mpeg',
              '.mpc' => 'application/x-project',
              '.mpe' => 'video/mpeg',
              '.mpeg' => 'video/mpeg',
              '.mpg' => 'audio/mpeg',
              '.mpg' => 'video/mpeg',
              '.mpga' => 'audio/mpeg',
              '.mpp' => 'application/vnd.ms-project',
              '.mpt' => 'application/x-project',
              '.mpv' => 'application/x-project',
              '.mpx' => 'application/x-project',
              '.mrc' => 'application/marc',
              '.ms' => 'application/x-troff-ms',
              '.mv' => 'video/x-sgi-movie',
              '.my' => 'audio/make',
              '.mzz' => 'application/x-vnd.audioexplosion.mzz',
              '.nap' => 'image/naplps',
              '.naplps' => 'image/naplps',
              '.nc' => 'application/x-netcdf',
              '.ncm' => 'application/vnd.nokia.configuration-message',
              '.nif' => 'image/x-niff',
              '.niff' => 'image/x-niff',
              '.nix' => 'application/x-mix-transfer',
              '.nsc' => 'application/x-conference',
              '.nvd' => 'application/x-navidoc',
              '.o' => 'application/octet-stream',
              '.oda' => 'application/oda',
              '.omc' => 'application/x-omc',
              '.omcd' => 'application/x-omcdatamaker',
              '.omcr' => 'application/x-omcregerator',
              '.p' => 'text/x-pascal',
              '.p10' => 'application/pkcs10',
              '.p10' => 'application/x-pkcs10',
              '.p12' => 'application/pkcs-12',
              '.p12' => 'application/x-pkcs12',
              '.p7a' => 'application/x-pkcs7-signature',
              '.p7c' => 'application/pkcs7-mime',
              '.p7c' => 'application/x-pkcs7-mime',
              '.p7m' => 'application/pkcs7-mime',
              '.p7m' => 'application/x-pkcs7-mime',
              '.p7r' => 'application/x-pkcs7-certreqresp',
              '.p7s' => 'application/pkcs7-signature',
              '.part' => 'application/pro_eng',
              '.pas' => 'text/pascal',
              '.pbm' => 'image/x-portable-bitmap',
              '.pcl' => 'application/vnd.hp-pcl',
              '.pcl' => 'application/x-pcl',
              '.pct' => 'image/x-pict',
              '.pcx' => 'image/x-pcx',
              '.pdb' => 'chemical/x-pdb',
              '.pdf' => 'application/pdf',
              '.pfunk' => 'audio/make',
              '.pgm' => 'image/x-portable-greymap',
              '.pic' => 'image/pict',
              '.pict' => 'image/pict',
              '.pkg' => 'application/x-newton-compatible-pkg',
              '.pko' => 'application/vnd.ms-pki.pko',
              '.pl' => 'text/plain',
              '.pl' => 'text/x-script.perl',
              '.plx' => 'application/x-pixclscript',
              '.pm' => 'image/x-xpixmap',
              '.pm' => 'text/x-script.perl-module',
              '.pm4' => 'application/x-pagemaker',
              '.pm5' => 'application/x-pagemaker',
              '.png' => 'image/png',
              '.pnm' => 'application/x-portable-anymap',
              '.pnm' => 'image/x-portable-anymap',
              '.pot' => 'application/mspowerpoint',
              '.pot' => 'application/vnd.ms-powerpoint',
              '.pov' => 'model/x-pov',
              '.ppa' => 'application/vnd.ms-powerpoint',
              '.ppm' => 'image/x-portable-pixmap',
              '.pps' => 'application/mspowerpoint',
              '.pps' => 'application/vnd.ms-powerpoint',
              '.ppt' => 'application/mspowerpoint',
              '.ppt' => 'application/powerpoint',
              '.ppt' => 'application/vnd.ms-powerpoint',
              '.ppt' => 'application/x-mspowerpoint',
              '.ppz' => 'application/mspowerpoint',
              '.pre' => 'application/x-freelance',
              '.prt' => 'application/pro_eng',
              '.ps' => 'application/postscript',
              '.psd' => 'application/octet-stream',
              '.pvu' => 'paleovu/x-pv',
              '.pwz' => 'application/vnd.ms-powerpoint',
              '.py' => 'text/x-script.phyton',
              '.pyc' => 'applicaiton/x-bytecode.python',
              '.qcp' => 'audio/vnd.qcelp',
              '.qd3' => 'x-world/x-3dmf',
              '.qd3d' => 'x-world/x-3dmf',
              '.qif' => 'image/x-quicktime',
              '.qt' => 'video/quicktime',
              '.qtc' => 'video/x-qtc',
              '.qti' => 'image/x-quicktime',
              '.qtif' => 'image/x-quicktime',
              '.ra' => 'audio/x-pn-realaudio',
              '.ra' => 'audio/x-pn-realaudio-plugin',
              '.ra' => 'audio/x-realaudio',
              '.ram' => 'audio/x-pn-realaudio',
              '.ras' => 'application/x-cmu-raster',
              '.ras' => 'image/cmu-raster',
              '.ras' => 'image/x-cmu-raster',
              '.rast' => 'image/cmu-raster',
              '.rexx' => 'text/x-script.rexx',
              '.rf' => 'image/vnd.rn-realflash',
              '.rgb' => 'image/x-rgb',
              '.rm' => 'application/vnd.rn-realmedia',
              '.rm' => 'audio/x-pn-realaudio',
              '.rmi' => 'audio/mid',
              '.rmm' => 'audio/x-pn-realaudio',
              '.rmp' => 'audio/x-pn-realaudio',
              '.rmp' => 'audio/x-pn-realaudio-plugin',
              '.rng' => 'application/ringing-tones',
              '.rng' => 'application/vnd.nokia.ringing-tone',
              '.rnx' => 'application/vnd.rn-realplayer',
              '.roff' => 'application/x-troff',
              '.rp' => 'image/vnd.rn-realpix',
              '.rpm' => 'audio/x-pn-realaudio-plugin',
              '.rt' => 'text/richtext',
              '.rt' => 'text/vnd.rn-realtext',
              '.rtf' => 'application/rtf',
              '.rtf' => 'application/x-rtf',
              '.rtf' => 'text/richtext',
              '.rtx' => 'application/rtf',
              '.rtx' => 'text/richtext',
              '.rv' => 'video/vnd.rn-realvideo',
              '.s' => 'text/x-asm',
              '.s3m' => 'audio/s3m',
              '.saveme' => 'aapplication/octet-stream',
              '.sbk' => 'application/x-tbook',
              '.scm' => 'application/x-lotusscreencam',
              '.scm' => 'text/x-script.guile',
              '.scm' => 'text/x-script.scheme',
              '.scm' => 'video/x-scm',
              '.sdml' => 'text/plain',
              '.sdp' => 'application/sdp',
              '.sdp' => 'application/x-sdp',
              '.sdr' => 'application/sounder',
              '.sea' => 'application/sea',
              '.sea' => 'application/x-sea',
              '.set' => 'application/set',
              '.sgm' => 'text/sgml',
              '.sgm' => 'text/x-sgml',
              '.sgml' => 'text/sgml',
              '.sgml' => 'text/x-sgml',
              '.sh' => 'application/x-bsh',
              '.sh' => 'application/x-sh',
              '.sh' => 'application/x-shar',
              '.sh' => 'text/x-script.sh',
              '.shar' => 'application/x-bsh',
              '.shar' => 'application/x-shar',
              '.shtml' => 'text/html',
              '.shtml' => 'text/x-server-parsed-html',
              '.sid' => 'audio/x-psid',
              '.sit' => 'application/x-sit',
              '.sit' => 'application/x-stuffit',
              '.skd' => 'application/x-koan',
              '.skm' => 'application/x-koan',
              '.skp' => 'application/x-koan',
              '.skt' => 'application/x-koan',
              '.sl' => 'application/x-seelogo',
              '.smi' => 'application/smil',
              '.smil' => 'application/smil',
              '.snd' => 'audio/basic',
              '.snd' => 'audio/x-adpcm',
              '.sol' => 'application/solids',
              '.spc' => 'application/x-pkcs7-certificates',
              '.spc' => 'text/x-speech',
              '.spl' => 'application/futuresplash',
              '.spr' => 'application/x-sprite',
              '.sprite' => 'application/x-sprite',
              '.src' => 'application/x-wais-source',
              '.ssi' => 'text/x-server-parsed-html',
              '.ssm' => 'application/streamingmedia',
              '.sst' => 'application/vnd.ms-pki.certstore',
              '.step' => 'application/step',
              '.stl' => 'application/sla',
              '.stl' => 'application/vnd.ms-pki.stl',
              '.stl' => 'application/x-navistyle',
              '.stp' => 'application/step',
              '.sv4cpio' =>'application/x-sv4cpio',
              '.sv4crc' => 'application/x-sv4crc',
              '.svf' => 'image/vnd.dwg',
              '.svf' => 'image/x-dwg',
              '.svr' => 'application/x-world',
              '.svr' => 'x-world/x-svr',
              '.swf' => 'application/x-shockwave-flash',
              '.t' => 'application/x-troff',
              '.talk' => 'text/x-speech',
              '.tar' => 'application/x-tar',
              '.tbk' => 'application/toolbook',
              '.tbk' => 'application/x-tbook',
              '.tcl' => 'application/x-tcl',
              '.tcl' => 'text/x-script.tcl',
              '.tcsh' => 'text/x-script.tcsh',
              '.tex' => 'application/x-tex',
              '.texi' => 'application/x-texinfo',
              '.texinfo' =>' lication/x-texinfo',
              '.text' => 'application/plain',
              '.text' => 'text/plain',
              '.tgz' => 'application/gnutar',
              '.tgz' => 'application/x-compressed',
              '.tif' => 'image/tiff',
              '.tif' => 'image/x-tiff',
              '.tiff' => 'image/tiff',
              '.tiff' => 'image/x-tiff',
              '.tr' => 'application/x-troff',
              '.tsi' => 'audio/tsp-audio',
              '.tsp' => 'application/dsptype',
              '.tsp' => 'audio/tsplayer',
              '.tsv' => 'text/tab-separated-values',
              '.turbot' => 'image/florian',
              '.txt' => 'text/plain',
              '.uil' => 'text/x-uil',
              '.uni' => 'text/uri-list',
              '.unis' => 'text/uri-list',
              '.unv' => 'application/i-deas',
              '.uri' => 'text/uri-list',
              '.uris' => 'text/uri-list',
              '.ustar' => 'application/x-ustar',
              '.ustar' => 'multipart/x-ustar',
              '.uu' => 'application/octet-stream',
              '.uu' => 'text/x-uuencode',
              '.uue' => 'text/x-uuencode',
              '.vcd' => 'application/x-cdlink',
              '.vcs' => 'text/x-vcalendar',
              '.vda' => 'application/vda',
              '.vdo' => 'video/vdo',
              '.vew' => 'application/groupwise',
              '.viv' => 'video/vivo',
              '.viv' => 'video/vnd.vivo',
              '.vivo' => 'video/vivo',
              '.vivo' => 'video/vnd.vivo',
              '.vmd' => 'application/vocaltec-media-desc',
              '.vmf' => 'application/vocaltec-media-file',
              '.voc' => 'audio/voc',
              '.voc' => 'audio/x-voc',
              '.vos' => 'video/vosaic',
              '.vox' => 'audio/voxware',
              '.vqe' => 'audio/x-twinvq-plugin',
              '.vqf' => 'audio/x-twinvq',
              '.vql' => 'audio/x-twinvq-plugin',
              '.vrml' => 'application/x-vrml',
              '.vrml' => 'model/vrml',
              '.vrml' => 'x-world/x-vrml',
              '.vrt' => 'x-world/x-vrt',
              '.vsd' => 'application/x-visio',
              '.vst' => 'application/x-visio',
              '.vsw' => 'application/x-visio',
              '.w60' => 'application/wordperfect6.0',
              '.w61' => 'application/wordperfect6.1',
              '.w6w' => 'application/msword',
              '.wav' => 'audio/wav',
              '.wav' => 'audio/x-wav',
              '.wb1' => 'application/x-qpro',
              '.wbmp' => 'image/vnd.wap.wbmp',
              '.web' => 'application/vnd.xara',
              '.wiz' => 'application/msword',
              '.wk1' => 'application/x-123',
              '.wmf' => 'windows/metafile',
              '.wml' => 'text/vnd.wap.wml',
              '.wmlc' => 'application/vnd.wap.wmlc',
              '.wmls' => 'text/vnd.wap.wmlscript',
              '.wmlsc' => 'application/vnd.wap.wmlscriptc',
              '.word' => 'application/msword',
              '.wp' => 'application/wordperfect',
              '.wp5' => 'application/wordperfect',
              '.wp5' => 'application/wordperfect6.0',
              '.wp6' => 'application/wordperfect',
              '.wpd' => 'application/wordperfect',
              '.wpd' => 'application/x-wpwin',
              '.wq1' => 'application/x-lotus',
              '.wri' => 'application/mswrite',
              '.wri' => 'application/x-wri',
              '.wrl' => 'application/x-world',
              '.wrl' => 'model/vrml',
              '.wrl' => 'x-world/x-vrml',
              '.wrz' => 'model/vrml',
              '.wrz' => 'x-world/x-vrml',
              '.wsc' => 'text/scriplet',
              '.wsrc' => 'application/x-wais-source',
              '.wtk' => 'application/x-wintalk',
              '.xbm' => 'image/x-xbitmap',
              '.xbm' => 'image/x-xbm',
              '.xbm' => 'image/xbm',
              '.xdr' => 'video/x-amt-demorun',
              '.xgz' => 'xgl/drawing',
              '.xif' => 'image/vnd.xiff',
              '.xl' => 'application/excel',
              '.xla' => 'application/excel',
              '.xla' => 'application/x-excel',
              '.xla' => 'application/x-msexcel',
              '.xlb' => 'application/excel',
              '.xlb' => 'application/vnd.ms-excel',
              '.xlb' => 'application/x-excel',
              '.xlc' => 'application/excel',
              '.xlc' => 'application/vnd.ms-excel',
              '.xlc' => 'application/x-excel',
              '.xld' => 'application/excel',
              '.xld' => 'application/x-excel',
              '.xlk' => 'application/excel',
              '.xlk' => 'application/x-excel',
              '.xll' => 'application/excel',
              '.xll' => 'application/vnd.ms-excel',
              '.xll' => 'application/x-excel',
              '.xlm' => 'application/excel',
              '.xlm' => 'application/vnd.ms-excel',
              '.xlm' => 'application/x-excel',
              '.xls' => 'application/excel',
              '.xls' => 'application/vnd.ms-excel',
              '.xls' => 'application/x-excel',
              '.xls' => 'application/x-msexcel',
              '.xlt' => 'application/excel',
              '.xlt' => 'application/x-excel',
              '.xlv' => 'application/excel',
              '.xlv' => 'application/x-excel',
              '.xlw' => 'application/excel',
              '.xlw' => 'application/vnd.ms-excel',
              '.xlw' => 'application/x-excel',
              '.xlw' => 'application/x-msexcel',
              '.xm' => 'audio/xm',
              '.xml' => 'application/xml',
              '.xml' => 'text/xml',
              '.xmz' => 'xgl/movie',
              '.xpix' => 'application/x-vnd.ls-xpix',
              '.xpm' => 'image/x-xpixmap',
              '.xpm' => 'image/xpm',
              '.x-png' => 'image/png',
              '.xsr' => 'video/x-amt-showrun',
              '.xwd' => 'image/x-xwd',
              '.xwd' => 'image/x-xwindowdump',
              '.xyz' => 'chemical/x-pdb',
              '.z' => 'application/x-compress',
              '.z' => 'application/x-compressed',
              '.zip' => 'application/x-compressed',
              '.zip' => 'application/x-zip-compressed',
              '.zip' => 'application/zip',
              '.zip' => 'multipart/x-zip',
              '.zoo' => 'application/octet-stream',
              '.zsh' => 'text/x-script.zsh'
          );
    
          $_ext = "";
          foreach($mime_types as $k => $vl){
            if ($vl == $ext){
                $_ext = $k;
                break;
            }
            unset($vl);
          }

          return $_ext;
    
        } else {
          return "";
        }
    
    
    }

    public static function getTimeDateTime($date, $datai = ""){

        $dataFuturo = $date;
        if ($datai == ""){
            $dataAtual = date('Y-m-d H:i:s');
        } else {
           $dataAtual = $datai;
        }
      
      
        $date_time  = new \DateTime($dataAtual);
        $diff       = $date_time->diff( new \DateTime($dataFuturo));
        $str = "";
        if ($diff->y > 0){
            $str .= $diff->y."a ";
        }
        if ($diff->m > 0){
            $str .= $diff->m."m ";
        }
        if ($diff->d > 0){
            $str .= $diff->d."d ";
        }
        if ($diff->h > 0){
            $str .= $diff->h."h ";
        }
        if ($diff->i > 0){
            $str .= $diff->i."m ";
        }
        if ($diff->s > 0){
            $str .= $diff->s."s ";
        }
        return $str;
      
      }

      public static function getTimeLineTasks($inicial, $final){
        $date_time_dias  = new \DateTime($inicial);
        $diff_dias       = $date_time_dias->diff( new \DateTime($final));
        return $diff_dias;
      }
      
      public static function getTimeLine($inicial, $final){
      
        $time_inicial = strtotime($inicial);
        $time_final = strtotime($final);
        // Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_final - $time_inicial; // 19522800 segundos
        // Calcula a diferença de dias
        $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dia
      
        return $dias;
      
      }
      
      public static function getPercentTask($datainc, $prazo){
      
        if ($datainc && $prazo) {
          $datai = self::getTimeLineTasks($datainc, $prazo);
          $dataf = self::getTimeLineTasks(date('Y-m-d H:i:s'), $prazo);
      
          $horasi = 0;
          if ($datai->y != ""){
            $horasi += ($datai->y*365*24);
          }
          if ($datai->m != ""){
            $horasi += ($datai->m*31*24);
          }
          if ($datai->d != ""){
            $horasi += ($datai->d*24);
          }
          if ($datai->h != ""){
            $horasi += $datai->h;
          }
      
          $horasf = 0;
          if ($dataf->y != ""){
            $horasf += ($dataf->y*365*24);
          }
          if ($dataf->m != ""){
            $horasf += ($dataf->m*31*24);
          }
          if ($dataf->d != ""){
            $horasf += ($dataf->d*24);
          }
          if ($dataf->h != ""){
            $horasf += $dataf->h;
          }
      
          $div = round(($horasf/$horasi)*100);
          $res = (int) (100-$div);
          return ($res);
        } else {
          return 0;
        }
      }
      
      /**
      * RETORNA O TEMPO RESTANTE PARA O PRAZO FINAL
      */
      public static function getTempoFaltando($prazo){
        return self::getTimeDateTime($prazo);
      }

    public static function getField($field, $table, $vl_recovery = ""){
        
        $type = strtolower(@$field->attributes->type);
        @$class = @$field->attributes->class;

        $required = ($field->null != "N") ? " required " : "";

        if ($type == "input"){

            $fld_type = self::getTypeField($field);

            $place = (@$field->attributes->placeholder != "") ? @$field->attributes->placeholder : "{{\Config::get(\"translate.".$table.".".$field->name."\")}}";

            $str  = "<input name='".$field->name."'  
                           id='".$field->name."'  
                           type='".$fld_type."'
                           class='".$class." form-control-plaintext' 
                           maxlength='".$field->attributes->max."'
                           minlength='".@$field->attributes->min."' 
                           placeholder='".$place."' 
                           ".$required;
                           if ($vl_recovery){
                                $str .= " value='".$vl_recovery."' ";
                           }
                    $str .= "/>";
                    return $str;

        } if ($type == "color"){

            $fld_type = self::getTypeField($field);

            $place = (@$field->attributes->placeholder != "") ? @$field->attributes->placeholder : "{{\Config::get(\"translate.".$table.".".$field->name."\")}}";

            $str  = "<input name='".$field->name."'  
                           id='".$field->name."'  
                           type='".$fld_type."'
                           class='".$class." form-control-plaintext' 
                           maxlength='7'
                           minlength='7' 
                           placeholder='".$place."' 
                           ".$required;
                           if ($vl_recovery){
                                $str .= " value='".$vl_recovery."' ";
                           }
                    $str .= "/>";
                    return $str;

        } else if ($type == "checkbox") {
            return "<input name='".$field->name."'  
                id='".$field->name."'  
                type='checkbox'
                class='".$class." form-control-plaintext' 
                value='".$field->attributes->value."' 
                ".$required." 
                />";
        } else if ($type == "radio") {
            return "<input name='".$field->name."'  
                id='".$field->name."'  
                type='radio'
                class='".$class." form-control-plaintext' 
                value='".$field->attributes->value."' 
                ".$required." 
                />";
        } else if ($type == "select") {
            $str = "<select name='".$field->name."' id='".$field->name."' ".$required." 
            class='".$class." select2 form-control-plaintext'>";
            $exp = explode(",",$field->attributes->options);
            if (!empty($exp) && (sizeof($exp) > 0)){
                foreach($exp as $vl){
                    $_exp = explode("|",$vl);
                    if (!empty($_exp) && (sizeof($_exp) > 1)){
                        if ($vl_recovery != ""){
                            $str .= "<option value='".trim($_exp[0])."'  @if(\$".$table."->".$field->name." == \"".trim($_exp[0])."\") selected=\"selected\" @endif >".$_exp[1]."</option>";
                        } else {
                            $str .= "<option value='".trim($_exp[0])."'>".$_exp[1]."</option>";
                        }
                        
                    }
                    unset($vl);
                }
            }
            $str .= "</select>";
            return $str;

        } else if ($type == "textarea") {
            $str = "<textarea name='".$field->name."' id='".$field->name."' ".$required." 
            class='".$class." form-control-plaintext' cols='".@$field->attributes->cols."' rows='".$field->attributes->rows."'
            placeholder='".(@$field->attributes->placeholder != "") ? @$field->attributes->placeholder : "Config::get(\"translate.".$table.".".$field->name."\")" ."' 
            >";
            $str .= "</textarea>";
        } else {

            $fld_type = self::getTypeField($field);

            $str = "<input name='".$field->name."' ";
            $str .= " type='".$fld_type."'";
            $str .= " id='".$field->name."'";
            $str .= " class='".$class." form-control-plaintext'";
            $str .= " placeholder='{{Config::get(\"translate.".$table.".".$field->name."\")}}' ";
            $str .= " maxlength='".$field->attributes->max."'";
            $str .= " minlength='".@$field->attributes->min."'"; 
            $str .= $required;
            
            if ($vl_recovery){
                $str .= " value='".$vl_recovery."' ";
            }
            $str .= " />";

            return $str;    
        }
    }

    public static function getTypeField($obj){
        
        if ($obj->type == "TEXT"){
            $ret = "text";
        } else if ($obj->type == "BIGINT"){
            $ret = "number";
        } else if ($obj->type == "VARCHAR"){
            $ret = "text";
        } else if ($obj->type == "DATE"){
            $ret = "date";
        } else if ($obj->type == "DATETIME"){
            $ret = "date";
        } else if ($obj->type == "DECIMAL"){
            $ret = "number";
        } else {
            $ret = "text";
        }
        return $ret;
    }
    
    public static function active($tipo){
        $cookie = \Cookie::get('language');
        if ($cookie == 'en'){
            return "flag-icon-us";
        } else if ($cookie == 'pt-br'){
            return "flag-icon-br";
        } else if ($cookie == 'es'){
            return "flag-icon-es";
        } else {
            return "flag-icon-br";
        }
    }

    public static function getLanguage(){
        $cookie = \Cookie::get('language');
        if (!$cookie){
            $cookie = "pt-br";
        }
        $trans = include(base_path()."/lang/".$cookie."/fields.php");
        return $trans;
    }
    
    public static function montaFormulario($diretorio, $formulario="", $nameModal="", $obj="", $connection="cliente"){

       $file =  resource_path().DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$diretorio.DIRECTORY_SEPARATOR.$formulario;
       $content = json_decode(file_get_contents($file));

        $str = "";

        $str .= '';
        if (!empty($content->campos) && (sizeof($content->campos)>0)){
            foreach($content->campos as $ca){
                //if ($connection == "cliente") {
                    if (@$content->vuejs) {
                        $str .= self::getFieldForm($ca, "S", $nameModal, $diretorio, $obj);
                    } else {
                        $str .= self::getFieldForm($ca, "N", $nameModal, $diretorio, $obj);
                    }
                // } else {
                //     if (@$content->vuejs) {
                //         $str .= self::getFieldForm($ca, "S", $nameModal, $diretorio, $obj, $connection);
                //     } else {
                //         $str .= self::getFieldForm($ca, "N", $nameModal, $diretorio, $obj, $connection);
                //     }
                // }
                unset($ca);
            }
        }
        $str .= '';

       return $str;

    }

    public static function getFieldForm($field, $vuejs = "N", $nameModal="", $diretorio="", $translate=""){

        $str = "";
        if ($field->type != "hide"){
            $req_field = false;
            if (@$field->validation){
                $ret_val = self::getValidation($field->validation);
                $validation = $ret_val->str;
                $req_field = $ret_val->required;
            }

            $asterisco = "";
            if ($req_field){
                $asterisco = " * ";
            }

            $deVujs = "";
            if ($vuejs == "S"){
                $deVujs = " :model=\"this.\$emit.registro.".$field->id."\" ";
            } else {
                $deVujs = ' name="'.$field->id.'" ';
            }

            if ($field->type == "hidden"){
                $str .= '
                    <input type="hidden" '.$deVujs.' id="'.$field->id.'" value="" />
                ';
            }

            if ((@$field->type == "text")){
                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.' mb-2">';
                }
                $str .= '
                        <div class="form-group">
                            <label>'.$asterisco.$translate->translate[$field->id].'</label>
                            <input type="'.$field->type.'" '.$deVujs.' 
                            data-validation-required-message="This First Name field is required"
                            id="'.$field->id.'" class="form-control task-title" placeholder="'.$translate->translate[$field->id.'_placeholder'].'"
                            '.@$validation.'
                                />
                        </div>   
                ';
                if (@$field->coluna){
                    $str .= '</div>';
                }
            }
            //PAULO CAPELETT 09/02
            // if ((@$field->type == "label")){
            //     if (@$field->coluna){
            //         $str .= '<div class="col-md-'.$field->coluna.'">';
            //     }
            //     $str .= '
            //             <div class="form-group">
            //                 <label>'.$asterisco.$translate->translate[$field->id].'</label>';
            //                 if($asterisco.$translate->translate[$field->id] == "INSS"){
            //                     $str.= '<div class="input-group">
            //                     <span class="input-group-text">R$</span>';
            //                 };'
            //                 <input type="'.$field->type.'" '.$deVujs.' readonly="false"
            //                 data-validation-required-message="This First Name field is required"
            //                 id="'.$field->id.'" class="form-control task-title" placeholder="'.$translate->translate[$field->id.'_placeholder'].'"
            //                 '.@$validation.'
            //                     />
            //             </div>
            //     ';
            //     if (@$field->coluna){
            //         $str .= '</div>';
            //     }
            // }

            if ((@$field->type == "email") || (@$field->type == "password")){
                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.'">';
                }
                $str .= '
                        <div class="form-group">
                            <label>'.$asterisco.$translate->translate[$field->id].'</label>
                            <input type="'.$field->type.'" '.$deVujs.' 
                            data-validation-required-message="This First Name field is required"
                            id="'.$field->id.'" class="form-control task-title" placeholder="'.$translate->translate[$field->id.'_placeholder'].'"
                            '.@$validation.'
                                />
                        </div>   
                ';
                if (@$field->coluna){
                    $str .= '</div>';
                }
            }

            if (@$field->type == "color"){
                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.'">';
                }
                $str .= '
                        <div class="form-group">
                            <label>'.$asterisco.$translate->translate[$field->id].'</label>
                            <input type="'.$field->type.'" '.$deVujs.' 
                            data-validation-required-message="This First Name field is required"
                            id="'.$field->id.'" class="form-control task-title" placeholder="'.$translate->translate[$field->id.'_placeholder'].'"
                            '.@$validation.'
                                />
                        </div>   
                ';
                if (@$field->coluna){
                    $str .= '</div>';
                }
            }

            if (@$field->type == "file"){
                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.'">';
                }
                $str .= '

                    <fieldset class="form-group">
                        <label for="basicInputFile">'.$translate->translate[$field->id.'_placeholder'].'</label> 
                        <div class="custom-file"><input type="'.$field->type.'" id="'.$field->id.'" class="custom-file-input"> 
                            <label for="inputGroupFile01" class="custom-file-label">'.$asterisco.$translate->translate[$field->id].'</label>
                        </div>
                    </fieldset>
                ';
                if (@$field->coluna){
                    $str .= '</div>';
                }
            }

            if (@$field->type=="item"){
                $tm = ($field->tamanho) ? $field->tamanho : 6;
                $str .= '
                    <div class="col-md-12" style="margin-bottom:11px;">
                        <h'.$tm.'>'.$translate->translate[$field->id].'</h'.$tm.'>

                    </div>       
                ';
            }

            if (@$field->type == "divider"){
                $str .= '
                    <div class="col-md-12 md-1" style="margin-bottom: 11px;color:##5c6480;">
                        <div class="assigned d-flex justify-content-between border-bottom">
                        </div>
                    </div> 
                ';
            }

            if (@$field->type == "select"){
                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.'">';
                }
                $str .= '
                        <div class="form-group">
                            <label>'.$asterisco.$translate->translate[$field->id].'</label>
                            <v-select id="'.$field->id.'" '.$deVujs.' class="form-control task-title">
                                <option value="">Selecione...</option>';
                                if (!empty($field->values) && (sizeof($field->values) > 0)){
                                    foreach($field->values as $v){
                                        $str .= '<option value="'.$v->id.'">'.$v->nome.'</option>';
                                        unset($v);
                                    }
                                }
                        $str .= '</v-select>
                        </div>   
                ';
                if (@$field->coluna){
                    $str .= '</div>';
                }
                
            }

            // if (@$field->type == "query"){
            //     $table = @$field->table;
            //     $classe = @$field->classe;
            //     $onchange = @$field->onchange;
            //     $array = "";

            //     if (@$field->coluna){
            //         $str .= '<div class="col-md-'.$field->coluna.'">';
            //     }

            //     $str_change = "";
            //     if ($onchange) {
            //         $str_change = ' @change="'.$onchange.'" ';
            //     }


            //     $str .= '
            //             <div class="form-group">
            //                 <label>'.$asterisco.$translate->translate[$field->id].'</label>
            //                     <select id="'.$field->id.'" '.$deVujs.' '. $str_change .' class="form-control task-title">';

            //                     if (is_array(@$field->condiction) && @sizeof($field->condiction) > 0){
            //                         if ($classe && !$table) {
            //                             unset($array);
            //                             $array = array();
            //                         }
            //                         foreach($field->condiction as $vl){
            //                             $fl = $vl->field;
            //                             $cond = $vl->value;
            //                             $valor_query = self::getFilterQuery($cond);
            //                             if ($table){
            //                                 if (strlen($array) > 1){
            //                                     $array .= " and ";
            //                                 } else {
            //                                     $array .= " where "; 
            //                                 }
            //                                 $array .= " ".$fl."='".$valor_query."' ";
            //                             } else {
            //                                 $array[$fl] = $valor_query;
            //                             }
            //                             unset($vl);
            //                         }
            //                     }

            //                     if ($table && !$classe){
            //                         $sel = 'select '.$field->fields->id.','.$field->fields->label.' from '.$table.' '.$array;
            //                         $select = \DB::connection($connection)->select($sel);
            //                     } else {
            //                         $classe_objeto = new \ReflectionClass('\App\Models\\'.$field->classe);
            //                         $objeto = $classe_objeto->newInstanceArgs();
            //                         if (is_array($array) && @sizeof($array)>1){
            //                             $select = $objeto::where($array)->get();
            //                         } else {
            //                             $select = $objeto::all();
            //                         }
            //                     }

            //                     if (!empty($select) && (sizeof($select) > 0)){
            //                         if (@$field->classe != "Empresa") {
            //                             $str .= '<option value="">Selecione...</option>';
            //                         } else {
            //                             if (!empty($select) && (sizeof($select) > 1)){
            //                                 $str .= '<option value="">Selecione...</option>';
            //                             }
            //                         }

            //                         foreach($select as $v){
            //                             $str .= '<option value="'.$v->{$field->fields->id}.'">'.$v->{$field->fields->label}.'</option>';
            //                             unset($v);
            //                         }
            //                     }
            //             $str .= '</select>';
            //             $str .= '</div>'; 

            //             if ($classe) {
            //                 //$str .= '</div>';
            //                 // <div class="col-md-2">
            //                 //     <button style="margin-top:23px;" 
            //                 //         type="button" 
            //                 //         class="btn btn-sm btn-icon btn-success glow mr-1 mb-1 open_classe_add"
            //                 //         data-formulario="'.$diretorio.'"
            //                 //         data-field-return="'.$field->id.'"
            //                 //         data-select-return="'.@$sel.'"
            //                 //         data-name-modal="'.$nameModal.'"
            //                 //         data-classe-return="'.@$classe.'">
            //                 //         <i class="bx bx-plus"></i>
            //                 //     </button> 
            //                 // </div>    
            //                 //';
            //             }

            //     if (@$field->coluna){
            //         $str .= ' </div>';
            //     }
            // }

            if (@$field->type == "query"){
                $table = @$field->table;
                $classe = @$field->classe;
                $onchange = @$field->onchange;
                $array = "";

                if (@$field->coluna){
                $str .= '<div class="col-md-'.$field->coluna.' mb-2">';
                }

                    $str_change = "";
                    if ($onchange) {
                        $str_change = ' @change="'.$onchange.'" ';
                    }

                    $str .= '
                    <div class="form-group">
                        <label>'.$asterisco.$translate->translate[$field->id].'</label>
                        <v-select id="'.$field->id.'" '.$deVujs.' '.$str_change.'';

                        if (is_array(@$field->condiction) && @sizeof($field->condiction) > 0){
                            if ($classe && !$table) {
                                unset($array);
                                $array = array();
                            }
                            foreach($field->condiction as $vl){
                                $fl = $vl->field;
                                $cond = $vl->value;
                                $valor_query = self::getFilterQuery($cond);
                                if ($table){
                                    if (strlen($array) > 1){
                                        $array .= " and ";
                                    } else {
                                        $array .= " where "; 
                                    }
                                    $array .= " ".$fl."='".$valor_query."' ";
                                } else {
                                    $array[$fl] = $valor_query;
                                }
                                unset($vl);
                            }
                        }

                        if ($table && !$classe){
                            $sel = 'select '.$field->fields->id.','.$field->fields->label.' from '.$table.' '.$array;
                            $select = \DB::connection($connection)->select($sel);
                        } else {
                            $classe_objeto = new \ReflectionClass('\App\Models\\'.$field->classe);
                            $objeto = $classe_objeto->newInstanceArgs();
                            if (is_array($array) && @sizeof($array)>1){
                                $select = $objeto::where($array)->get();
                            } else {
                                $select = $objeto::all();
                            }
                        }

                        $options = [];
                        
                        foreach($select as $v){
                            if (isset($v->descricao)) {
                                $options[] = ['descricao' => $v->descricao, 'value' => $v->{$field->fields->id}];
                            }
                            if (isset($v->nome)) {
                                $options[] = ['nome' => $v->nome, 'value' => $v->{$field->fields->id}];
                            }
                            //$options[] = ['descricao' => $v->{$field->fields->label}, 'value' => $v->{$field->fields->id}];
                            unset($v);
                        }
                        $optionsJson = json_encode($options);
                        $str .= ' :options=\''.$optionsJson.'\' :reduce="option => option.value" label="'.$field->fields->label.'" />
                    </div>';
                    Functions::getOptionsJson($optionsJson);
                    if (@$field->coluna){
                $str .= ' </div>';
                }
            }

            if (@$field->type == "query-multi"){

                $table = @$field->table;
                $classe = @$field->classe;
                $array = "";

                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.'">';
                }

                $str .= '
                        <div class="form-group">
                            <label>'.$asterisco.$translate->translate[$field->id].'</label>
                                <select id="'.$field->id.'"  name="'.$field->id.'[]" '.$deVujs.' class="form-control task-title select2-multiple" multiple>
                                <option value="">Selecione...</option>';

                                if (isset($field->condiction) && (count(@$field->condiction) > 0)){
                                    if ($classe && !$table) {
                                        unset($array);
                                        $array = array();
                                    }
                                    foreach($field->condiction as $vl){
                                        $fl = $vl->field;
                                        $cond = $vl->value;
                                        $valor_query = self::getFilterQuery($cond);
                                        if ($table){
                                            if (strlen($array) > 1){
                                                $array .= " and ";
                                            } else {
                                                $array .= " where "; 
                                            }
                                            $array .= " ".$fl."='".$valor_query."' ";
                                        } else {
                                            $array[$fl] = $valor_query;
                                        }
                                        unset($vl);
                                    }
                                }

                                if ($table && !$classe){
                                    $sel = 'select '.$field->fields->id.','.$field->fields->label.' from '.$table.' '.$array;
                                    $select = \DB::select($sel);
                                } else {
                                    $classe_objeto = new \ReflectionClass('\App\Models\\'.$field->classe);
                                    $objeto = $classe_objeto->newInstanceArgs();
                                    
                                    if (is_array($array) && (count(@$array)>1)){
                                        $select = $objeto::where($array)->get();
                                    } else {
                                        $select = $objeto::all();
                                    }
                                }

                                if (!empty($select) && (sizeof($select) > 0)){
                                    foreach($select as $v){
                                        $str .= '<option value="'.$v->{$field->fields->id}.'">'.$v->{$field->fields->label}.'</option>';
                                        unset($v);
                                    }
                                }
                        $str .= '</select>';
                        $str .= '</div>'; 

                        if ($classe) {
                            //$str .= '</div>';
                            // <div class="col-md-2">
                            //     <button style="margin-top:23px;" 
                            //         type="button" 
                            //         class="btn btn-sm btn-icon btn-success glow mr-1 mb-1 open_classe_add"
                            //         data-formulario="'.$diretorio.'"
                            //         data-field-return="'.$field->id.'"
                            //         data-select-return="'.@$sel.'"
                            //         data-name-modal="'.$nameModal.'"
                            //         data-classe-return="'.@$classe.'">
                            //         <i class="bx bx-plus"></i>
                            //     </button> 
                            // </div>    
                            //';
                        }

                if (@$field->coluna){
                    $str .= ' </div>';
                }
            }

            if (@$field->type == "query-multi-table"){

                $table = @$field->table;
                $classe = @$field->classe;
                $array = "";
                $table_save = @$field->table_save;
                $field_save = @$field->field_save;

                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.'">';
                }

                $str .= '
                        <div class="form-group">
                            <label>'.$asterisco.$translate->translate[$field->id].'</label>
                                <select id="'.$field->id.'"  name="'.$field->id.'[]" '.$deVujs.' class="form-control task-title select2-multiple" multiple="multiple">
                                <option value="">Selecione...</option>';

                                if (isset($field->condiction) && (count(@$field->condiction) > 0)){
                                    if ($classe && !$table) {
                                        unset($array);
                                        $array = array();
                                    }
                                    foreach($field->condiction as $vl){
                                        $fl = $vl->field;
                                        $cond = $vl->value;
                                        $valor_query = self::getFilterQuery($cond);
                                        if ($table){
                                            if (strlen($array) > 1){
                                                $array .= " and ";
                                            } else {
                                                $array .= " where "; 
                                            }
                                            $array .= " ".$fl."='".$valor_query."' ";
                                        } else {
                                            $array[$fl] = $valor_query;
                                        }
                                        unset($vl);
                                    }
                                }

                                $classe_objeto = new \ReflectionClass('\App\Models\\'.$classe);
                                $objeto = $classe_objeto->newInstanceArgs();
                                $select_all = $objeto::all();

                                if ($table_save && $field_save){
                                    $classe_objeto = new \ReflectionClass('\App\Models\\'.$table_save);
                                    $objeto = $classe_objeto->newInstanceArgs();
                                    
                                    if ($field_save == "whatsuserqueues") {
                                        $select = $objeto::where(array('usuarios_id'=> Auth::user()->id))->get();
                                    }
                                }

                                if (!empty($select_all) && (sizeof($select_all) > 0)){
                                    foreach($select_all as $v){
                                        $achou = '';
                                        if (!empty($select) && (sizeof($select) > 0)){
                                            foreach($select as $se){
                                                if ($se->whatsqueues_id == $v->{$field->fields->id}){
                                                    $achou = " selected ";
                                                    break;
                                                }
                                                unset($se);
                                            }
                                        }
                                        $str .= '<option value="'.$v->{$field->fields->id}.'" '.$achou.'>'.$v->{$field->fields->label}.'</option>';
                                        unset($v);
                                    }
                                }

                        $str .= '</select>';
                        $str .= '</div>'; 

                        if ($classe) {
                            //$str .= '</div>';
                            // <div class="col-md-2">
                            //     <button style="margin-top:23px;" 
                            //         type="button" 
                            //         class="btn btn-sm btn-icon btn-success glow mr-1 mb-1 open_classe_add"
                            //         data-formulario="'.$diretorio.'"
                            //         data-field-return="'.$field->id.'"
                            //         data-select-return="'.@$sel.'"
                            //         data-name-modal="'.$nameModal.'"
                            //         data-classe-return="'.@$classe.'">
                            //         <i class="bx bx-plus"></i>
                            //     </button> 
                            // </div>    
                            //';
                        }

                if (@$field->coluna){
                    $str .= ' </div>';
                }
            }

            if (@$field->type == "date"){
                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.' mb-2">';
                }
                $str .= '
                        <label>'.$asterisco.$translate->translate[$field->id].'</label>
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="'.$field->type.'" id="'.$field->id.'" '.$deVujs.' class="form-control pickadate" placeholder="'.$asterisco.$translate->translate[$field->id.'_placeholder'].'">
                            <div class="form-control-position">
                                <i class="bx bx-calendar"></i>
                            </div>
                        </fieldset>
                ';
                if (@$field->coluna){
                    $str .= '</div>';
                }    

            }

            if (@$field->type == "time"){
                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.' mb-2">';
                }
                $str .= '
                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="text" id="'.$field->id.'" '.$deVujs.' class="form-control pickatime" placeholder="'.$asterisco.$translate->translate[$field->id.'_placeholder'].'">
                            <div class="form-control-position">
                                <i class="bx bx-history"></i>
                            </div>
                        </fieldset>
                ';
                if (@$field->coluna){
                    $str .= '</div>';
                }    

            }

            if (@$field->type == "date-inline") {
                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.' mb-2">';
                }
                $str .= '
                    <p id="inlinecontainer"></p>
                    <input class="inlinedatapicker" '.$deVujs.' id="'.$field->id.'" type="hidden">
                ';
                if (@$field->coluna){
                    $str .= '</div>';
                }
            }

            if (@$field->type == "switch"){
                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.' mb-2">';
                }
                $str .= '
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-glow custom-control-inline mb-1">
                            <input type="checkbox" class="custom-control-input" '.$deVujs.'  id="'.$field->id.'">
                            <label class="custom-control-label" for="'.$field->id.'"></label>
                            <span style="font-weight: bold">&nbsp;'.$asterisco.$translate->translate[$field->id].'</span>
                        </div>
                    </div>';
                if (@$field->coluna){
                    $str .= '</div>';
                } 
            }

            if (@$field->type == "checkbox"){
                dd("checkbox");
                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.' mb-2">';
                }
                $str .= '
                    <fieldset>
                        <div class="form-check">
                            <input type="'.$field->type.'" '.$deVujs.' class="form-check-input" id="'.$field->id.'">
                            <label class="form-check-label" for="'.$field->id.'">'.$asterisco.$translate->translate[$field->id].'</label>
                        </div>
                    </fieldset>

                ';
                if (@$field->coluna){
                    $str .= '</div>'; 
                }
            }

            if (@$field->type == "tag"){
                if (@$field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.'">';
                }
                $str .= '
                    <div class="form-group">
                        <label>'.$asterisco.$translate->translate[$field->id].'</label>
                        <input 
                         value="" 
                         name="'.$field->id.'"
                         id="'.$field->id.'" class="form-control task-title" placeholder="'.$translate->translate[$field->id.'_placeholder'].'"
                         '.@$validation.'
                        />
                    </div>  
                ';
                if (@$field->coluna){
                    $str .= '</div>'; 
                }
            }

            if (@$field->type == "editor") {

                if ($field->coluna) {
                    $str .= '';
                }
                $str  .= '<textarea class="editorTexto" id="'.$field->id.'" name="'.$field->id.'"></textarea>';
                if (@$field->coluna){
                    $str .= '</div>'; 
                }
            }

            if (@$field->type == "textarea") {
                if ($field->coluna){
                    $str .= '<div class="col-md-'.$field->coluna.' mb-2">';
                }

                $str  .= '
                    <div class="form-group">
                        <label>'.$asterisco.$translate->translate[$field->id].'</label>
                        <textarea class="form-control scrollbar" style="width:100%;" rows="10" id="'.$field->id.'" name="'.$field->id.'"></textarea>
                    </div>
                ';

                // $str .= '
                //     <div class="snow-container rounded p-50 scroll-corpo scrolling">
                //             <div class="compose-editor mx-75"></div>
                //             <quill-editor
                //                 class="scrollbar" 
                //                 style="min-height:225px; max-height:300px;"
                //                 ref="Editordefault"
                //                 '.$deVujs.'
                //             />
                //     </div>
                // ';

                if (@$field->coluna){
                    $str .= '</div>'; 
                }
            }

        }
        return $str;
    }

    public static function getOptionsJson($optionsJson){  
        return json_encode($optionsJson);
    }


    public static function getValidation($val){
        $req = false;
        $str = "";
        if ($val){

            if (@$val->required == true){
                $req = true;
                $str .= ' required ';
            }

            // if ((@$val->min > 0) && (@$val->max > 0)){
            //     $str .= ' min="'.$val->min.'" ';
            //     $str .= ' max="'.$val->max.'" ';
            //     $str .= ' data-validation-regex-regex="([^a-z]*[A-Z]*)*" ';
            //     $str .= ' data-validation-containsnumber-regex="([^0-9]*[0-9]+)+" ';
            //     $str .= ' data-validation-containsnumber-message="Informe valores entre '.$val->min.' & '.$val->max.' obrigatóriamente" ';
            //     $str .= ' placeholder="Informe valores entre '.$val->min.' & '.$val->max.' obrigatóriamente"" ';
            // }
            if (@$val->type == "number"){
                $str .= ' data-validation-regex-regex="^([0-9]+)$" ';
                //$str .= ' data-validation-containsnumber-regex="([^0-9]*[0-9]+)+" ';
                //$str .= ' data-validation-containsnumber-message="Informe apenas números obrigatóriamente" ';
                $str .= ' placeholder="Informe apenas números obrigatóriamente" ';
            }
            if (@$val->minlength > 0){
                $str .= ' minlength="'.$val->minlength.'" ';
            }
            if (@$val->maxlength > 0){
                $str .= ' maxlength="'.$val->maxlength.'" ';
            }
            // if (@$val->type == "string"){
            //     $str .= ' 
            //         data-validation-containsnumber-regex="^[a-zA-Z]+$"  
            //         data-validation-containsnumber-message="Informe apenas letras sem caracters especiais"  
            //      ';
            // }
            if (@$val->type == "url"){
                $str .= ' 
                    data-validation-regex-regex="^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$" 
                    data-validation-containsnumber-message="Informe uma URL válida"  
                 ';
            }
        }
        $obj_ret = new \stdClass();
        $obj_ret->str = $str;
        $obj_ret->required = $req;
        return $obj_ret;
    }

    public static function getFilterQuery($field){
        $explode = explode(".", $field);
        $retorno = "";
        if ($explode[0] == "USERSESSION"){
            $retorno = 1;
        } else {
            $retorno = $field;
        }

        return $retorno;
    }

    public static function exportTable(){
        return false;
    }

    public static function getValidateModuloUsuario($modulo, $usuario){

        $habilitados = explode(",",self::encrypt($usuario->modulos, false));
        $op = explode("|",@$habilitados[0]);

        if (@$op[1] == $usuario->id){
            if (in_array($modulo, $habilitados)){
                return " checked ";
            } 
        }
        return "";
    }

    public static function getPermissionCadastro($user, $acl, $qual, $perm){
        $return = "";

        if ($acl){
            $exp = explode(",",self::encrypt($acl, false));
            $valida_user = explode("|",$exp[0]);
            if (@$valida_user[1] == $user->id){
                array_shift($exp);
                if (!empty($exp) && (sizeof($exp) > 0)){
                    foreach($exp as $e){
                        $pos = strpos($e, $qual."|");
                        if ($pos > -1){
                            if (strpos($e, "|".$perm) > -1){
                                $return = " checked ";
                                break;
                            }
                        } 
                        unset($e);
                    }
                }
            }
        }
        return $return;
    }

    public static function getPermissionGeral($user, $acl, $pos, $local){
        $return = "";
        if ($local == "P") {
            if ($acl){
                $permissoes = explode(",",self::encrypt($acl, false));
                $us_auth = explode("|",$permissoes[0]);
                if (@$us_auth[1] == $user->id){
                    $perm = $permissoes[1];
                    if ($perm[$pos] == "S"){
                        return " checked ";
                    } else {
                        return "";
                    }
                }
            } 
        } else if ($local == "AC") {
            $dias = explode(",",$user->diasacesso);
            $p = $pos - 1;
            if (@$dias[$p] == "S"){
                return " checked ";
            } else {
                return "";
            }
        } else if ($local == "BL") {
            $dias = $user->bloqueiaferiado;
            if ($dias == "S"){
                return " checked ";
            } else {
                return "";
            }
        } else {
            @$permissoes = \Session::get("PERM_GERAL");
            if (@$permissoes[$pos] == "S"){
                return true;
            } else {
                return false;
            }

        }
    }

    public static function getPermissionChat($user, $acl, $pos, $local){
        $return = "";
        if ($local == "P") {
            if ($acl){
                $permissoes = explode(",",self::encrypt($acl, false));
                $us_auth = explode("|",$permissoes[0]);
                if (@$us_auth[1] == $user->id){
                    $perm = $permissoes[1];
                    if (@$perm[$pos] == "S"){
                        return " checked ";
                    } else {
                        return "";
                    }
                }
            } 
        } else {
            @$permissoes = \Session::get("PERM_CHAT");
            if (@$permissoes[$pos] == "S"){
                return true;
            } else {
                return false;
            }

        }
    }

    public static function getPermissionTarefa($user, $acl, $pos, $local){
        $return = "";
        if ($local == "P") {
            if ($acl){
                $permissoes = explode(",",self::encrypt($acl, false));
                $us_auth = explode("|",$permissoes[0]);
                if (@$us_auth[1] == $user->id){
                    $perm = $permissoes[1];
                    if (@$perm[$pos] == "S"){
                        return " checked ";
                    } else {
                        return "";
                    }
                }
            } 
        } else {
            @$permissoes = \Session::get("PERM_TAREFAS");
            if (@$permissoes[$pos] == "S"){
                return true;
            } else {
                return false;
            }

        }
    }

    public static function getPermissionConhecimento($user, $acl, $pos, $local){
        $return = "";
        if ($local == "P") {
            if ($acl){
                $permissoes = explode(",",self::encrypt($acl, false));
                $us_auth = explode("|",$permissoes[0]);
                if (@$us_auth[1] == $user->id){
                    $perm = $permissoes[1];
                    if (@$perm[$pos] == "S"){
                        return " checked ";
                    } else {
                        return "";
                    }
                }
            } 
        } else {
            @$permissoes = \Session::get("PERM_CONHECIMENTO");
            if (@$permissoes[$pos] == "S"){
                return true;
            } else {
                return false;
            }

        }
    }

    public static function getPermissionWhatsapp($user, $acl, $pos, $local){
        $return = "";
        if ($local == "P") {
            if ($acl){
                $permissoes = explode(",",self::encrypt($acl, false));
                $us_auth = explode("|",$permissoes[0]);
                if (@$us_auth[1] == $user->id){
                    $perm = $permissoes[1];
                    if (@$perm[$pos] == "S"){
                        return " checked ";
                    } else {
                        return "";
                    }
                }
            } 
        } else {
            @$permissoes = \Session::get("PERM_WHATSAPP");
            if (@$permissoes[$pos] == "S"){
                return true;
            } else {
                return false;
            }

        }
    }

    public static function getPermissionCrm($user, $acl, $pos, $local){
        $return = "";
        if ($local == "P") {
            if ($acl){
                $permissoes = explode(",",self::encrypt($acl, false));
                $us_auth = explode("|",$permissoes[0]);
                if (@$us_auth[1] == $user->id){
                    $perm = $permissoes[1];
                    if (@$perm[$pos] == "S"){
                        return " checked ";
                    } else {
                        return "";
                    }
                }
            } 
        } else {
            @$permissoes = \Session::get("PERM_CRM");
            if (@$permissoes[$pos] == "S"){
                return true;
            } else {
                return false;
            }

        }
    }

    public static function getPermissionReport($user, $acl, $pos, $local){
        $return = "";
        if ($local == "P") {
            if ($acl){
                $permissoes = explode(",",self::encrypt($acl, false));
                $us_auth = explode("|",$permissoes[0]);
                if (@$us_auth[1] == $user->id){
                    $perm = $permissoes[1];
                    if (@$perm[$pos] == "S"){
                        return " checked ";
                    } else {
                        return "";
                    }
                }
            } 
        } else {
            @$permissoes = \Session::get("PERM_REPORT");
            if (@$permissoes[$pos] == "S"){
                return true;
            } else {
                return false;
            }

        }
    }

    public static function permissionModulos($modulo){
        $_user = Auth::user();
        $exp = explode("@", $_user->email);
        if (($exp[1] == "lptsolutions.com.br") || ($exp[0] == "admin")){
            if (($exp[1] == "lptsolutions.com.br") && ($exp['0'] == "paulo")) {
                return true;
            } else {
                $_mod = Modulo::all();
                if ($_mod){
                    foreach($_mod as $m){
                        if ($m->modulo == $modulo) {
                            return true;
                            break;
                        }
                        unset($m);
                    }
                }
                return false;
            }
            
        } else {
            $session = \Session::get('MODULOS');
            if (is_array($session) && in_array(@$modulo, @$session)){
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public static function permissionReport($modulo, $report){
        
        if ($modulo && $report) {
            $url = explode("/", $report);
            if ($url[0] == "report") {
                return self::validaPermissaoRelatorio($url[1].$url[0]);
            }
        }

        return false;
    }

    public static function permissoesGlobal($table, $modulo, $p, $url = "#", $name = ""){
        $user = \Auth::user();
        return true;
    }

    public static function validaPermissaoRelatorio($name){
        $get_cadastros = \Session::get('PERM_REPORT');
        if ($name == "whatsappreport") {
            if (substr($get_cadastros,0,1) == "S") {
                return true;   
            }
        }

        if ($name == "crmreport") {
            if (substr($get_cadastros,1,1) == "S") {
                return true;   
            }
        }

        if ($name == "calendarreport") {
            if (substr($get_cadastros,2,1) == "S") {
                return true;   
            }
        }

        if ($name == "tasksreport") {
            if (substr($get_cadastros,3,1) == "S") {
                return true;   
            }
        }

        if ($name == "inventarioreport") {
            if (substr($get_cadastros,4,1) == "S") {
                return true;   
            }
        }

        return false;
    }

    /**
     * PREENCHER QUANDO CRIAR UM NOVO RELATÓRIO E DAR AS PERMISSÕES
     */
    public static function retornaRelatorios(){
        $name[] = "whatsappreport";
        $name[] = "crmreport";
        $name[] = "calendarreport";
        $name[] = "tasksreport";
        $name[] = "inventarioreport";
        return $name;
    }


    public static function permModulo($modulo){
        $_mo = Modulo::where(array('modulo'=>$modulo))->first();
        if (!$_mo){
            return false;
        } 
        return true;
    }


    //public static function 

    public static function getOnline(){

        $users = null; //\Tracker::onlineUsers();
        //dd($users);
        $str = '';
        if ($users){
            foreach($users as $us){
                //if ($us->user->id != \Auth::user()->id){
                    if (@$us->user->id > 0){
                        $avatar = (trim(@$us->user->avatar_provider) != "") ? @$us->user->avatar_provider : @$us->user->avatar;
                        if (@$us->user->online == "S"){
                            $str .= '<li class="chat_full_all">
                            <div class="d-flex align-items-center">';
                                if (trim($avatar)  != ""){
                                    $str .= ' <div class="avatar m-0 mr-50"><img src="'.$avatar.'" height="36"
                                                width="36" alt="sidebar user image">
                                                <span class="avatar-status-busy"><i class="'.self::getHumor($us->user->eu).'" style="margin-top: 0px;
                                                margin-left: -22px; width: 28px !important; height: 29px !important; border-radius: 50%;"></i></span>';
                                } else {
                                    $_nome = explode(" ",$us->user->nome);
                                    $tm = sizeof($_nome);
                                    $nome = '';
                                    if ($tm > 1){
                                        $nome = substr($_nome[0],0,1).substr($_nome[1],0,1);
                                    } else {
                                        if ($tm == 1){
                                            $nome = substr($_nome[0],0,1);
                                        } else {
                                            $nome = substr($us->user->nome,0,1);
                                        }
                                        
                                    }
                                    $str .= ' <div class="avatar_text m-0 mr-50">'.$nome.'
                                            <span class="avatar-status-busy"><i class="'.self::getHumor($us->user->eu).'" style="margin-top: 0px;
                                            margin-left: -22px; width: 28px !important; height: 29px !important; border-radius: 50%;"></i></span>';
                                }
                            $str .= '</div>
                                <div class="chat-sidebar-name">
                                    <h6 class="mb-0">'.$us->user->nome.'</h6><span class="text-muted">'.$us->user->cargos->nome.'</span>
                                </div>
                            </div>
                            </li>';
                        }
                    }
                //}
                unset($us);
            }
        }

        return $str;
    
    }

    public static function getHumor($status){
        $retorno = "far ";
        if ($status == 0){
            $retorno.=" fa-angry text-danger";
        } else if ($status == 1){
            $retorno.=" fa-sad-tear text-danger";
        } else if ($status == 2){
            $retorno.=" fa-sad-cry text-danger";
        } else if ($status == 3){
            $retorno.=" fa-meh-rolling-eyes text-info";
        } else if ($status == 4){
            $retorno.=" fa-grimace text-info";
        }else if ($status == 5){
            $retorno.=" fa-grin-alt text-info";
        } else if ($status == 6){
            $retorno.=" fa-laugh-squint text-success";
        } else if ($status == 7){
            $retorno.=" fa-laugh-beam text-success";
        } else if ($status == 8){
            $retorno.=" fa-laugh text-success";
        } else if ($status == 9){
            $retorno.=" fa-grin-hearts text-success";
        } else if ($status == 10){
            $retorno.=" fa-grin-tongue text-success";
        } else {
            $retorno.=" fa-grin-alt text-success";
        }

        return $retorno;
    }

    public static function getConversas($de, $para, $quantidade, $data = "N", $id=""){
        if ($data == "N"){
            $filter = "";
            if ($id > 0){
                $filter = " AND id < '".$id."' ";
            }

            $select = "select * from conversas c where c.de_usuario='".$de."' AND c.para_usuario='".$para."' ".$filter." 
            union all 
            select * from conversas c where c.de_usuario='".$para."' AND c.para_usuario='".$de."' ".$filter."
            order by created_at desc LIMIT ".$quantidade;

            //$mensagens = Conversa::whereRaw("(de_usuario=? AND para_usuario=?) OR (de_usuario = ? and para_usuario = ?) ".$filter, array($de,$para,$para,$de))->orderBy('created_at', 'DESC')->take($quantidade)->get();
            $mensagens = \DB::connection('cliente')->select($select);
            if (!empty($mensagens) && (sizeof($mensagens) > 0)){
                foreach($mensagens as $me){
                    if (@$me->tipo == "F"){
                        $fi = Conversasarquivo::where(array('conversas_id'=>$me->id))->first();
                        $fi->arquivo = null;
                        $me->_file = $fi;
                    } 
                    unset($me);
                }
            }
        } else {
            $mensagens = Conversa::whereRaw("(de_usuario=? AND para_usuario=?) OR (de_usuario = ? and para_usuario = ?)", array($de,$para,$para,$de))->orderBy('created_at', 'DESC')->first();
        }
        return $mensagens;
    }


    public static function getConversasGrupo($grupo, $quantidade, $data = "N", $id=""){
        if ($data == "N"){
            $filter = "";
            if ($id > 0){
                $filter = " AND id < '".$id."' ";
            }

            $select = "select c.*,u.nome as usuario from conversasdogrupo c left join usuarios u on u.id = c.de_usuario where  grupos_id='".$grupo."' ".$filter."
            order by created_at desc LIMIT ".$quantidade;

            $mensagens = \DB::connection('cliente')->select($select);
            if (!empty($mensagens) && (sizeof($mensagens) > 0)){
                foreach($mensagens as $me){
                    if (@$me->tipo == "F"){
                        $fi = Arquivosgrupo::where(array('conversasdogrupo_id'=>$me->id))->first();
                        $fi->arquivo = null;
                        $me->_file = $fi;
                    } 
                    unset($me);
                }
            }
        } else {
            $mensagens = Conversasdogrupo::whereRaw("id=?", array($grupo))->orderBy('created_at', 'DESC')->first();
        }
        return $mensagens;
    }
    
    public static function getMeuDepartamento($usuario = ""){
        if ($usuario){
            $user = Usuario::find($usuario);
        } else {
            $user = \Auth::user();
        }

        $cargo = Cargo::find($user->cargos_id);
        $departamento = Departamento::find(@$cargo->departamentos_id);
        return $departamento;
    }

    public static function getMinhasTarefas( $filtro = ""){

        $cargo = Cargo::find(\Auth::user()->cargos_id);

        if ($filtro == 1){
            $tarefas = Chamado::where('usuarios_id','=',\Auth::user()->id)
            ->where('encerrado','<>','S')
            ->orderBy('created_at','DESC')
            ->get();
        } else if ($filtro == 2){
            $tarefas = Chamado::where('criador_id','=',\Auth::user()->id)
            ->orderBy('created_at','DESC')
            ->get();
        } else if ($filtro == 3){
            $tarefas = Chamado::where('departamentos_id','=',$cargo->departamentos_id)
            ->orderBy('created_at','DESC')
            ->get();
        } else if ($filtro == 4){
            $tarefas =  Chamado::where('usuarios_id','=',\Auth::user()->id)
            ->where('encerrado','=','S')
            ->orderBy('created_at','DESC')
            ->get();
        } else {
            $tarefas = Chamado::where('criador_id','=',\Auth::user()->id)
            ->orWhere('usuarios_id','=',\Auth::user()->id)
            ->orWhere('departamentos_id','=',$cargo->departamentos_id)
            ->orderBy('created_at','DESC')
            ->get();
        }

        if (!empty($tarefas) && (sizeof($tarefas) > 0)){
          foreach($tarefas as $ta){
            $usuario = Usuario::find($ta->criador_id);
            $ta->previsao = self::formatDate($ta->dataprevisao, "F", "yyyy-mm-dd");
            $cargo = Cargo::find($usuario->cargos->id);
            $usuario->cargo = $cargo;
            $ta->usuario = $usuario;

            $conversas = Mensagenschamado::where(array('chamados_id'=>$ta->id))->orderBy('created_at','DESC')->get();
            $ta->conversas = $conversas;

            $participantes = Usuarioschamado::where(array('chamados_id'=>$ta->id))->orderBy('created_at','DESC')->get();
            $ta->participantes = $participantes;

            $arquivos = Arquivoschamado::where(array('chamados_id'=>$ta->id))->get();
            if ($arquivos) {
                $ta->arquivos = $arquivos;
            }

            unset($ta);
          }
        }
        return $tarefas;

    }

    public static function setaMensagemChamado($chamados_id,$usuarios_id, $mensagem ){
        if ($chamados_id && $usuarios_id && $mensagem){
            $msg = new Mensagenschamado();
            $msg->mensagem = $mensagem;
            $msg->chamados_id = $chamados_id;
            $msg->usuarios_id = $usuarios_id;
            $msg->save();
        }
    }


    public static function setaUsuarioAtual($chamado_id, $anterior, $atual){
        $us = new Usuarioschamado();
        $us->chamados_id = $chamado_id;
        $us->usuanterior = $anterior;
        $us->usuatual = $atual;
        $us->save();
    }

    /**
     * MÉTODO PARA MONTAR OS RETORNOS EM JSON PARA AS CHAMADAS VIA AXIOS
     */
    public static function returnMessage($erro, $message, $title, $icon, $lista = ""){
        
        $retorno = array();
        $retorno['error'] = $erro;
        $retorno['message'] = $message;
        $retorno['title'] = $title;
        $retorno['icon'] = $icon;
        if ($lista != ""){
            $retorno['lista'] = $lista;
        }
        return json_encode($retorno);
    }

    public static function validaDias($usuario){
        return true;
        if ($usuario->diasacesso) {
            $data = date('Y-m-d');
            $dia = date('w', strtotime($data));
            $dd = $dia - 1;
            $dias = explode(",", $usuario->diasacesso);
            if ($dias[$dd] == "S"){
                if ($usuario->horainicial && $usuario->horafinal) {
                    $hora_ini = explode(',', $usuario->horainicial);
                    $hora_fim = explode(',', $usuario->horafinal);
                    $ini = substr($hora_ini[$dd],0,strlen($hora_ini[$dd])-3);
                    $fim = substr($hora_fim[$dd],0,strlen($hora_fim[$dd])-3);
                    $p_ini = substr($hora_ini[$dd],strlen($hora_ini[$dd])-2,strlen($hora_ini[$dd]));
                    $p_fim = substr($hora_fim[$dd],strlen($hora_fim[$dd])-2,strlen($hora_fim[$dd]));
                    
                    if (($ini != "--") || ($fim != "--")) {
                        

                        $ini_m = explode(":", $ini);
                        $fim_m = explode(":", $fim);
                        $hh_i = self::deParaHora($p_ini, $ini_m[0]);
                        $hh_f = self::deParaHora($p_fim, $fim_m[0]);

                        $dt_ini = $hh_i.':'.$ini_m[1].':00';
                        $dt_fim = $hh_f.':'.$fim_m[1].':00';
                        $atual = date('H:i:s');
                        if (self::intervaloEntreHoras($dt_ini, $dt_fim, $atual)){
                            return true;
                        } else {
                            return false;
                        }

                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return true;
        }

    }

    public static function intervaloEntreHoras($inicio, $fim, $agora) {
        $inicioTimestamp = strtotime($inicio);
        $fimTimestamp = strtotime($fim);
        $agoraTimestamp = strtotime($agora);
        return (($agoraTimestamp >= $inicioTimestamp) && ($agoraTimestamp <= $fimTimestamp));
     }

    public static function deParaHora($periodo, $hora){
        
        if ($periodo == "PM"){
            switch($hora) {
                case 1:
                    return 13;
                    break;
                case 2:
                    return 14;
                break;    
                case 3:
                    return 15;
                break;
                case 4:
                    return 16;
                break;    
                case 5:
                    return 17;
                break;    
                case 6:
                    return 18;
                break;    
                case 7:
                    return 19;
                break;    
                case 8:
                    return 20;
                break;    
                case 9:
                    return 21;
                break;    
                case 10:
                    return 22;
                break;    
                case 11:
                    return 23;
                break;    
              }
        } else {
            if (strlen($hora) < 1){
                return "0".$hora;
            } else {
                return $hora;
            }
        }
    }

    public static function getDepartamento($usuario){
        $cargo = cargo::find($usuario->cargos_id);
        $departamento = Departamento::find(@$cargo->departamentos_id);
        return $departamento;
    }

    public static function getCategorias($departamento){
        $categorias = Conhecimento::where(array('departamentos_id'=>$departamento))->get();
        if (!empty($categorias) && (sizeof($categorias) > 0)){
            foreach($categorias as $ca){
                $total = Conhecimentosprocesso::where(array('conhecimentos_id'=>$ca->id))->count();
                $ca->total = $total;
                unset($ca);
            }
        }

        return $categorias;
    }

    public static function getConhecimentoItens($categoria){
        $processos = Conhecimentosprocesso::where(array('conhecimentos_id'=>$categoria))->get();
        if (!empty($processos) && (sizeof($processos) > 0)){
            foreach($processos as $pr){
                $usuario = Usuario::find($pr->usuarios_id);
                $anexo = Processosanexo::where(array('conhecimentosprocessos_id'=>$pr->id))->whereRaw("id = (select max(id) from processosanexos where conhecimentosprocessos_id = '".$pr->id."')")->first();
                $pr->usuario = $usuario;
                $pr->file = $anexo;

                unset($pr);
            }
        }

        return $processos;
    }

    /**
     * VALIDA SE PODE VER OS EMAILS DA CAIXA INFORMADA
     */
    public static function validaMinhasCaixas($caixa){
        $user = \Auth::user();
        $caixa = Caixasmensagen::find($caixa);
        $monitorado = Emailsmonitorado::find($caixa->emailsmonitorados_id);
        if ($monitorado->usuarios_id > 0){
            if ($user->id == $monitorado->usuarios_id){
                return true;
            } else {
                return false;
            }
        } else {
            $departamento = self::getMeuDepartamento($user);
            if ($departamento->id == $monitorado->departamentos_id){
                return true;
            } else {
                return false;
            }
        }
    }

    public static function validaSeEmailPossoAlterar($id){
        $user = \Auth::user();
        $email = Email::find($id);
        $caixamensagem = Caixasmensagen::find($email->caixasmensagens_id);
        $monitorados = Emailsmonitorado::find($caixamensagem->emailsmonitorados_id);
        $departamento = \App\Utils\Functions::getDepartamento($user);

        if (($departamento->id == $monitorados->departamentos_id) || ($monitorados->usuarios_id == $user->id)){
            return true;
        } else {
            return false;
        }

    }

    public static function converteHexRgb($hex){
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        $cor['0'] = $r;
        $cor['1'] = $g;
        $cor['2'] = $b;
        return $cor;
    }

    public static function geraAssinatura($usuario, $obj, $geral = 'N'){

        $ba = base_path()."/storage/assinatura/";
        $path = base_path()."/storage/assinatura/fundo.png";
        $imgResource = ImageCreateFromPNG($path);
        
        $base_font = base_path()."/resources/fonts/assinatura/";

        $session = $usuario;
        foreach($obj as $o){
            //dd($o);
            if ($o['cor'] == ""){
                $o['cor'] = "#000000";
            }
            $campo = "";
            if ($o['campo'] == "NOME"){
                $campo = $usuario->nome;
            }
            if ($o['campo'] == "TEXTO"){
                $campo = $o['texto'];
            }
            if ($o['campo'] == "EMAIL"){
                $campo = $usuario->email;
            }
            if ($o['campo'] == "TELEFONE"){
                $campo = $usuario->telefone;
            }
            if ($o['campo'] == "CELULAR"){
                $campo = $usuario->celular;
            }
            if ($o['campo'] == "CARGO"){
                $cargo = Cargo::find($usuario->cargos_id);
                $campo = $cargo->nome;
            }
            if ($o['campo'] == "DEPARTAMENTO"){
                $departamento = self::getMeuDepartamento($usuario->id);
                $campo = $departamento->nome;
            }
            if (strlen($campo) > 1) {
                imagettftext(
                    $imgResource, 
                    $o['tamanho'], 
                    0, 
                    $o['posx'], 
                    $o['posy'], 
                    imagecolorallocate($imgResource, self::converteHexRgb($o['cor'])[0], self::converteHexRgb($o['cor'])[1], self::converteHexRgb($o['cor'])[2]),
                    $base_font.$o['fonte'].".ttf", 
                    $campo
                );
            }
            unset($o);
        }
        if ($geral == "N") {
            header( 'Content-type: image/jpeg; charset=utf-8' );
            if (imagejpeg( $imgResource, $ba."sample.png", 80 )){
                return true;
            } else {
                return false;
            }
        } else {
            header('Content-type: image/jpeg; charset=utf-8' );
            if (!is_dir($ba."geral")) {
                mkdir($ba."geral");
            }
            if (imagejpeg($imgResource, $ba."geral/".$usuario->email.".png", 80 )){
                $_img = $ba."geral/".$usuario->email.".png";
                $imageData = base64_encode(file_get_contents($_img));
                $mimeType = mime_content_type($_img);
                $obj['src'] = 'data: '.$mimeType.';base64,'.$imageData;
                $obj['mime'] = $mimeType;
                $obj['size'] = filesize($_img);
                $obj['ext'] = pathinfo($_img, PATHINFO_EXTENSION);
                //unlink($_img);
                return $obj;
            } else {
                return null;
            }
        }
        
    }

    public static function getAvisos($total) {

        $user = \Auth::user();
        if ($user) {
            if ($total == "S") {
                @$avisos = \DB::connection('cliente')->select("select * from avisos a 
                left join avisosleitura a2 on a.id  = a2.avisos_id and a2.usuarios_id = '".$user->id."'
                where a2.created_at is null
                and a.exigever = 'S'
                and status = 'S'
                and a.datalimite >= '".date('Y-m-d')."'
                and a.departamentos_id is null limit 1")[0];
                if (@$avisos) {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                $avisos = \DB::connection('cliente')->select("select a.id, a.titulo, a.mensagem, a2.id as id2 from avisos a 
                left join avisosleitura a2 on a.id  = a2.avisos_id and a2.usuarios_id = '".$user->id."'
                where a2.created_at is null
                and a.exigever = 'S'
                and a.status = 'S'
                and a.datalimite >= '".date('Y-m-d')."'
                and a.departamentos_id is null limit 1")[0];
                if ($avisos) {
                    return $avisos;
                } else {
                    return null;
                }
            }
        }
    }

    public static function getIconesModulos($modulo){
        $array['EMAIL'] = "bx bx-envelope";
        $array['CHAT'] = "bx bx-chat";
        $array['TAREFAS'] = "bx bx-check-circle";
        $array['CALENDARIO'] = "bx bx-calendar";
        $array['COFRE'] = "bx bxs-lock";
        $array['CONHECIMENTO'] = "bx bxs-info-circle";
        $array['INVENTARIOS'] = "bx bx-purchase-tag";
        $array['WHATSAPP'] = "bx bxl-whatsapp";
        $array['CRM'] = "bx bx-receipt";
        
        if (@$array[$modulo] != ""){
            return $array[$modulo];
        } else {
            return "bx bx-message-square";
        }
        
        
    }

    public static function getUrlApi($empresa){
        if (strlen($empresa->portaapi) > 3) {
            return $empresa->enderecoapi.':'.$empresa->portaapi;
        } else {
            return $empresa->enderecoapi;
        }
    }

    public static function retornaColorAlert($tipo) {
        if ($tipo) {
            switch($tipo) {
                case "A":
                    return "warning";
                    break;
                case "D":
                    return "danger";
                    break;
                case "I":
                    return "info";
                    break;
                case "S":
                    return "primary";
                    break;                
            }
        } else {
            return "info";
        }
    }

    public static function getMessageAlert(){

        $empresa = \Session::get("_empresa");

        $avisos = Avisolpt::where(array(
            'status' => 'S',
            'empresa' => $empresa->id
        ))->where('ate', '>=', \date('Y-m-d'))->orderBy('ate')->first();
        if ($avisos){
            return '<div style="margin-top: 40px;margin-left: 80px;text-align: center;" class="alert alert-'.self::retornaColorAlert($avisos->tipo).' mb-1" role="alert">
                <span>'.$avisos->mensagem.'</span>
            </div>';
        } else {
            $avisos = Avisolpt::where(array(
                'status' => 'S',
            ))->where('ate', '>=', \date('Y-m-d'))->whereNull('empresa')->orderBy('ate')->first();
            if ($avisos) {
                return '<div style="margin-top: 40px;margin-left: 80px;text-align: center;" class="alert alert-'.self::retornaColorAlert($avisos->tipo).' mb-1" role="alert">
                    <span>'.$avisos->mensagem.'</span>
                </div>';
            }
        }

    }

    public static function validarCnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
    
        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;	
    
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;
    
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    public static function getDatabaseAtual(){
        return [
            'ip' => env('DATABASE_CREATE_IP'),
            'porta' => env('DATABASE_CREATE_PORTA'),
            'usuario' => env('DATABASE_CREATE_USUARIO'),
            'senha' => env('DATABASE_CREATE_SENHA'),
        ];
    }

    public static function getComandoSH($empresa){

        $comando = "./instala.sh ".$empresa->database;
        $endereco_api = str_ireplace("https://","", $empresa->enderecoapi);
        $endereco_api = str_ireplace("http://","", $endereco_api);
        $endereco_api = str_ireplace(".edialoga.com.br/","", $endereco_api);
        $endereco_api = str_ireplace(".localhost","", $endereco_api);
        $endereco_api = str_ireplace("edi","", $endereco_api);
        $endereco_api = str_ireplace(".aloga.com.br","", $endereco_api);
        $endereco_api_exp = explode("-",$endereco_api);

        $comando .= " ".@$endereco_api_exp[1]." ".$empresa->databaseip." 21313141".$empresa->cnpj." ".$empresa->enderecoapi." ".env('APP_URL')." ".$empresa->databaseuser." ".$empresa->databasepwd;

        return $comando;
    }


    public static function calendarioPendente(){
        
        $retorno = json_decode(\App\Http\Controllers\CalendarioController::getMeuCalendarioDoDia());
        if (count($retorno->lista) > 0){
            return true;
        } else {
            return false;
        }

    }

    /**
     * FUNÇÃO PARA FAZER ALTERAÇÃO NO TEXTO DA MENSAGEM PRÉ CONFIGURADA
     */
    public static function replaceTexto($text, $id = ""){
        $user = \Auth::user();
        if ($id != ""){
            return str_ireplace("['PROTOCOLO']",'#'.$id, $text);
        } else {
            return str_ireplace("['NOME_USUARIO']",$user->nome, $text);
        }
    }

    public static function formataCpfVale($cpf){
        if ($cpf) { //000.000.000.00
            $cpf = str_replace(['.', '-'], '', $cpf);
            return substr($cpf,0,3).".".substr($cpf,3,3).".".substr($cpf,6,3).".".substr($cpf,9,2);
        } else {
            return "";
        }
    }

    public static function formataCnpj($cnpj){
        if ($cnpj) { //00.000.000/0000-00
            return substr($cnpj,0,2).".".substr($cnpj,2,3).".".substr($cnpj,5,3)."/".substr($cnpj,8,4)."-".substr($cnpj,12,2);
        } else {
            return "";
        }
    }

    public static function lowerCase($lowerCase){        
        if ($lowerCase) {
            return mb_strtolower($lowerCase);
        } else {
            return "";
        }
    }

    public static function calculaHorasMinutos($manha, $tarde, $noite){

        list($inimanha, $fimmanha) = explode(" - ", $manha);
        list($initarde, $fimtarde) = explode(" - ", $tarde);
        list($ininoite, $fimnoite) = explode(" - ", $noite);

            if($manha != "00:00"){
                $inimanha = DateTime::createFromFormat("H:i", $inimanha);
                $fimmanha = DateTime::createFromFormat("H:i", $fimmanha);
                $interval = $fimmanha->diff($inimanha);
                $horaManha = $interval->format("%h");
                $minManha = $interval->format("%i");
            }else{
                $horaManha = 0;
                $minManha = 0;
            }

            if($tarde != "00:00"){
                $initarde = DateTime::createFromFormat("H:i", $initarde);
                $fimtarde = DateTime::createFromFormat("H:i", $fimtarde);
                $interval = $fimtarde->diff($initarde);
                $horaTarde = $interval->format("%h");
                $minTarde = $interval->format("%i");
            }else{
                $horaTarde = 0;
                $minTarde = 0;
            }

            if($noite != "00:00"){
                $ininoite = DateTime::createFromFormat("H:i", $ininoite);
                $fimnoite = DateTime::createFromFormat("H:i", $fimnoite);
                $interval = $fimnoite->diff($ininoite);
                $horaNoite = $interval->format("%h");
                $minNoite = $interval->format("%i");
            }else{
                $horaNoite = 0;
                $minNoite = 0;
            }

        return array(
            'horaManha' => $horaManha,
            'minManha' => $minManha,
            'horaTarde' => $horaTarde,
            'minTarde' => $minTarde,
            'horaNoite' => $horaNoite,
            'minNoite' => $minNoite
        );
    }

    public static function somaHorasMinutos($horaManha, $minManha, $horaTarde, $minTarde, $horaNoite, $minNoite) {
        $totalHoras = $horaManha + $horaTarde + $horaNoite;
        $totalMinutos = $minManha + $minTarde + $minNoite;
        
        if ($totalMinutos >= 60) {
            $totalHoras += floor($totalMinutos / 60);
            $totalMinutos = $totalMinutos % 60;
        }
        
        return array(
            'totalHoras' => $totalHoras, 
            'totalMinutos' => $totalMinutos
        );
    }

    public static function validaMenuName($menu){
        $user = Auth::user();
        $hasPermission = false;
        $menuDataset = [];        

         // Verifique se o menu tem submenus
        if (isset($menu->submenu) && count($menu->submenu) > 0) {
            
            $submenusPermitidos = [];
            $menuName = [];
            foreach ($menu->submenu as $submenu) {
                $perm = Permission::where('nome', '=', 'lista_' .strtolower($submenu->name))->first();
                if ($perm) {
                    $hasPermission = self::checkUserPermission($user, $perm);
                    if ($hasPermission) {
                        $submenusPermitidos[] = $submenu;
                        $menuName = [
                            'name' => $menu->name, 
                            'icon' => $menu->icon
                        ];
                    }
                }
            }

            $menuDataset['menu'] = $menuName;
            $menuDataset['submenus'] = $submenusPermitidos;
        }
        // dd($menuDataset);
        return $menuDataset;
    }

    public static function validaRelatorio($menu){
        $user = Auth::user();
        $hasPermission = false;

        if (isset($menu)) {
            // Verifique as permissões para cada submenu
            foreach ($menu as $relatorio) {
                $perm = Permission::where('nome', '=', 'gera_' .$relatorio->name)->first();

                if ($perm) {
                    $hasPermission = self::checkUserPermission($user, $perm);
                    if ($hasPermission) {
                        return true;
                    }
                }
            }
        }  
        return $hasPermission;
    }

    public static function checkUserPermission($user, $perm) {
        $myroles = Roleusuario::where('usuarios_id', $user->id)->pluck('roles_id')->toArray();

        if (!empty($myroles)) {
                $driver = \DB::connection()->getPdo()->getAttribute(\PDO::ATTR_DRIVER_NAME);

                if ($driver === 'mysql') {
                    $permissionrole = Permissionsrole::where('permissions_id', $perm->id)
                        ->whereIn('roles_id', $myroles)
                        ->where(function($query) {
                            $query->where('permission->LISTA', true)
                                  ->orWhere('permission->GERA', true);
                        })
                        ->exists();
                        
                } elseif ($driver === 'sqlsrv') {
                    $permissionrole = Permissionsrole::where('permissions_id', $perm->id)
                        ->whereIn('roles_id', $myroles)
                        ->where(function ($query) {
                            $query->whereRaw("JSON_VALUE(permission, '$.LISTA') = 'true'")
                                ->orWhereRaw("JSON_VALUE(permission, '$.GERA') = 'true'");
                        })
                        ->exists();
                } else {
				// Lidar com outros bancos de dados, se necessário
				return false;
			}
            // dd($permissionrole);
			return $permissionrole;
		}
    
        // if (!empty($myroles)) {
        //     $permissionrole = Permissionsrole::where('permissions_id', $perm->id)
        //         ->whereIn('roles_id', $myroles)
        //         ->whereJsonContains('permission->LISTA', true)
        //         ->exists();
    
        //     return $permissionrole;
        // }
        return false;
    }


    public static function validaMenuNameController($menu, $user){
        $perm = Permission::where('nome', '=', 'lista_' . strtolower($menu) . '')->first();
        if ($perm) {
            if ($user) {

                $myroles = Roleusuario::where(array('usuarios_id' => $user->id))->get();
                $_id = array();
                foreach($myroles as $role) {
                    $_id[] = $role->roles_id;
                    unset($role);
                }

                if (sizeof($_id) > 0) {
                    $permissionrole = Permissionsrole::where(array('permissions_id' => $perm->id))->whereIn('roles_id',$_id)->get();
                    if ($permissionrole) {
                        foreach($permissionrole as $pe){
                            $permission = json_decode($pe->permission);
                            if ($permission->LISTA == true) {
                                return true;
                                break;
                            }
                            unset($pe);
                        }
                    }
                }
            }
        } 
        return false;
    }

    public static function validaMenuNameJsonController($menu, $user){
        $perm = Permission::where('nome', '=', 'lista_' . strtolower($menu) . '')->first();
        if ($perm) {
            if ($user) {

                $myroles = Roleusuario::where(array('usuarios_id' => $user->id))->get();
                $_id = array();
                foreach($myroles as $role) {
                    $_id[] = $role->roles_id;
                    unset($role);
                }

                if (sizeof($_id) > 0) {
                    $permissionrole = Permissionsrole::where(array('permissions_id' => $perm->id))->whereIn('roles_id',$_id)->first();
                    if ($permissionrole) {
                        return $permissionrole->permission;
                    }
                }
            }
        }
        return false;
    }

    public static function validaProcessoController($menu, $user){
        $perm = Permission::where('nome', '=', 'permite_' . strtolower($menu) . '')->first();
        if ($perm) {
            if ($user) {

                $myroles = Roleusuario::where(array('usuarios_id' => $user->id))->get();
                $_id = array();
                foreach($myroles as $role) {
                    $_id[] = $role->roles_id;
                    unset($role);
                }

                if (sizeof($_id) > 0) {
                    $permissionrole = Permissionsrole::where(array('permissions_id' => $perm->id))->whereIn('roles_id',$_id)->get();
                    if ($permissionrole) {
                        foreach($permissionrole as $pe){
                            $permission = json_decode($pe->permission);
                            if ($permission->PERMITE == true) {
                                return true;
                                break;
                            }
                            unset($pe);
                        }
                    }
                }
            }
        } 
        return false;
    }

    public static function validaProcessoJsonController($menu, $user){
        $perm = Permission::where('nome', '=', 'permite_' . strtolower($menu) . '')->first();
        if ($perm) {
            if ($user) {

                $myroles = Roleusuario::where(array('usuarios_id' => $user->id))->get();
                $_id = array();
                foreach($myroles as $role) {
                    $_id[] = $role->roles_id;
                    unset($role);
                }

                if (sizeof($_id) > 0) {
                    $permissionrole = Permissionsrole::where(array('permissions_id' => $perm->id))->whereIn('roles_id',$_id)->first();
                    if ($permissionrole) {
                        return $permissionrole->permission;
                    }
                }
            }
        }
        return false;
    }

    public static function validaRelatorioController($menu, $user){
        $perm = Permission::where('nome', '=', 'gera_' . strtolower($menu) . '')->first();
        
        if ($perm) {
            if ($user) {

                $myroles = Roleusuario::where(array('usuarios_id' => $user->id))->get();
                $_id = array();
                foreach($myroles as $role) {
                    $_id[] = $role->roles_id;
                    unset($role);
                }

                if (sizeof($_id) > 0) {
                    $permissionrole = Permissionsrole::where(array('permissions_id' => $perm->id))->whereIn('roles_id',$_id)->get();
                    if ($permissionrole) {
                        foreach($permissionrole as $pe){
                            $permission = json_decode($pe->permission);
                            if ($permission->GERA == true) {
                                return true;
                                break;
                            }
                            unset($pe);
                        }
                    }
                }
            }
        } 
        return false;
    }

    public static function validaRelatorioJsonController($menu, $user){
        $perm = Permission::where('nome', '=', 'gera_' . strtolower($menu) . '')->first();
        if ($perm) {
            if ($user) {

                $myroles = Roleusuario::where(array('usuarios_id' => $user->id))->get();
                $_id = array();
                foreach($myroles as $role) {
                    $_id[] = $role->roles_id;
                    unset($role);
                }

                if (sizeof($_id) > 0) {
                    $permissionrole = Permissionsrole::where(array('permissions_id' => $perm->id))->whereIn('roles_id',$_id)->first();
                    if ($permissionrole) {
                        return $permissionrole->permission;
                    }
                }
            }
        }
        return false;
    }

}